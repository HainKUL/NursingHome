<?php
class Question_model extends CI_Model{

    public function get_question($idSubmission, $question){
        $query=$this->db->query("SELECT * FROM a18ux04.Questions WHERE idQuestions = $question");
        foreach ($query->result_array() as $row) //TODO de-stupify (foreach over 1 element??)
        {
            $data['question'] = $row['question'];
            $data['category'] = $row['category'];
            $data['progress'] = $row['idQuestions'];
        }
        return $data;
    }

    public function send_confirmation($idQuestion, $idAnswer, $idSubmission){//send info to db that the question has been answered
        // Create connection
        $db = mysqli_connect('mysql.studev.groept.be', 'a18ux04', '1d2r3tezbm', 'a18ux04');
        // Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //TODO cleaner sql, fix "off by 1"-error
        $query = "INSERT INTO Responses (question, answer, submission) VALUES('$idQuestion', '$idAnswer', '$idSubmission')";
        mysqli_query($db, $query);
        $nextQuestion = $idQuestion + 1;
        $sql = "UPDATE `a18ux04`.`Submissions` SET `nextQuestion`='$nextQuestion' WHERE `idSubmissions`='$idSubmission';";
        mysqli_query($db, $sql);
        $db->close();
    }
}

