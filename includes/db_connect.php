<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    includes/db_connect.php
    15/02/2017 10:56
    
*/

// Fetch our config file, as we're not fetching functions.php at this point
include_once 'config.php';

// Establish a MySQL connection
$mysqli = new mysqli(SQLHOST, SQLUSER, SQLPASSWORD, SQLDBNAME);

// Check if we received a connection error
if ($mysqli->connect_error) {

    // If we did, redirect to the error page
    header("Location: ../error.php?err=Unable to connect to MySQL in db_connect.php");
    exit();

}