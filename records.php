<?php
// include the MVC php files
include "models/CoreModel.php";
include "models/RecordModel.php";
include "controllers/RecordController.php";
include "views/RecordView.php";

// instanciate a new model
$coreModel = new CoreModel ();
$recordModel = new RecordModel();

// instanciate a new controller by passing in the new model, action and the request
$controller = new RecordController ( $coreModel, $recordModel, $_REQUEST );

// instanciate a new view by providing the controller and the model
$view = new RecordView ( $controller, $coreModel, $recordModel );

// call the view output function to output to the browser
$view->output ();
?>