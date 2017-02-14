<?

/*

    phpMusicLibrary
    version 0.1

    @nimraynn (https://github.com/nimraynn)

    error.php
    14/02/2017 15:14

*/

$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

if (!$error) {

    $error = 'Oops! An unknown error happened!';

}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>phpMusicLibrary: Error</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <h1>There was a problem</h1>
        <p class="error"><?php echo $error; ?></p>
    </body>
</html>