
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

    <meta charset="UTF-8" />
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500,600,700" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS one for localhost, the other for on the server-->
    <link href="<?=base_url()?>assets/css/questionnaire.css" rel="stylesheet" type="text/css"/>

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
    <div class="container-fluid">

        <div class="row header">
            <div class="col-1"></div>
            <div class="col-5 header-title">
                <p>{category}</p>
            </div>
            <div class="col-5 header-button" id ="test">
                <a class="button_back" href=<?=base_url()?>index.php/Homepage_controller/residentHome/<?php echo $_SESSION['id']?>>
                    <?php echo $this->lang->line('Back'); ?>
                </a>
            </div>
            <div class="col-1"></div>
        </div>

        <div class="row question-row">
                <div class="col-12 question">
                    <p>{question}</p>
                </div>
        </div>

        <div class="row button-row">

                <div class="col-1">
                </div>
                <div class="col-2">
                    <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                        <input type="submit" name="never" value="<?php echo $this->lang->line('button_never');?>" id="never"
                            class= <?php if($highlight_answer == 1) echo "button_selected"; else echo "button_menu";?> >
                    </form>
                </div>

                <div class="col-2">
                    <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                        <input type="submit" name="rarely" value="<?php echo $this->lang->line('button_rarely');?>" id="rarely"
                            class= <?php if($highlight_answer == 2) echo "button_selected"; else echo "button_menu";?> >
                    </form>
                </div>

                <div class="col-2">
                    <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                        <input type="submit" name="sometimes" value="<?php echo $this->lang->line('button_sometimes');?>" id="sometime"
                            class= <?php if($highlight_answer == 3) echo "button_selected"; else echo "button_menu";?> >
                    </form>
                </div>

                <div class="col-2">
                    <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                        <input type="submit" name="mostly" value="<?php echo $this->lang->line('button_mostly');?>" id="mostly"
                            class= <?php if($highlight_answer == 4) echo "button_selected"; else echo "button_menu";?> >
                    </form>
                </div>

                <div class="col-2">
                    <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                        <input type="submit" name="always" value="<?php echo $this->lang->line('button_always');?>" id="always"
                            class= <?php if($highlight_answer == 5) echo "button_selected"; else echo "button_menu";?> >
                    </form>
                </div>

                <div class="col-1">
                </div>

        </div>

        <div class="row progress-row">
                <div class="col-3"></div>
                <div class="col-6 progress-border">
                    <div class="progress-bar" style="width:calc(100%*{progress}/52)"></div>
                    <p>{progress}/52</p>
                </div>
                <div class="col-3"></div>
        </div>

        <div class="row back-row">
            <div class="col-1"></div>
            <div class="col-2">
                <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
                    <input type="submit" name=<?php echo $this->lang->line('Return');?> value="<?php echo $this->lang->line('Return');?>" id="previous"
                    class=<?php if($question_id > 1) echo "button-previous"; else echo "button-hidden"?>>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

