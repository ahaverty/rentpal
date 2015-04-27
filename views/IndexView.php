<?php

require_once 'View.php';

/**
 * Controls how the userModel data appears using template files
 *
 * @author Alan
 */
class IndexView extends View {


	/**
	 * Outputs the userModel data
	 */
	public function output() {
		
		// set variables up from the userModel (for the template)
		$appName = $this->userModel->appName;
		$introMessage = $this->userModel->introMessage;
		$newUserErrorMessage = $this->userModel->newUserErrorMessage;
		$baseUrl = $this->userModel->baseUrl;
		
		$loginRegisterBox = "";
		$authenticationErrorMessage = "";
		$rightBox = "";
		$loginRegisterStatus = "";
		$userStatus = "";
		
		// if the user is logged in
		if ($this->userModel->loginStatusString != null) {
			$loginRegisterBox = "<a href='index.php?action=logout'>" . $this->userModel->loginStatusString . "</a>";
			
			// list of options available to logged in user
			//TODO make dynamic home link !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			$rightBox = "<a href='home.php'>Home</a>";
			
			$userStatus = "<li><a href='home.php'>Logged in as " . $_SESSION['username'] . "</a></li>";
			
		} else {
			// if the user is not logged in
			
			$authenticationErrorMessage = "";
			
			// if the authentication failed
			if ($this->userModel->hasAuthenticationFailed) {
				// set the authentication message from the userModel
				$authenticationErrorMessage = $this->userModel->authenticationErrorMessage;
				
				$loginRegisterStatus = "<div class='alert alert-danger' role='alert'>
						<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'>
						</span><span class='sr-only'>Error:</span> " . $authenticationErrorMessage . "</div>";
			}
			
			
			// reads the login form template into the string
			$loginRegisterBox = file_get_contents ( "templates/login_register_form.php", FILE_USE_INCLUDE_PATH );
			$rightBox = $this->userModel->rightBox;
			
			// reads the input form template file into the string
			$registrationForm = file_get_contents ( './templates/insert_new_user_form.php' );
			
			$confirmationMessage = "";
			
			if (! isset ( $this->userModel->hasRegistrationFailed )) {
				// if the userModel registration boolean is not set
				$rightBox = $registrationForm;
			} else if ($this->userModel->hasRegistrationFailed) {
				// if the registration failed was set to true, then make the right box display error message and the registration field
				$rightBox = $newUserErrorMessage . $registrationForm;
			} else if ($this->userModel->hasRegistrationFailed == false) {
				// if the registration didnt fail then show a confirmation message in the right box
				$confirmationMessage = $this->userModel->signUpConfirmation;
				$rightBox = $confirmationMessage;
			}
		}
		
		// include the index template that displays the variables set through the MVC in html form
		include_once 'templates/header.php';
		include_once 'templates/pages/front_jumbotron.php';
		include_once 'templates/pages/front.php';
		include_once 'templates/footer.php';
	}

}
?>