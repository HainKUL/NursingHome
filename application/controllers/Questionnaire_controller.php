<?php

class Questionnaire_controller extends CI_Controller{

	public function __construct(){
		parent::__construct();
        $this->load->library('session');
		$this->load->library('parser');
		$this->load->helper('url');
        $this->load->model('Question_model');
	}


	public function questionnaire_start($userID){ //TODO get next unanswered question with SQL instead
        $query = "INSERT INTO Submissions (idResident, completed) VALUES(".$this->db->escape($userID).", 0)";
        $this->db->query($query);
        $id = $this->db->insert_id();
        $_SESSION["idSubmission"] = $id;

        $sql = "SELECT nextQuestion FROM Submissions WHERE idSubmissions = '$id';";
        $result = $this->db->query($sql);
        $nextQuestion = $result->result_array()[0]['nextQuestion'];
        $this->question($nextQuestion, $_SESSION["idSubmission"]);
	}


	public function question($question){
        $data1['jslibs_to_load'] = array('jquery-3.3.1.min.js');

        //load data(question info) to the controller
        $data2 = $this->Question_model->get_question($_SESSION["idSubmission"], $question);//submission, question
        if($data2 == 0) {
            $this->Question_model->set_submission_complete($_SESSION["idSubmission"]);
            redirect('/Homepage_controller/residentHome');
        }
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

        $data['quit'] = "Quit!";

        //pass data to the view(the page)
        $this->parser->parse('questionnaire',$data);//variables sent to html content
	}

	public function update()
    {
        //$idSubmissions = $_SESSION["idSubmission"];
        //$userID = $_SESSION["idUser"];



        $userID = 0;

        $sql = "SELECT idSubmissions FROM Submissions WHERE completed <> 1 LIMIT 1";
        $submission = $this->db->query($sql)->result_array()[0][idSubmissions];

        $sql = "SELECT * FROM Questions WHERE NOT EXISTS".
            "(SELECT * FROM Responses WHERE Questions.idQuestions = Responses.question AND submission = '$submission');";
        $result = $this->db->query($sql);
        if($result->num_rows() === 0) {
            //completed! => redirect
        }
        $nextQuestion = $result->result_array()[0][idQuestions];


        $sql = "SELECT nextQuestion FROM Submissions WHERE idSubmissions = '$idSubmission';";
        $result = $this->db->query($sql);
        $nextQuestion = $result->result_array()[0]['nextQuestion'];
        //send confimation to db;
        $submit = 1;
        if(isset($_GET['never']))           $this->Question_model->send_confirmation($nextQuestion, 1, $_SESSION["idSubmission"]);
        else if(isset($_GET['rarely']))     $this->Question_model->send_confirmation($nextQuestion, 2, $_SESSION["idSubmission"]);
        else if(isset($_GET['sometimes']))  $this->Question_model->send_confirmation($nextQuestion, 3, $_SESSION["idSubmission"]);
        else if(isset($_GET['mostly']))     $this->Question_model->send_confirmation($nextQuestion, 4, $_SESSION["idSubmission"]);
        else if(isset($_GET['always']))     $this->Question_model->send_confirmation($nextQuestion, 5, $_SESSION["idSubmission"]);
        else $submit = 0;
        //TODO FIX PREVIOUS BUTTON (return)
        //TODO catch refresh (don't go to next question on F5)
        //reload page
        if($submit == 1) $this->question($nextQuestion);
        else $this->question($nextQuestion - 2);
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
        $data['button_text'] = "Klik hier!";
        $this->parser->parse('done_with_questionnaire', $data);
    }

    public function menu(){
        $data['page_title'] = 'Menu';
        $data['first'] = "Vragenlijst invullen";
        $data['second'] = "Vragen van verzorgsters";
        $data['third'] = "Nieuws van vandaag";
        $data['fourth'] = "Sportnieuws";
        $data['fifth'] = "Het weer";
        $data['logout'] = "Afmelden";
        $this->parser->parse('olderadultmenu', $data);
    }
}
