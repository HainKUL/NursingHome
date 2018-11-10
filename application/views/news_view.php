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
        text-align: center;
    }
    .titel2 {
        font-size: 38px;
        text-align: center;
    }
    .content1
    {
        font-size: 30px;
        text-align: center;
    }
    .button1
    {
        display: block;
        margin: auto; /* put button in the middle */
        padding: 15px 25px; /*make button bigger than text*/
        font-size: 24px;
        text-align: center;
        color: #fff;
        background-color: grey;
        border-radius: 15px;

    }
    .button1:active { /* to show button being pressed*/
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
        width:60px;
        height:60px;
        display: block;
        position: relative;
        margin-left: auto;
        margin-right: auto;

    }
    .image2
    {
        width:100px;
        height:60px;
        display: block;
        position: relative;
        margin-left: auto;
        margin-right: auto;
    }
    .image3
    {
        width:140px;
        height:40px;
        display: block;
        position: relative;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<body>
<p class ="titel1">{content_title_1}</p>
<p class="titel2">{content_title_2}</p>

    <p class = "content1"><img src="http://localhost:8888/a18ux04/assets/photos/hln.jpg" class="image1">Het Laatste Nieuws</p>
    <button type="button" class="button1"><a class="link1" href="http://localhost:8888/a18ux04/index.php/Homepage_controller/hln">KLIK HIER</a></button>

    <p class = "content1" ><img src="http://localhost:8888/a18ux04/assets/photos/nieuwsblad.jpg" class="image1">Het Nieuwsblad </p>
    <button type="button" class="button1"><a class="link1" href="http://localhost:8888/a18ux04/index.php/Homepage_controller/nieuwsblad">KLIK HIER</a></button>

    <p class = "content1"><img src="http://localhost:8888/a18ux04/assets/photos/standaard.jpg" class="image2">De Standaard </p>
    <button type="button" class="button1"><a class="link1" href="http://localhost:8888/a18ux04/index.php/Homepage_controller/standard">KLIK HIER</a></button>

    <p class = "content1"><img src="http://localhost:8888/a18ux04/assets/photos/demorgen.png" class="image3" >De Morgen</p>
    <button type="button"class="button1" ><a class="link1" href="http://localhost:8888/a18ux04/index.php/Homepage_controller/dm">KLIK HIER</a></button>
</body>

</html>


