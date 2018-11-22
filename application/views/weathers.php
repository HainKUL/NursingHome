<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>{page_title}</title>

</head>
<style>
    .titel1 {
        font-size: 40px;
        /*text-align: center;*/
    }
    .button1
    {
        display: inline-block;
        margin: auto; /* put button in the middle */
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
</style>

<body>
<button type="button"class="button1" ><a class="link1" href="residentHome">{buttonBack}</a></button>

<!--<iframe scrolling="no" width="334" height ="175" frameborder="0" marginwidth="0" marginheight="0" src="https://www.meteo.be/services/widget/.?postcode=3000&nbDay=2&type=4&lang=nl&bgImageId=1&bgColor=567cd2&scrolChoice=0&colorTempMax=A5D6FF&colorTempMin=ffffff"></iframe>-->
<iframe scrolling="no" width="1800" height ="900" frameborder="0" marginwidth="0" marginheight="0" src="https://www.meteo.be/services/widget/.?postcode=3000&nbDay=2&type=11&lang=nl&bgImageId=1&bgColor=567cd2&scrolChoice=0&colorTempMax=ffffff&colorTempMin=ffffff"></iframe>
<!--<script src="//www.powr.io/powr.js?external-type=html"></script>
<div class="powr-weather" id="2ca6ab20_1542708558"></div>-->


</body>
</html>