<?php

class Homepage_controller extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->model('Menu_model');
    }

    public function home(){
        $data['page_title'] = 'homepage';
        $data['content_title_1'] = 'Who are you?';
        $data['content'] = "<button>resident</button><button>caregiver</button>";
        $this->parser->parse('Homepage_view', $data);
    }

    public function residentHome(){

        $data['menu_items'] = $this->Menu_model->get_menuitems('Nieuws');
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
    public function nieuws() {
        $nieuws = $data3['nieuws']=$this->Menu_model->get_menuitems();
        $data['page_title']='UXWD nieuws pagina';
        $data['content_title_1']='Ontdek hier alle nieuwtjes van vandaag';
        $data['content_title_2']='Welke krant wilt u bekijken?';
        $data3['nieuws'] = $nieuws;
        $data['content'] = $this->parser->parse('news_view', $data3, true);
        $data['menu_items'] = $this->Menu_model->get_menuitems('nieuws');
        $this->parser->parse('Homepage_view',$data);
    }

}