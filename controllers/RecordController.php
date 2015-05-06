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
	public function __construct(CoreModel $coreModel, RecordModel $recordModel, $parameters) {
		parent::__construct ( $coreModel, $parameters );
		
		if ($this->coreModel->isUserLoggedIn () == false) {
			// if the user is not logged in, set the session var with
			// a warning message and redirect the user to the index page
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
				// set the session var with the success message and redirect the page to refresh content
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
			if ($this->recordModel->verifyUserOwnsRecord ( $_SESSION ['user_id'], $recordId )) {
				
				if ($this->recordModel->editTextRecord ( $recordId, $recordText )) {
					$this->setSessionMessageAlert ( "success", RECORD_EDIT_SUCCESS );
					$this->redirect ( "records.php" );
				} else {
					$this->coreModel->setPageAlert ( "danger", RECORD_EDIT_ERROR );
				}
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
		
		$recordId = $parameters ['record_id'];
		
		if ($this->recordModel->verifyUserOwnsRecord ( $_SESSION ['user_id'], $recordId )) {
			if ($this->recordModel->deleteTextRecord ( $recordId )) {
				$this->setSessionMessageAlert ( "success", RECORD_DELETE_SUCCESS );
				$this->redirect ( "records.php" );
			} else {
				$this->coreModel->setPageAlert ( "danger", RECORD_DELETE_ERROR );
			}
		} else {
			$this->coreModel->setPageAlert ( "danger", RECORD_DELETE_ERROR );
		}
	}

}
?>