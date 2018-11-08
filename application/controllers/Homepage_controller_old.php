<?php

class Homepage_controller_old extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
    }

    public function home(){
        $this->load->model('DBdump_model');
        $oldPeople = $this->DBdump_model->get_oldPeople();
        $data['page_title'] = 'UXWD home page';
        $data['content_title_1'] = 'test site';
        $data['content_title_2'] = 'database test';
        $data2['oldPeople'] = $oldPeople;
        $data['content'] = $this->parser->parse('oldPeople', $data2, true);
        $this->parser->parse('Homepage_view', $data);
    }

    public function residentHome(){
        $data['page_title'] = 'UXWD home page';
        $data['content_title_1'] = 'residents homepage';
        $data['content_title_2'] = 'Welcome to the residents homepage';
        $data['content'] = 'content';
        $this->parser->parse('Homepage_view', $data);
    }

    public function caregiverHome(){
        $this->load->model('DBdump_model');
        $oldPeople = $this->DBdump_model->get_oldPeople();
        $data['page_title'] = 'UXWD home page';
        $data['content_title_1'] = 'caregiver homepage';
        $data['content_title_2'] = 'database test';
        $data2['oldPeople'] = $oldPeople;
        $data['content'] = $this->parser->parse('oldPeople', $data2, true);
        $this->parser->parse('Homepage_view', $data);
    }

}