<!DOCTYPE html>
<meta charset="UTF-8">

<html lang="en">
<head>
    <title>{page_title}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?=base_url()?>/assets/photos/favicon.png" type="image/gif" sizes="16x16">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS one for localhost, the other for on the server-->
    <link href="<?=base_url()?>assets/css/older_adult.css" rel="stylesheet" type="text/css"/>
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

        <div class="row" id="top_row">


            <div class="col-12">

                <div id="title">
                    <p>{head_message}</p>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-12">

                <div id="text_1">
                    <p>{first_sentence}</p>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-12">

                <div id="text_2">
                    <p>{second_sentence}</p>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-12">
                <a href="<?=base_url()?>index.php/questionnaire_controller/menu\">
                    <button id="button" class="button_done">{button_text}</button>
                </a>
            </div>

        </div>

    </div>

</div>

</body>

<footer>
    <!--
    <p>Copyright © 2018 UXWD. Groep T All Rights Reserved.
        <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
    </p>
    -->
</footer>

</html>