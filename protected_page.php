<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    protected_page.php
    15/02/2017 11:31

*/

include_once 'includes/db_connect.php';     // Fetch our database connection
include_once 'includes/functions.php';      // Fetch our configuration & functions

// Include database connection and functions here.  See 3.1. 
sec_session_start();

// Check if the user is logged in. If they're not...
if (login_check($mysqli) == FALSE) :

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Access Denied</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <p>
            <span class="error">You are not authorized to access this page, please login</span>
        </p>
    </body>
</html>

<?php

// But if the user is logged in
elseif (login_check($mysqli) == TRUE) :
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <p>Welcome, <?php echo htmlentities($_SESSION['username']); ?>!</p>
        <p>
            This is some stuff. Loads of stuff!
        </p>
    </body>
</html>

<?php endif; ?>