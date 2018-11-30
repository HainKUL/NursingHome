<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camera</title>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon.png" type="image/gif" sizes="16x16">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?=base_url() ?>assets/css/features.css" rel="stylesheet" type="text/css"/>

    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
    </select>

    <style>
        video{
            height: 400px;
            width: 400px;
            border: thin solid silver;
        }
    </style>
</head>

<body>
<h2>{welcome}</h2>
<h1>{login}</h1>
    <a href="<?=base_url()?>Homepage_controller/residenthome">
    <button style="button" class="button1">
        {skip}
    </button>
    </a>
<button style="button" class="button1">
    {capture}
</button>
<video autoplay></video>
<div id="loadInfo"></div>

<script>
document.getElementById("capture").addEventListener('click',capture)
    function capture() {
        navigator.mediaDevices.getUserMedia({video:true, audio:false})
            .then(function (stream) {
                const video =document.querySelector("video")
                video.srcObject = stream
            })
        .catch(e => console.log("error "+e))
    }
</script>
</body>
<footer>
    <p><?php echo $this->lang->line('text_copyright_footer'); ?>
        <a href="#"><?php echo $this->lang->line('text_copyright_privacy'); ?></a> | <a href="#"><?php echo $this->lang->line('text_copyright_term'); ?></a>
    </p>
</footer>
</html>