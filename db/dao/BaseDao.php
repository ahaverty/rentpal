<?php

/**
 * Base class for Data Access Objects
 */
class BaseDao {
	protected $dbManager = null;

	/**
	 * 
	 * @param unknown $dbMng
	 */
	function __construct($dbMng) {
		$this->dbManager = $dbMng;
	}

	/**
	 * Gets the dbManager
	 */
	function getDbManager() {
		return $this->dbManager;
	}

}

?>
