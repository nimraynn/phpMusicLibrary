<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    includes/process_login.php
    15/02/2017 10:54

*/

include_once 'db_connect.php';      // Fetch our database connection_aborted
include_once 'functions.php';       // Fetch our functions

// Start a PHP session
sec_session_start();

if (isset($_POST['email'], $_POST['p'])) {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['p'];

    if (login($email, $password, $mysqli) == TRUE) {

        // Login successful
        header('Location: ../protected_page.php');

    } else {

        // Login failed
        header('Location: ../index.php?error=1');
        exit();

    }

} else {

    // The correct POST variables were not sent to this password_get_info
    header('Location: ../error.php?err=Could not process login');
    exit();

}