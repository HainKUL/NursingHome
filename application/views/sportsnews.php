<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="keywords" content="UXWD's course demo" />
    <title>{page_title}</title>
    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
    </select>
</head>
<style>
    .title1 {
        font-size: 40px;
        /*text-align: center;*/
    }
    .button1
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
    .button1:active { /* to show button being pressed*/
        background-color: grey;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }
    h4 {
        font-size: xx-large;
    }
    p
    {
        font-size: xx-large;
    }

</style>

<body>
<p class ="title1">{content_title_1}</p>
<button type="button"class="button1" ><a class="link1" href="residentHome">{buttonBack}</a></button>
<!--<iframe width="100%" height="750" frameborder="0" class="rssdog" src="https://www.rssdog.com/index.php?url=https%3A%2F%2Fsportmagazine.knack.be%2Fsport%2Ffeed.rss&mode=html&showonly=&maxitems=5&showdescs=1&desctrim=0&descmax=0&tabwidth=100%25&linktarget=_blank&textsize=x-large&fullhtml=1&bordercol=transparent&headbgcol=transparent&headtxtcol=%23ffffff&titlebgcol=transparent&titletxtcol=%23000000&itembgcol=transparent&itemtxtcol=%23000000&ctl=0"></iframe>
-->
<script src="//rss.bloople.net/?url=https%3A%2F%2Fsportmagazine.knack.be%2Fsport%2Ffeed.rss&showtitle=false&type=js"></script>
</body>
</html>