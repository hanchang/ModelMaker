<?php
class Search extends Controller {

	function Search()
	{
		parent::Controller();	
		$this->lang->load('global');
		$this->load->model('users');
	}

	function index() {
		$this->template->load('template', 'search/search_form');
	}
	
	function results() {
		$this->load->model('search_model');

		$something = false;
		foreach ($_POST as $criteria) {
			if (!empty($criteria)) {
				$something = true;
				break;
			}
		}
		
		if ($something) {
			$result = array('results' => $this->search_model->search($_POST));
			$this->template->load('template', 'search/search_results', $result);
		}
		else {
			$data = array('error' => lang('search.no_criteria'));
			$this->template->load('template', 'search/search_form', $data);
		}
	}
}