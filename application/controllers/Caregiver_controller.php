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
    }

    public function login(){
        $data['head_message'] = 'Caregiver Login | Welcome';
        if($_POST) {
            $result = $this->caregiver_login_view->validate_user($_POST);
            if(!empty($result)) {
                $data = array('id_Caregivers' => $result->id_Caregivers, 'email' => $result->email);
                $this->session->set_userdata($data);
                redirect('Dashboard/dashboard');
                //check if $result not empty or the user already exist on database,
                //we create the session and go to home page
            } else {
                $this->session->set_flashdata('flash_data', 'Username or password is wrong!');
                redirect('Caregiver_controller/login');
                //if user not in database, so login is failed and back again to login page
            }
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


}