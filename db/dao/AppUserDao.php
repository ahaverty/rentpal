<?php
require_once ("BaseDao.php");

class AppUserDao extends BaseDao {
	private $table_AppUser = "app_user";
	private $col_id = "id";
	private $col_username = "username";
	private $col_password = "password";
	private $col_email = "email";

	function __construct($dbMng) {
		parent::__construct ( $dbMng );
	}

	/**
	 * Checks if a user exists in the database
	 *
	 * @param string $username        	
	 * @return boolean
	 */
	public function isUserExisting($username) {
		$sqlQuery = "SELECT count(*) as isExisting ";
		$sqlQuery .= "FROM $this->table_AppUser ";
		$sqlQuery .= "WHERE $this->col_username='$username' ";
		$result = $this->dbManager->executeSelectQuery ( $sqlQuery );
		
		if ($result [0] ["isExisting"] == 1)
			return (true);
		else
			return (false);
	}

	/**
	 * Gets the corresponding user id from the database
	 *
	 * @param string $username        	
	 * @return boolean
	 */
	public function getUserId($username) {
		$sqlQuery = "SELECT $this->col_id ";
		$sqlQuery .= "FROM $this->table_AppUser ";
		$sqlQuery .= "WHERE $this->col_username='$username' ";
		
		$result = $this->dbManager->executeSelectQuery ( $sqlQuery );
		
		if (! empty ( $result [0] [$this->col_id] ))
			return ($result [0] [$this->col_id]);
		else
			return (false);
	}

	/**
	 * Get the password digest for a username from the database
	 *
	 * @param string $username        	
	 * @return NULL|string
	 */
	public function getUserPasswordDigest($username) {
		$passwordDigest = NULL;
		
		$sqlQuery = "SELECT $this->col_password ";
		$sqlQuery .= "FROM $this->table_AppUser ";
		$sqlQuery .= "WHERE $this->col_username='$username'";
		
		$result = $this->dbManager->executeSelectQuery ( $sqlQuery );
		
		if ($result != NULL) {
			$passwordDigest = $result [0] [$this->col_password];
		}
		
		return $passwordDigest;
	}

	/**
	 * Insert a new user into the database
	 *
	 * @param string $username        	
	 * @param string $passwordHash        	
	 * @param string $email        	
	 * @return string
	 */
	public function insertNewUser($username, $passwordHash, $email) {
		$sqlQuery = "INSERT INTO $this->table_AppUser ($this->col_username, $this->col_password, $this->col_email) ";
		$sqlQuery .= "VALUES ('$username', '$passwordHash', '$email') ";
		$result = $this->dbManager->executeQuery ( $sqlQuery );
		return $result;
	}

}
?>