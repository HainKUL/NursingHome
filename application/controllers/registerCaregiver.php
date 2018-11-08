<?php
/**
 * Created by PhpStorm.
 * User: martijn
 * Date: 08/11/2018
 * Time: 16:41
 */
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect(' mysql.studev.groept.be', 'a18ux04', '1d2r3tezbm', 'a18ux04');

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($name)) { array_push($errors, "name is required"); }
    if (empty($firstname)) { array_push($errors, "firstname is required"); } //TODO remove this restriction!
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM Caregivers WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['email'] === $email) {
            array_push($errors, "email already registered");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        // generate a 16-character salt string
        $salt = substr(str_replace('+','.',base64_encode(md5(mt_rand(), true))),0,16);
        // how many times the string will be hashed
        $rounds = 10000;
        // pass in the password, the number of rounds, and the salt
        $passhash =  crypt($password_1, sprintf('$6$rounds=%d$%s$', $rounds, $salt));

        $query = "INSERT INTO Caregivers (name, firstName, email, passwordHash, passwordSalt) 
  			  VALUES('$name', '$firstname', '$email', '$passhash', '$salt')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $email;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}