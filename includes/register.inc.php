<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    includes/register.inc.php
    15/02/2017 10:50
    
*/

include_once 'db_connect.php';          // Fetch our DB conneciton
include_once 'config.php';              // Fetch our configuration file

$error_msg = "";

if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {

    // Sanitise and validate the data passed in_array
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // Not a valid email
        $error_msg .= '<p class="error"> The email address you entered is not valid</p>';
  
    }

    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);

    // Check if the hashed password is 128 characters. If it's not, something isn't right
    if (strlen($password) != 128) {

        $error_msg .= '<p class="error">Invalid password configuration.</p>';

    }

    // Username validity and password validity have been checked client side.
    // This should be adequate as nobody gains an advantage from breaking these rules

    $prep_stmt = "SELECT id FROM muslib_users WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    // Check existing email
    if ($stmt) {

        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {

            // A user with this email address already exists
            $error_msg .= '<p class="error">A user with this email address already exists</p>';
            $stmt->close();

        }

    } else {

        $error_msg .= '<p class="error">Database error line 66</p>';
        $stmt->close();

    }

    // Check existing username
    $prep_stmt = "SELECT id FROM muslib_users WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {

        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {

            // A user with this username already exists
            $error_msg .= '<p class="error">A user with this username already exists</p>';
            $stmt->close();

        }

    } else {

            $error_msg .= '<p class="error">Database error line 91</p>';
            $stmt->close();

    }

    // Check if the error message is empty
    if (empty($error_msg)) {

        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password
        $password = hash('sha512', $password, $random_salt);

        // Insert the new user into the database
        if ($insert_stmt = $mysqli->prepare("INSERT INTO muslib_users (username, email, password, salt) VALUES (?, ?, ?, ?)")) {

            $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);

            // Execute the prepared query
            if (!$insert_stmt->execute()) {

                header('Location: ../error.php?err=Registration failure: INSERT');
                exit();

            }

        }

        header('Location: ./register_success.php');
        exit();

    }

}

?>
