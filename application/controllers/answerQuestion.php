<?php

// connect to the database
$db = mysqli_connect(' mysql.studev.groept.be', 'a18ux04', '1d2r3tezbm', 'a18ux04');

if (!$db) {
    die('Could not connect: ' . mysqli_error());
}

$question_id = (int) $_POST[question_id];
$answer_id = (int) $_POST[answer_id];

$sql="INSERT INTO Responses (question, answer)
VALUES
('$question_id','$answer_id')";



if (!mysqli_stmt_execute($sql,$db))   {
    die('Error: ' . mysqli_error());
}

//echo "1 record added";
mysqli_close($db);

?>

