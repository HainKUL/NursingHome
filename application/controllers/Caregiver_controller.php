<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Caregiver_controller extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->model("login_model","caregiver_login_view");
        $this->load->model("Our_chart_model");
        $this->load->model("Bar_chart_model");
        $this->load->database();
        $this->load->library('session');
    }


    public function login()
    {
        if($_POST) {
            /* get credentials from database */
            $email = $this->db->escape($_POST['email']);
            $query = "SELECT passwordHash, idCaregivers, email, preferences FROM Caregivers WHERE email = $email LIMIT 1;";
            $result = $this->db->query($query);
            $rows = $result->result();
            $hash = $rows[0]->passwordHash;
            $lang = $rows[0]->preferences;
            $_SESSION['lang']=$lang;
            /* check if email is registered. Show general message "email OR password is wrong" to discourage bruteforce */
            if($result->num_rows() === 0)   {
                $this->session->set_flashdata('flash_data', 'Email or password incorrect!'); //TODO translate, add in layout somehow
                redirect('Caregiver_controller/login');
            }

            /* check submitted password vs the hash in the database */
            if(! password_verify($_POST['password'], $hash)) {
                $this->session->set_flashdata('flash_data', 'Email or password incorrect!'); //TODO translate, add in layout somehow
                redirect('Caregiver_controller/login'); //reject login: redirect back to login page
            }

            /* everything is fine, set session data */
            $data = array('id_Caregivers' => $rows[0]->idCaregivers, 'email' => $rows[0]->email);
            $this->session->set_userdata($data);
            $_SESSION["caregiver"]="yes";
            $_SESSION['id']=$rows[0]->idCaregivers;
            echo "<script>window.location.href='".base_url()."MultiLanguageSwitcher/switcher/".$lang."';</script>";
            //redirect('Dashboard/dashboard');
        }
        $this->load->view("caregiver_login_view");
    }
    

    public function forgot()
    {
        $data['page_title']     = 'Wachtwoord Vergeten';    //TODO translate
        $data['head_message']   = 'Wachtwoord vergeten?';
        $data['first_sentence'] = "Geen probleem! Geef uw e-mail adres in en er zal u een nieuw wachtwoord opgestuurd worden";
        $data['button_text']    = "<button id='button'>Verstuur e-mail!</button>";
        $this->parser->parse('password_forgot', $data);
    }


    public function add_note()
    {
        $data['page_title'] = 'add note';   //TODO translate
        if ($_POST) {
            /* receive all input values from the form */
            $userid = $_SESSION['id'];
            $note = $this->db->escape($_POST['note']);
            /* form validation */
            if (!empty($note)) {
                $query = "INSERT INTO Notes (noteText, author, context) VALUES(".$note.", '$userid', '0')";
                if(!($this->db->query($query)))    {
                    //TODO deal with error
                }
            }
            header('location: index.php');
            redirect('Dashboard/dashboard');
        }
        $this->parser->parse('add_note', $data);
    }


    public function registration_caregiver()
    {
        $data['page_title'] = 'registration_caregiver';
        $errors = array();

        //TODO show ***** for password in form in stead of plaintext
        if ($_POST) {
            /* receive & sanitize all input values from the form
            passwords are not sanitized. This is safe since they go directly to the hash function.
            having special characters in a password is a GOOD thing so we leave them in!*/
            $name = $this->db->escape($_POST['name']);
            $firstname = $this->db->escape($_POST['firstname']);
            $email = $this->db->escape($_POST['email']);
            $lang           = $this->db->escape($_POST['Radio']);
            $password_1 = $_POST['password_1'];
            $password_2 = $_POST['password_2'];

            /* form validation: ensure that the form is correctly filled */
            if (empty($_POST['name']))       array_push($errors, "name is required");
            if (empty($_POST['firstname']))  $firstname = ''; //first name is not required (some people don't two names)
            if (empty($_POST['email']))      array_push($errors, "Email is required");
            if (empty($_POST['password_1'])) array_push($errors, "Password is required"); //TODO enforce minimum password strength
            if ($password_1 != $password_2)  array_push($errors, "Passwords do not match");
            if (count($errors) !== 0)   {
                $errorstring = "";
                foreach($errors as $err)    {
                    $errorstring = $errorstring.$err.".   ";
                }
                $this->session->set_flashdata('flash_data', $errorstring);
                redirect('Caregiver_controller/registration_caregiver'); //TODO keep form data after refresh
            }

            /* check the database to make sure  a user does not already exist with the same username and/or email */
            $query = "SELECT * FROM Caregivers WHERE email = $email LIMIT 1;";
            $result = $this->db->query($query);
            if($result->num_rows() > 0) {
                $this->session->set_flashdata('flash_data', 'Email is already registered');
                redirect('Caregiver_controller/registration_caregiver');
            }

            /* generate a 16-character salt string */
            $salt = substr(str_replace('+','.',base64_encode(md5(mt_rand(), true))),0,16);
            // how many times the string will be hashed
            $rounds = 10000;
            // pass in the password, the number of rounds, and the salt
            $passhash =  crypt($password_1, sprintf('$6$rounds=%d$%s$', $rounds, $salt));

            $query = "INSERT INTO Caregivers (name, firstName, email, passwordHash,preferences) VALUES($name, $firstname, $email, '$passhash',$lang)";
            if(!($this->db->query($query))) {
                //TODO errorcheck
            }
            $_SESSION['username'] = $email; //TODO redirect where??
            //TODO security (now everyone can register and log in with full access to website)
            $_SESSION['success'] = "You are now logged in";
            //redirect('Dashboard/dashboard');
        }
        $this->parser->parse('registration_caregiver', $data);
    }
}