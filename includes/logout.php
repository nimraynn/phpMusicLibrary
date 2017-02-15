<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    includes/logout.php
    13/02/2017 20:40

*/

include_once 'functions.php';       // Fetch our functions

// Start a PHP session
sec_session_start();

// Unset all of our session variables
$_SESSION = array();

// Get our session parameters
$params = session_get_cookie_params();

// Delete the cookie
setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

// Destroy the session
session_destroy();

// Redirect us back to the index
header('Location: ../index.php');

exit();