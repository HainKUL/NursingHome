<!DOCTYPE html>
<meta charset="UTF-8">

<html lang="en">
<head>
    <title>{page_title}</title>
    <link rel="icon" href="<?=base_url()?>/assets/photos/favicon.png" type="image/gif" sizes="16x16">

    <link href="assets/css/older_adult.css" rel="stylesheet" type="text/css"/>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS one for localhost, the other for on the server-->
    <link href="<?=base_url()?>assets/css/older_adult.css" rel="stylesheet" type="text/css"/>

</head>

<body>

<div class="container-fluid">

    <div id="card_menu">

        <div class="row" id="top_row_m">
            <div class="col-1" >
                <a onclick="question()">
                    <img id="questionnaire_icon" src="data:image/png;base64,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" alt="Vragenlijst">
                </a>

            </div>

            <div class="col-8" id="menu_text">
                <button id="menu_button" onclick="#">{first}</button>

            </div>
            <div class="col-2">
            </div>
            <div class="col-1">
                <a onclick="question()">
                    <img id="logout_icon" src="data:image/png;base64,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" alt="poll">
                </a>
                <p id="logout_text" onclick="residentHome()">{logout}</p>
            </div>
        </div>
    </div>
    <div id="card_menu">

        <div class="row" id="second_row_m">
            <div class="col-1">
                <a onclick="#">
                    <img id="poll_icon" src="data:image/png;base64,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" alt="poll">
                </a>
            </div>

            <div class="col-8" id="menu_text">
                <button id="menu_button" onclick="#">{second}</button>
            </div>

            <div class="col-3">
            </div>
        </div>
    </div>

    <div id="card_menu">

        <div class="row" id="third_row_m">
            <div class="col-1">
                <a onclick="#">
                    <img id="news_icon" src="data:image/png;base64,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" alt="nieuws">
                </a>
            </div>

            <div class="col-8" id="menu_text">
                <button id="menu_button" onclick="#">{third}</button>
            </div>

            <div class="col-3">
            </div>
        </div>
    </div>

    <div id="card_menu">

        <div class="row" id="fourth_row_m">
            <div class="col-1">
                <a onclick="#">
                    <img id="tvguide_icon" src="data:image/png;base64,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" alt="tv-gids">
                </a>
             </div>

            <div class="col-8" id="menu_text">
                <button id="menu_button" onclick="#">{fourth}</button>
            </div>

            <div class="col-3">
            </div>
        </div>
    </div>

    <div id="card_menu">

        <div class="row" id="fifth_row_m">
            <div class="col-1">
                <a onclick="#">
                    <img src="data:image/png;base64,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" alt="Familiefoto's">
                </a>
            </div>

            <div class="col-8" id="menu_text">
                <button id="menu_button" onclick="#">{fifth}</button>
            </div>

            <div class="col-3">
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
    icons from <a href="https://icons8.com">Icon pack by Icons8</a>
    -->
</footer>

</html>