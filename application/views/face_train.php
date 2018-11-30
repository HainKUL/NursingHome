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
        <a href="#" class="brand-logo center">{welcome}</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li class="active"><a href="#">{train}</a></li>
            <li><a href="<?=base_url()?>index.php/Face_Login_controller/face_test">{test}</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="card center">
        <div class="card-content">
            <div class="card-action">
                <button onclick="startWebcam();">{start}</button>
                <button onclick="snapshot();">{capture}</button>
            </div>
            <div class="input-field col s6">
                <input placeholder="Enter Name" type="text" class="validate" id="ip">
            </div>

            <div>
                <video onclick="snapshot(this)" id="video" width="400" height="300" controls autoplay></video>
                <canvas  id="myCanvas" width="400" height="300"></canvas>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../../assets/js/face_train.js"></script>
</html>