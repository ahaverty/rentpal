<?php

/**
 * a basic implementation of a database manager for connecting, executing and closing the connection
 */
class DbManager {
	private $dbLink;
	private $hostname = DB_HOST;
	private $username = DB_USER;
	private $password = DB_PASS;
	private $dbName;

	/**
	 * DbManager constructor for setting the dbName
	 *
	 * @param unknown $dbName        	
	 */
	function __construct($dbName) {
		$this->dbName = $dbName;
	}

	/**
	 * Opens a connection to the database and sets the conenction to the dbLink variable
	 */
	function openConnection() {
		$this->dbLink = mysqli_connect ( $this->hostname, $this->username, $this->password, $this->dbName ) or die ( "Unable to connect to database." );
	}

	/**
	 * Execute the provided select query on the connected database or die
	 *
	 * @param string $query        	
	 * @return multitype:unknown
	 */
	function executeSelectQuery($query) {
		$result = mysqli_query ( $this->dbLink, $query ) or die ( "Syntax error in SQL statement." . $this->dbLink->error );
		// Fetch a result row as an associative array
		$rows = array ();
		while ( $row = $result->fetch_array ( MYSQLI_ASSOC ) ) {
			$rows [] = $row;
		}
		return $rows;
	}

	/**
	 * Execute the provided query on the database
	 *
	 * @param string $query        	
	 * @return the number of rows affected
	 */
	function executeQuery($query) {
		mysqli_query ( $this->dbLink, $query ) or die ( "Syntax error in SQL statement." . $this->dbLink->error );
		$numAffectedRows = mysqli_affected_rows ( $this->dbLink );
		return $numAffectedRows;
	}

	/**
	 * Close the database connection
	 */
	function closeConnection() {
		$this->dbLink->close ();
	}

}
?>
