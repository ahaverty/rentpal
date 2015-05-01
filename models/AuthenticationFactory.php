<?php

/**
 * Handles the credential data for the project
 */
class AuthenticationFactory {
	private $appUserDao;

	/**
	 * Construct for the class to set the AppUserDao
	 *
	 * @param
	 *        	$appUserDao
	 */
	public function __construct($appUserDao) {
		$this->appUserDao = $appUserDao;
	}

	/**
	 * Checks if the user exists in the database
	 *
	 * @param string $username
	 */
	public function isUserExisting($username) {
		return ($this->appUserDao->isUserExisting ( $username ));
	}

	/**
	 * Inserts a new user into the database
	 *
	 * @param string $username
	 * @param string $password
	 */
	public function insertNewUser($username, $password, $email) {
		$hashedPassword = hash ( "sha1", $password );
		return ($this->appUserDao->insertNewUser ( $username, $hashedPassword, $email ));
	}

	/**
	 * Gets the sha1 hash value of the provided string
	 *
	 * @param string $string        	
	 * @return string
	 */
	public function getHashValue($string) {
		return (hash ( "sha1", $string ));
	}

	/**
	 * Sets the Session user id and username with the provided credentials
	 *
	 * @param unknown $userId        	
	 * @param unknown $username        	
	 */
	public function loginUser($userId, $username) {
		$_SESSION ['user_id'] = $userId;
		$_SESSION ['username'] = $username;
	}

	/**
	 * Checks if the user is logged in by referencing the Session variable
	 *
	 * @return boolean
	 */
	public function isUserLoggedIn() {
		if(! empty ( $_SESSION ['username'] )){
			if($this->isUserExisting($_SESSION ['username'])){
				return (true);
			}
		}
		return (false);
	}

	/**
	 * Gets the username of the logged in user from the session variable
	 *
	 * @return unknown|NULL
	 */
	public function getUsernameLoggedIn() {
		if ($this->isUserLoggedIn ())
			return $_SESSION ['username'];
		
		return (null);
	}

	/**
	 * Logs the user out by unsetting the username and id from the Session variable and destroying the session
	 */
	public function logoutUser() {
		unset ( $_SESSION ['user_id'] );
		unset ( $_SESSION ['username'] );
		session_destroy ();
	}

}
?>