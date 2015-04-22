<?php

require_once 'View.php';

/**
 * Controls how the model data appears using template files
 *
 * @author Alan
 */
class IndexView extends View {


	/**
	 * Outputs the model data
	 */
	public function output() {
		
		// set variables up from the model (for the template)
		$appName = $this->model->appName;
		$introMessage = $this->model->introMessage;
		$newUserErrorMessage = $this->model->newUserErrorMessage;
		
		$loginBox = "";
		$authenticationErrorMessage = "";
		$rightBox = "";
		
		// if the user is logged in
		if ($this->model->loginStatusString != null) {
			$loginBox = "<a href='index.php?action=logout'>" . $this->model->loginStatusString . "</a>";
			
// 			// list of options available to logged in user
// 			$rightBox = "list of options for logged in user: to update";
		} else {
			// if the user is not logged in
			
			$authenticationErrorMessage = "";
			
			// if the authentication failed
			if ($this->model->hasAuthenticationFailed) {
				// set the authentication message from the model
				$authenticationErrorMessage = $this->model->authenticationErrorMessage;
			}
			
			// reads the login form template into the string
			$loginBox = file_get_contents ( "templates/login_form.php", FILE_USE_INCLUDE_PATH );
			$rightBox = $this->model->rightBox;
			
			// reads the input form template file into the string
			$registrationForm = file_get_contents ( './templates/insert_new_user_form.php' );
			
			$confirmationMessage = "";
			
			if (! isset ( $this->model->hasRegistrationFailed )) {
				// if the model registration boolean is not set
				$rightBox = $registrationForm;
			} else if ($this->model->hasRegistrationFailed) {
				// if the registration failed was set to true, then make the right box display error message and the registration field
				$rightBox = $newUserErrorMessage . $registrationForm;
			} else if ($this->model->hasRegistrationFailed == false) {
				// if the registration didnt fail then show a confirmation message in the right box
				$confirmationMessage = $this->model->signUpConfirmation;
				$rightBox = $confirmationMessage;
			}
		}
		
		// include the index template that displays the variables set through the MVC in html form
		include_once 'templates/header.php';
		include_once 'templates/pages/front.php';
		include_once 'templates/footer.php';
	}

}
?>