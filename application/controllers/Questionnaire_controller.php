<?php

class Questionnaire_controller extends CI_Controller{

	public function __construct(){
		parent::__construct();
        $this->load->library('session');
		$this->load->library('parser');
		$this->load->helper('url');
        $this->load->model('Question_model');
	}


	public function questionnaire_start($userID){
	    //make/find submission to start/resume
	    $this->checkSession($userID);
        $sql = "SELECT idSubmissions FROM Submissions WHERE idResident = $userID AND completed <> 1 LIMIT 1";
        $result = $this->db->query($sql);
        if($result->num_rows() === 0) { // no submission to resume, start new one
            $query = "INSERT INTO Submissions (idResident, completed) VALUES(".$this->db->escape($userID).",'0')";
            $this->db->query($query);
            $idSubmission = $this->db->insert_id();
        } else {
            $rows = $this->db->query($sql)->result_array();
            $idSubmission = $rows[0]["idSubmissions"]; // get id of submission to resume
        }

        //update session and launch questionnaire
        $_SESSION["idSubmission"] = $idSubmission;

    //TODO extract method and deduplicate
        $sql =
            "SELECT idQuestions FROM Questions WHERE NOT EXISTS "
           ."(SELECT idResponses FROM Responses WHERE Questions.idQuestions = Responses.questionNum AND submission = '$idSubmission');";
        $result = $this->db->query($sql);
        if($result->num_rows() === 0) {
            $nextQuestion = 0;
            $this->Question_model->set_submission_complete($idSubmission);
            redirect('questionnaire_controller/done');
        } else {
            $rows = $result->result_array();
            $nextQuestion = $rows[0]["idQuestions"];
        }
        $this->question($nextQuestion);
	}


	public function question($question){
		$this->checkSession();
        $data1['jslibs_to_load'] = array('jquery-3.3.1.min.js');
        $_SESSION["Current_Question"] = $question;
        //load data(question info) to the controller
        $data2 = $this->Question_model->get_question($question);
        $data = array_merge($data1, $data2);//merge two array

        $data['user_id'] = $_SESSION["id"];
        $data['question_id'] = $question;

        // add information about previous answer given to this question
        $idSubmission = $_SESSION["idSubmission"];
        $prevAnswer = -1;
        $sql =
            "SELECT answer FROM Responses WHERE Responses.questionNum = '$question' AND submission = '$idSubmission';";
        $result = $this->db->query($sql);
        if($result->num_rows() != 0) {
            $rows = $this->db->query($sql)->result_array();
            $prevAnswer = $rows[0]["answer"]; // get id of submission to resume
        }
        $data['highlight_answer'] = $prevAnswer;

        //pass data to the view(the page)
        $this->parser->parse('questionnaire',$data);//variables sent to html content
	}


	public function update()
    {
        $this->checkSession();
        $idSubmission = $_SESSION["idSubmission"];
        $question = $_SESSION["Current_Question"];

        //send confimation to db;
        $submit = 1;
        if     (isset($_GET['never']))      $this->Question_model->send_confirmation($question, 1, $idSubmission);
        else if(isset($_GET['rarely']))     $this->Question_model->send_confirmation($question, 2, $idSubmission);
        else if(isset($_GET['sometimes']))  $this->Question_model->send_confirmation($question, 3, $idSubmission);
        else if(isset($_GET['mostly']))     $this->Question_model->send_confirmation($question, 4, $idSubmission);
        else if(isset($_GET['always']))     $this->Question_model->send_confirmation($question, 5, $idSubmission);
        else if(isset($_GET['vorige_vraag']))   {$this->question($question - 1); return;}
        else $submit = 0;
        $sql =
            "SELECT idQuestions FROM Questions WHERE NOT EXISTS "
            ."(SELECT idResponses FROM Responses WHERE Questions.idQuestions = Responses.questionNum AND submission = '$idSubmission');";
        $result = $this->db->query($sql);
        if($result->num_rows() === 0) {
            $this->Question_model->set_submission_complete($idSubmission);
            redirect('questionnaire_controller/done');
        } else {
            $nextQuestion = $result->result_array()[0]["idQuestions"];
            if($submit == 1) $this->question($nextQuestion);
        }
    }


    public function done(){
        $data['page_title']     = 'Klaar!';
        $data['head_message']   = 'Goed gedaan! 😊';
        $data['first_sentence'] = "U heeft al de vragen ingevuld!";
        $data['second_sentence']= "Klik op de onderstaande knop om terug te gaan naar het beginscherm";
        $data['button_text'] = "Klik hier!";
        $this->parser->parse('done_with_questionnaire', $data);
    }

    public function menu(){
        $data['page_title'] = 'Menu';
        $data['first']      = "Vragenlijst invullen";
        $data['second']     = "Vragen van verzorgsters";
        $data['third']      = "Nieuws van vandaag";
        $data['fourth']     = "Sportnieuws";
        $data['fifth']      = "Het weer";
        $data['logout']     = "Afmelden";
        $this->parser->parse('olderadultmenu', $data);
    }

    public function checkSession($userID = -1)
    {
        if( !isset($_SESSION["resident"]) || (($userID != -1 && $_SESSION["id"] != $userID))     ) { // kick you out if not logged in
            session_destroy();
            echo "<script>
                    window.location.href='".base_url()."index.php/Face_Login_controller/face_login';
                  </script>";
            exit();
        }
    }
}
