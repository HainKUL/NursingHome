<?php
if(!isset($_SESSION['id']))
{

    header("Location:./index.php?msg=YouMustLoginFirst");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/ >

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

    <!-- D3.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/1.3.0/d3-legend.js" charset="utf-8"></script>


    <!--    <script src="--><?//= base_url()?><!--assets/js/trail.js"></script>-->


    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 11px;
            font-weight: 300;
            fill: #242424;
            text-align: center;
            /*text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, -1px 0 0 #fff, 0 -1px 0 #fff;*/
            cursor: default;

        }



        select {
            font-family: sans-serif;
            font-size: 30px;
            background: none repeat scroll 0 0 #FFFFFF;
            border: 1px solid #E5E5E5;
            border-radius: 5px 5px 5px 5px;
            box-shadow: 0 0 10px #E8E8E8 inset;
            height: 40px;
            padding: 8px;
            width: 210px;
            margin-left:100px;

        }


        option {
            direction: ltr;
        }

        label
        {
            font: 300 16px/1.7 'Open Sans', sans-serif;
            color: #666;
            cursor: pointer;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
            display: block
        }

        #button1{
            width: 300px;
            height: 40px;
        }
        #button2{
            width: 300px;
            height: 40px;
        }
        #container{
            text-align: center;
        }

        h4.validate {
            visibility: hidden;
        }

    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.png" type="image/gif" sizes="16x16">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS-->

    <link href="<?= base_url()?>assets/css/dashboard.css" rel="stylesheet" type="text/css"/>
</head>


<body onload="init()">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<div class="container-fluid">
    <div class="row" style="height:100vh;">
        <div class="col-3" id="div1" style="background-color:#009489;padding:0;"></div>

        <div class="col-6" style="background-color:#f9f9f9;padding:0px;">
            <div style="width:100%;">
                <ul class="nav nav-tabs" style="text-align:center;border:none;">
                    <li class="nav-item" style="width:25%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-1" style="border:none;"><?php echo $this->lang->line('dash_questionnaire'); ?></a></li>
                    <li class="nav-item" style="width:25%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2" style="border:none;" ><?php echo $this->lang->line('dash_poll'); ?></a></li>
                    <li class="nav-item" style="width:25%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-3" style="border:none;"><?php echo $this->lang->line('dash_personal'); ?></a></li>
                    <li class="nav-item" style="width:25%;"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-4" style="border:none;" onload="loadDiv4()"><?php echo $this->lang->line('dash_register'); ?></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" role="tabpanel" id="tab-4" style="padding:5%;max-height:94vh;overflow-y:scroll;">
                        <div class="card register-card">
                            <h3 class="title_registration"><?php echo $this->lang->line('title'); ?></h3>
                            <div>
                                <form  method="post">
<!--                                    ID:<input type="text" class="validate" id="ip">-->
                                    <h4 type="text" class="validate" id="ip"><?php echo $_SESSION["reg_id"] ?></h4>

                                </form>
                                <div id="container">
                                    <button  id="button1" onclick="startWebcam();"><?php echo $this->lang->line('login_start'); ?></button>
                                    <br/><br/>
                                    <button  id="button2" onclick="snapshot();"><?php echo $this->lang->line('login_capture'); ?></button>
                                    <br/><br/>
                                </div>
                                <div>
                                    <video  class="center" onclick="snapshot(this)"  class="center" id="video" margin="0" width="400" height="300" controls autoplay></video>
                                    <br/>
                                    <canvas  class="center" id="myCanvas" width="400" height="300"></canvas>
                                </div>
                                <a href="<?=base_url()?>Homepage_controller/residentHome"><button >login bypass</button></a>
                                <script src="../../assets/js/face_registration.js"></script>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-3" style="background-color:#c7de6e;padding:0;"></div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>

































<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>Camera</title>-->
<!--    <!--Import materialize.css-->-->
<!--</head>-->
<!---->
<!--<body onload="init()">-->
<!--<!--Import jQuery before materialize.js-->-->
<!---->
<!--<nav>-->
<!--    <div class="nav-wrapper">-->
<!--        <a href="#" class="brand-logo center">--><?php //echo $this->lang->line('login_welcome'); ?><!--</a>-->
<!--        <ul id="nav-mobile" class="right hide-on-med-and-down">-->
<!--            <li class="active"><a href="#">--><?php //echo $this->lang->line('login_registration'); ?><!--</a></li>-->
<!--            <li><a href="--><?//=base_url()?><!--index.php/Face_Login_controller/face_login">--><?php //echo $this->lang->line('login_login'); ?><!--</a></li>-->
<!--        </ul>-->
<!--    </div>-->
<!--</nav>-->
<!---->
<!--<div class="container">-->
<!--    <div class="card center">-->
<!--        <div class="card-content">-->
<!--            <div class="card-action">-->
<!--                <form action="face_registration.php" method="post">-->
<!--                    --><?php //echo $this->lang->line('register_id'); ?><!--: <input type="text" class="validate" id="ip">-->
<!--                </form>-->
<!---->
<!--                <button onclick="startWebcam();">--><?php //echo $this->lang->line('login_start'); ?><!--</button>-->
<!--                <button onclick="snapshot();">--><?php //echo $this->lang->line('login_capture'); ?><!--</button>-->
<!--            </div>-->
<!---->
<!--            <div>-->
<!--                <video onclick="snapshot(this)" id="video" width="400" height="300"  controls autoplay></video>-->
<!--                <canvas  id="myCanvas" width="400" height="300"></canvas>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--</body>-->
<!--<script src="../../assets/js/face_registration.js"></script>-->
<!--</html>-->