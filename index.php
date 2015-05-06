<?php
// include the MVC php files
include "models/CoreModel.php";
include "controllers/IndexController.php";
include "views/IndexView.php";

// instanciate a new model
$coreModel = new CoreModel();

// instanciate a new controller by passing in the new model, action and the request
$controller = new IndexController($coreModel, $_REQUEST);

// instanciate a new view by providing the controller and the model
$view = new IndexView($controller, $coreModel);

// call the view output function to output to the browser
$view->output();
?>