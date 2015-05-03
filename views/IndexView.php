<?php

require_once 'View.php';

/**
 * Controls how the coreModel data appears using template files
 *
 * @author Alan
 */
class IndexView extends View {


	/**
	 * Outputs the coreModel data
	 */
	public function output() {
		
		$loginRegisterBox = "";
		$authenticationErrorMessage = "";
		$loginRegisterStatus = "";
		
		// if the user is logged in
		if ($this->coreModel->isUserLoggedIn()) {
			
		} else {
			// if the user is not logged in
			
			$authenticationErrorMessage = "";
			
			// if the authentication failed
			if ($this->coreModel->hasAuthenticationFailed) {
				// set the authentication message from the coreModel
				$authenticationErrorMessage = $this->coreModel->authenticationErrorMessage;
				
				$loginRegisterStatus = "<div class='alert alert-danger' role='alert'>
						<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'>
						</span><span class='sr-only'>Error:</span> " . $authenticationErrorMessage . "</div>";
			}
			
			// reads the login form template into the string
			$loginRegisterBox = file_get_contents ( "templates/pages/front/login_register_form.php", FILE_USE_INCLUDE_PATH );

		}
		
		// include the index template that displays the variables set through the MVC in html form
		include_once 'templates/pages/header.php';
		include_once 'templates/pages/front/front_jumbotron.php';
		include_once 'templates/pages/front/front.php';
		include_once 'templates/pages/footer.php';
	}

}
?>