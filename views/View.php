<?php

/**
 * Parent view class should be inherited by all view classes
 * @author Alan
 */
class View {
	protected $userModel;
	protected $controller;
	public $appName;
	public $baseUrl;
	public $userStatus;
	public $alertMessage = "";

	/**
	 * Construct for assigning the controller and model passed into the View class
	 *
	 * @param	$controller
	 * @param  	$userModel
	 */
	public function __construct(Controller $controller, UserModel $userModel) {
		$this->controller = $controller;
		$this->userModel = $userModel;
		$this->appName = $this->userModel->appName;
		$this->baseUrl = $this->userModel->baseUrl;
		$this->userOptions = $this->userModel->userOptions;
	}

}
?>