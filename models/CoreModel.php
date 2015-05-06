<?php

/*
 * Include the files needed for the model class
 */
include_once './conf/config.inc.php';
include_once './db/DaoFactory.php';
include_once 'ValidationFactory.php';
include_once 'CoreAuthenticationFactory.php';

/**
 * Model class that defines the data used in the View and Controller classes
 */
class CoreModel {
	
	// factories
	public $daoFactory;
	public $validationFactory;
	public $coreAuthenticationFactory;
	
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
		$this->coreAuthenticationFactory = new CoreAuthenticationFactory ( $this->appUserDao );
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
		$this->coreAuthenticationFactory->loginUser ( $userID, $username );
	}

	/**
	 * Gets the hashed password from the database
	 *
	 * @param string $username        	
	 * @return NULL
	 */
	public function getUserPasswordDigest($username) {
		return ($this->appUserDao->getUserPasswordDigest ( $username ));
	}

	/**
	 * Gets the corrosponding user id for the provided username
	 *
	 * @param unknown $username        	
	 * @return boolean
	 */
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

	/**
	 * Adds to the page alert string with a default category of "default" if one is not provided.
	 *
	 * @param string $category        	
	 * @param string $message        	
	 */
	public function setPageAlert($category = "default", $message = "") {
		$this->pageAlert .= $this->createAlertMessage ( $category, $message );
	}

	/**
	 * Retrieves the page alert message
	 */
	public function getPageAlert() {
		return $this->pageAlert;
	}

	/**
	 * Adds to the login/register alert message
	 *
	 * @param string $category        	
	 * @param string $message        	
	 */
	public function setloginRegisterAlert($category = "default", $message = "") {
		$this->loginRegisterAlert .= $this->createAlertMessage ( $category, $message );
	}

	/**
	 * Retrieves the login/register alert message
	 *
	 * @return string
	 */
	public function getLoginRegisterAlert() {
		return $this->loginRegisterAlert;
	}

	/**
	 * Set the user options with the username and the template file
	 * 
	 * @param unknown $username        	
	 */
	public function updateUserOptions($username) {
		$userOptionsTemplate = file_get_contents ( "templates/pages/user_options_template.php", FILE_USE_INCLUDE_PATH );
		$this->userOptions = str_replace ( "{{ username }}", $username, $userOptionsTemplate );
	}

	/**
	 * Inserts a new user
	 * @param unknown $username
	 * @param unknown $hashedPassword
	 * @param unknown $email
	 * @return string
	 */
	public function insertNewUser($username, $hashedPassword, $email) {
		return ($this->appUserDao->insertNewUser ( $username, $hashedPassword, $email ));
	}

	/**
	 * Logs out a user using the authentication factory
	 */
	public function logoutUser() {
		$this->coreAuthenticationFactory->logoutUser ();
	}

	/**
	 * Checks if a user is logged in using the authentication factory
	 */
	public function isUserLoggedIn() {
		return ($this->coreAuthenticationFactory->isUserLoggedIn ());
	}

	public function __destruct() {
		$this->daoFactory->clearDbResources ();
	}

}
?>