<?php

// connect to the database
$db = mysqli_connect(' mysql.studev.groept.be', 'a18ux04', '1d2r3tezbm', 'a18ux04');

if (!$db) {
    die('Could not connect: ' . mysqli_error());
}

// receive all input values from the form
$email = mysqli_real_escape_string($db, $_POST['email']);
$password = mysqli_real_escape_string($db, $_POST['password']);

// form validation: ensure that the form is correctly filled ...
// by adding (array_push()) corresponding error unto $errors array
if (empty($name)) { array_push($errors, "email is required"); }
if (empty($password)) { array_push($errors, "Password is required"); }

$sql = "SELECT passwordHash FROM Caregivers WHERE email = $email;";
$result = $db->query($sql);

if ($result->num_rows == 1) { //TODO deal with multiple entries in db with same email (probably fix this in registration)
    // output data of each row
    $row = $result->fetch_assoc();
    $hash = $row[$passwordHash];
    if(password_verify($password, $hash))   {
        echo 'success!';
    }
    else { //TODO
    }

} else { //TODO deal with error
    echo "email not registered";
}

mysqli_close($db);