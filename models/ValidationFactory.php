<?php

/**
 * Factory class containing functions for validation purposes
 */
class ValidationFactory {

	/**
	 * check whether the email string is a valid email address using a regular expression
	 *
	 * @param $emailStr -
	 *        	the input email string
	 * @return boolean indicating whether it is a valid email or not
	 */
	public function isEmailValid($emailStr) {
		$regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i";
		if (! preg_match ( $regex, $emailStr ))
			return (false);
		else
			return (true);
	}

	/**
	 *
	 * @param $string -
	 *        	the input string
	 * @param $maxchars -
	 *        	the maximum length of the input string
	 * @return boolean indicating whether it is a valid string of the right max length
	 */
	public function isLengthStringValid($string, $maxchars) {
		if (is_string ( $string ))
			if (strlen ( $string ) <= $maxchars)
				return (true);
		return (false);
	}
	
	/**
	 * Verifies whether a query is valid or not
	 * @param unknown $searchQuery
	 * @return boolean
	 */
	public function isQueryValid($searchQuery) {
		$regex = "/^[a-zA-Z0-9_ ]*$/";
		
		if(strlen($searchQuery) > 1){
		
			if (! preg_match ( $regex, $searchQuery ))
				return (false);
			else
				return (true);
		} else {
			return (false);
		}
	}

}
?>