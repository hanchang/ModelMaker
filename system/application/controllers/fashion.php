<?php
class Fashion extends Controller {

	function Fashion()
	{
		parent::Controller();	
		$this->lang->load('global');
	}

	function index() {
		$this->template->load('template', 'fashion');
	}
}