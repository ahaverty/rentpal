<?php
/* database constants */
define ( "DB_HOST", "localhost" );
define ( "DB_USER", "alan" );
define ( "DB_PASS", "C12410858" );
define ( "DB_PORT", 3306 );
define ( "DB_NAME", "rentpal" );

/* application constants */
define ( "APP_NAME", "RentPal" );
define ( "BASE_URL", $_SERVER ['SERVER_NAME'] . dirname ( $_SERVER ['PHP_SELF'] ) );

/* new user form constants */
define ( "NEW_USER_FORM_MAX_USERNAME_LENGTH", 30 );
define ( "NEW_USER_FORM_MAX_PASSWORD_LENGTH", 20 );

/* login user form constants */
define ( "LOGIN_USER_FORM_MAX_USERNAME_LENGTH", 30 );
define ( "LOGIN_USER_FORM_MAX_PASSWORD_LENGTH", 20 );

/* Alert Message strings */
define ( "NEW_USER_FORM_ERRORS_STR", "<strong>Error: </strong>Errors exist in the form" );
define ( "NEW_USER_FORM_ERRORS_COMPULSORY_STR", "<strong>Error: </strong>All the fields are compulsory" );
define ( "NEW_USER_FORM_EXISTING_ERROR_STR", "<strong>Error: </strong>Another user already exists in the system with the same username" );
define ( "NEW_USER_FORM_REGISTRATION_CONFIRMATION_STR", "<strong>Success: </strong>You have registered successfully. Please login to continue!" );
define ( "NEW_USER_FORM_SYSTEM_ERROR_STR", "<strong>Error: </strong>Something went wrong during registration" );
define ( "LOGIN_USER_FORM_AUTHENTICATION_ERROR", "<strong>Error: </strong>Incorrect Username and Password combination" );
define ( "LOGOUT_SUCCESS", "<strong>Success: </strong>You have been logged out!" );

define ("RECORD_INSERT_SUCCESS", "<strong>Success: </strong>Record saved!");
define ("RECORD_INSERT_EMPTY", "<strong>Error: </strong>Record must not be empty! Please try again.");
define ("RECORD_INSERT_ERROR", "<strong>Error: </strong>There was an error while trying to save your record.");
define ("RECORD_EDIT_SUCCESS", "<strong>Success: </strong>Record has been edited and saved!");
define ("RECORD_EDIT_ERROR", "<strong>Error: </strong>There was an error while trying to edit your record.");
define ("RECORD_DELETE_SUCCESS", "<strong>Success: </strong>Your record was deleted!");
define ("RECORD_DELETE_ERROR", "<strong>Error: </strong>There was an error while trying to delete your record.");
?>