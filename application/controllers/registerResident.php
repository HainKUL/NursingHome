<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();

//name, firstName, dateOfBirth
// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $name = $this->db->escape($_POST['name']);
    $firstname = $this->db->escape($_POST['firstname']);
    $dateOfBirth = $this->db->escape($_POST['dateOfBirth']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($name)) { array_push($errors, "name is required"); }
    if (empty($firstname)) { array_push($errors, "firstname is required"); } //TODO remove this restriction!
    if (empty($dateOfBirth)) { array_push($errors, "Date of birth is required"); }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query =
        "SELECT * FROM Residents WHERE firstName='$firstName' AND name = $name AND dateofBirth = $dateOfBirth LIMIT 1";
    $result = $this->db->query($user_check_query);

    if (!empty($result->result_array())) array_push($errors, "user already registered");

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $query = "INSERT INTO Residents (name, firstName, dateOfBirth) 
  			  VALUES('$name', '$firstname', '$dateOfBirth)";
        $this->db->query($query);
        header('location: index.php');
    }
}