<?php

class About extends Controller {

	function About()
	{
		parent::Controller();	
		$this->lang->load('global');
	}
	
	function index()
	{
		$this->template->load('template', 'about'); //, $data);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
