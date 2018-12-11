<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="<?=base_url() ?>assets/css/features.css" rel="stylesheet" type="text/css"/>

    <title>{page_title}</title>

</head>


<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2" style="padding-bottom:10px" >
            <a class="link1" href="residenthome">
                <button type="button" class ="btn btn-default button_back float-right" >
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
    <iframe width="100%" height="750" frameborder="0" class="rssdog" src="https://www.rssdog.com/index.php?url=https%3A%2F%2Fsportmagazine.knack.be%2Fsport%2Ffeed.rss&mode=html&showonly=&maxitems=0&showdescs=1&desctrim=0&descmax=0&tabwidth=100%25&linktarget=_blank&textsize=xx-large&bordercol=transparent&headbgcol=%232585858&headtxtcol=%23ffffff&titlebgcol=%232585858&titletxtcol=%23000000&itembgcol=%232585858&itemtxtcol=%23000000&ctl=0"></iframe>
</body>

</html>