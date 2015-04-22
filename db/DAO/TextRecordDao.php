<?php
require_once ("BaseDao.php");

class TextRecordDao extends BaseDao {
	private $table_TextRecord = "text_record";
	private $col_recordId = "record_id";
	private $col_appUserId = "app_user_id";
	private $col_timestamp = "timestamp";
	private $col_text = "text";

	function __construct($dbMng) {
		parent::__construct ( $dbMng );
	}

	/**
	 * Checks if a record exists in the database
	 *
	 * @param string $recordId        	
	 * @return boolean
	 */
	public function isRecordExisting($recordId) {
		$sqlQuery = "SELECT count(*) as isExisting ";
		$sqlQuery .= "FROM $this->table_TextRecord ";
		$sqlQuery .= "WHERE $this->col_recordId='$recordId' ";
		$result = $this->dbManager->executeSelectQuery ( $sqlQuery );
		
		if ($result [0] ["isExisting"] == 1)
			return (true);
		else
			return (false);
	}


	public function getRecordForUser($appUserId, $recordId) {
		
		$record = NULL;
		
		$sqlQuery = "SELECT * ";
		$sqlQuery .= "FROM $this->table_TextRecord ";
		$sqlQuery .= "WHERE $this->col_appUserId='$appUserId' ";
		$sqlQuery .= "AND $this->col_recordId='$recordId' ";
		
		$result = $this->dbManager->executeSelectQuery ( $sqlQuery );
		
		if ($result != NULL) {
			$record = $result;
		}
		return ($record);
	}
	

	public function getAllRecordsForUser($appUserId) {
	
		$record = NULL;
	
		$sqlQuery = "SELECT * ";
		$sqlQuery .= "FROM $this->table_TextRecord ";
		$sqlQuery .= "WHERE $this->col_appUserId='$appUserId' ";
	
		$result = $this->dbManager->executeSelectQuery ( $sqlQuery );
	
		if ($result != NULL) {
			$record = $result;
		}
		return ($record);
	}


	/**
	 * Insert a new text record
	 * @param unknown $appUserId
	 * @param unknown $text
	 * @return unknown
	 */
	public function insertNewRecord($appUserId, $text) {
		$sqlQuery = "INSERT INTO $this->table_AppUser ($this->col_appUserId, $this->col_text) ";
		$sqlQuery .= "VALUES ('$appUserId', '$text') ";
		$result = $this->dbManager->executeQuery ( $sqlQuery );
		return $result;
	}

}
?>