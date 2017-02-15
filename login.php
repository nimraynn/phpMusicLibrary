<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    login.php
    13/02/2017 19:48
    
*/

include_once 'includes/db_connect.php';     // Fetch our database connection
include_once 'includes/functions.php';      // Fetch our configuration & functions

// Start a PHP session
sec_session_start();

// Check if we are already logged in
if (login_check($mysqli) == TRUE) {

    // Logged in
    $logged = 'in';

} else {

    // Logged out
    $logged = 'out';

}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>phpMusicLibrary: Login</title>
        <link rel="stylesheet" href="styles/main.css" />
        <script type="text/JavaScript" src="js/sha512.js"></script>
        <script type="text/JavaScript" src="js/forms.js"></script>
    </head>
    <body>
        <?php

        // Check if an error was passed
        if (isset($_GET['error'])) {

            // Write the error
            echo '<p class="error">Error logging in!</p>';

        }

        ?>
        <form action="includes/process_login.php" method="post" name="login_form">
            <input type="text" name="email" placeholder="Email address" />
            <input type="password" name="password" id="password" placeholder="password" />
            <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
        </form>

        <?php

        // Check if we are logged in
        if (login_check($mysqli) == TRUE) {
            
            // If we are, display a logged in message
            echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
            echo '<a href="includes/logout.php">Logout</p>';

        } else {

            echo '<p>Currently logged ' . $logged . '.</p>';
            echo 'If you don\'t have a login, please <a href="register.php">register</a></p>';

        }

        ?>
    </body>
</html>