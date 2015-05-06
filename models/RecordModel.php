<?php
include_once './conf/config.inc.php';
include_once './db/DaoFactory.php';
include_once 'RecordAuthenticationFactory.php';
include_once 'ValidationFactory.php';

/**
 * Model class that defines the data used in the View and Controller classes
 */
class RecordModel {
	private $recordList = "";
	private $textRecordDao;
	public $recordAuthenticationFactory;
	public $validationFactory;

	/**
	 * Construct for Model class for setting up variables and factories.
	 */
	public function __construct() {
		$this->daoFactory = new DaoFactory ();
		$this->daoFactory->initDbResources ();
		$this->textRecordDao = $this->daoFactory->getTextRecordDao ();
		$this->recordAuthenticationFactory = new RecordAuthenticationFactory ( $this->textRecordDao );
		$this->validationFactory = new ValidationFactory ();
	}

	/**
	 * Set the user's list of records by retrieving all records from the database
	 *
	 * @param unknown $appUserId        	
	 */
	public function setRecordListWithAll($appUserId) {
		$this->recordList = $this->textRecordDao->getAllRecordsForUser ( $appUserId );
	}

	/**
	 * Set the record list to the results of the search
	 * 
	 * @param unknown $appUserId        	
	 * @param unknown $searchQuery        	
	 */
	public function setRecordListWithSearchQuery($appUserId, $searchQuery) {
		$this->recordList = $this->textRecordDao->getFilteredRecordsForUser ( $appUserId, mysql_escape_string ( $searchQuery ) );
	}

	/**
	 * Return the models list of records
	 *
	 * @return string
	 */
	public function getRecordList() {
		return $this->recordList;
	}

	/**
	 * Inserts a text record for a provided user id
	 *
	 * @param unknown $appUserId        	
	 * @param unknown $recordText        	
	 */
	public function insertTextRecord($appUserId, $recordText) {
		return $this->textRecordDao->insertNewRecord ( $appUserId, mysql_escape_string ( $recordText ) );
	}

	/**
	 * Updates an existing text record
	 *
	 * @param unknown $recordId        	
	 * @param unknown $recordText        	
	 */
	public function editTextRecord($recordId, $recordText) {
		return $this->textRecordDao->editRecord ( $recordId, mysql_escape_string ( $recordText ) );
	}

	/**
	 * Delete a text record by the record Id
	 *
	 * @param unknown $recordId        	
	 */
	public function deleteTextRecord($recordId) {
		return $this->textRecordDao->deleteRecord ( $recordId );
	}

	public function __destruct() {
		$this->daoFactory->clearDbResources ();
	}

}
?>