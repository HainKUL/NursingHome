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
    }.button1
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
</style>
<body>
<p class ="titel1">{content_title_1}</p>
<button type="button"class="button1" ><a class="link1" href="nieuws">{buttonBack}</a></button>
<iframe width="100%" height="750" frameborder="0" class="rssdog" src="https://www.rssdog.com/index.php?url=https%3A%2F%2Fwww.demorgen.be%2Frss.xml&mode=html&showonly=&maxitems=7&showdescs=1&desctrim=0&descmax=0&tabwidth=100%25&excltitle=1&linktarget=_blank&textsize=xx-large&bordercol=white&headbgcol=blue&headtxtcol=white&titlebgcol=white&titletxtcol=black&itembgcol=white&itemtxtcol=black&ctl=0"></iframe>

</body>
</html>