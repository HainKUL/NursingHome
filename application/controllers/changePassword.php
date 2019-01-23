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

if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $email = $this->db->escape($_POST['email']);
    $password_old = $this->db->escape($_POST['password_old']);
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($_POST['email']))       array_push($errors, "Email is required");
    if (empty($_POST['password_1']))  array_push($errors, "Password is required");
    if (empty($_POST['password_2']))  array_push($errors, "Please confirm password");
    if (empty($_POST['password_old']))array_push($errors, "Please fill in your previous password");
    if ($password_1 != $password_2)   array_push($errors, "The two passwords do not match");

    if (count($errors) !== 0) {
        $errorstring = "";
        foreach($errors as $err) $errorstring = $errorstring.$err.".   ";
        $this->session->set_flashdata('flash_data', $errorstring);
        redirect('Caregiver_controller/change_password'); //TODO keep form data after refresh
    }

    $sql = "SELECT passwordHash, idCaregivers, email FROM Caregivers WHERE email = $email LIMIT 1;";
    //TODO! deduplicate with login
    $result = $this->db->query($sql);

    if($result->num_rows() === 0)   {
        $this->session->set_flashdata('flash_data', 'Email or password incorrect!');
        redirect('Caregiver_controller/change_password');
    }

    $hash = $result->result[0]->passwordHash;

    if(password_verify($_POST['password_old'], $hash)) {
        // generate a new 16-character salt string
        $salt = substr(str_replace('+','.',base64_encode(md5(mt_rand(), true))),0,16);
        // how many times the string will be hashed
        $rounds = 10000;
        // pass in the password, the number of rounds, and the salt
        $passhash =  crypt($password_1, sprintf('$6$rounds=%d$%s$', $rounds, $salt));
        $query = "UPDATE Caregivers SET passwordHash = $passhash WHERE email = $email";
        header('location: index.php');
        redirect('Dashboard/dashboard');
    } else {
        $this->session->set_flashdata('flash_data', 'Email or password incorrect!');
        redirect('Caregiver_controller/change_password');
    }
}