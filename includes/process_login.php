<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    includes/process_login.php
    13/02/2017 20:37

*/

include_once 'db_connect.php';      // Fetch our database connection_aborted
include_once 'functions.php';       // Fetch our functions

// Start a PHP session
sec_session_start();

if (isset($_POST['email'], $_POST['p'])) {

    $email = $_POST['email'];
    $password = $_POST['p'];

    if (login($email, $password, $mysqli) == TRUE) {

        // Login successful
        header('Location: ../protected_page.php');

    } else {

        // Login failed
        header('Location: ../index.php?error=1');

    }

} else {

    // The correct POST variables were not sent to this password_get_info
    echo 'Invalid request!';

}