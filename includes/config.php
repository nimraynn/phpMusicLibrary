<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    includes/config.php
    13/02/2017 19:48
    
*/

define("SQLHOST", "10.169.0.136");                 // MySQL DB hostname
define("SQLUSER", "libraryn_dblogin");             // MySQL DB username
define("SQLPASSWORD", "sd346APH75x2");             // MySQL DB password_get_info
define("SQLDBNAME", "libraryn_db");                // MySQL DB namespace

define("CAN_REGISTER", "any");                     // Who can register?
define("DEFAULT_ROLE", "member");                  // What is the default permission?

define("SECURE", FALSE);                           // Development use