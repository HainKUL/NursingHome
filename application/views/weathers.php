<?php
if(!isset($_SESSION["resident"]))
{

    header("Location:./index.php?msg=YouMustLoginFirst");
    exit();

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">

    <title><?php echo $this->lang->line('title'); ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?=base_url() ?>assets/css/features.css" rel="stylesheet" type="text/css"/>
    <!-- language changer -->

</head>


<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2" style="padding-bottom:10px" >
            <a class="link1" href="<?=base_url()?>/Homepage_controller/residentHome/<?php echo $_SESSION['id']?>">
                <button type="button"class="btn btn-default button_back float-right" ><?php echo $this->lang->line('Back'); ?></button>
            </a>
        </div>
    </div>
    <div class="row" ">
        <div class="col-md-0" style="left: 0" >
            <iframe scrolling="no" width="1800" height ="700" frameborder="0" marginwidth="0" marginheight="0" src="https://www.meteo.be/services/widget/.?postcode=3000&nbDay=2&type=11&lang=nl&bgImageId=1&bgColor=567cd2&scrolChoice=0&colorTempMax=ffffff&colorTempMin=ffffff"></iframe>
        </div>
    </div>
</div>

<!--<iframe scrolling="no" width="334" height ="175" frameborder="0" marginwidth="0" marginheight="0" src="https://www.meteo.be/services/widget/.?postcode=3000&nbDay=2&type=4&lang=nl&bgImageId=1&bgColor=567cd2&scrolChoice=0&colorTempMax=A5D6FF&colorTempMin=ffffff"></iframe>-->
<!--<script src="//www.powr.io/powr.js?external-type=html"></script>
<div class="powr-weather" id="2ca6ab20_1542708558"></div>-->


</body>

</html>