<?php

class Controller {
	protected $userModel;
	protected $parameters;
	protected $action;

	/**
	 * Controller construct
	 *
	 * @param unknown $model        	
	 * @param string $action        	
	 * @param unknown $parameters        	
	 */
	public function __construct(UserModel $userModel, $action, $parameters) {
		$this->userModel = $userModel;
		$this->parameters = $parameters;
		$this->action = $action;
	}

	protected function redirect($page) {
		$location = $this->userModel->baseUrl . "/" . $page;
		
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
		if ($this->userModel->isUserLoggedIn ())
			$this->userModel->updateLoginStatus ();
	}

	/**
	 * Logout the user
	 */
	function logoutUser() {
		$this->userModel->logoutUser ();
	}

}
?>