<?php
/**
 * Created by IntelliJ IDEA.
 * User: Haien
 * Date: 11/20/2018
 * Time: 15:53
 */

class Face_Login_controller extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->library('session');
        //$this->load->model('Question_model');
    }

    function facelogin(){
        $data['welcome'] = 'Welcome 😊';
        $data['capture'] = 'Click to start';
        $data['login'] = 'Login';

        $this->parser->parse('face_login',$data);
        //$this->load->view('face_login');
    }


}