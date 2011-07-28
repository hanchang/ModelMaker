<?php

class Contact extends Controller {

	function Contact()
	{
		parent::Controller();	
		$this->lang->load('global');
	}
	
	function index()
	{
		$this->template->load('template', 'contact'); //, $data);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
