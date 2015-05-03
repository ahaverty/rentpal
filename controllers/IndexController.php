<?php
require_once 'Controller.php';

class IndexController extends Controller {

	/**
	 * Index Controller construct calls parent construct and delegates action
	 *
	 * @param unknown $model
	 * @param string $action
	 * @param unknown $parameters
	 */
	public function __construct($coreModel, $action = null, $parameters) {
		parent::__construct ( $coreModel, $action, $parameters );
		
		switch ($this->action) {
			case "insertNewUser" :
				$this->insertNewUser ( $this->parameters );
				break;
			case "loginUser" :
				$this->loginUser ( $this->parameters );
				break;
			default :
				break;
		}
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
			if ($this->coreModel->validationFactory->isLengthStringValid ( $username, NEW_USER_FORM_MAX_USERNAME_LENGTH ) && $this->coreModel->validationFactory->isLengthStringValid ( $password, NEW_USER_FORM_MAX_PASSWORD_LENGTH ) && $this->coreModel->validationFactory->isEmailValid ( $email )) {
				
				if (! $this->coreModel->authenticationFactory->isUserExisting ( $username )) {
					$hashedPassword = $this->coreModel->authenticationFactory->getHashValue ( $password );
					if ($this->coreModel->insertNewUser ( $username, $hashedPassword, $email )) {
						$this->coreModel->hasRegistrationFailed = false;
						$this->coreModel->setConfirmationMessage ();
						return (true);
					}
				} else
					$this->coreModel->setUpNewUserError ( NEW_USER_FORM_EXISTING_ERROR_STR );
			} else
				$this->coreModel->setUpNewUserError ( NEW_USER_FORM_ERRORS_STR );
		} else
			$this->coreModel->setUpNewUserError ( NEW_USER_FORM_ERRORS_COMPULSORY_STR );
		
		$this->coreModel->hasRegistrationFailed = true;
		$this->coreModel->updateLoginErrorMessage ();
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
			if ($this->coreModel->validationFactory->isLengthStringValid ( $username, NEW_USER_FORM_MAX_USERNAME_LENGTH ) && $this->coreModel->validationFactory->isLengthStringValid ( $password, NEW_USER_FORM_MAX_PASSWORD_LENGTH )) {
				
				$databaseHashedPassword = $this->coreModel->getUserPasswordDigest ( $username );
				$userHashedPassword = $this->coreModel->authenticationFactory->getHashValue ( $password );
				if ($databaseHashedPassword == $userHashedPassword) {
					$userId = $this->coreModel->getUserId ( $username );
					$this->coreModel->loginUser( $userId, $username );
					$this->coreModel->hasAuthenticationFailed = false;
					
					$this->redirect ( "records.php" );
				}
			}
		}
		$this->coreModel->updateLoginErrorMessage ();
		$this->coreModel->hasAuthenticationFailed = true;
		return;
	}

}
?>