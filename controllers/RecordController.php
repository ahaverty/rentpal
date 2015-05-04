<?php
require_once 'Controller.php';

class RecordController extends Controller {
	private $recordModel;

	/**
	 * RecordsController Construct calls parent construct and controls which action to use.
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
		
		// Retrieve page alert message from the session variable due to how record page redirects after saving
		if (isset ( $_SESSION ['record_message'] )) {
			$recordCategory = "default";
			if (isset ( $_SESSION ['record_message_category'] )) {
				$recordCategory = $_SESSION ['record_message_category'];
			}
			$this->coreModel->setPageAlert ( $recordCategory, $_SESSION ['record_message'] );
			
			// unset the session variable record messages after using
			unset ( $_SESSION ['record_message_category'] );
			unset ( $_SESSION ['record_message'] );
		}
		
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
			default :
				break;
		}
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
			
			if ($this->recordModel->insertTextRecord ( $_SESSION ['user_id'], mysql_escape_string ( $recordText ) )) {
				$this->setSessionMessageAlert ( "success", RECORD_INSERT_SUCCESS );
				$this->redirect ( "records.php" );
			} else {
				$this->coreModel->setPageAlert ( "danger", RECORD_INSERT_ERROR );
			}
		} else {
			$this->coreModel->setPageAlert ( "danger", RECORD_INSERT_EMPTY );
		}
		
		return (false);
	}

	function editRecord($parameters) {
		$recordId = $parameters ['record_id'];
		$recordText = $parameters ['record_text'];
		
		if (! empty ( $recordText )) {
			
			if ($this->recordModel->editTextRecord ( $recordId, mysql_escape_string ( $recordText ) )) {
				$this->setSessionMessageAlert ( "success", RECORD_EDIT_SUCCESS );
				$this->redirect ( "records.php" );
			} else {
				$this->coreModel->setPageAlert("danger", RECORD_EDIT_ERROR);
			}
		} else {
			$this->coreModel->setPageAlert("danger", RECORD_INSERT_EMPTY);
		}
		
		return (false);
	}

	function deleteRecord($parameters) {
		$recordId = $parameters ['record_id'];
		
		if ($this->recordModel->deleteTextRecord ( $recordId )) {
			$this->setSessionMessageAlert ( "success", RECORD_DELETE_SUCCESS );
			$this->redirect ( "records.php" );
		} else {
			$this->coreModel->setPageAlert("danger", RECORD_DELETE_ERROR);
		}
	}

	/**
	 * Set the message alert through the $_SESSION variable due to the way records page saves and redirects to refresh content.
	 * 
	 * @param string $category        	
	 * @param unknown $message        	
	 */
	private function setSessionMessageAlert($category = "default", $message) {
		$_SESSION ['record_message_category'] = $category;
		$_SESSION ['record_message'] = $message;
	}

}
?>