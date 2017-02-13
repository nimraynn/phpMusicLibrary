<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    includes/db_connect.php
    13/02/2017 19:48
    
*/

// Fetch our config file, as we're not fetching functions.php at this point
include_once 'config.php';

// Establish a MySQL connection
$mysqli = new mysqli(SQLHOST, SQLUSER, SQLPASSWORD, SQLDBNAME);

?>