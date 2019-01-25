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
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">

    <title><?php echo $this->lang->line('weather'); ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?=base_url() ?>assets/css/questionnaire.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url() ?>assets/css/weather.css" rel="stylesheet" type="text/css"/>
    <!-- language changer -->

</head>


<body>
<div class="container-fluid menu_container">
    <div class="row header ">

        <div class="col-6 header-title">

            <p><?php echo $this->lang->line('weather'); ?></p>
        </div>
        <div class="col-5 header-button" id ="test">
            <a class="button_back" href="<?=base_url()?>index.php/Homepage_controller/residentHome/<?php echo $_SESSION['id']?>">
                <p id="logout_text"><?php echo $this->lang->line('buttonBack'); ?></p>
            </a>
        </div>
        <div class="col-1"></div>
    </div>
    <div class="row" >
        <div class="col-md-0" style="left: 0" >
            <iframe class="frame" scrolling="no" width="1800" height ="700" frameborder="0" marginwidth="0" marginheight="0" src="https://www.meteo.be/services/widget/.?postcode=3000&nbDay=2&type=11&lang=nl&bgImageId=1&bgColor=567cd2&scrolChoice=0&colorTempMax=ffffff&colorTempMin=ffffff"></iframe>
        </div>
    </div>

</div>

</body>

</html>