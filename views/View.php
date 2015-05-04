<?php

/**
 * Parent view class should be inherited by all view classes
 * @author Alan
 */
class View {
	protected $coreModel;
	protected $controller;
	public $appName;
	public $baseUrl;
	public $userStatus;
	public $pageAlert = "";
	public $navigationLinks = "";

	/**
	 * Construct for assigning the controller and model passed into the View class
	 *
	 * @param	$controller
	 * @param  	$coreModel
	 */
	public function __construct(Controller $controller, CoreModel $coreModel) {
		$this->controller = $controller;
		$this->coreModel = $coreModel;
		$this->appName = $this->coreModel->appName;
		$this->baseUrl = $this->coreModel->baseUrl;
		
		$this->userOptions = $this->coreModel->userOptions;
		$this->pageAlert = $this->coreModel->getPageAlert();
		
		$this->setupHeaderLinks();
	}
	
	public function setupHeaderLinks() {
		if($this->coreModel->isUserLoggedIn()){
			$this->navigationLinks = "<li><a href='records.php'>Records</a></li>";
		}
	}

}
?>