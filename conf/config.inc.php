<?php
/* database constants */
define ( "DB_HOST", "localhost" );
define ( "DB_USER", "alan" );
define ( "DB_PASS", "C12410858" );
define ( "DB_PORT", 3306 );
define ( "DB_NAME", "rentpal" );

/* application constants */
define ( "APP_NAME", "RentPal" );

/* new user form constants */
define ( "NEW_USER_FORM_ERRORS_STR", "Errors exist in the form" );
define ( "NEW_USER_FORM_ERRORS_COMPULSORY_STR", "All the fields are compulsory" );
define ( "NEW_USER_FORM_EXISTING_ERROR_STR", "Another user already exists in the system with the same username" );
define ( "NEW_USER_FORM_MAX_USERNAME_LENGTH", 30 );
define ( "NEW_USER_FORM_MAX_PASSWORD_LENGTH", 20 );
define ( "NEW_USER_FORM_REGISTRATION_CONFIRMATION_STR", "You have registered successfully" );
define ( "NEW_USER_FORM_SYSTEM_ERROR_STR", "Something went wrong during registration" );

/* login user form constants */
define ( "LOGIN_USER_FORM_MAX_USERNAME_LENGTH", 30 );
define ( "LOGIN_USER_FORM_MAX_PASSWORD_LENGTH", 20 );
define ( "LOGIN_USER_FORM_WELCOME_STR", "Welcome" );
define ( "LOGIN_USER_FORM_AUTHENTICATION_ERROR", "Error: Incorrect Username and Password combination" );
define ( "LOGIN_USER_FORM_LOGOUT_STR", "Logout" );

/* misc */
define ( "INDEX_INTRO_MESSAGE_STR", "Record lease and rent details in the cloud with " . APP_NAME );
define ( "LOGGED_IN_USER_MENU", "<ul><li>option 1</li><li>option 2 </li></li>" );
?>