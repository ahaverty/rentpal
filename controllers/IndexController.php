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
	public function __construct($coreModel, $parameters) {
		parent::__construct ( $coreModel, $parameters );
		
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
						
						$this->coreModel->setloginRegisterAlert ( "success", NEW_USER_FORM_REGISTRATION_CONFIRMATION_STR );
						
						// Set the new user with some sample records in the db
						$this->setupSampleRecords($username);
						
						return (true);
					}
				} else {
					
					$this->coreModel->setloginRegisterAlert ( "danger", NEW_USER_FORM_EXISTING_ERROR_STR );
				}
			} else {
				
				$this->coreModel->setloginRegisterAlert ( "danger", NEW_USER_FORM_ERRORS_STR );
			}
		} else {
			
			$this->coreModel->setloginRegisterAlert ( "danger", NEW_USER_FORM_ERRORS_COMPULSORY_STR );
		}
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
					$this->coreModel->loginUser ( $userId, $username );
					
					$this->setSessionMessageAlert ( "success", LOGIN_SUCCESS );
					$this->redirect ( "records.php" );
				}
			}
		}
		$this->coreModel->setloginRegisterAlert ( "danger", LOGIN_USER_FORM_AUTHENTICATION_ERROR );
		return;
	}
	
	/**
	 * Setup sample records for a new registered user
	 */
	private function setupSampleRecords($username) {
		
		// Setup sample records for when a new user first joins
		include "models/RecordModel.php";
		$recordModel = new RecordModel ();
		
		$userId = $this->coreModel->getUserId ( $username );
		
		$recordModel->insertTextRecord ( $userId, DEFAULT_RECORD_1 );
		$recordModel->insertTextRecord ( $userId, DEFAULT_RECORD_2 );
		$recordModel->insertTextRecord ( $userId, DEFAULT_RECORD_3 );
	}

}
?>