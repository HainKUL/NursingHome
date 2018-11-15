<!DOCTYPE html>
<html>
<head>
    <title>Care for you</title>
    <link href="<?= base_url()?>assets/css/main.css" rel="stylesheet" type="text/css"/>
    <meta charset="UTF-8" />
    <meta name="keywords" content="UXWD's course demo" />
    <meta name="description"
          content="This a demonstration site for the UXWD's course. But still... the question is... who will cook tonight?" />
    <link href="https://fonts.googleapis.com/css?family=Dosis:400,500,600,700" rel="stylesheet">

    <?php if(isset($jslibs_to_load)) foreach ($jslibs_to_load as $jslib) : ?>
        <script src="<?= base_url()?>assets/js/<?=$jslib?>"></script>
    <?php endforeach; ?>

    <!--  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js">
      </script> -->
    <script type="text/javascript">
        function reload(id) {
            let url="http://localhost/a18ux04/index.php/Questionnaire_controller/update/".concat(id);
            window.location.href = url;
        }

        function residentHome() {
            let url="http://localhost/a18ux04/index.php/Homepage_controller/residentHome"
            window.location.href = url;
        }

    </script>
</head>

<body>
<header>
    <div id="category">
        <h1>{category}</h1>
    </div>
    <button id="quit" onclick="residentHome()">Quit</button>

</header>
<main>
	<section>
        <h4>How do you agree with the following statement:</h4>
        <h1>{question}</h1>
        <div>
            <button id="never" onclick="reload({progress})">Never</button>
            <button id="rarely" onclick="reload({progress})"> Rarely </button>
            <button id="sometimes" onclick="reload({progress})">Sometimes</button>
            <button id="mostly" onclick="reload({progress})">Mostly</button>
            <button id="always" onclick="reload({progress})">Always</button>
        </div>

        <h3>{progress}/52</h3>
	</section>
	<aside>
        <a href="#">Return</a>
	</aside>
</main>


</body>
</html>
