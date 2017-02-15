/*
 * phpMusicLibrary
 * version 0.1
 *
 * @nimraynn (https://github.com/nimraynn)
 *
 * includes/process_login.php
 * 13/02/2017 20:37
 * 
 */

function formhash(form, password) {

    // Create a new element input.
    // This will be our hashed password field
    var p = document.createElement("input");

    // Add the new element to our form
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plain text password doesn't go anywhere
    password.value = "";

    // Finally, submit the form
    form.submit();

}

function regformhash(form, uid, email, password, conf) {

    // Check that each field has a value
    if (uid.value == '' || email.value == '' || password.value == '' || conf.value == '') {
            
            // Create an alert
            alert('You must provide all the requested details. Please try again');
            // Kill the function
            return false;

        }

    // Check the username
    re = /^\w+$/;

    if (!re.test(form.username.value)) {
        
        // Create an alert
        alert('Username must contain only letters, numbers and underscores. Please try again.');
        // Focus on the username field
        form.username.focus();
        // Kill the function
        return false;

    }

    // Check that the password is sufficiently long
    // It should be at least 8 characters long
    if (password.value.length < 8) {

        // Create an alert
        alert('Passwords must be at lesat 8 characters long. Please try again.');
        // Focus on the password field
        form.password.focus();
        // Kill the function
        return false;

    }

    // Check that the password has at least one number, one lowercase and one uppercase
    // Also, check again that it has at least 8 characters
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
    if (!re.test(password.value)) {

        // Create an alert
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter. Please try again.');
        // Kill the function
        return false;

    }

    // Check that the password and confirmation are the same
    if (password.value != conf.value) {

        // Create an alert
        alert('Your password and confirmation do not match. Please try again.');
        // Focus on the password fields
        form.password.focus();
        // Kill the function
        return false;

    }

    // Create a new element input, this will be our hashed password field
    var p = document.createElement('input');

    // Add the new element to our form
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    // Make sure the plain text password doesn't go anywhere
    password.value = "";
    conf.value = "";

    // Submit the form
    form.submit();
    return true;

}
