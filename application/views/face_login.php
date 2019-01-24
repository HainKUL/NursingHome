<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camera</title>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../assets/css/questionnaire.css"  media="screen"/>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../../assets/js/materialize.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body onload="startWebcam()">
<div class="container-fluid menu_container">
    <div class="row header " >
        <div class="col-5"></div>
        <div class="col-4 header-title">
            <p><?php echo $this->lang->line('login_welcome'); ?></p>
        </div>

        <div class="col-3"></div>
    </div>
    <div class = "col-12 info">
        <?php echo $this->lang->line('login_face'); ?>
    </div>
    <div class="row">
        <div class=" col-4"></div>
<!--        click button to take picture-->
        <div class = "col-4 ">
            <button type = "button" class="button_picture" onclick="snapshot_login();"><?php echo $this->lang->line('login_capture'); ?></button>
        </div>
        <div class = "col-4"></div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 button-box">
<!--            touch camera to take picture-->
            <div class="row" >
                <div class="col-1"></div>
                <video onclick="snapshot_login(this)" id="video" width="400" height="300" controls autoplay></video>
                <canvas  id="myCanvas" width="400" height="300"></canvas>
            </div>

        <div class="col-12 alternative"><?php echo $this->lang->line('alternative'); ?></div>

        <form method="post" action="<?=base_url()?>Homepage_controller/login">

            <table >

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
            </table>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                        <input class="button_picture" type="submit" id="submit" value="<?php echo $this->lang->line('login_button'); ?>" />
                </div>
             </div>
        </form>
        </div>
    </div>
</div>
</body>
<script src="../../assets/js/face_recognition.js"></script>
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


