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
    <title><?php echo $this->lang->line('DM_title'); ?></title>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?=base_url() ?>assets/css/features.css" rel="stylesheet" type="text/css"/>



</head>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2" style="padding-bottom:10px" >
            <a class="link1" href="<?=base_url()?>/Homepage_controller/news">
                <button type="button" class ="btn btn-default button_back float-right" >
                    <?php echo $this->lang->line('buttonback'); ?>
                </button>
            </a>
        </div>
    </div>
    <div class="row">

        <div class = "col-md-12"">
            <h1 class="h1">
                <?php echo $this->lang->line('DM'); ?>
            </h1>
    </div>

    <iframe  width="100%" height="750" frameborder="0" class="rssdog" src="https://www.rssdog.com/index.php?url=https%3A%2F%2Fwww.demorgen.be%2Frss.xml&mode=html&showonly=&maxitems=7&showdescs=1&desctrim=0&descmax=0&tabwidth=100%25&excltitle=1&linktarget=_blank&textsize=xx-large&bordercol=transparent&headbgcol=blue&headtxtcol=white&titlebgcol=%2585858&titletxtcol=%23282828&itembgcol=%585858&itemtxtcol=%23282828&ctl=0"></iframe>
</div>
</body>
</html>