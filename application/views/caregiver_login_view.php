<!DOCTYPE html>
<html lang="en">

<html>
<head>
    <meta charset="UTF-8">
    <title>Caregiver Login | Welcome</title>
    <link href="http://localhost:8888/a18ux04/assets/css/caregiver_login.css" rel="stylesheet" type="text/css"/>
    <!-- <link href="<?=base_url() ?>assets/css/main.css" rel="stylesheet" type="text/css"/> for on the actual site-->
</head>

<body>
<?php if(isset($_SESSION)) {
    echo $this->session->flashdata('flash_data');
} ?>

<!--<form method="post" action="index.html">-->
<form method="post" action="<?= site_url('Caregiver_controller/login') ?>">
    <div class="box">
        <h1>Caregiver Login </h1>

        <p>
            <label>Username:</label>
            <input type="text" name="email" id="email" class="form-control" name="email" />
        </p>
        <p>
            <label>Password:</label>
            <input type="password" name="password" id="password" class="form-control" name="password" />
        </p>
        <p>
            <input type="submit" id="submit" value="Login" />
        </p>


        <!--<input type="username" name="username" value="username" onFocus="field_focus(this, 'username');" onblur="field_blur(this, 'username');" class="username" />

        <input type="password" name="password" value="password" onFocus="field_focus(this, 'password');" onblur="field_blur(this, 'password');" class="password" />
<a href="/a18ux04/index.php/Caregiver_controller/dashboard">dev login</a>
        <a href="#"><div class="btn">Sign In</div></a>

        <a href="#"><div id="btn2">Log In</div></a>

        <a href="/index.php/Caregiver_controller/dashboard">dev login</a>-->

    </div> <!-- End Box -->

</form>

<p>Forgot your password? <a href="forgot">Click Here!</a></p>


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<footer>
    <p>Copyright © 2018 UXWD. Groep T All Rights Reserved.
        <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
    </p>
</footer>
</body>
</html>
