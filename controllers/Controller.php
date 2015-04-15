<?php

class Controller {
	protected $model;
	protected $parameters;
	protected $action;

	/**
	 * Controller construct
	 * 
	 * @param unknown $model        	
	 * @param string $action        	
	 * @param unknown $parameters        	
	 */
	public function __construct($model, $action, $parameters) {
		$this->model = $model;
		$this->parameters = $parameters;
		$this->action = $action;
	}

}
?>