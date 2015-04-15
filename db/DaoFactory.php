<?php
/**
 * definition of the DAO factory
 *
 * @author alan
 */
include_once 'DbManager.php';

class DaoFactory {
	private $dbManager;

	function getDbManager() {
		if ($this->dbManager == null) {
			throw new Exception ( "No persistence storage link" );
		}
		return $this->dbManager;
	}

	/**
	 * init resources: connect to the database
	 */
	function initDbResources() {
		$this->dbManager = new DbManager ( DB_NAME );
		$this->dbManager->openConnection ();
	}

	/**
	 * release resources: close the database link
	 */
	function clearDbResources() {
		if ($this->dbManager != null)
			$this->dbManager->closeConnection ();
	}

	/**
	 * return the reference of the Users DAO
	 */
	function getAppUserDao() {
		require_once ("dao/AppUserDao.php");
		return new AppUserDao ( $this->getDbManager () );
	}
	
	/**
	 * return the reference of the Text Record DAO
	 */
	function getTextRecordDao() {
		require_once ("dao/TextRecordDao.php");
		return new TextRecordDao ( $this->getDbManager () );
	}

}


