<!DOCTYPE html>
<meta charset="UTF-8">

<html>
<head>
    <title>Caregiver Login | Welcome</title>
    <!-- <link href="http://localhost:8888/a18ux04/assets/css/caregiver_login.css" rel="stylesheet" type="text/css"/> for not on the actual site-->
     <link href="<?=base_url() ?>assets/css/caregiver_login.css" rel="stylesheet" type="text/css"/>
</head>


<form method="post" action="index.html">
    <div class="box">
        <h1>Caregiver Login </h1>

        <input type="username" name="username" value="username" onFocus="field_focus(this, 'username');" onblur="field_blur(this, 'username');" class="username" />

        <input type="password" name="username" value="username" onFocus="field_focus(this, 'username');" onblur="field_blur(this, 'username');" class="username" />

        <a href="#"><div class="btn">Sign In</div></a> <!-- End Btn -->

        <a href="#"><div id="btn2">Log In</div></a> <!-- End Btn2 -->

    </div> <!-- End Box -->

</form>

<p>Forgot your password? <a href="<?=base_url() ?>index.php/Caregiver_controller/forgot">Click Here!</a></p>


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<footer>
    <p>Copyright © 2018 UXWD. Groep T All Rights Reserved.
        <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
    </p>
</footer>

</html>
