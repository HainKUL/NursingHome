<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caregiver_controller extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->model("login_model","caregiver_login_view");
        $this->load->model("Our_chart_model");
        $this->load->model("Bar_chart_model");
        $this->load->database();
        $this->load->library('session');
    }


    public function login(){
        $data['head_message'] = 'Caregiver Login | Welcome';

        if($_POST) {
            $email = $this->db->escape($_POST['email']);
            $query = "SELECT passwordHash, idCaregivers, email FROM Caregivers WHERE email = $email LIMIT 1;";
            $result = $this->db->query($query);
            $_SESSION['id']=$result->result()[0]->idCaregivers;

            if($result->num_rows() === 0)   {
                $this->session->set_flashdata('flash_data', 'Email or password incorrect!');
                redirect('Caregiver_controller/login');
            }

            $hash = $result->result()[0]->passwordHash;

            if(password_verify($_POST['password'], $hash)) { //TODO verify guaranteed forward compatibility with crypt()
                $data = array('id_Caregivers' => $result->result()[0]->idCaregivers, 'email' => $result->result()[0]->email);
                $this->session->set_userdata($data);
                redirect('Dashboard/dashboard'); // Has something to do with not being able to remove index.php in url
            } else {
                $this->session->set_flashdata('flash_data', 'Email or password incorrect!');
                redirect('Caregiver_controller/login'); // Has something to do with not being able to remove index.php in url
            }
        }

        $this->load->view("caregiver_login_view");
    }


    public function getnotes($context, $time1, $time2){ //TODO remove times as argument, or use them
        //$query = "SELECT noteText, author, timestamp FROM Notes WHERE timestamp >= $time1 AND timestamp < $time2;";
        $query = "SELECT noteText, author timestamp FROM Notes;";
        $result = $this->db->query($query);

//        foreach ($result->result_array() as $row) {
//            $noteText = $row['noteText'];
//            $noteAuthor = $row['author'];
//            $noteTS = $row['timestamp'];
//        }
        return $result;
    }

    public function dashboard(){
//        $result = $this->getnotes(0,0, time());
//        $this->parser->parse('dashboard', $result);
        $data_each1 = $this->Bar_chart_model->get_each();
        $data['data_each1'] = $data_each1;
        $data1 = $this->Our_chart_model->get_avg();
        $data['data1'] = $data1;
        $this->load->view('dashboard', $data);
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



    public function add_note(){
        $data['page_title'] = 'add note';
        //session_start();

        // initializing variables
        $userid = "";
        $note    = "";


        // ADD NOTE
        if ($_POST) {
            // receive all input values from the form
            $userid = (int) $_POST['id'];
            $query = "SELECT passwordHash FROM Caregivers WHERE email = ".$this->db->escape($_POST['note'])." LIMIT 1;";
            // form validation
            if (empty($userID) || empty($note)) { /*TODO*/ }

            $query = "INSERT INTO Notes (noteText, author, context) VALUES(".$this->db->escape($_POST['note']).", '$userid', '0')";
            if(!($this->db->query($query)))    {
                //TODO deal with error
            }
            header('location: index.php');
            redirect('Caregiver_controller/dashboard');
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

        // REGISTER USER //TODO show ***** for password in form in stead of plaintext
        if ($_POST) {
            // receive & sanitize all input values from the form
            $name = $this->db->escape($_POST['name']);
            $firstname = $this->db->escape($_POST['firstname']);
            $email = $this->db->escape($_POST['email']);
            $password_1 = $_POST['password_1'];
            $password_2 = $_POST['password_2'];

            // form validation: ensure that the form is correctly filled ...
            // by adding (array_push()) corresponding error unto $errors array
            if (empty($_POST['name']))       array_push($errors, "name is required");
            if (empty($_POST['firstname']))  array_push($errors, "firstname is required"); //TODO remove this restriction!
            if (empty($_POST['email']))      array_push($errors, "Email is required");
            if (empty($_POST['password_1'])) array_push($errors, "Password is required");
            if ($password_1 != $password_2)  array_push($errors, "Passwords do not match");
            //TODO enforce minimum password strength
            if (count($errors) !== 0)   {
                $errorstring = "";
                foreach($errors as $err)    {
                    $errorstring = $errorstring.$err.".   ";
                }
                $this->session->set_flashdata('flash_data', $errorstring);
                redirect('Caregiver_controller/registration_caregiver'); //TODO keep form data after refresh
            }

            // first check the database to make sure
            // a user does not already exist with the same username and/or email
            $query = "SELECT * FROM Caregivers WHERE email = $email LIMIT 1;";
            $result = $this->db->query($query);
            if($result->num_rows() > 0) {
                $this->session->set_flashdata('flash_data', 'Email is already registered');
                redirect('Caregiver_controller/registration_caregiver');
            }

            // Finally, register user

            // generate a 16-character salt string
            $salt = substr(str_replace('+','.',base64_encode(md5(mt_rand(), true))),0,16);
            // how many times the string will be hashed
            $rounds = 10000;
            // pass in the password, the number of rounds, and the salt
            $passhash =  crypt($password_1, sprintf('$6$rounds=%d$%s$', $rounds, $salt));

            $query = "INSERT INTO Caregivers (name, firstName, email, passwordHash, passwordSalt) VALUES($name, $firstname, $email, '$passhash', '$salt')";
            if(!($this->db->query($query))) { //TODO don't store salt in DB, unnecessary
                //TODO errorcheck
            }
            $_SESSION['username'] = $email; //TODO security (now everyone can register and log in with full access to website)
            $_SESSION['success'] = "You are now logged in";
            //redirect('Dashboard/dashboard');
        }
        $this->parser->parse('registration_caregiver', $data);

    }

}