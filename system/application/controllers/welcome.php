<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
		$this->lang->load('global');
	}
	
	function index()
	{
		$this->load->model('profile_model');
		$data['recent_profiles'] = $this->profile_model->getRecentProfiles();
		$this->template->load('template', 'welcome_message', $data);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
