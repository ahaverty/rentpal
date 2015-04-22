<?php

/**
 * Controls how the model data appears using template files
 *
 * @author Alan
 */
class View {
	protected $userModel;
	protected $controller;
	
	/**
	 * Construct for assigning the controller and model passed into the View class
	 *
	 * @param
	 *        	$controller
	 * @param
	 *        	$userModel
	 */
	public function __construct($controller, $userModel) {
		$this->controller = $controller;
		$this->userModel = $userModel;
	}

}
?>