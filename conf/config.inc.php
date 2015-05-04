<?php
/* database constants */
define ( "DB_HOST", "localhost" );
define ( "DB_USER", "alan" );
define ( "DB_PASS", "C12410858" );
define ( "DB_PORT", 3306 );
define ( "DB_NAME", "rentpal" );

/* application constants */
define ( "APP_NAME", "RentPal" );
define ( "BASE_URL",  $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) );

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
define ( "NEW_USER_FORM_REGISTRATION_CONFIRMATION_STR", "<strong>Success: </strong>You have registered successfully" );
define ( "NEW_USER_FORM_SYSTEM_ERROR_STR", "<strong>Error: </strong>Something went wrong during registration" );
define ( "LOGIN_USER_FORM_AUTHENTICATION_ERROR", "<strong>Error: </strong>Incorrect Username and Password combination" );
?>