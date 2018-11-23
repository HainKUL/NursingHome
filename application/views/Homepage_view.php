<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title><?php echo $this->lang->line('home_page'); ?></title>
<!--    css file -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?=base_url() ?>assets/css/homepage.css" rel="stylesheet" type="text/css"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js">
    </script>
<!-- language changer -->
    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
</select>
</head>



<body background="<?=base_url() ?>assets/photos/background_remy_blur_export.jpg">
<div class="row" style="padding-top: 300px"></div>
<div class="container" style="background-color: white;padding-top: 30px;padding-bottom: 30px">

    <div class = "row" >
        <div class = "col-md-2">
        </div>
        <div class = "col-md-8">
            <h1 class="text-center">
                <?php echo $this->lang->line('home_er'); ?>
            </h1>
        </div>
        <div class = "col-md-2">
        </div>
    </div>
    <div class="row">
        <div class = "col-md-2">
        </div>
        <div class = "col-md-8">
            <h2 class ="text-center">
                <?php echo $this->lang->line('home_who'); ?>
            </h2>
        </div>
        <div class = "col-md-2">
        </div>
    </div>
    <div class="row">
        <div class = "col-md-4">
        </div>
        <div class = "col-md-1">
        <button type="button" class ="btn btn-succes">
            <a href=<?=base_url()?>index.php/Homepage_controller/residenthome><?php echo $this->lang->line('home_resident'); ?></a>
        </button>
        </div>
        <div class = "col-md-2">
        </div>
        <div class = "col-md-1">
        <button type="button" class = "btn btn-succes" >
            <a href=<?=base_url()?>index.php/Caregiver_controller/login><?php echo $this->lang->line('home_caregiver'); ?></a>
        </button>
        </div>
        <div class = "col-md-4">
        </div>
    </div>
</div>
</body>
<footer>
    <p><?php echo $this->lang->line('text_copyright_footer'); ?>
        <a href="#"><?php echo $this->lang->line('text_copyright_privacy'); ?></a> | <a href="#"><?php echo $this->lang->line('text_copyright_term'); ?></a>
    </p>
</footer>

</html>

