<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class development_controller extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->library('session');
    }


    public function getOS() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform = "Unknown OS Platform";
        if (!(stristr($_SERVER['HTTP_USER_AGENT'], 'Mac') === FALSE))         $os_platform = "Mac";
        else if(!(stristr($user_agent, 'Windows') === FALSE)) $os_platform = "Windows";
        else                                                  $os_platform = "Linux";
        return $os_platform;
    }

    public function development(){
        $data['page_title'] = 'development';
        $data['user_agent'] = $this->getOS();
        $this->parser->parse('development', $data);
    }
}