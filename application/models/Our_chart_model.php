
<?php
/**
 * Created by PhpStorm.
 * User: Weihao
 * Date: 11/26/18
 * Time: 19:20
 */

class Our_chart_model extends CI_Model
{
    function __construct(){

        parent::__construct();
        $this->load->database();
        $this->load->library('session');
       // $this->load->library('session');
    }


    public function get_avg()
    {
        $query=$this->db->
        query("SELECT category,catergoryID,submission,timestampStart,AVG(answer) AS answer FROM ((Questions
               INNER JOIN Responses
               ON Questions.idQuestions=Responses.questionNum)
               INNER JOIN Submissions
               ON Submissions.idSubmissions=Responses.submission)
               WHERE completed = '1' AND idResident = '1' AND submission IN (
               #SELECT max(idSubmissions) as submission
               SELECT idSubmissions as submission
               FROM Submissions
               WHERE completed = '1' AND idResident = '1' )
               GROUP BY  category,catergoryID,timestampStart,submission
               ORDER BY submission DESC,catergoryID;");
       // $this->db->query($query);


        foreach ($query->result_array() as $row)
        {
            $data['category'] = $row['category'];
            $data['timestampStart'] = $row['timestampStart'];
            $data['answer'] = $row['answer'];
            //echo(json_encode($query));
            $rawdata[]=$data;
            //echo(json_encode($data));
        }
        //change_array_key( $rawdata, $old_key, $new_key)

        foreach ($rawdata as $value)
       {
            $time= $value['timestampStart'];
            $x[$time][]= $value;
       }
       $bothData= $x;

        foreach ($bothData as $key =>$v)
        {
            $data11["key"] = $key;
            $data11["values"] = $v;
            $data22[]=$data11;
            unset($data11);
        }
        $sliced_array = array_slice($data22, 0, 3);
        return $sliced_array;
        //echo(json_encode($bothData);
    }

    /*function change_array_key( $array, $old_key, $new_key) {
        if(!is_array($array)){ print 'You must enter a array as a haystack!'; exit; }
        if(!array_key_exists($old_key, $array)){
            return $array;
        }

        $key_pos = array_search($old_key, array_keys($array));
        $arr_before = array_slice($array, 0, $key_pos);
        $arr_after = array_slice($array, $key_pos + 1);
        $arr_renamed = array($new_key => $array[$old_key]);

        return $arr_before + $arr_renamed + $arr_after;
    }*/


    function __destruct() {
        $this->db->close();
    }

}
    ?>
