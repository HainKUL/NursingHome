<?php
if(!isset($_SESSION["resident"]))
{

    echo "<script> 
                    alert('You are not logged in!'); 
                    window.location.href='".base_url()."index.php/Face_Login_controller/face_login';
          </script>";

    exit();

}
//echo $_SESSION['lang'];
//echo $_SESSION['birth'];
?>
<!DOCTYPE html>
<meta charset="UTF-8">

<html>
<head>
    <title><?php echo $this->lang->line('home'); ?></title>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!--    <link href="--><?//=base_url()?><!--assets/css/features.css" rel="stylesheet" type="text/css"/>-->
    <link href="<?=base_url()?>assets/css/questionnaire.css" rel="stylesheet" type="text/css"/>


</head>

<body>
<div class="container-fluid menu_container">
    <div class="row header " style="margin-bottom:5vh;">
        <div class="col-1"></div>
        <div class="col-5 header-title">
            <p><?php echo $this->lang->line('welcome'); ?></p>
        </div>
        <div class="col-5 header-button" id ="test">
            <a class="button_back" href="<?=base_url()?>index.php/Homepage_controller/logout">
                <p id="logout_text"><?php echo $this->lang->line('logout'); ?></p>
            </a>
        </div>
        <div class="col-1"></div>
    </div>
    <div class="row">
    <div class="col-2"></div>
    <div class="col-8 button-box">

        <div class="row">
            <div class="col-2"></div>
            <div class="col-1 button-icon">
                <img id="menu_icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAexSURBVGhD5VppT1tHFI1U9S9Ular2f7Rfq6qV+q1S/0KXAFFWpWmiAFJolIDdsDghhng3i9kSINQ4hM2YfTUGEyAEzBbCvm82t/fOW/yesQ0JPAe1I47kmfvmzjlv7szcsTmnRHlwwfhVWrwuWRWnd6kS9NMM9DlOn5T2u+5L/rGzW2w/2z5RxetuIbZV8XrQXDUsFKlMu0Uq867mqn6B2tLidFtpcfqb9Czf7WwV1a+GL5BgPZHNuWl4PdFmW96dLAUpxlttyzm3DGOcIHwW+/DdlSn41r7DwZrxzb45PvTrqgSd32XL29z1ccR9HTaaFYapThtr20GbsyBvUx2vD7A+YX1FQIKhKe28/lueZvRy/7z+czVOf9YlQ8CSZIGjoLlsBHrDuttGmOooks1A/n0TsxEK7pllNpwdeHzDwGzkI5zvUGReZOI3U38zfcbTjVxU5/U/kHNnTimMVTqiYqisGtIvGsCSYoaNsRIZUYLLlo9EiawBWoryD9lXR0rAkGxiPshXuDGkcGpLmXCMmO95upFLarz+R3q4TmOFvrziqHipKWCOvbWFh0gKoDdPCGcjDNYUMh/kK9wYUhAnepY48nQjF0FIbZYVuoz5Ilpy86D+kRyld83M8Uy3PKTeB9SXfJCvUP+tOKaUA3E6kRBHuhXUCVw8h4Ov/cOFUN9wPgk0piMjyOPEQqxJXBx3O1wytD1vZIPpEo1QnWv9IFBf9QU9dDo6oa+ul6GnpoX5pzFp7FMTYk40QeYVE+wtjx1Cf50LniTmg+aa6Zgw8+DqTxILYNDVA7C9wuBfnRR905g0dkyEvA8Cm/PgX58V6/srb+BgaykoQmIjZF4xKydkecILnsZWcbD50QEYam4X6zODbhjt6BLrE329DAEkGdh8x2wzXjfaSMQCjHR4YXlqGgIbc+x58r3s86LIcci6alFOSEt5A2ASCJtzI6xeY3GwUBGIlz2sgJzbBWK9IK0MClRPkfQi7K2MMRs9E9h4x2ZBc80Ctfn1zEY+ybeztBYONheVFdJMQtC+8ZYT4jBV44BBISWZ5aC9lS/W81NJSDl7w1QnW2lWpRhORNZhdjAb+STfzhKnaFNMyLsRDzQ/wzfIE53y9EGn3SnWx7q7wV3bzNfHYbgDQ68lGGruujbweUY5IVsr0GV3MR+CvbXCBUu+SeWFRMP+Gu44uIC5Oq6BzQXwr00H7SsTSHCZE4GQ2ghUF2wfTwiGzsH+NgSQKNVp8QbW30rsJGxRJEmLX7Qh9ld92B4U+dGEkACAA/zz4+dFJD2P7cLsjMEBv7iZCGYL9qX1A9vBbVjARwstEuPHmWA7FK4PsR3fvkCOZoV2KLEffpbOlBQxETLZ3weV2ufwLLsS7AY7LI3T3u+D0W4vlGdz7YTyx1VQoXXwqGa2V22dzMdgYxuUa+2ivb2qPfZCniQVgk1dBtVGOxhTipDQc/Zmu6qb2VkhIDfRJkJoE3a51oommb1K9zL2Qujs8DRwJ3xDYQ0efM9CUgxc/NL0Y21KYju8QzHsrMrqMRGS/YcVGmwv4XVnF1Tk2KEovYK1+9y9UI/tjcVOaCxxMTQUN7C2IGoxQ2jF7TpkbeBGIRUTEyHtVY2QcYm7kz+8ngcj7VzcU3pBbUchC1OTtVl+EyDy/l3c9bD490QxMRFCoAOOwkdIPwj+9RnxjXI7VHALZjsUJoqCXUQAyUtLYB/bV2MlhFsDdJAJbft4lwgeastMqLQPZb+HRAjY2+JE7O+IbTEQQqc03i1k6Yf0UEMRkgsSQXqWRASFlaSuuBBp+rG99BryhhqgabKfDe6c8kBKzz9wp6dKRAqh1x4R99wOmFkK2cUwoVT0YkVrgJLB+flhWERoPTVwub0MXFMDjMDArBf03joRBm89GF+5osI63AJLa3MyIX5MQGlMRYRQuAjph9pdDdc6njIRjoleNnhofkXhJj1Ljgt6WdRfISFmfnFzC3hg2g23uyuhxtfHBucEvoEuXzc88rxgyB6sQ9SHhW7ICVs4s6EipFmxIkJo4flXg6czCaI4ZgS2aHFzApsnukDltoO6/wWiJiI0A3WwsTEvF8Hf2wUoMyOS62xo+sEuVBIClKpICR4HoWFJUGyNcANwNz+BgH+Ni2cBNGtSgsfBoYOTh6JCaNsVCISGArvKCuF2TAiZwcbcCKzNDMuQcVkhIdKMlWZFHgofsEPh2qJ+tgfljGA42O6YT1kIrhEh/SDCRECcCbYth8mhooI7/eeGPYycVu0Ak6mNITe9hrWlXzJCkzb4jfyJhViTLWzXYgQwdIQdionAewZLv/e3Q4hGh5DezA71M3JFVa/gxdguVHYvQMaNAiaiTnPKPytYSAim3RyBMDsUpeA7a4fIRoL0AiYVEk0E4cRCKLTYOSIhwESgqHBEo0H2FRFCEGKxdkYVQTgVIfJzRDgQ5d9DHYUAHoBSHwRBCH3nG00E4cRCaOegH2PMfxWJsNwtRZS9B0pl/QXok22M3FEiCCcWQr/lWXFWdH8qA/LtzI4ugnBiIWcF/08haQm6b+jh4hQzuPAwOksgTsTt7zjj1zzdyIX/Dx8ndTiLUMfrGo79n0WPf3n8aWq87idVnO76WQJxIm48zf9iOXfuX0jHPygwONrlAAAAAElFTkSuQmCC" alt="Vragenlijst">
            </div>
            <div class="col-6">
                <a href="<?=base_url()?>index.php/questionnaire_controller/questionnaire_start/<?php echo $_SESSION['id']?>">
                    <button type = "button" class="button_menu button_margin">
                        <?php echo $this->lang->line('questionnaire'); ?>
                    </button>
                </a>
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row">
            <div class="col-2"></div>
            <div class="col-1 button-icon">
                <img id="menu_icon" src="data:image/png;base64,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" alt="nieuws">
            </div>
            <div class="col-6" >
                <a href="<?=base_url()?>index.php/Homepage_controller/news">
                    <button type = "button" class="button_menu button_margin">
                        <?php echo $this->lang->line('newspaper'); ?>
                    </button>
                </a>
            </div>
            <div class="col-3"></div>
        </div>

        <div class="row">
            <div class="col-2"></div>
            <div class="col-1 button-icon">
                <img id="menu_icon" src="data:image/png;base64,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" alt="Sport">
            </div>
            <div class="col-6" >
                <a href="<?=base_url()?>index.php/Homepage_controller/sportsnews">
                    <button type = "button" class="button_menu button_margin">
                        <?php echo $this->lang->line('sports'); ?>
                    </button>
                </a>
             </div>
            <div class="col-3"></div>
        </div>

        <div class="row">
            <div class="col-2"></div>
            <div class="col-1 button-icon">
                <img id="menu_icon" src="data:image/png;base64,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" alt="Het weer">
            </div>
            <div class="col-6" >
                <a href="<?=base_url()?>index.php/Homepage_controller/weathers">
                    <button type = "button" class="button_menu button_margin">
                        <?php echo $this->lang->line('weather'); ?>
                    </button>
                </a>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <div class="col-2"></div>
    </div>
</div>

</body>


</html>