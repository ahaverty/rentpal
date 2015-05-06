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
	 * Controller construct for common actions and updating the header navigation with user details.
	 *
	 * @param CoreModel $coreModel        	
	 * @param unknown $action        	
	 * @param unknown $parameters        	
	 */
	public function __construct(CoreModel $coreModel, $parameters) {
		$this->coreModel = $coreModel;
		$this->parameters = $parameters;
		
		if (! empty ( $_REQUEST ['action'] )) {
			$this->action = $_REQUEST ['action'];
		} else {
			$this->action = "";
		}
		
		$this->getMessageAlertFromSession ();
		
		switch ($this->action) {
			case "logout" :
				$this->logoutUser ();
				break;
			default :
				break;
		}
		
		$this->updateHeader ();
	}

	/**
	 * Redirects to the provided page
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
		$this->coreModel->setPageAlert ( "success", LOGOUT_SUCCESS );
	}

	/**
	 * Set the message alert through the $_SESSION variable due to the way some pages save and redirects to refresh content.
	 *
	 * @param string $category        	
	 * @param unknown $message        	
	 */
	protected function setSessionMessageAlert($category = "default", $message) {
		$_SESSION ['alert_message_category'] = $category;
		$_SESSION ['alert_message'] = $message;
	}

	/**
	 * Extracts an alert message and category from the $_SESSION variable and sets the model page alert with it.
	 * Necessary due to how the some pages handle redirects to refresh content.
	 */
	protected function getMessageAlertFromSession() {
		if (isset ( $_SESSION ['alert_message'] )) {
			
			$recordCategory = "default";
			
			if (isset ( $_SESSION ['alert_message_category'] )) {
				$recordCategory = $_SESSION ['alert_message_category'];
			}
			
			// set the coremodel with the message
			$this->coreModel->setPageAlert ( $recordCategory, $_SESSION ['alert_message'] );
			
			// unset the session variable record messages after using
			unset ( $_SESSION ['alert_message_category'] );
			unset ( $_SESSION ['alert_message'] );
		}
	}

}
?>