<?php

/*Get data from HTML
casting to (int) provides enough safety as input validation
especially since it's not a input field - the id's are emitted by buttons */
$question_id = (int) $_POST[question_id];
$answer_id = (int) $_POST[answer_id];


/* connect to the database */ //TODO @Martijn centralise this in the app to reduce overhead 
$db = mysqli_connect(' mysql.studev.groept.be', 'a18ux04', '1d2r3tezbm', 'a18ux04');

/* verification & security TODO expand*/
if (!$db) {
    //TODO @Martijn add security, verify that correct user is *actually* logged in (check SESSION)
    //TODO @Martijn handle bad connection more intelligently
    die('Could not connect: ' . mysqli_error());
}

/* do the DB operation */ 
$sql="INSERT INTO Responses (question, answer)
VALUES
('$question_id','$answer_id')";

/* error checking */
if (!mysqli_stmt_execute($sql,$db))   {
    die('Error: ' . mysqli_error());
}

/* close connection TODO @Martijn centralise this */
mysqli_close($db);

?>

