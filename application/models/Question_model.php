<?php
/**
 * Created by IntelliJ IDEA.
 * User: Haien
 * Date: 11/2/2018
 * Time: 12:55
 */

class Question_model extends CI_Model{

    public function get_questions(){
        $query=$this->db->query("SELECT * FROM a18ux04.Questions WHERE isAnswered=0 LIMIT 1;");
        foreach ($query->result_array() as $row)
        {
            $data['question'] = $row['question'];
            $data['category'] = $row['category'];
            $data['progress'] = $row['idQuestions'];
        }
        return $data;
    }

    public function send_confirmation($idQuestion){//send info to db that the question has been answered
        $hostname = 'mysql.studev.groept.be';
        $username = "a18ux04";
        $password = "1d2r3tezbm";
        $dbname = "a18ux04";
        // Create connection
        $conn = new mysqli($hostname, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE `a18ux04`.`Questions` SET `isAnswered`='1' WHERE `idQuestions`=" . $idQuestion;

        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}

