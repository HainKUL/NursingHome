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

if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_old = mysqli_real_escape_string($db, $_POST['password_old']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if (empty($password_2)) { array_push($errors, "Please confirm password"); }
    if (empty($password_old)) { array_push($errors, "Please fill in your previous password"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }


    $sql = "SELECT passwordHash FROM Caregivers WHERE email = $email;";
    $result = $this->db->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hash = $row[$passwordHash];
        if(password_verify($password, $hash))   {
            echo 'success!';
            // generate a new 16-character salt string
            $salt = substr(str_replace('+','.',base64_encode(md5(mt_rand(), true))),0,16);
            // how many times the string will be hashed
            $rounds = 10000;
            // pass in the password, the number of rounds, and the salt
            $passhash =  crypt($password_1, sprintf('$6$rounds=%d$%s$', $rounds, $salt));
            $query = "UPDATE Caregivers SET passwordHash = $passhash SET passwordSalt = $salt WHERE email = $email";
            header('location: index.php');
        }
        else {
            echo 'fail!';
        }

    } else {
        echo "email not registered";
    }
}