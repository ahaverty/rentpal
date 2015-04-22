<?php

class Controller {
	protected $model;
	protected $parameters;
	protected $action;

	/**
	 * Controller construct
	 *
	 * @param unknown $model        	
	 * @param string $action        	
	 * @param unknown $parameters        	
	 */
	public function __construct($model, $action, $parameters) {
		$this->model = $model;
		$this->parameters = $parameters;
		$this->action = $action;
	}

	protected function redirect($page) {
		$location = "http://" . $this->model->baseUrl . "/" . $page;
		
		/*
		 * Use @header to redirect the page:
		 */
		header ( "Location: " . $location );
		exit ();
	}

	/**
	 * Update the header messages
	 */
	function updateHeader() {
		if ($this->model->isUserLoggedIn ())
			$this->model->updateLoginStatus ();
	}

	/**
	 * Logout the user
	 */
	function logoutUser() {
		$this->model->logoutUser ();
	}

}
?>