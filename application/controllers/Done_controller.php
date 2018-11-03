<?php

class Done_controller extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
    }

    public function done(){
        $data['page_title'] = 'Klaar!';
        $data['head_message'] = 'Goed gedaan! 😊';
        $data['first_sentence'] = "U heeft al de vragen ingevuld!";
        $data['second_sentence'] = "Klik op de onderstaande knop om terug te gaan naar het beginscherm";
        $data['button_text'] = "<button id='button'>Klik hier!</button>";
        $this->parser->parse('done_with_questionnaire', $data);
    }
}