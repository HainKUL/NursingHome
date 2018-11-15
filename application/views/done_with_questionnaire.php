<!DOCTYPE html>
<meta charset="UTF-8">

<html lang="en">
<head>
    <title>{page_title}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS one for localhost, the other for on the server-->
    <link href="http://localhost/a18ux04/assets/css/older_adult.css" rel="stylesheet" type="text/css"/>
    <!-- Custom CSS
    <link href="<?=base_url() ?>assets/css/older_adult.css" rel="stylesheet" type="text/css"/> for on the actual site-->

</head>


<body>

<div class="container">

    <div class="row" id="top_row">

        <div class="col-2">
        </div>

        <div class="col-8">

            <div id="title">
                <p>{head_message}</p>
            </div>

        </div>

        <div class="col-2" id ="test">
        </div>

    </div>

    <div class="row">

        <div class="col-2">
        </div>

        <div class="col-10">

            <div id="text">
                <p>{first_sentence}</p>
                <p>{second_sentence}</p>
            </div>
        </div>

        <div class="col-0">
        </div>

    </div>

    <div class="row">

        <div class="col-4">
        </div>

        <div class="col-6">
            <button id="button_done" href="#">{button_text}</button>
        </div>

        <div class="col-2">
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