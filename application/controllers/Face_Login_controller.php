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
    }

    function face_train(){
        $data['welcome'] = 'Hello, Welcome 😊';
        $data['start'] = 'Start Camera';
        $data['capture'] = 'Take Picture';
        $data['train'] = 'Train';
        $data['test'] = 'Test';

        $this->parser->parse('face_train',$data);
    }

    function face_test(){
        $data['welcome'] = 'Welcome 😊';
        $data['capture'] = 'Click to start';
        $data['login'] = 'Login';
        $data['skip']='Skip';
        $this->parser->parse('face_test',$data);
    }


}