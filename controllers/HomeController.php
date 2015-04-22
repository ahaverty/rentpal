<?php

require_once 'Controller.php';

class HomeController extends Controller {

	/**
	 * Controller construct
	 * 
	 * @param unknown $model        	
	 * @param string $action        	
	 * @param unknown $parameters        	
	 */
	public function __construct($model, $action = null, $parameters) {
		
		parent::__construct($model, $action, $parameters);
		
		if( $model->isUserLoggedIn() == false ) {
			$this->redirect("index.php");
		}
		
		switch ($this->action) {
			case "insertNewUser" :
				$this->insertNewUser ( $this->parameters );
				break;
			case "loginUser" :
				$this->loginUser ( $this->parameters );
				break;
			case "logout" :
				$this->logoutUser ();
				break;
			default :
				break;
		}
		

		$this->updateHeader ();
	}

}
?>