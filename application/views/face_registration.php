<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camera</title>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../assets/css/materialize.min.css"  media="screen,projection"/>
</head>

<body onload="init()">
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../../assets/js/materialize.min.js"></script>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo center"><?php echo $this->lang->line('login_welcome'); ?></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="active"><a href="#"><?php echo $this->lang->line('login_registration'); ?></a></li>
            <li><a href="<?=base_url()?>index.php/Face_Login_controller/face_login"><?php echo $this->lang->line('login_login'); ?></a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="card center">
        <div class="card-content">
            <div class="card-action">
                <form action="face_registration.php" method="post">
<!--                TODO the info below needs to be store in our databse-->
                    <?php echo $this->lang->line('register_firstname'); ?>:  <input type="text">
                    <?php echo $this->lang->line('register_lastname'); ?>:   <input type="text">
                    <?php echo $this->lang->line('register_birthday'); ?>:   <input type="text">
                    <?php echo $this->lang->line('register_id'); ?>:         <input type="text" class="validate" id="ip">
                </form>

                <button onclick="startWebcam();"><?php echo $this->lang->line('login_start'); ?></button>
                <button onclick="snapshot();"><?php echo $this->lang->line('login_capture'); ?></button>
            </div>

            <div>
                <video onclick="snapshot(this)" id="video" width="400" height="300" controls autoplay></video>
                <canvas  id="myCanvas" width="400" height="300"></canvas>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../../assets/js/face_registration.js"></script>
</html>