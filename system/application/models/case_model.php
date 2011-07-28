<?php
class Case_model extends Model {

	function Case_model() {
		// Call the Model constructor
		parent::Model();
	}
	
	function getCase($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('cases');
		if ($query->num_rows != 1) {
			return FALSE;
		}
		return $query->row();
	}
	
	function getMyAppliedCases($user_id, $date = 'NOW()') {
		$this->db->where('user_id', $user_id);
		$this->db->join('cases', 'case_models_applied.case_id = cases.id');
		$this->db->order_by('cases.casting_date', 'desc');
		$query = $this->db->get('case_models_applied');
		return $query->result();
	}
	
	function getMyAcceptedCases($user_id, $date = 'NOW()') {
		$this->db->where('user_id', $user_id);
		$this->db->where("cases.case_date > $date");
		$this->db->join('cases', 'case_models_accepted.case_id = cases.id');
		$this->db->order_by('cases.case_date', 'desc');
		$query = $this->db->get('case_models_accepted');
		return $query->result();
	}
	
	function addCase($data) {
		if (empty($data['id']) || $this->getCase($data['id'])->is_empty()) {
			$this->db->insert('cases', $data);
		}
		else {
			updateCase($data);
		}

		if ($this->db->affected_rows() == '1') {
			return TRUE;
		}

		return FALSE;
	}
	
	function updateCase($data) {
		if (!is_numeric($data['id'])) {
			return FALSE;
		}
		
		$case = $this->getCase($data['id']);
		if (empty($case)) {
			return FALSE;
		}
		
		$this->db->where('id', $data['id']);
		return $this->db->update('cases', $data);
	}
	
	function deleteCase($case_id) {
		$this->db->trans_start();
		
		$this->db->where('id', $case_id);
		$query1 = $this->db->delete('cases');
		
		$this->db->where('case_id', $case_id);
		$query2 = $this->db->delete('case_models_applied');
		
		$this->db->where('case_id', $case_id);
		$query3 = $this->db->delete('case_models_accepted');
		
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
	
	function getAllCases() {
		$query = $this->db->get('cases');
		return $query->result();
	}
	
	function getCurrentCasesByEventDate($limit = 0) {
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		
		$where = "case_date > CURDATE()";
		$this->db->where($where);
		$query = $this->db->get('cases');
		return $query->result();
	}
	
	function getCurrentCasesByDeadline($limit = 0) {
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		$where = 'application_deadline < NOW()';
		$this->db->where($where);
		$query = $this->db->get('cases');
		return $query->result();
	}
	
	function getPastCasesByEventDate($limit = 0) {
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		$where = "case_date < CURDATE()";
		$this->db->where($where);
		$query = $this->db->get('cases');
		return $query->result();
	}
	
	function getPastCasesByDeadline($limit = 0) {
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		$where = 'application_deadline < NOW()';
		$this->db->where($where);
		$query = $this->db->get('cases');
		return $query->result();
	}
	
	function applyToCase($user_id, $case_id) {
		$data['user_id'] = $user_id;
		$data['case_id'] = $case_id;
		$this->db->insert('case_models_applied', $data);
		
		if ($this->db->affected_rows() == '1') {
			return TRUE;
		}

		return FALSE;
	}
	
	function unapplyFromCase($model_id, $case_id) {
		$this->db->where('model_id', $model_id);
		$this->db->where('case_id', $case_id);
		return $this->db->delete('case_models_applied');
	}
	
	function acceptToCase($user_id, $case_id) {
		$data['user_id'] = $user_id;
		$data['case_id'] = $case_id;
		
		return $this->db->insert('case_models_accepted', $data);
	}
	
	function removeFromCase($user_id, $case_id) {
		$data['user_id'] = $user_id;
		$data['case_id'] = $case_id;
		
		return $this->db->delete('case_models_accepted', $data);
	}
	
	function getApplicantsByCase($case_id) {
		$this->db->where('case_id', $case_id);
		$this->db->join('profiles', 'case_models_applied.user_id = profiles.id');
		$query = $this->db->get('case_models_applied');
		return $query->result();
	}
	
	function getAcceptedByCase($case_id) {
		$this->db->where('case_id', $case_id);
		$this->db->join('profiles', 'case_models_accepted.user_id = profiles.id');
		$query = $this->db->get('case_models_accepted');
		return $query->result();
	}
}