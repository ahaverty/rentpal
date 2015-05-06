<?php
require_once 'Controller.php';

class RecordController extends Controller {
	private $recordModel;
	private $userId;

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
		$this->userId = $_SESSION ['user_id'];
		
		switch ($this->action) {
			case "insertNewRecord" :
				$this->insertNewRecord ();
				$this->recordModel->setRecordListWithAll ( $this->userId );
				break;
			case "editRecord" :
				$this->editRecord ();
				$this->recordModel->setRecordListWithAll ( $this->userId );
				break;
			case "deleteRecord" :
				$this->deleteRecord ();
				$this->recordModel->setRecordListWithAll ( $this->userId );
				break;
			case "searchRecords" :
				$this->searchRecords ();
				break;
			default :
				$this->recordModel->setRecordListWithAll ( $this->userId );
				break;
		}
	}

	/**
	 * Inserts a new text record for the user
	 *
	 * @param unknown $parameters        	
	 * @return boolean
	 */
	function insertNewRecord() {
		$recordText = $this->parameters ['record_text'];
		
		if (! empty ( $recordText )) {
			
			if ($this->recordModel->insertTextRecord ( $_SESSION ['user_id'], $recordText )) {
				$this->coreModel->setPageAlert ( "success", RECORD_INSERT_SUCCESS );
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
	function editRecord() {
		$recordId = $this->parameters ['record_id'];
		$recordText = $this->parameters ['record_text'];
		
		if (! empty ( $recordText )) {
			if ($this->recordModel->recordAuthenticationFactory->verifyUserOwnsRecord ( $_SESSION ['user_id'], $recordId )) {
				
				if ($this->recordModel->editTextRecord ( $recordId, $recordText )) {
					$this->coreModel->setPageAlert ( "success", RECORD_EDIT_SUCCESS );
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
	function deleteRecord() {
		$recordId = $this->parameters ['record_id'];
		
		if ($this->recordModel->recordAuthenticationFactory->verifyUserOwnsRecord ( $_SESSION ['user_id'], $recordId )) {
			if ($this->recordModel->deleteTextRecord ( $recordId )) {
				$this->coreModel->setPageAlert ( "success", RECORD_DELETE_SUCCESS );
			} else {
				$this->coreModel->setPageAlert ( "danger", RECORD_DELETE_ERROR );
			}
		} else {
			$this->coreModel->setPageAlert ( "danger", RECORD_DELETE_ERROR );
		}
	}

	function searchRecords() {
		$searchQuery = $this->parameters ['record_search_query'];
		
		// TODO implement validation function for search query @alanhave
		if ($this->recordModel->validationFactory->isQueryValid ( $searchQuery )) {
			$this->recordModel->setRecordListWithSearchQuery ( $this->userId, $searchQuery );
		} else {
			$this->coreModel->setPageAlert ( "danger", RECORD_SEARCH_INVALID );
		}
	}

}
?>