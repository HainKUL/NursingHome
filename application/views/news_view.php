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
    <title><?php echo $this->lang->line('news_title'); ?></title>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?=base_url() ?>assets/css/questionnaire.css" rel="stylesheet" type="text/css"/>

</head>



<body >

<div class="container-fluid menu_container">
    <div class="row header " style="margin-bottom:5vh;">
        <div class="col-1"></div>
        <div class="col-5 header-title">
            <p><?php echo $this->lang->line('welcome'); ?></p>
        </div>
        <div class="col-5 header-button" id ="test">
            <a class="button_back" href="<?=base_url()?>index.php/Homepage_controller/residentHome/<?php echo $_SESSION['id']?>">
                <p id="logout_text"><?php echo $this->lang->line('buttonBack'); ?></p>
            </a>
        </div>
        <div class="col-1"></div>
    </div>


    <div class = "col-12 info">
        <?php echo $this->lang->line('news_h1'); ?>
    </div>
    <div class = "col-12 info">
        <?php echo $this->lang->line('news_h2'); ?>
    </div>


    <div class="row ">
        <div class="col-2"></div>
        <div class="col-8 button-box">

            <div class="row">
                <div class="col-2"></div>
                <div class="col-2 button-icon">
                    <img id="menu_icon" src="<?=base_url()?>assets/photos/nieuwsblad.jpg"  class="image1">
                </div>
                <div class="col-6">
                    <a href="<?=base_url()?>Homepage_controller/nieuwsblad">
                        <button type = "button" class="button_menu button_margin">
                            <?php echo $this->lang->line('buttonClickHere'); ?>
                        </button>
                    </a>
                </div>
                <div class="col-2"></div>
            </div>

            <div class="row">
                <div class="col-2"></div>
                <div class="col-2 button-icon">
                    <img id="menu_icon1" src="<?=base_url()?>assets/photos/standaard.jpg" class="image2">
                </div>
                <div class="col-6" >
                    <a href="<?=base_url()?>index.php/Homepage_controller/standard">
                        <button type = "button" class="button_menu button_margin">
                            <?php echo $this->lang->line('buttonClickHere'); ?>
                        </button>
                    </a>
                </div>
                <div class="col-2"></div>
            </div>

            <div class="row">
                <div class="col-2"></div>
                <div class="col-2 button-icon">
                    <img id="menu_icon2" src="<?=base_url()?>assets/photos/demorgen.png" class="image3">
                </div>
                <div class="col-6" >
                    <a href="<?=base_url()?>index.php/Homepage_controller/dm">
                        <button type = "button" class="button_menu button_margin">
                            <?php echo $this->lang->line('buttonClickHere'); ?>
                        </button>
                    </a>
                </div>
                <div class="col-2"></div>
            </div>


        </div>



    </div>
</div>
</body>


</html>



