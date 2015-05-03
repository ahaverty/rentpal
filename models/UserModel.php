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
class UserModel {
	
	// factories
	public $daoFactory;
	public $validationFactory;
	public $authenticationFactory;
	
	// DAOs
	private $appUserDao;
	private $textRecordDao;
	
	// strings
	public $appName = "";
	public $introMessage = "";
	public $loginStatusString = "";
	public $rightBox = "";
	public $signUpConfirmation = "";
	public $baseUrl = "";
	public $userOptions = "<li class='dropdown'><a href='index.php'>Login or Register</a></li>";
	
	// error messages
	public $newUserErrorMessage = "";
	public $authenticationErrorMessage = "";
	
	// control variables
	public $hasAuthenticationFailed = false;
	public $hasRegistrationFailed = null;

	/**
	 * Construct for Model class for setting up variables and factories.
	 */
	public function __construct() {
		$this->daoFactory = new DaoFactory ();
		$this->daoFactory->initDbResources ();
		$this->appUserDao = $this->daoFactory->getAppUserDao ();
		$this->textRecordDao = $this->daoFactory->getTextRecordDao ();
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

	public function setUpNewUserError($errorString) {
		$this->newUserErrorMessage = "<div class='alert alert-error'>" . $errorString . "</div>";
	}

	public function updateUserOptions($username) {
		$this->userOptions =	"<a href='#' class='dropdown-toggle' data-toggle='dropdown'>" . $username . "<span class='caret'></span></a>
								<ul class='dropdown-menu' role='menu'>
									<li>
										<a href='index.php?action=logout'>
											Logout
										</a>
									</li>
								</ul>";
	}

	public function updateLoginErrorMessage() {
		$this->authenticationErrorMessage = LOGIN_USER_FORM_AUTHENTICATION_ERROR;
		$this->loginStatusString = "";
	}

	public function setConfirmationMessage() {
		$this->signUpConfirmation = "<div class='alert alert-success'>" . NEW_USER_FORM_REGISTRATION_CONFIRMATION_STR . "</div>";
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