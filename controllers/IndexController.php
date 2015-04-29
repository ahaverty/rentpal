<?php
require_once 'Controller.php';

class IndexController extends Controller {

	/**
	 * Controller construct
	 *
	 * @param unknown $model        	
	 * @param string $action        	
	 * @param unknown $parameters        	
	 */
	public function __construct($userModel, $action = null, $parameters) {
		parent::__construct ( $userModel, $action, $parameters );
		
		switch ($this->action) {
			case "insertNewUser" :
				$this->insertNewUser ( $this->parameters );
				break;
			case "loginUser" :
				$this->loginUser ( $this->parameters );
				break;
			case "logout" :
				$this->logoutUser ();
				break;
			default :
				break;
		}
		
		$this->updateHeader ();
	}

	/**
	 * Validate the input parameters, and if successful, and user does not exist,
	 * insert the new user in the database
	 *
	 * @param : $parameters
	 *        	- array containing the parameters to be validated
	 */
	function insertNewUser($parameters) {
		$email = $parameters ["fEmail"];
		$username = $parameters ["fUsername"];
		$password = $parameters ["fPassword"];
		
		if (! empty ( $username ) && ! empty ( $password ) && ! empty ( $email )) {
			if ($this->userModel->validationFactory->isLengthStringValid ( $username, NEW_USER_FORM_MAX_USERNAME_LENGTH ) && $this->userModel->validationFactory->isLengthStringValid ( $password, NEW_USER_FORM_MAX_PASSWORD_LENGTH ) && $this->userModel->validationFactory->isEmailValid ( $email )) {
				
				if (! $this->userModel->authenticationFactory->isUserExisting ( $username )) {
					$hashedPassword = $this->userModel->authenticationFactory->getHashValue ( $password );
					if ($this->userModel->insertNewUser ( $username, $hashedPassword, $email )) {
						$this->userModel->hasRegistrationFailed = false;
						$this->userModel->setConfirmationMessage ();
						return (true);
					}
				} else
					$this->userModel->setUpNewUserError ( NEW_USER_FORM_EXISTING_ERROR_STR );
			} else
				$this->userModel->setUpNewUserError ( NEW_USER_FORM_ERRORS_STR );
		} else
			$this->userModel->setUpNewUserError ( NEW_USER_FORM_ERRORS_COMPULSORY_STR );
		
		$this->userModel->hasRegistrationFailed = true;
		$this->userModel->updateLoginErrorMessage ();
		return (false);
	}

	/**
	 * Validate the input parameters, and if successful, authenticate the user.
	 * If authentication process is ok, login the user.
	 *
	 * @param : $parameters
	 *        	- array containing the parameters to be validated.
	 *        	This is the $_REQUEST super global array.
	 */
	function loginUser($parameters) {
		$username = $parameters ["fUser"];
		$password = $parameters ["fPassword"];
		
		if (! (empty ( $username ) && empty ( $password ))) {
			if ($this->userModel->validationFactory->isLengthStringValid ( $username, NEW_USER_FORM_MAX_USERNAME_LENGTH ) && $this->userModel->validationFactory->isLengthStringValid ( $password, NEW_USER_FORM_MAX_PASSWORD_LENGTH )) {
				
				$databaseHashedPassword = $this->userModel->getUserPasswordDigest ( $username );
				$userHashedPassword = $this->userModel->authenticationFactory->getHashValue ( $password );
				if ($databaseHashedPassword == $userHashedPassword) {
					$userId = $this->userModel->getUserId ( $username );
					$this->userModel->loginUser ( $userId, $username );
					$this->userModel->updateLoginStatus ();
					$this->userModel->hasAuthenticationFailed = false;
					
					$this->redirect ( "home.php" );
				}
			}
		}
		$this->userModel->updateLoginErrorMessage ();
		$this->userModel->hasAuthenticationFailed = true;
		return;
	}

}
?>