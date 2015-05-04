<?php
/*
 * Creates a session or resumes the current one based on a session identifier
 * passed via a GET or POST request, or passed via a cookie.
 * The $_SESSION superglobal array can contain variable
 * accessible accross the entire session
 */
session_start ();

// Get the action if there is one defined
$action = "";

if (! empty ( $_REQUEST ['action'] )) {
	$action = $_REQUEST ['action'];
}

// include the MVC php files
include "models/CoreModel.php";
include "models/RecordModel.php";
include "controllers/RecordController.php";
include "views/RecordView.php";

// instanciate a new model
$coreModel = new CoreModel ();

$recordModel = new RecordModel();

// instanciate a new controller by passing in the new model, action and the request
$controller = new RecordController ( $coreModel, $recordModel, $action, $_REQUEST );

// instanciate a new view by providing the controller and the model
$view = new RecordView ( $controller, $coreModel, $recordModel );

// call the view output function to output to the browser
$view->output ();
?>