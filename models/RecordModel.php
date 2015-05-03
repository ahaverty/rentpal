<?php

include_once './conf/config.inc.php';
include_once './db/DaoFactory.php';

/**
 * Model class that defines the data used in the View and Controller classes
 */
class RecordModel {
	
	public $recordList = "";
	private $textRecordDao;

	/**
	 * Construct for Model class for setting up variables and factories.
	 */
	public function __construct() {
		$this->daoFactory = new DaoFactory ();
		$this->daoFactory->initDbResources ();
		$this->textRecordDao = $this->daoFactory->getTextRecordDao ();
	}

	public function setRecordList($appUserId) {
		$this->recordList = $this->textRecordDao->getAllRecordsForUser($appUserId);
	}
	
	public function insertTextRecord($appUserId, $recordText) {
		return $this->textRecordDao->insertNewRecord($appUserId, $recordText);
	}
	
	public function editTextRecord($recordId, $recordText) {
		return $this->textRecordDao->editRecord($recordId, $recordText);
	}
	
	public function deleteTextRecord($recordId) {
		return $this->textRecordDao->deleteRecord($recordId);
	}

	public function __destruct() {
		$this->daoFactory->clearDbResources ();
	}

}
?>