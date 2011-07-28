<?php

class Cases extends Controller {

	function Cases()
	{
		parent::Controller();	
		$this->lang->load('global');
		$this->load->model('case_model');
	}
	
	function index() {
		$user_id = $this->tank_auth->get_user_id();
		$data['user_id'] = $user_id;
		
		$data['accepted_cases'] = array();
		$data['my_cases'] = array();
		
		if ($user_id !== FALSE) {
			$data['accepted_cases'] = $this->case_model->getMyAcceptedCases($user_id);
			$data['my_cases'] = $this->case_model->getMyAppliedCases($user_id);
		}
		
		$data['upcoming_cases'] = $this->case_model->getCurrentCasesByEventDate(10);
		$data['past_cases'] = $this->case_model->getPastCasesByEventDate(10);
		
		$this->template->load('template', 'cases/index', $data);
		return;
	}
	
	function apply($case_id) {
		$user_id = $this->tank_auth->get_user_id();
		if ($user_id === FALSE) {
			redirect("auth/login");
			return;
		}
		$this->case_model->applyToCase($user_id, $case_id);
		$this->session->set_flashdata('positive_message', lang('case.applied_successfully'));
		redirect('auth/cp');
	}
	
	function unapply($case_id) {
		$user_id = $this->tank_auth->get_user_id();
		if ($user_id === FALSE) {
			redirect("auth/login");
			return;
		}
		$this->case_model->unapplyFromCase($user_id, $case_id);
	}
	
	function model_accepted($id) {
		// ADMIN ONLY
	}
}