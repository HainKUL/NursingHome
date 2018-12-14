<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camera</title>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../assets/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body onload="init();">
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../../assets/js/materialize.min.js"></script>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo center"><?php echo $this->lang->line('login_welcome'); ?></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
<!--            <li><a href="#">{registration}</a></li>-->
            <li class="active"><a href="#"><?php echo $this->lang->line('login_login'); ?></a></li>
        </ul>
    </div>
</nav>


<div class="container">
    <div class="card center">
        <div class="card-content">
            <div class="card-action">
                <div class="card-action">
                    <button onclick="startWebcam();"><?php echo $this->lang->line('login_start'); ?></button>
                    <button onclick="snapshot();"><?php echo $this->lang->line('login_capture'); ?></button>
                </div>
            </div>

            <div>
                <video onclick="snapshot(this)" id="video" width="400" height="300" controls autoplay></video>
                <canvas  id="myCanvas" width="400" height="300"></canvas>
            </div>
        </div>
        <!--<audio id="myAudio">-->
        <!--<source src="success.wav" type="audio/wav">-->
        <!--</audio>-->

    </div>
</div>
<form method="post" action="<?=base_url()?>Homepage_controller/login">
    <h1>login</h1>

    <p>
        <label>name:</label>
        <input type="text" name="name" id="name" class="form-control"  />

    </p>
    <p>
        <label>pincode:</label>
        <input type="password" name="pincode" id="pincode" class="form-control"  />
    </p>
    <br />
    <p>
        <input type="submit" id="submit" value="<?php echo $this->lang->line('login_button'); ?>" />
    </p>
</body>
<script src="../../assets/js/face_login.js"></script>
</html>


