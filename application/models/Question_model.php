<?php
class Question_model extends CI_Model{

    public function get_question($question) {
        $query=$this->db->query("SELECT question_en, question_nl, category, categoryID, idQuestions"
            ." FROM a18ux04.Questions INNER JOIN a18ux04.Categories ON a18ux04.Questions.categoryID = a18ux04.Categories.idCategories"
            ." WHERE idQuestions = $question");
        if(count($query->result_array()) == 0) return 0;
        $result = $query->result_array();
        $row = $result[0];
        if($_SESSION["lang"] == 'English')
            $data['question'] = $row['question_en'];
        else
            $data['question'] = $row['question_nl'];
        $data['category'] = $row['category'];
        $data['progress'] = $row['idQuestions'];
        return $data;
    }

    public function send_confirmation($idQuestion, $idAnswer, $idSubmission){ //send info to db that the question has been answered
        $query = "UPDATE `a18ux04`.`Responses` SET `answer` = '$idAnswer' ".
                    "WHERE (`submission`='$idSubmission' AND `questionNum`='$idQuestion');";
        $this->db->query($query);
        if($this->db->affected_rows() === 0) {
            $query = " INSERT INTO `a18ux04`.`Responses` (questionNum, answer, submission)".
                            " VALUES('$idQuestion', '$idAnswer', '$idSubmission')";
            $this->db->query($query);
        }
    }

     public function set_submission_complete($idSubmission){ //send info to db that all questions have been answered
         $query = "UPDATE `a18ux04`.`Submissions` SET `completed`='1', `timestampCompleted`=now()".
         " WHERE `idSubmissions`='$idSubmission';";
         $this->db->query($query);
     }
}