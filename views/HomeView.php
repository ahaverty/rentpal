<?php

require_once 'View.php';

/**
 * Controls how the model data appears using template files
 *
 * @author Alan
 */
class HomeView extends View {


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
			
			// list of options available to logged in user
			$rightBox = "list of options for logged in user: to update";
		} else {
		}
		
		
		
		$recordList = "";
		
		include_once 'templates/header.php';
		include_once 'templates/pages/home/record_list.php';
		include_once 'templates/footer.php';
	}

}
?>