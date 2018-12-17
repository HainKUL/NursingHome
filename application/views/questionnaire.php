
<?php
if(!isset($_SESSION["resident"]))
{

    header("Location:./index.php?msg=YouMustLoginFirst");
    exit();

}

?>
<!DOCTYPE html>
<html>
<head>
    <title> Questionnaire</title>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">

    <link href="<?= base_url()?>assets/css/features.css" rel="stylesheet" type="text/css"/>
    <meta charset="UTF-8" />
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500,600,700" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS one for localhost, the other for on the server-->
    <link href="<?=base_url()?>assets/css/features.css" rel="stylesheet" type="text/css"/>

    <?php if(isset($jslibs_to_load)) foreach ($jslibs_to_load as $jslib) : ?>
        <script src="<?= base_url()?>assets/js/<?=$jslib?>"></script>
    <?php endforeach; ?>

    <!--  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js">
      </script> -->
    <script type="text/javascript">
        function reload(id) {
            let url="<?=base_url()?>".concat("Questionnaire_controller/update/").concat(id);
            window.location.href = url;
            //console.log("<?=base_url()?>");
        }

        function residentHome() {
            let url="<?=base_url()?>".concat("index.php/Homepage_controller/residentHome")
            window.location.href = url;
        }

    </script>

</head>

<body>

<div class="container card ">

    <div id="card">

        <div class="row" >
            <div class="col-8">
                <h2>
                    <p>{category}</p>
                </h2>
            </div>
            <div class="col-2">
            </div>
            <div class="col-1" id ="test">
                <a href=<?=base_url()?>index.php/Homepage_controller/residentHome/<?php echo $_SESSION['id']?>>
                    <button type="button"class="btn btn-default button_back float-right" ><?php echo $this->lang->line('Back'); ?></button>
                </a>
            </div>
        </div>

        <div class="row" id="second_row">
            <div class="col-12">
                <div id ="text_question">
                    <!-- <p>{agree}</p> -->
                </div>
            </div>
        </div>

        <div class="row" id="third_row">
            <!--
            <div class="col-12">
                <div id="text">
                    <p>{question}</p>
                </div>
            </div>
            -->
            <div class="col-12" style="text-align: center">
                <h1>
                    <p>{question}</p>
                </h1>
            </div>
        </div>

        <div class="row" style="padding-top: 10%" >

            <div class="col-1">
            </div>
            <div class="col-2">
                <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                    <input type="submit" name="never" value="<?php echo $this->lang->line('button_never');?>" id="never" class="button_menu">
                </form>
            </div>

            <div class="col-2">
                <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                    <input type="submit" name="rarely" value="<?php echo $this->lang->line('button_rarely');?>" id="rarely" class="button_menu">
                </form>
            </div>

            <div class="col-2">
                <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                    <input type="submit" name="sometimes" value="<?php echo $this->lang->line('button_sometimes');?>" id="sometime" class="button_menu">
                </form>
            </div>

            <div class="col-2">
                <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                    <input type="submit" name="mostly" value="<?php echo $this->lang->line('button_mostly');?>" id="mostly" class="button_menu">
                </form>
            </div>

            <div class="col-2">
                <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                    <input type="submit" name="always" value="<?php echo $this->lang->line('button_always');?>" id="always" class="button_menu">
                </form>
            </div>

            <div class="col-1">
            </div>

        </div>

        <div class="row" style="padding-top: 10%">

            <div class="col-12">
                <div id="progress">
                    <progress value={progress} max ="52"></progress>
                    <p>{progress}/52</p>
                </div>
            </div>
        </div>
        <div class="col-2">
            <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                <input type="submit" name=<?php echo $this->lang->line('Return');?> value="<?php echo $this->lang->line('Return');?>" id="previous" class="button1">
            </form>

        </div>
    </div>

</body>

</html>

