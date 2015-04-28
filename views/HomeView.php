<?php
require_once 'View.php';

/**
 * Controls how the model data appears using template files
 *
 * @author Alan
 */
class HomeView extends View {
	private $recordModel;

	public function __construct($controller, $userModel, $recordModel) {
		parent::__construct ( $controller, $userModel );
		$this->recordModel = $recordModel;
	}

	/**
	 * Outputs the model data
	 */
	public function output() {
		
		// set variables up from the model (for the template)
		$appName = $this->userModel->appName;
		$baseUrl = $this->userModel->baseUrl;
		
		$recordList = $this->recordModel->recordList;
		//$recordsHtml = "";
		$articlesHtml = "";
		
		if(isset($recordList)) {
			
			//$recordsHtml .= "<table class='text-record-table'>";
			
			$article_template = file_get_contents ( './templates/pages/home/article_template.php' );
			
			foreach ( $recordList as $record ) {
// 				$recordsHtml .= "<tr>";
// 				$recordsHtml .= "<td nowrap>" . date_format(new DateTime($record['timestamp']), 'Y-m-d H:i') . "</td>";
// 				$recordsHtml .= "<td>" . $record['text'] . "</td>";
// 				$recordsHtml .= "</tr>";
				
				$articleWithHeader = str_replace("<HEADER_HOLDER>", date_format(new DateTime($record['timestamp']), 'Y-m-d H:i'), $article_template);
				$articleWithBody = str_replace("<BODY_HOLDER>", $record['text'], $articleWithHeader);
				$articlesHtml .= $articleWithBody;
			}
			
			//$recordsHtml .= "</table>";
			
		} else{
			$recordsHtml = "No records found.";
		}
		
		$loginBox = "";
		$authenticationErrorMessage = "";
		$loginBox = "<a href='index.php?action=logout'>" . $this->userModel->loginStatusString . "</a>";
		$userStatus = "<li><a href='home.php'>Logged in as " . $_SESSION['username'] . "</a></li>";
		
		include_once 'templates/header.php';
		include_once 'templates/pages/home/insert_new_record.php';
		include_once 'templates/pages/home/record_list.php';
		include_once 'templates/footer.php';
	}

}
?>