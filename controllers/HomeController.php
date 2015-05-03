<?php
require_once 'Controller.php';

class HomeController extends Controller {
	private $recordModel;

	/**
	 * Controller construct
	 *
	 * @param unknown $model        	
	 * @param string $action        	
	 * @param unknown $parameters        	
	 */
	public function __construct(CoreModel $userModel, RecordModel $recordModel, $action = null, $parameters) {
		parent::__construct ( $userModel, $action, $parameters );
		
		if ($userModel->isUserLoggedIn () == false) {
			$this->redirect ( "index.php" );
		}
		
		$this->recordModel = $recordModel;
		
		$this->recordModel->setRecordList ( $_SESSION ['user_id'] );
		
		switch ($this->action) {
			case "insertNewRecord" :
				$this->insertNewRecord ( $this->parameters );
				break;
			case "editRecord" :
				$this->editRecord ( $this->parameters );
				break;
			case "deleteRecord" :
				$this->deleteRecord ( $this->parameters );
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
	 * Inserts a new text record for the user
	 *
	 * @param unknown $parameters        	
	 * @return boolean
	 */
	function insertNewRecord($parameters) {
		$recordText = $parameters ['record_text'];
		
		if (! empty ( $recordText )) {
			
			if ($this->recordModel->insertTextRecord ( $_SESSION ['user_id'], mysql_real_escape_string($recordText) )) {
				$this->redirect ( "home.php" );
			}
		}
		
		return (false);
	}

	function editRecord($parameters) {
		$recordId = $parameters ['record_id'];
		$recordText = $parameters ['record_text'];
		
		if (! empty ( $recordText )) {
			
			if ($this->recordModel->editTextRecord ( $recordId, mysql_real_escape_string($recordText) )) {
				$this->redirect ( "home.php" );
			}
		}
		
		return (false);
	}

	function deleteRecord($parameters) {
		$recordId = $parameters ['record_id'];
		
		if ($this->recordModel->deleteTextRecord ( $recordId )) {
			$this->redirect ( "home.php" );
		}
	}

}
?>