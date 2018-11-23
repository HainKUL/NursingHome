<?php
/**
 * Created by PhpStorm.
 * User: Weihao
 * Date: 11/8/18
 * Time: 17:36
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Caregiver_controller extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->model("login_model", "caregiver_login_view");
        $this->load->database();
        $this->load->library('session');
    }


    public function login(){
        $data['head_message'] = 'Caregiver Login | Welcome';
        $db = mysqli_connect('mysql.studev.groept.be', 'a18ux04', '1d2r3tezbm', 'a18ux04');
        if (!$db) die('Could not connect: ' . mysqli_error());

        if($_POST) {
            $email = mysqli_real_escape_string($db, $_POST['email']);
            $password = mysqli_real_escape_string($db, $_POST['password']);

            if (empty($name)) { array_push($errors, "email is required"); }
            if (empty($password)) { array_push($errors, "Password is required"); }

            $sql = "SELECT passwordHash FROM Caregivers WHERE email = '$email';";
            //$sql = "SELECT passwordHash FROM Caregivers WHERE email = '$email';";

            $result = $db->query($sql);

            if ($result->num_rows == 1) { //TODO deal with multiple entries in db with same email (probably fix this in registration)
                $hash = $result->fetch_assoc();
                if(password_verify($password, implode(", ", $hash))) {
                    $data = array('id_Caregivers' => $result->id_Caregivers, 'email' => $result->email);
                    $this->session->set_userdata($data);
                    redirect('Dashboard/dashboard');
                } else {
                    $this->session->set_flashdata('flash_data', 'Password incorrect!');
                    redirect('Caregiver_controller/login');
                    //if user not in database, so login is failed and back again to login page
                }
            } else {
                $this->session->set_flashdata('flash_data', 'User not registered!');
                redirect('Caregiver_controller/login');
            }
            mysqli_close($db);
        }

        $this->load->view("caregiver_login_view");
    }


    public function forgot(){
        $data['page_title'] = 'Wachtwoord Vergeten';
        $data['head_message'] = 'Wachtwoord vergeten?';
        $data['first_sentence'] = "Geen probleem! Geef uw e-mail adres in en er zal u een nieuw wachtwoord opgestuurd worden";
        $data['button_text'] = "<button id='button'>Verstuur e-mail!</button>";
        $this->parser->parse('password_forgot', $data);
    }


    public function registration(){
        $data['page_title'] = 'registration';
        $this->parser->parse('registration', $data);
    }


public function add_note(){ //TODO extract method
        $data['page_title'] = 'add note';
        //session_start();

        // initializing variables
        $userid = "";
        $note    = "";

        // connect to the database
        $db = mysqli_connect('mysql.studev.groept.be', 'a18ux04', '1d2r3tezbm', 'a18ux04');

        if ($db->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // ADD NOTE
        if ($_POST) {
            // receive all input values from the form
            $userid = (int) $_POST['id'];
            $note = mysqli_real_escape_string($db, $_POST['note']);

            // form validation: ensure that the form is correctly filled ...
            // by adding (array_push()) corresponding error unto $errors array
            if (empty($userID) || empty($note)) { /*TODO*/ }

            $query = "INSERT INTO Notes (noteText, author, context)
                  VALUES('$note', '$userid', '0')";
            mysqli_query($db, $query);
            header('location: index.php');
            redirect('Caregiver_controller/add_note');
        }

        $this->parser->parse('add_note', $data);

    }


    public function registration_caregiver(){
        $data['page_title'] = 'registration_caregiver';
        //session_start();

        // initializing variables
        $username = "";
        $email    = "";
        $errors = array();

        // connect to the database
        $db = mysqli_connect('mysql.studev.groept.be', 'a18ux04', '1d2r3tezbm', 'a18ux04');

        // REGISTER USER
        if ($_POST) {
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
                $this->session->set_flashdata('flash_data', 'the two passwords do not match');
                redirect('Caregiver_controller/registration_caregiver');
            }

            // first check the database to make sure
            // a user does not already exist with the same username and/or email
            $user_check_query = "SELECT * FROM Caregivers WHERE email='$email' LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            if($result->num_rows > 0) {
                $this->session->set_flashdata('flash_data', 'Email is already registered');
                redirect('Caregiver_controller/registration_caregiver');
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

        $this->parser->parse('registration_caregiver', $data);

    }

}