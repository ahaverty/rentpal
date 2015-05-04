<?php

/*
 * Include the files needed for the model class
 */
include_once './conf/config.inc.php';
include_once './db/DaoFactory.php';
include_once 'ValidationFactory.php';
include_once 'AuthenticationFactory.php';

/**
 * Model class that defines the data used in the View and Controller classes
 */
class CoreModel {
	
	// factories
	public $daoFactory;
	public $validationFactory;
	public $authenticationFactory;
	
	// DAOs
	private $appUserDao;
	
	// strings
	public $appName = "";
	public $baseUrl = "";
	
	// Alert messages
	public $pageAlert = "";
	public $loginRegisterAlert = "";
	
	// Site components
	public $userOptions = "<li class='dropdown'><a href='index.php'>Login or Register</a></li>";
	
	

	/**
	 * Construct for Model class for setting up variables and factories.
	 */
	public function __construct() {
		$this->daoFactory = new DaoFactory ();
		$this->daoFactory->initDbResources ();
		$this->appUserDao = $this->daoFactory->getAppUserDao ();
		$this->authenticationFactory = new AuthenticationFactory ( $this->appUserDao );
		$this->validationFactory = new ValidationFactory ();
		$this->appName = APP_NAME;
		$this->baseUrl = "http://" . BASE_URL;
	}

	/**
	 * Logs a user in
	 *
	 * @param int $userID        	
	 * @param string $username        	
	 */
	public function loginUser($userID, $username) {
		$this->authenticationFactory->loginUser ( $userID, $username );
	}

	/**
	 *
	 * @param string $username        	
	 * @return NULL
	 */
	public function getUserPasswordDigest($username) {
		return ($this->appUserDao->getUserPasswordDigest ( $username ));
	}

	public function getUserId($username) {
		return ($this->appUserDao->getUserId ( $username ));
	}

	/**
	 * Creates the alert message html using the provided category (default, danger, info..) and the message.
	 *
	 * @param string $category        	
	 * @param string $message        	
	 * @return the alert message as html code
	 */
	private function createAlertMessage($category = "default", $message = "") {
		$alertHtmlTemplate = file_get_contents ( "templates/pages/alert_template.php", FILE_USE_INCLUDE_PATH );
		
		$start = array (
				"{{ alertCategory }}",
				"{{ alertMessage }}" 
		);
		
		$replace = array (
				$category,
				$message 
		);
		
		$alertHtml = str_replace ( $start, $replace, $alertHtmlTemplate );
		return $alertHtml;
	}
	
	public function setPageAlert($category = "default", $message = "") {
		$this->pageAlert .= $this->createAlertMessage($category, $message);
	}
	
	public function getPageAlert() {
		return $this->pageAlert;
	}
	
	public function setloginRegisterAlert($category = "default", $message = "") {
		$this->loginRegisterAlert .= $this->createAlertMessage($category, $message);
	}
	
	public function getLoginRegisterAlert() {
		return $this->loginRegisterAlert;
	}

	public function updateUserOptions($username) {
		$this->userOptions = "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>" . $username . "<span class='caret'></span></a>
								<ul class='dropdown-menu' role='menu'>
									<li>
										<a href='index.php?action=logout'>
											Logout
										</a>
									</li>
								</ul>";
	}

	public function insertNewUser($username, $hashedPassword, $email) {
		return ($this->appUserDao->insertNewUser ( $username, $hashedPassword, $email ));
	}

	public function logoutUser() {
		$this->authenticationFactory->logoutUser ();
		$this->loginStatusString = null;
		$this->authenticationErrorMessage = "";
	}

	public function isUserLoggedIn() {
		return ($this->authenticationFactory->isUserLoggedIn ());
	}

	public function __destruct() {
		$this->daoFactory->clearDbResources ();
	}

}
?>