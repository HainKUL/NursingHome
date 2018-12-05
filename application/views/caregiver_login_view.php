<!DOCTYPE html>
<html lang="en">

<html>
<head>
    <meta charset="UTF-8">
    <title>Caregiver Login | Welcome</title>
    <link href="<?=base_url()?>assets/css/caregiver_login.css" rel="stylesheet" type="text/css"/>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">


    <!-- <link href="<?=base_url() ?>assets/css/main.css" rel="stylesheet" type="text/css"/> for on the actual site-->
    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
    </select>
</head>

<body>
<?php if(isset($_SESSION)) {
    echo $this->session->flashdata('flash_data');
} ?>

<!--<form method="post" action="index.html">-->
<form method="post" action="<?= site_url('Caregiver_controller/login') ?>">
                    <!-- action="<?=base_url()?>Caregiver_controller/login">
    <!--<div class="box">-->
        <h1><?php echo $this->lang->line('login_title'); ?> </h1>

        <p>
            <label><?php echo $this->lang->line('login_username'); ?>:</label>
            <input type="text" name="email" id="email" class="form-control" name="email" />
            <?php
                    $_SESSION['username']='email';
                    ?>
        </p>
        <p>
            <label><?php echo $this->lang->line('login_password'); ?>:</label>
            <input type="password" name="password" id="password" class="form-control" name="password" />
        </p>
    <br />
        <p>
            <input type="submit" id="submit" value="<?php echo $this->lang->line('login_button'); ?>" />
        </p>


        <!--<input type="email" name="email" value="email" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />

        <input type="password" name="password" value="password" onFocus="field_focus(this, 'password');" onblur="field_blur(this, 'password');" class="password" />
<a href="/a18ux04/index.php/Caregiver_controller/dashboard">dev login</a>
        <a href="#"><div class="btn">Sign In</div></a>

        <a href="#"><div id="btn2">Log In</div></a>

        <a href="/index.php/Caregiver_controller/dashboard">dev login</a>-->

    </div> <!-- End Box -->

</form>
<br /><br /><br /><br /><br /><br />
<p><?php echo $this->lang->line('login_forgot'); ?> <a href="forgot"><?php echo $this->lang->line('login_click'); ?></a></p>


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<footer>
    <p><?php echo $this->lang->line('text_copyright_footer'); ?>
        <a href="#"><?php echo $this->lang->line('text_copyright_privacy'); ?></a> | <a href="#"><?php echo $this->lang->line('text_copyright_term'); ?>e</a>
    </p>
</footer>
</body>
</html>
