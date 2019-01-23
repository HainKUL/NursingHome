<?php
if(!isset($_SESSION["resident"]))
{

    echo "<script> 
                    alert('You are not logged in!'); 
                    window.location.href='".base_url()."index.php/Face_Login_controller/face_login';
          </script>";

    exit();

}

?>
<!DOCTYPE html>
<meta charset="UTF-8">

<html lang="en">
<head>
    <title>{page_title}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS one for localhost, the other for on the server-->
    <link href="<?=base_url()?>assets/css/questionnaire.css" rel="stylesheet" type="text/css"/>

</head>


<body>

<div class="container-fluid">
    <div class="row header">
    </div>
    <div class="row end-row">
        <div class="col-12 question">
            <p><?php echo $this->lang->line('well_done'); ?></p>
        </div>

    </div>
    <div id="text_1" class="h2" align="center">
        <p><?php echo $this->lang->line('filled'); ?></p>
        <p><?php echo $this->lang->line('click'); ?></p>
    </div>


    <div class="row back-row">
            <div class="col-5"></div>
            <div class="col-2" align="center">
                <a href="<?=base_url()?>questionnaire_controller/menu/<?php echo $_SESSION['id']?>">
                    <button id="button" class="button_menu" ><?php echo $this->lang->line('button'); ?></button>
                </a>
            </div>

        </div>



</div>

</body>



</html>