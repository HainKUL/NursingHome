<!DOCTYPE html>
<html>
<head>
    <title>Care for you</title>
    <link href="<?= base_url()?>assets/css/older_adult.css" rel="stylesheet" type="text/css"/>
    <meta charset="UTF-8" />
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500,600,700" rel="stylesheet">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS one for localhost, the other for on the server-->
    <link href="<?=base_url()?>assets/css/older_adult.css" rel="stylesheet" type="text/css"/>
    <!--
    <link href="<?=base_url() ?>assets/css/older_adult.css" rel="stylesheet" type="text/css"/> for on the actual site-->

    <?php if(isset($jslibs_to_load)) foreach ($jslibs_to_load as $jslib) : ?>
        <script src="<?= base_url()?>assets/js/<?=$jslib?>"></script>
    <?php endforeach; ?>

    <!--  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js">
      </script> -->
    <script type="text/javascript">
        function reload(id) {
            let url="<?=base_url()?>".concat("index.php/Questionnaire_controller/update/").concat(id);
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

<div class="container">

    <div class="row " id="top_row">
        <div class="col-8">
            <div id="category">
                <p>{category}</p>
            </div>
        </div>

        <div class="col-2">

        </div>

        <div class="col-2" id ="test">
            <button id="quit" onclick="residentHome()">Quit</button>
        </div>

    </div>

    <div class="row" id="second_row">


        <div class="col-12">
            <div id ="text_question">
                <p>{agree}</p>
            </div>
        </div>
        <div class="col-0">
        </div>



        <div class="col-0" id ="test">
        </div>

    </div>

    <div class="row" id="third_row">


        <div class="col-8">
            <div id="text">
                <p>{question}</p>
            </div>
        </div>

        <div class="col-3">
        </div>



        <div class="col-1" id ="test">
        </div>
    </div>

    <div class="row" id="fourth_row">

        <form action="<?= site_url('questionnaire_controller/update') ?>" method="get">
            <input type="submit" name="never" value="never" id="never">
            <input type="submit" name="rarely" value="rarely" id="rarely">
            <input type="submit" name="sometimes" value="sometimes" id="sometimes">
            <input type="submit" name="mostly" value="mostly" id="mostly">
            <input type="submit" name="always" value="always" id="always">
        </form>
    </div>

    <div class="row" id="fifth_row">

        <div class="col-5">

        </div>

        <div class="col-7">
            <div id="progress">
                <p>{progress}</p>
            </div>
        </div>
    </div>

    <div class="row" id="last_row">



        <div class="col-0">
            <div id="return">
                <a href="">Return</a>
            </div>
        </div>

        <div class="col-12">

        </div>
    </div>


    <aside>

    </aside>
</div>

</body>
</html>

