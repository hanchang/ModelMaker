<?php
class Portfolio extends Controller {

	function Portfolio()
	{
		parent::Controller();	
		$this->lang->load('global');
	}

	function index() {
		$this->template->load('template', 'portfolio');
	}
}