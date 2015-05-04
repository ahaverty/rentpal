<?php
require_once 'View.php';

/**
 * Controls how the index page is outputted
 *
 * @author Alan
 */
class IndexView extends View {

	/**
	 * Outputs the index page
	 */
	public function output() {
		$loginRegisterBox = "";
		$loginRegisterAlert = "";
		
		if ($this->coreModel->isUserLoggedIn () == false) {

			$loginRegisterAlert = $this->coreModel->getLoginRegisterAlert();
			
			// reads the login form template into the string
			$loginRegisterBox = file_get_contents ( "templates/pages/front/login_register_form.php", FILE_USE_INCLUDE_PATH );
		}
		
		include_once 'templates/pages/header.php';
		include_once 'templates/pages/front/front_jumbotron.php';
		include_once 'templates/pages/front/front.php';
		include_once 'templates/pages/footer.php';
	}

}
?>