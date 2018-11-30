<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">

    <title>{page_title}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?=base_url() ?>assets/css/features.css" rel="stylesheet" type="text/css"/>

    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
    </select>
</head>


<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2" style="padding-bottom:10px" >
            <a class="link1" href="news">
                <button type="button" class ="btn btn-default button1 float-right" >
                    {buttonBack}
                </button>
            </a>
        </div>
    </div>
    <div class="row">

        <div class = "col-md-12"">
        <h1 class="h1">
            {content_title_1}
        </h1>
    </div>

<iframe width="100%" height="850" frameborder="0" class="rssdog" src="https://www.rssdog.com/index.php?url=http%3A%2F%2Fwww.standaard.be%2Frss%2Fsection%2F1f2838d4-99ea-49f0-9102-138784c7ea7c&mode=html&showonly=&maxitems=7&showdescs=1&desctrim=0&descmax=0&tabwidth=100%25&excltitle=1&linktarget=_blank&textsize=xx-large&bordercol=transparent&headbgcol=blue&headtxtcol=white&titlebgcol=%2585858&titletxtcol=%23282828&itembgcol=%2585858&itemtxtcol=%23282828&ctl=0"></iframe>
</div>
</body>

</html>