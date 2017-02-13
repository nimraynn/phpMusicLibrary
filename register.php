<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    includes/process_login.php
    13/02/2017 20:46

*/

include_once 'includes/register.inc.php';       // Fetch our registration specific includes
include_once 'includes/functions.php';          // Fetch our functions

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>phpMusicLibrary: Registration Form</title>
        <script type="text/JavaScript" src="js/sha512.js"></script>
        <script type="text/JavaScript" src="js/forms.js"></script>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    
    <body>
        <!-- Registration form to be output if the POST varialbes are not set,
            or if the registration script caused an error -->
        <h1>Register with us</h1>
        <?php
            if (!empty($error_msg)) {
                echo $error_msg;
            }
        ?>
        <ul>
            <li>Usernames may contain only digits, upper and lowercase letters and understores</li>
            <li>Email addresses must be in a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain:
                <ul>
                    <li>At least one uppercase letter (A..Z)</li>
                    <li>At least one lowercase letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>

        <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="POST" name="registration_form">
            Username: <input type='text' name='username' id='username' /><br />
            Email Address: <input type='text' name='email' id='email' /><br />
            Password: <input type='password' name='password' id='password' /><br />
            Confirm: <input type='password' name='confirmpwd' id='confirmpwd' /><br />
            <input type='button' value='Register' onclick='return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd);' />
        </form>
        <p>Return to the <a href="index.php">login page</a>.</p>
    </body>
</html>