<?php

/**
 * Controls how the model data appears using template files
 *
 * @author Alan
 */
class View {
	protected $model;
	protected $controller;

	/**
	 * Construct for assigning the controller and model passed into the View class
	 *
	 * @param
	 *        	$controller
	 * @param
	 *        	$model
	 */
	public function __construct($controller, $model) {
		$this->controller = $controller;
		$this->model = $model;
	}

}
?>