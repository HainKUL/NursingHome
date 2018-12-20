<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camera</title>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../assets/css/features.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<!--<body onload="init();">-->
<body onload="startWebcam()">
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../../assets/js/materialize.min.js"></script>
<nav>
    <div class="nav-wrapper">
        <h1><?php echo $this->lang->line('login_welcome'); ?></h1>

    </div>
</nav>


<div class="container">
    <div class="card center">
        <div class="card-content">
            <div class="card-action">
                <div class="card-action">

                    <table align="center" cellpadding = "10">
                        <tr>
                            <h2 align="center"><?php echo $this->lang->line('login_face'); ?></h2>
                        </tr>
                        <tr>
<!--                            <td>-->
<!--                                <button class="button_logout" onclick="startWebcam();">--><?php //echo $this->lang->line('login_start'); ?><!--</button>-->
<!--                            </td>-->
                            <td>
                                <button class="button_logout" onclick="snapshot();"><?php echo $this->lang->line('login_capture'); ?></button>
                            </td>
                        </tr>
                    </table>
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

    <table align="center" cellpadding = "10">
        <tr>
            <h2 align="center"><?php echo $this->lang->line('alternative'); ?></h2>
        </tr>
    <tr>
        <td><label><?php echo $this->lang->line('register_firstname'); ?>: </label></td>
        <td><input type="text" oninput="checkInput(this.id)" pattern="[a-z A-Z'éèëï-]{1,20}" name="firstname" id="firstname" class="form-control"  /></td>
    </tr>
    <tr>

        <td><label><?php echo $this->lang->line('register_lastname'); ?>: </label></td>
        <td><input type="text" oninput="checkInput(this.id)" pattern="[a-z A-Z'éèëï-]{1,20}" name="name" id="name" class="form-control"  /></td>
    </tr>
    <tr>

        <td><label>Pincode:</label></td>
        <td><input type="password" oninput="checkInput(this.id)" pattern="[0-9]{1,4}" name="pincode" id="pincode" class="form-control"  /></td>
    </tr>

    <tr>
        <td>

             <input class="button_logout" type="submit" id="submit" value="<?php echo $this->lang->line('login_button'); ?>" />

        </td>
    </tr>
    </table>
</body>
<script src="../../assets/js/face_login.js"></script>
<script>
    function checkInput(id){
        input = document.getElementById(id).value
        if(input.includes("<")||input.includes(">")||input.includes("\;")) {
            alert("code injection not yet supported")
            input = input.slice(0, -1);
            document.getElementById(id).value = input
        }
    }
</script>
</html>


