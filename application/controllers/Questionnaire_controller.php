<?php

class Questionnaire_controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('parser');
		$this->load->helper('url');
        $this->load->model('Question_model');
        $this->load->library('session');
	}

	public function question(){
        $data1['jslibs_to_load'] = array('jquery-3.3.1.min.js');
        //$data1['jslibs_to_load'] = array('jquery-3.3.1.min.js','myjs.js');

        //load data(question info) to the controller
        $data2 = $this->Question_model->get_questions();//id,category,question

        $data = array_merge($data1, $data2);//merge two array

        // text
        $data['page_title'] = 'Care for you';
        $data['button_text'] = "Quit!";
        $data['agree'] = 'How do you agree with the following statement:';

        $data['button_never'] = "Never";
        $data['button_rarely'] = "Rarely";
        $data['button_sometimes'] = "Sometimes";
        $data['button_mostly'] = "Mostly";
        $data['button_always'] = "Always";

        //pass data to the view(the page)
        $this->parser->parse('questionnaire',$data);//variables sent to html content
	}

	public function update($idQuestion)
    {
        //send confimation to db;
        $this->Question_model->send_confirmation($idQuestion);

        //reload page
        $this->question();
    }

    public function forgot(){
        $data['page_title'] = 'Wachtwoord Vergeten';
        $data['head_message'] = 'Wachtwoord vergeten?';
        $data['first_sentence'] = "Geen probleem! Geef uw e-mail adres in en er zal u een nieuw wachtwoord opgestuurd worden";
        $data['button_text'] = "<button id='button'>Verstuur e-mail!</button>";
        $this->parser->parse('password_forgot', $data);
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
