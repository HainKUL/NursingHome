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

}