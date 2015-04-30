<?php
require_once 'View.php';

class HomeView extends View {
	private $recordModel;

	public function __construct($controller, $userModel, $recordModel) {
		parent::__construct ( $controller, $userModel );
		$this->recordModel = $recordModel;
	}

	public function output() {
		
		// set variables up from the model (for the template)
		$appName = $this->userModel->appName;
		$baseUrl = $this->userModel->baseUrl;
		
		$recordList = $this->recordModel->recordList;
		$articlesHtml = "";
		
		$article_template = file_get_contents ( './templates/pages/home/article_template.php' );
		$start = array (
				"{{ header }}",
				"{{ body }}" 
		);
		
		if (isset ( $recordList )) {
			
			foreach ( $recordList as $record ) {
				
				$recordTime = new DateTime ( $record ['timestamp'] );
				$recordText = $record ['text'];
				
				$replace = array (
						date_format ( $recordTime, 'Y-m-d H:i' ),
						$recordText 
				);
				
				$articlesHtml .= str_replace ( $start, $replace, $article_template );
			}
		} else {
			
			//TODO should this be done in the controller? @alanhave
			
			$replace = array (
					date ( 'Y-m-d H:i' ),
					"Emailed the landlord today about the water leak above the apartment. This is an example record that will dissapear after creating a new record." 
			);
			
			$articlesHtml .= str_replace ( $start, $replace, $article_template );
		}
		
		$loginBox = "";
		$authenticationErrorMessage = "";
		$loginBox = "<a href='index.php?action=logout'>" . $this->userModel->loginStatusString . "</a>";
		$userStatus = "<li><a href='home.php'>Logged in as " . $_SESSION ['username'] . "</a></li>";
		
		include_once 'templates/header.php';
		include_once 'templates/pages/home/insert_new_record.php';
		include_once 'templates/pages/home/record_list.php';
		include_once 'templates/footer.php';
	}

}
?>