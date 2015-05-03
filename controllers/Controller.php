<?php

/**
 * Base Controller class containing some common functionality.
 * All Controller classes should extend this class.
 * 
 * @author Alan
 *        
 */
class Controller {
	protected $coreModel;
	protected $parameters;
	protected $action;

	/**
	 * Controller construct
	 *
	 * @param unknown $model        	
	 * @param string $action        	
	 * @param unknown $parameters        	
	 */
	public function __construct(CoreModel $coreModel, $action, $parameters) {
		$this->coreModel = $coreModel;
		$this->parameters = $parameters;
		$this->action = $action;
		
		switch ($this->action) {
			case "logout" :
				$this->logoutUser ();
				break;
			default :
				break;
		}
		
		$this->updateHeader();
		
	}

	/**
	 *
	 * @param unknown $page        	
	 */
	protected function redirect($page) {
		$location = $this->coreModel->baseUrl . "/" . $page;
		header ( "Location: " . $location );
		exit ();
	}

	/**
	 * Update the header depending on if the user is logged in
	 */
	function updateHeader() {
		if ($this->coreModel->isUserLoggedIn ()) {
			$this->coreModel->updateUserOptions ( $_SESSION ['username'] );
		}
	}

	/**
	 * Logout the user
	 */
	function logoutUser() {
		$this->coreModel->logoutUser ();
	}

}
?>