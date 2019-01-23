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
    <title><?php echo $this->lang->line('Nieuwsblad_title'); ?></title>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?=base_url() ?>assets/css/questionnaire.css" rel="stylesheet" type="text/css"/>

</head>

<body>
<div class="container-fluid menu_container">
    <div class="row header " style="margin-bottom:5vh;">
        <div class="col-4"> <img id="menu_icon" src="<?=base_url()?>assets/photos/nieuwsblad.jpg"  class="image1">
        </div>
        <div class="col-2 header-title">

            <p><?php echo $this->lang->line('Nieuwsblad'); ?></p>
        </div>
        <div class="col-5 header-button" id ="test">
            <a class="button_back" href="<?=base_url()?>index.php/Homepage_controller/news">
                <p id="logout_text"><?php echo $this->lang->line('buttonBack'); ?>
            </a>
        </div>
        <div class="col-1"></div>
    </div>


    <iframe width="100%" height="750" frameborder="0" class="rssdog" src="https://www.rssdog.com/index.php?url=http%3A%2F%2Ffeeds.nieuwsblad.be%2Fnieuws%2Fsnelnieuws&mode=html&showonly=&maxitems=7&showdescs=1&desctrim=0&descmax=0&tabwidth=100%25&excltitle=1&linktarget=_blank&textsize=xx-large&bordercol=transparent&headbgcol=blue&headtxtcol=white&titlebgcol=%585858&titletxtcol=%23282828&itembgcol=%585858&itemtxtcol=%23282828&ctl=0"></iframe>
</div>
</body>
</html>v