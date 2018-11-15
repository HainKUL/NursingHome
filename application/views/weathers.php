<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="keywords" content="UXWD's course demo" />
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
<p class ="titel1">{content_title_1}</p>
<button type="button"class="button1" ><a class="link1" href="residentHome">{buttonBack}</a></button>

<!--<iframe scrolling="no" width="334" height ="175" frameborder="0" marginwidth="0" marginheight="0" src="https://www.meteo.be/services/widget/.?postcode=3000&nbDay=2&type=4&lang=nl&bgImageId=1&bgColor=567cd2&scrolChoice=0&colorTempMax=A5D6FF&colorTempMin=ffffff"></iframe>-->
<iframe scrolling="no" width="1950" height ="700" frameborder="0" marginwidth="0" marginheight="0" src="https://www.meteo.be/services/widget/.?postcode=3000&nbDay=2&type=11&lang=nl&bgImageId=1&bgColor=567cd2&scrolChoice=2&colorTempMax=ffffff&colorTempMin=ffffff"></iframe>
</body>
</html>