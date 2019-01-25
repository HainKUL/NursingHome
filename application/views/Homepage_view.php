<!DOCTYPE html>
<html lang="english">
<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">
    <title><?php echo $this->lang->line('home_page'); ?></title>
<!--    css file -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?=base_url() ?>assets/css/homepage.css" rel="stylesheet" type="text/css"/>
    <!--<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js">-->


</head>

<body  background="<?=base_url() ?>assets/photos/background_remy.png">
<div class="row" style="padding-top: 15%"></div>
<div class="container container_box" >

    <div class = "row" >

        <div class = "col-md-12">
            <h1 style="text-align: center" >
                <?php echo $this->lang->line('home_er'); ?>
            </h1>
        </div>

    </div>
    <div class="row" style="padding-bottom: 40px">

        <div class = "col-md-12">
            <h2 style="text-align: center">
                <?php echo $this->lang->line('home_who'); ?>
            </h2>
        </div>

    </div>
    <div class="row">
        <div class = "col-md-2">
        </div>
        <div class = "col-md-3">
            <a  href=<?=base_url()?>index.php/Face_Login_controller/face_login class="btn btn-default button1">

                    <?php echo $this->lang->line('home_resident'); ?>
            </a>
        </div>
        <div class = "col-md-2">
        </div>
        <div class = "col-md-3">
         <a  href=<?=base_url()?>index.php/Caregiver_controller/login class="btn btn-default button1">
                <?php echo $this->lang->line('home_caregiver'); ?>
         </a>
        </div>
        <div class = "col-md-2">
        </div>

    </div>
</div>
</body>

</html>

