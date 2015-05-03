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
		header ( "Location: " . $location );
		exit ();
	}

	/**
	 * Update the header depending on if the user is logged in
	 */
	function updateHeader() {
		if ($this->userModel->isUserLoggedIn())
			$this->userModel->updateUserOptions($_SESSION['username']);
	}

	/**
	 * Logout the user
	 */
	function logoutUser() {
		$this->userModel->logoutUser ();
	}

}
?>