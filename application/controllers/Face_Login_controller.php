<?php

class Face_Login_controller extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->library('session');
    }

    function face_registration(){
        $data['welcome'] = 'Hello, Welcome 😊';
        $data['start'] = 'Start Camera';
        $data['capture'] = 'Take Picture';
        $data['registration'] = 'Registration';
        $data['login'] = 'Login';

        $this->parser->parse('face_registration',$data);
    }

    function face_login(){
        $data['welcome'] = 'Hello, Welcome 😊';
        $data['start'] = 'Start Camera';
        $data['capture'] = 'Take Picture';
        $data['login'] = 'Login';
        $this->parser->parse('face_login',$data);
    }
}