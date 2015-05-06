<?php
require_once ("BaseDao.php");

class TextRecordDao extends BaseDao {
	
	/*
	 * Database constants
	 */
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

	/**
	 * Get a single record for a user with the provided record id and app user id
	 *
	 * @param unknown $appUserId        	
	 * @param unknown $recordId        	
	 * @return Ambigous <NULL, unknown>
	 */
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

	/**
	 * Get all text records for a user
	 *
	 * @param unknown $appUserId        	
	 * @return <recordId, recordText>
	 */
	public function getAllRecordsForUser($appUserId) {
		$record = NULL;
		
		$sqlQuery = "SELECT * ";
		$sqlQuery .= "FROM $this->table_TextRecord ";
		$sqlQuery .= "WHERE $this->col_appUserId='$appUserId' ";
		$sqlQuery .= "ORDER BY $this->col_timestamp DESC";
		
		$result = $this->dbManager->executeSelectQuery ( $sqlQuery );
		
		if ($result != NULL) {
			$record = $result;
		}
		return ($record);
	}

	/**
	 * Get all records for user filtered by the search query
	 * 
	 * @param unknown $appUserId        	
	 * @param unknown $searchQuery        	
	 * @return Ambigous <NULL, unknown>
	 */
	public function getFilteredRecordsForUser($appUserId, $searchQuery) {
		$record = NULL;
		
		$sqlQuery = "SELECT * ";
		$sqlQuery .= "FROM $this->table_TextRecord ";
		$sqlQuery .= "WHERE $this->col_appUserId='$appUserId' ";
		$sqlQuery .= "AND $this->col_text LIKE '%" . $searchQuery . "%' ";
		$sqlQuery .= "ORDER BY $this->col_timestamp DESC";
		
		$result = $this->dbManager->executeSelectQuery ( $sqlQuery );
		
		if ($result != NULL) {
			$record = $result;
		}
		return ($record);
	}

	/**
	 * Insert a new text record
	 *
	 * @param unknown $appUserId        	
	 * @param unknown $text        	
	 * @return unknown
	 */
	public function insertNewRecord($appUserId, $text) {
		$sqlQuery = "INSERT INTO $this->table_TextRecord ($this->col_appUserId, $this->col_text) ";
		$sqlQuery .= "VALUES ($appUserId, '$text') ";
		$result = $this->dbManager->executeQuery ( $sqlQuery );
		return $result;
	}

	/**
	 * Edit an existing text record
	 *
	 * @param unknown $recordId        	
	 * @param unknown $text        	
	 * @return unknown
	 */
	public function editRecord($recordId, $text) {
		$sqlQuery = "UPDATE $this->table_TextRecord ";
		$sqlQuery .= "SET $this->col_text = '$text' ";
		$sqlQuery .= "WHERE $this->col_recordId = $recordId ";
		$result = $this->dbManager->executeQuery ( $sqlQuery );
		return $result;
	}

	/**
	 * Delete an existing text record
	 *
	 * @param unknown $recordId        	
	 * @return unknown
	 */
	public function deleteRecord($recordId) {
		$sqlQuery = "DELETE FROM $this->table_TextRecord ";
		$sqlQuery .= "WHERE " . $this->col_recordId . " = " . $recordId;
		$result = $this->dbManager->executeQuery ( $sqlQuery );
		return $result;
	}

	/**
	 * Check whether an app user owns the provided record
	 * 
	 * @param unknown $userId        	
	 * @param unknown $recordId        	
	 * @return boolean
	 */
	public function isUserTheRecordOwner($userId, $recordId) {
		$sqlQuery = "SELECT count(*) as isExisting ";
		$sqlQuery .= "FROM $this->table_TextRecord ";
		$sqlQuery .= "WHERE $this->col_recordId='$recordId' ";
		$sqlQuery .= "AND $this->col_appUserId='$userId' ";
		
		$result = $this->dbManager->executeSelectQuery ( $sqlQuery );
		
		if ($result [0] ["isExisting"] == 1)
			return (true);
		else
			return (false);
	}

}
?>