<?php
class Question_model extends CI_Model{

    public function get_question($question){
        $query=$this->db->query("SELECT * FROM a18ux04.Questions WHERE idQuestions = $question");
        if(count($query->result_array()) == 0) {
            return 0;
        }

        foreach ($query->result_array() as $row) //TODO de-stupify (foreach over 1 element??)
        {
            $data['question'] = $row['question'];
            $data['category'] = $row['category'];
            $data['progress'] = $row['idQuestions'];
        }
        return $data;
    }

    public function send_confirmation($idQuestion, $idAnswer, $idSubmission){//send info to db that the question has been answered
        $query = "INSERT INTO Responses (questionNum, answer, submission) VALUES('$idQuestion', '$idAnswer', '$idSubmission')";
        $this->db->query($query);
    }


     public function set_submission_complete($idSubmission){//send info to db that all questions have been answered
         $query = "UPDATE `a18ux04`.`Submissions` SET `completed`='1' WHERE `idSubmissions`='$idSubmission';";
         $this->db->query($query);
     }
}

