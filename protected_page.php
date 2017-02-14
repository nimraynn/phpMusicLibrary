<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    protected_page.php
    14/02/2017 15:22

*/

include_once 'includes/db_connect.php';     // Fetch our database connection
include_once 'includes/functions.php';      // Fetch our configuration & functions

// Include database connection and functions here.  See 3.1. 
sec_session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <?php if(login_check($mysqli) == TRUE) : ?>
        <p>Welcome, <?php echo htmlentities($_SESSION['username']); ?>!</p>
        <p>
            This is some stuff. Loads of stuff!
        </p>
        <?php else : ?>
        <p>
            <span class="error">You are not authorized to access this page, please login</span>
        </p>
        <?php endif; ?>
    </body>
</html>