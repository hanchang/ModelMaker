<?php
class Admin extends Controller {

	function Admin()
	{
		parent::Controller();	
		$this->lang->load('global');
		$this->load->model('profile_model');
	}
	
	function index() {
		redirect('admin/show_unapproved');
	}
	
	// CMS
	
	function cms() {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$data['content'] = $this->content_model->getAllContent();
			$this->template->load('template', 'admin/cms', $data);
			return;
		}
		else {
			redirect('auth/login');
		}
	}
	
	function updateContent() {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$this->content_model->setContent($this->input->post('key'), $this->input->post('lang'), $this->input->post('value'));
			redirect('admin/cms');
			return;
		}
		else {
			redirect('auth/login');
		}
	}
	
	// Cases
	
	function add_case() {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$data['page'] = 'add_case';
			$this->template->load('template', 'admin/edit-case', $data);
		}
		else {
			redirect('auth/login');
		}	
	}
	
	function edit_case($id) {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$this->load->model('case_model');
			$case = $this->case_model->getCase($id);
			$case->page = 'edit_case';
			
			$case_date = explode('-', $case->case_date);
			$case->case_year = $case_date[0];
			$case->case_month = $case_date[1];
			$case->case_day = $case_date[2];
			
			$case_time = explode(':', $case->case_time);
			$case->case_hour = $case_time[0];
			$case->case_minute = $case_time[1];
			
			$casting_date = explode('-', $case->casting_date);
			$case->casting_year = $casting_date[0];
			$case->casting_month = $casting_date[1];
			$case->casting_day = $casting_date[2];
			
			$casting_time = explode(':', $case->casting_time);
			$case->casting_hour = $casting_time[0];
			$case->casting_minute = $casting_time[1];
			
			$deadline = explode('-', $case->application_deadline);
			$case->deadline_year = $deadline[0];
			$case->deadline_month = $deadline[1];
			$case->deadline_day = $deadline[2];
			
			$this->template->load('template', 'admin/edit-case', $case);
		}
		else {
			redirect('auth/login');
		}	
	}
	
	function update_case() {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$this->load->model('case_model');
			
			$id = $this->input->post('id');
			$data['name'] = $this->input->post('name');
			$data['type'] = $this->input->post('type');
			$data['client'] = $this->input->post('client');
			$data['case_time'] = $this->input->post('case_hour') . ':' . $this->input->post('case_minute');
			$data['case_date'] = $this->input->post('case_year') . '-' . $this->input->post('case_month') . '-' . $this->input->post('case_day');
			$data['location'] = $this->input->post('location');
			$data['models_needed'] = $this->input->post('models_needed');
			$data['payrate'] = $this->input->post('payrate');
			$data['height_req'] = $this->input->post('height_req');
			$data['weight_req'] = $this->input->post('weight_req');
			$data['gender_req'] = $this->input->post('gender_req');
			$data['casting_time'] = $this->input->post('casting_hour') . ':' . $this->input->post('casting_minute');
			$data['casting_date'] = $this->input->post('casting_year') . '-' . $this->input->post('casting_month') . '-' . $this->input->post('casting_day');
			$data['casting_location'] = $this->input->post('casting_location');
			$data['application_deadline'] = $this->input->post('deadline_year') . '-' . $this->input->post('deadline_month') . '-' . $this->input->post('deadline_day');
			$data['details'] = $this->input->post('detais');
			
			// Upload Config
			$upload_config['upload_path'] = 'img/uploads/cases';
			// $upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
			$upload_config['allowed_types'] = 'jpg|jpeg';
			$upload_config['max_size'] = 250;
			$upload_config['overwrite'] = TRUE;
			$this->load->library('upload');
				
			// $upload_config['file_name'] = $this->input->post('photo');
			$this->upload->initialize($upload_config);
			$retval = $this->upload->do_upload('photo');
			
			if (!$retval) {
				$this->session->set_flashdata('error_message', 'Error uploading case photo: ' . $this->upload->display_errors());
			}
			else {
				$upload_data = $this->upload->data();
				$data['photo'] = $upload_config['upload_path'] . '/' . $upload_data['file_name'];
				
				if (!empty($id)) {
					$data['id'] = $id;
					$this->case_model->updateCase($data);
					$this->session->set_flashdata('positive_message', lang('case.updated'));
				}
				else {
					$this->case_model->addCase($data);
					$this->session->set_flashdata('positive_message', lang('case.added'));
				}
			}
			redirect('admin/manage_cases');
		}
		else {
			redirect('auth/login');
		}
	}
	
	function delete_case($case_id) {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$this->load->model('case_model');
			$this->case_model->deleteCase($case_id);
			
			$this->session->set_flashdata('positive_message', lang('case.deleted'));
			
			redirect('admin/manage_cases');
		}
		else {
			redirect('auth/login');
		}
	}
	
	function accept_to_case($user_id, $case_id) {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$this->load->model('case_model');
			if ($this->case_model->acceptToCase($user_id, $case_id)) {
				$this->session->set_flashdata('positive_message', lang('case.model_accepted'));
				redirect('admin/manage_cases');
			}
			else {
				$this->session->set_flashdata('error_message', 'There was an error accepting the model.');
				redirect('admin/manage_cases');
			}
		}
		else {
			redirect('auth/login');
		}
	}
	
	function remove_from_case($user_id, $case_id) {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$this->load->model('case_model');
			if ($this->case_model->removeFromCase($user_id, $case_id)) {
				$this->session->set_flashdata('positive_message', lang('case.model_removed'));
				redirect('admin/manage_cases');
			}
			else {
				$this->session->set_flashdata('error_message', 'There was an error removing the model.');
				redirect('admin/manage_cases');
			}
		}
		else {
			redirect('auth/login');
		}
	}
	
	function manage_cases() {
		$this->load->model('case_model');
		
		$data['current_cases'] = $this->case_model->getCurrentCasesByEventDate();
		foreach ($data['current_cases'] as $c_case) {
			$c_case->applicants = $this->case_model->getApplicantsByCase($c_case->id);
			$c_case->accepted = $this->case_model->getAcceptedByCase($c_case->id);
		}
		
		$data['past_cases'] = $this->case_model->getPastCasesByEventDate();
		foreach ($data['past_cases'] as $p_case) {
			$p_case->applicants = $this->case_model->getApplicantsByCase($p_case->id);
			$p_case->accepted = $this->case_model->getAcceptedByCase($p_case->id);
		}
		$this->template->load('template', 'admin/manage-cases', $data);
	}
	
	// Profiles

	function show_unapproved() {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$data['list'] = $this->profile_model->getAllUnapprovedProfiles();
			$data['title'] = lang('admin.show_unapproved');
			$data['admin_page'] = 'unapproved';
			$this->template->load('template', 'admin/admin-template', $data);
			return;
		}
		else {
			redirect('auth/login');
		}
	}
	
	function show_approved() {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$data['list'] = $this->profile_model->getAllApprovedProfiles();
			$data['title'] = lang('admin.show_approved');
			$data['admin_page'] = 'approved';
			$this->template->load('template', 'admin/admin-template', $data);
			return;
		}
		else {
			redirect('auth/login');
		}
	}
	
	function show_rejected() {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$data['list'] = $this->profile_model->getAllRejectedProfiles();
			$data['title'] = lang('admin.show_rejected');
			$data['admin_page'] = 'rejected';
			$this->template->load('template', 'admin/admin-template', $data);
			return;
		}
		else {
			redirect('auth/login');
		}
	}
	
	function show_all() {
	if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$data['list'] = $this->profile_model->getAllProfiles();
			$data['title'] = lang('admin.show_all');
			$data['admin_page'] = 'all';
			$this->template->load('template', 'admin/admin-template', $data);
			return;
		}
		else {
			redirect('auth/login');
		}
	}
	
	function approve($id) {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$this->profile_model->approveProfile($id);
			redirect('admin');
		}
		else {
			redirect('auth/login');
		}
	}
	
	function unapprove($id) {
		if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$this->profile_model->unapproveProfile($id);
			redirect('admin');
		}
		else {
			redirect('auth/login');
		}
	}
	
	function reject($id) {
	if ($this->tank_auth->get_user_id() && $this->tank_auth->is_admin($this->tank_auth->get_user_id())) {
			$this->profile_model->rejectProfile($id);
			redirect('admin');
		}
		else {
			redirect('auth/login');
		}
	}
}