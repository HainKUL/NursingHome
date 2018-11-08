<?php

class Homepage_controller extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
    }

    public function home(){
        $data['page_title'] = 'homepage';
        $data['content_title_1'] = 'Who are you?';
        $data['content'] = "<button>resident</button><button>caregiver</button>";
        $this->parser->parse('Homepage_view', $data);
    }
}