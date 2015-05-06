<?php

/**
 * Handles the authentication of records
 */
class RecordAuthenticationFactory {
	private $textRecordDao;

	/**
	 * Construct for the class to set the TextRecordDao
	 * 
	 * @param unknown $textRecordDao        	
	 */
	public function __construct($textRecordDao) {
		$this->textRecordDao = $textRecordDao;
	}

	/**
	 * Verify whether a user owns a record or not
	 *
	 * @param unknown $userId        	
	 * @param unknown $recordId        	
	 * @return boolean
	 */
	public function verifyUserOwnsRecord($userId, $recordId) {
		if ($this->textRecordDao->isUserTheRecordOwner ( $userId, $recordId )) {
			return (true);
		} else {
			return (false);
		}
	}

}
?>