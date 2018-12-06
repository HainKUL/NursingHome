<!DOCTYPE html>
<meta charset="UTF-8">

<html>
<head>
    <title>{page_title}</title>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">

    <link href="<?=base_url() ?>assets/css/password_forgot.css" rel="stylesheet" type="text/css"/>
    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
    </select>
</head>


<body>
<div id="title">
    <p>{head_message}</p>
</div>

<div id="text">
    <p>{first_sentence}</p>
    <p> E-mail: <input type="email" name="emailaddress" id = "emailInput" placeholder="e-mail"> </p>
</div>

<div id="button">
    {button_text}
</div>

</body>

<footer>
    <p>Copyright © 2018 UXWD. Groep T All Rights Reserved.
        <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
    </p>
</footer>

</html>