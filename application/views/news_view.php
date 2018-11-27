<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title><?php echo $this->lang->line('news_title'); ?></title>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon.png" type="image/gif" sizes="16x16">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?=base_url() ?>assets/css/features.css" rel="stylesheet" type="text/css"/>
    <!-- language changer -->
    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Nederlands</option>
    </select>
</head>



<body >
<div class="row" style="padding-top: 5%"></div>
<div class="container card" >
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2" style="padding-bottom:10px" >
            <a class="link1" href="residentHome">
            <button type="button" class ="btn btn-default button1 float-right" >
                <?php echo $this->lang->line('buttonBack'); ?>
            </button>
            </a>
        </div>
    </div>
    <div class="row">

            <div class = "col-md-12">
            <h1 class="h1">
                <?php echo $this->lang->line('news_h1'); ?>
            </h1>
        </div>
    </div>
    <div class ="row">

        <div class = "col-md-12">
            <h2 class="h2">
                <?php echo $this->lang->line('news_h2'); ?>
            </h2>
        </div>
    </div>

    <div class="row" style="padding-top: 20px;padding-bottom: 20px">
        <div class = "col-md-3">
        </div>
        <div class = "col-md-6">
            <a class="link1" href="nieuwsblad">
                <button type="button" class="button2">
                    <img src="<?=base_url()?>assets/photos/nieuwsblad.jpg"  class="image1">
                    <?php echo $this->lang->line('buttonClickHere'); ?>
                </button>
            </a>
        </div>
    </div>
    <div class="row" style="padding-top: 20px;padding-bottom: 20px">
        <div class = "col-md-3">
        </div>
        <div class = "col-md-6">
            <a class="link1" href="standard">
                <button type="button" class="button2">
                    <img src="<?=base_url()?>assets/photos/standaard.jpg" class="image2">
                    <?php echo $this->lang->line('buttonClickHere'); ?>
                </button>
            </a>
        </div>
    </div>
    <div class="row" style="padding-top: 20px;padding-bottom: 20px">
        <div class = "col-md-3">
        </div>
        <div class = "col-md-6">
            <a class="link1" href="dm">
                <button type="button"class="button2" >
                    <img src="<?=base_url()?>assets/photos/demorgen.png" class="image3" >
                    <?php echo $this->lang->line('buttonClickHere'); ?>
                </button>
            </a>
        </div>
    </div>

</div>
</body>

</html>


