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
            let url="<?=base_url()?>index.php/Questionnaire_controller/update/".concat(id);
            window.location.href = url;
        }

        function residentHome() {
            let url="<?=base_url()?>index.php/Questionnaire_controller/menu"
            window.location.href = url;
        }

    </script>
</head>

<body>

<div class="container-fluid">

    <div id="card">

        <div class="row " id="top_row">
            <div class="col-8">
                <div id="category">
                    <p>{category}</p>
                </div>
            </div>
            <div class="col-3">
            </div>
            <div class="col-1" id ="test">
                <a onclick="residentHome()">
                    <img id="quit_icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAALfSURBVGhD7Zpfb9JQGMbxK6nfwms/hYBOHf678ELvdIsJqLTQliUDNqZmcdkmmmwCJiZeuItplkjYNF5vjsSR6M3reWoPPSt/7Kn10My+yRP68p73vM8PSgbtEnHEEYd8UIJOzV4onp1JWuejJHhyLP45AMGaFpkoippNlqqO1fHhvBO0rpWp06pFSmvME7zdT5fOOHZHx72kdQ6L997W6MfXZ5ESPMEbPDp2R8eJBvneeUqNcpXqxbJSNSsVe3ZoIICYSVmUS5tKhZmACQ1k5dE8ZdMW7V/XlAozMTsGiUFCljqQmzod5hZp/4bneRmx3m5+iQ5uFQZqykAA8fPbLh29bgWDYT1HG017D8B46+reEcGINIyPXnUgEAxtNuRgfEBAakEgGRifEJB6EEiE2WwONyhCjFojaDIg0DijkhDQ5ECgYYYDQECTBYFE4+wxCAQ0eRBIgAkCAYUD8qZKvR2Deh/y9PxBMRgIM98HYVBBQDAbHuAFnqRBdl/p1Nt+bEsaRIA4dmpJwvRBHB/wJA3SeclehSAgHgjb+LDnhvV65AWBJzUg4wwHgJkMiGiU/WEcatTPGkHqQWCQfd3wZVBirVoQGQgunz3qQIJAcIm9Iz4zykC6c8vBILgEmMPswkBdGcjBbYO61nIwCC7Wa/9cZj+bvTVlIP9aMQhCFuRzRqOtq+4VkPa0TtvTbr7DjiGeo9bOuKcReveuDZ5WkFKQtaki5VJmP1+6ZJCedvPyRdMWz1HDGp6jF3vwXFToIA2zcOwidmmKGbvDPux3NVrNGPZAHEO1KwZpzDjP5y+btniOGtbwHL3YA8fYE3uLF7ExOzSQ7nsGYxVo/eFvtebczb9s5OndgvtNuV3XaeuJm39c0W3xHLV2Xevn6MUePMfefA5mYjav/TVIVPR/gvCboWtZgz690CKl1Zxhg/i6GYrALWA0RFIps+LY9BfR/IcB87RjL4444pCKROIXinxKROhJMmAAAAAASUVORK5CYII=" alt="Quit">
                </a>
                <p id="quit_text" onclick="residentHome()">{quit}</p>
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
            <div class="col-12">
                <div id="text">
                    <p>{question}</p>
                </div>
            </div>
        </div>

        <div class="row" id="fourth_row">
            <div class="col-1">
            </div>
            <div class="col-2">
                <button id="never" onclick="reload({progress})" class="answer_button" >{button_never}</button>
            </div>
            <div class="col-2">
                <button id="rarely" onclick="reload({progress})" class="answer_button">{button_rarely}</button>
            </div>
            <div class="col-2">
                <button id="sometimes" onclick="reload({progress})" class="answer_button">{button_sometimes}</button>
            </div>
            <div class="col-2">
                <button id="mostly" onclick="reload({progress})" class="answer_button">{button_mostly}</button>
            </div>
            <div class="col-2">
                <button id="always" onclick="reload({progress})" class="answer_button">{button_always}</button>
            </div>
            <div class="col-1">
            </div>
        </div>

        <div class="row" id="fifth_row">
            <div class="col-12">
                <div id="progress">
                    <p>{progress}/52</p>
                </div>
            </div>
        </div>
        <div class="row" id="last_row">
            <div class="col-1">
                <div id="return">
                    <a href="">Return</a>
                </div>
            </div>
            <div class="col-11">
            </div>
        </div>
    </div>
</div>

</body>
<!--
<footer>

    icons from <a href="https://icons8.com">Icon pack by Icons8</a>

</footer>
-->
</html>

