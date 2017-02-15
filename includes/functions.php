<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    includes/functions.php
    15/02/2017 09:57

*/

// Fetch our config file
include_once 'config.php';

// Function: checkbrute(user_id, mysqli)
// Purpose: Check for brute force attack.
//          Lock account after 5 attempts
function checkbrute($user_id, $mysqli) {

    // Get the current timestamp
    $now = time();

    // Count login attempts from the past 2 hours
    $valid_attempts = $now - (2 * 60 * 60);

    if ($stmt = $mysqli->prepare("SELECT time FROM muslib_loginattempts WHERE user_id = ? AND time > '$valid_attempts'")) {
        
        $stmt->bind_param('i', $user_id);

        // Execute the prepared query
        $stmt->execute();
        $stmt->store_result();

        // Check if we received more than 5 rows
        if ($stmt->num_rows > 5) {

            return true;

        } else {

            return false;

        }

    } else {

        // Could not create a prepared statement
        header("Location: ../error.php?err=Database error: cannot prepare statement on line 51");
        exit();

    }

}

// Function: esc_url(url)
// Purpose: Sanitise output from PHP_SELF variable
function esc_url($url) {

    if ('' == $url) {
        
        return $url;

    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;

    $count = 1;

    while ($count) {
        
        $url = str_replace($strip, '', $url, $count);

    }

    $url = str_replace(';//', '://', $url);
    $url = htmlentities($url);

    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';

     } else {
        
         return $url;
     
     }
     
}

// Function: login(email, password, mysqli)
// Purpose: Check the login credentials
function login($email, $password, $mysqli) {

    // Use prepared statements to prevent SQL injection
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt FROM muslib_users WHERE email = ? LIMIT 1")) {
        
        $stmt->bind_param('s', $email);     // Bind $email to parameter
        $stmt->execute();                   // Execute the prepared query
        $stmt->store_result();              // Store the result of the query

        // Bind results to variables
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();

        // Hash the password with the unique salt
        $password = hash('sha512', $password, $salt);

        // Check that we only return one result
        if ($stmt->num_rows == 1) {
            
            // Now let's check if the account is locked due to too many login attempts
            if (checkbrute($user_id, $mysqli) == true) {
                
                // Account is locked. Login unsuccessful
                return false;

            } else {

                // Check if the password matches the database
                if ($db_password == $password) {
                    
                    // Password is correct
                    // Get the user-agent string
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $db_password . $user_browser);

                    // Login successful
                    return true;

                } else {

                    // Password is not correct. Login unsuccessful
                    // Record this login attempt
                    $now = time();
                    if (!$mysqli->query("INSERT INTO muslib_loginattempts(user_id, time) VALUES ('$user_id', '$now')")) {
                        
                        header("Location: ../error.php?err=Database error: login_attempts");
                        exit();

                    }

                    return false;

                }

            }

        } else {

            // User does not exist
            return false;

        }

    } else {

        // Could not create a prepared statement
        header("Location: ../error.php?err=Database error: cannot prepare statement on line 174");
        exit();

    }

}

// Function: login_check(mysqli)
// Purpose: Check if we are currently logged in
function login_check($mysqli) {

    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {

        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];

        // Get the user-agent string
        $user_browser = $_SERVER['HTTP_USER_AGENT'];

        if ($stmt = $mysqli->prepare("SELECT password FROM muslib_users WHERE id = ? LIMIT 1")) {

            // Bind $user_id to parameter
            $stmt->bind_param('i', $user_id);

            // Execute prepared query
            $stmt->execute();   
            $stmt->store_result();

            // Check that we only received one result
            if ($stmt->num_rows == 1) {

                // Get variables from result
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);

                if ($login_check == $login_string) {

                    // Logged in
                    return true;

                } else {

                    // Not logged in 
                    return false;

                }

            } else {

                // Not logged in 
                return false;

            }

        } else {

            // Could not prepare statement
            header("Location: ../error.php?err=Database error: cannot prepare statement on line 234");
            exit();

        }

    } else {

        // Not logged in 
        return false;

    }

}

// Function: sec_session_start()
// Purpose: Establish a secure PHP session_cache_expire
function sec_session_start() {

    $session_name = 'sec_session_id';       // Set a custom session name
    $secure = SECURE; 
    
    $httponly = true;       // This stops JavaScript being able to access the session ID

    // Forces sessions to only use cookies
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        
        // Throw an error if we can't use only cookies
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        // Kill the app
        exit();

    }

    // Fetch our current cookie params
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

    // session_name($session_name);    // Set the session name to the one we set above
    
    // Start the PHP session
    session_start();
    session_regenerate_id(true);

}