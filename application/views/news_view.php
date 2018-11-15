<!DOCTYPE html>
<html>
<head>
    <title>{page_title}</title>
    <!--<link href="<?=base_url()?>assets/css/main.css" rel="stylesheet" type="text/css"/>-->
    <meta charset="UTF-8" />
    <meta name="keywords" content="UXWD's course demo" />

</head>
<style> /* should be in css*/
    p {
        color: black;
    }
    .titel1 {
        font-size: 40px;
        /*text-align: center;*/
    }
    .titel2 {
        font-size: 35px;
        /*text-align: center;*/
    }
    .content1
    {

        font-size: 28px;
        text-align: left;
    }
    .button1
    {
        display: block;
        /*margin: auto; /* put button in the middle */
        padding: 10px 20px; /*make button bigger than text*/
        font-size: 20px;
        text-align: center;
        color: #fff;
        background-color: #d5d5d5;
        border-radius: 15px;

    }
    .button1:active { /* to show button being pressed*/
        background-color: grey;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }
    .button2
    {
        display: block;
        margin: auto; /* put button in the middle */
        padding: 10px 20px; /*make button bigger than text*/
        font-size: 20px;
        text-align: center;
        color: #fff;
        background-color: #d5d5d5;
        border-radius: 15px;

    }
    .button2:active { /* to show button being pressed*/
        background-color: grey;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }
    .link1{
        color: black;
        text-decoration: none;

    }
    .image1
    {
        width:70px;
        height:70px;
        display: inline-block;
        position: relative;


    }
    .image2
    {
        width:90px;
        height:50px;
        display: inline-block;
        position: relative;

    }
    .image3
    {
        width:140px;
        height:35px;
        display: inline-block;
        position: relative;

    }
</style>

<body>
<p class ="titel1">{content_title_1}<button type="button"class="button2" ><a class="link1" href="residentHome">{buttonBack}</a></button></p>
<p class="titel2">{content_title_2}</p>

    <!--<p class = "content1"><img src="http://localhost:8888/a18ux04/assets/photos/hln.jpg" class="image1">Het Laatste Nieuws</p>
    <button type="button" class="button1"><a class="link1" href="http://localhost:8888/a18ux04/index.php/Homepage_controller/hln">KLIK HIER</a></button>
-->


    <img src="http://localhost:8888/a18ux04/assets/photos/nieuwsblad.jpg" class="image1">
    <button type="button" class="button1"><a class="link1" href="nieuwsblad">{buttonClickHere}</a></button>

    <img src="http://localhost:8888/a18ux04/assets/photos/standaard.jpg" class="image2">
    <button type="button" class="button1"><a class="link1" href="standard">{buttonClickHere}</a></button>

    <img src="http://localhost:8888/a18ux04/assets/photos/demorgen.png" class="image3" >
    <button type="button"class="button1" ><a class="link1" href="dm">{buttonClickHere}</a></button>


</body>

</html>


