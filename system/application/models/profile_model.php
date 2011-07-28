<?php
class Profile_model extends Model {

	function Profile_model() {
		// Call the Model constructor
		define('LIMIT', 20);
		parent::Model();
	}
	
	function getProfile($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('profiles');
		if ($query->num_rows != 1) {
			// ERROR!!!
		}
		return $query->row();
	}
	
	function getRecentProfiles($number = 20) {
		$this->db->limit($number);
		$this->db->where('approved', '1');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('profiles');
		return $query->result();
	}

	function addProfile($data) {
		$this->db->insert('profiles', $data);

		if ($this->db->affected_rows() == '1') {
			return TRUE;
		}

		return FALSE;
	}
	
	function updateProfile($data) {
		if (!is_numeric($data['id'])) {
			return FALSE;
		}
		
		$profile = $this->getProfile($data['id']);
		if (empty($profile)) {
			return FALSE;
		}
		
		$this->db->where('id', $data['id']);
		return $this->db->update('profiles', $data);
	}
	
	// Admin Functionality
	
	function getAllProfiles() {
		$query = $this->db->get('profiles');
		return $query->result();
	}
	
	function getAllApprovedProfiles($limit = LIMIT) {
		$this->db->where('approved', 1);
		$this->db->limit($limit);
		$query = $this->db->get('profiles');
		return $query->result();
	}
	
	function getAllUnapprovedProfiles($limit = LIMIT) {
		$this->db->where('approved', 0);
		$this->db->limit($limit);
		$query = $this->db->get('profiles');
		return $query->result();
	}
	
	function getAllRejectedProfiles($limit = LIMIT) {
		$this->db->where('approved', -1);
		$this->db->join('users', 'users.id = profiles.id');
		$this->db->limit($limit);
		$query = $this->db->get('profiles');
		return $query->result();
	}
	
	function approveProfile($id) {
		$this->db->where('id', $id);
		$this->db->update('profiles', array('approved' => 1));
	}
	
	function unapproveProfile($id) {
		$this->db->where('id', $id);
		$this->db->update('profiles', array('approved' => 0));
	}
	
	function rejectProfile($id) {
		$this->db->where('id', $id);
		$this->db->update('profiles', array('approved' => -1));
	}
}
