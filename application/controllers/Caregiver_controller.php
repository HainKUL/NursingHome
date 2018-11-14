<?php
/**
 * Created by PhpStorm.
 * User: Weihao
 * Date: 11/8/18
 * Time: 17:36
 */


class Caregiver_controller extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
    }

    public function login(){

        $data['head_message'] = 'Caregiver Login | Welcome';
        $this->load->view('caregiver_login_view',$data);
    }

    public function forgot(){
        $data['page_title'] = 'Wachtwoord Vergeten';
        $data['head_message'] = 'Wachtwoord vergeten?';
        $data['first_sentence'] = "Geen probleem! Geef uw e-mail adres in en er zal u een nieuw wachtwoord opgestuurd worden";
        $data['button_text'] = "<button id='button'>Verstuur e-mail!</button>";
        $this->parser->parse('password_forgot', $data);
    }

    public function dashboard(){
        $data['page_title'] = 'dashboard';
        $this->parser->parse('dashboard', $data);
    }

    public function registration(){
        $data['page_title'] = 'registration';
        $this->parser->parse('registration', $data);
    }
}