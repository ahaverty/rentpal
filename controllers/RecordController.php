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
			$this->setSessionMessageAlert ( "warning", NOT_LOGGED_IN );
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
			
			if ($this->recordModel->insertTextRecord ( $_SESSION ['user_id'], $recordText )) {
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

	/**
	 * Edit an existing record with the provided text and record_id
	 * 
	 * @param unknown $parameters        	
	 * @return boolean
	 */
	function editRecord($parameters) {
		$recordId = $parameters ['record_id'];
		$recordText = $parameters ['record_text'];
		
		if (! empty ( $recordText )) {
			
			if ($this->recordModel->editTextRecord ( $recordId, $recordText )) {
				$this->setSessionMessageAlert ( "success", RECORD_EDIT_SUCCESS );
				$this->redirect ( "records.php" );
			} else {
				$this->coreModel->setPageAlert ( "danger", RECORD_EDIT_ERROR );
			}
		} else {
			$this->coreModel->setPageAlert ( "danger", RECORD_INSERT_EMPTY );
		}
		
		return (false);
	}

	/**
	 * Delete a record with the provided record_id
	 *
	 * @param unknown $parameters        	
	 */
	function deleteRecord($parameters) {
		
		// TODO Documented that the hidden inputs containing the record_id could potentially be messed with,
		// resulting in any record to be deleted
		$recordId = $parameters ['record_id'];
		
		if ($this->recordModel->deleteTextRecord ( $recordId )) {
			$this->setSessionMessageAlert ( "success", RECORD_DELETE_SUCCESS );
			$this->redirect ( "records.php" );
		} else {
			$this->coreModel->setPageAlert ( "danger", RECORD_DELETE_ERROR );
		}
	}

}
?>