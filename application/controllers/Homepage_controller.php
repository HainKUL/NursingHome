<?php

class Homepage_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function home()
    {
        $data['page_title'] = 'homepage';
        #$data['content_title_1'] = 'Who are you?';
        #$data['content'] = "<button>resident</button><a href=\"/a18ux04/index.php/Caregiver_controller/login\">caregiver</a>";
        $this->parser->parse('Homepage_view', $data);
    }

    public function residentHome()
    {

        $data['page_title'] = 'UXWD home page';
        $data['content_title_1'] = 'residents homepage';
        $data['content_title_2'] = 'Welcome to the residents homepage';
        $data['content'] = 'content';
        $this->parser->parse('olderadultmenu', $data);
    }

    public function caregiverHome()
    {
        $this->load->model('DBdump_model');
        $oldPeople = $this->DBdump_model->get_oldPeople();
        $data['page_title'] = 'UXWD home page';
        $data['content_title_1'] = 'caregiver homepage';
        $data['content_title_2'] = 'database test';
        $data2['oldPeople'] = $oldPeople;
        $data['content'] = $this->parser->parse('oldPeople', $data2, true);
        $this->parser->parse('Homepage_view', $data);
    }

    public function nieuws()
    {
        $data['page_title'] = ' Nieuwspagina';
        $data['content_title_1'] = 'Ontdek hier alle nieuwtjes van vandaag';
        $data['content_title_2'] = 'Welke krant wilt u bekijken?';
        $data['buttonClickHere'] = 'KLIK HIER';
        $data['buttonBack'] = 'Ik wil terug';
        $this->parser->parse('news_view', $data);
    }

    public function nieuwsblad()
    {

        $data['page_title'] = ' Het Nieuwsblad nieuwspagina';
        $data['content_title_1'] = 'Het Nieuwsblad';
        $data['buttonBack'] = 'Ik wil terug';
        $this->parser->parse('nieuwsblad_view', $data);
    }

    public function standard()
    {

        $data['page_title'] = 'De Standard nieuwspagina';
        $data['content_title_1'] = 'De Standaard';
        $data['buttonBack'] = 'Ik wil terug';
        $this->parser->parse('standard_view', $data);
    }

    public function dm()
    {

        $data['page_title'] = 'De Morgen nieuwspagina';
        $data['content_title_1'] = 'De Morgen';
        $data['buttonBack'] = 'Ik wil terug';
        $this->parser->parse('dm_view', $data);
    }

    public function weathers()
    {

        $data['page_title'] = 'Het weer voor deze week';
        $data['content_title_1'] = 'Het weer voor deze week';
        $data['buttonBack'] = 'Ik wil terug';
        $this->parser->parse('weathers', $data);
    }

    public function sportsnews()
    {

        $data['page_title'] = 'Sportnieuws';
        $data['content_title_1'] = 'Sportnieuws voor vandaag';
        $data['buttonBack'] = 'Ik wil terug';
        $this->parser->parse('sportsnews', $data);
    }
}