<?php
class Models extends Controller {

	function Models()
	{
		parent::Controller();	
		$this->lang->load('global');
		$this->load->model('profile_model');
	}

	function index() {
		$data['results'] = $this->profile_model->getRecentProfiles();
		$this->template->load('template', 'models/models', $data);
	}
}