<!DOCTYPE html>
<meta charset="UTF-8">

<html lang="en">
<head>
    <title>{page_title}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS one for localhost, the other for on the server-->
    <link href="<?=base_url()?>assets/css/features.css" rel="stylesheet" type="text/css"/>
    <!-- Custom CSS
    <link href="<?=base_url() ?>assets/css/older_adult.css" rel="stylesheet" type="text/css"/> for on the actual site-->
    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
    </select>
</head>


<body>

<div class="container-fluid">

    <div id="card">

        <div class="row" style="padding-top: 15%">
            <div class="col-12">
                <div id="title" class="h1" align="center">
                    <p><?php echo $this->lang->line('well_done'); ?></p>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-12">

                <div id="text_1" class="h2" align="center">
                    <p><?php echo $this->lang->line('filled'); ?></p>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-12">

                <div id="text_2" class="h2" align="center">
                    <p><?php echo $this->lang->line('click'); ?></p>
                </div>
            </div>

        </div>

        <div class="row" style="padding-top: 5%">
            <div class="col-5"></div>
            <div class="col-2" align="center">
                <a href="<?=base_url()?>questionnaire_controller/menu/<?php echo $_SESSION['id']?>">
                    <button id="button" class="button1" ><?php echo $this->lang->line('button'); ?></button>
                </a>
            </div>

        </div>

    </div>

</div>

</body>



</html>