<?php
if(!isset($_SESSION['id']))
{

    header("Location:".base_url()."Caregiver_controller/login");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/ >

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

    <!-- D3.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/1.3.0/d3-legend.js" charset="utf-8"></script>



    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



    <!--    <script src="--><?//= base_url()?><!--assets/js/trail.js"></script>-->


    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 11px;
            font-weight: 300;
            fill: #242424;
            text-align: center;
            /*text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, -1px 0 0 #fff, 0 -1px 0 #fff;*/
            cursor: default;

        }
        .bar:hover{
            fill: red;
        }
        .tooltip {
            fill: #333333;
        }
        .radio{
            text-align: end;
        }
        .form-radio
        {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: inline-block;
            position: relative;
            background-color: #f1f1f1;
            color: #666;
            top: 10px;
            height: 30px;
            width: 30px;
            border: 0;
            border-radius: 50px;
            cursor: pointer;
            margin-right: 7px;
            outline: none;
        }
        .form-radio:checked::before
        {
            position: absolute;
            font: 13px/1 'Open Sans', sans-serif;
            left: 11px;
            top: 7px;
            content: '\02143';
            transform: rotate(40deg);
        }
        .form-radio:hover
        {
            background-color: #f7f7f7;
        }
        .form-radio:checked
        {
            background-color: #f1f1f1;
        }


        select {
            font-family: sans-serif;
            font-size: 30px;
            background: none repeat scroll 0 0 #FFFFFF;
            border: 1px solid #E5E5E5;
            border-radius: 5px 5px 5px 5px;
            box-shadow: 0 0 10px #E8E8E8 inset;
            height: 40px;
            padding: 8px;
            width: 210px;
            margin-left:100px;

        }

        .category{
            margin: 0px 0px 0px 40px;
            width: 210px;
        }



        option {
            direction: ltr;
        }

        label
        {
            font: 300 16px/1.7 'Open Sans', sans-serif;
            color: #666;
            cursor: pointer;
        }

    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.png" type="image/gif" sizes="16x16">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS-->

    <link href="<?= base_url()?>assets/css/dashboard.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<?php
$currentID = $_SESSION['id'];
$this->load->database();
$query = "SELECT Notes.noteText, Notes.author, Notes.timestamp, Caregivers.firstName FROM Notes INNER JOIN Caregivers on Notes.author = Caregivers.idCaregivers ORDER BY Notes.timestamp DESC;";
$result = $this->db->query($query);
$query = "SELECT firstName, name, idResidents, YEAR(CURRENT_TIMESTAMP) - YEAR(dateOfBirth) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(dateOfBirth, 5)) as age FROM Residents;";
$residents = $this->db->query($query);
    $query = "SELECT firstName FROM Caregivers WHERE $currentID = Caregivers.idCaregivers;";
    $firstName = $this->db->query($query);
    $query = "SELECT email FROM Caregivers WHERE Caregivers.idCaregivers = $currentID;";
    $email = $this->db->query($query);

$query = "SELECT firstName FROM Residents;";
$residentsFirstname = $this->db->query($query);
    ?>

<script>
    $( function() {
        var availableTags =  <?php
            echo "[";
            foreach ($residentsFirstname->result_array() as $row) {
                echo '"';
                echo $row['firstName'];
                echo '",';

            }
            echo "]";
            ?>

        $( "#tags" ).autocomplete({
            source: availableTags
        });
    } );
</script>


<div class="container-fluid">


    <div class="row" style="height:100vh;">
        <div class="col-3" id="div1" style="background-color:#009489;padding:0;">
            <!-- <a href="<?=base_url()?>Dashboard/logout">
            <button class="btn btn-primary btn-lg" type="button" style="min-width:100%;background-color:#009489;border:none;" >
                <p><?php echo $this->lang->line('dash_logout'); ?></p>
            </button>
            </a> -->
            <div style="height:5%;"></div>
            <div class="searchdiv" style="text-align:center;margin:15px;">
                <h2 class="floornumber"><?php echo $this->lang->line('dash_floor'); ?> 1</h2>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button"><?php echo $this->lang->line('dash_select_floor'); ?></button>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" role="presentation" href="#"><?php echo $this->lang->line('first_floor'); ?></a>
                        <a class="dropdown-item" role="presentation" href="#"><?php echo $this->lang->line('second_floor'); ?></a>
                        <a class="dropdown-item" role="presentation" href="#"><?php echo $this->lang->line('third_floor'); ?></a>
                        <a class="dropdown-item" role="presentation" href="#"><?php echo $this->lang->line('fourth_floor'); ?></a>
                        <a class="dropdown-item" role="presentation" href="#"><?php echo $this->lang->line('fifth_floor'); ?></a>
                        <a class="dropdown-item" role="presentation" href="#"><?php echo $this->lang->line('sixth_floor'); ?></a>
                    </div>
                </div>
                <div class="ui-widget" >
                    <input id="tags" for="tags" class ="searchbar" type="search" placeholder="<?php echo $this->lang->line('search'); ?>">
                </div>
            </div>
            <div style="overflow-y:scroll;max-height:68vh;">
                <div class="btn-group-vertical btn-group-lg" role="group" style="width:100%;">
                    <?php
                    foreach ($residents->result_array() as $row) {
                        ?><button class="btn btn-primary btn-resident" id="<?php echo $row['idResidents']?>" type="button" onclick="loadResident(this.id)">
                        <div class="resident-button">
                            <img class="profilePic" src="<?=base_url() ?>assets/photos/profilePicTest.jpg" alt="Avatar">
                        <span class="resident-nameage"><div class="button-name"><?php
                        echo $row['firstName'];
                        ?></div><div class="button-age"><?php
                        echo $row['age'] ?></div>
                            <?php
                            ?></span></div></button><?php
                    }
                    ?>

                </div>
            </div>
        </div>
        <div class="col-3 hiddendiv" id="div2" style="background-color:#009489;padding:0;">
            <div style="height:5%;"></div>
            <h2 class="floornumber" style="padding:15px"><?php echo $this->lang->line('polls');?></h2>
            <a href="#" style="padding:10%">
                <button class="btn btn-primary btn-lg" type="button" style="width:80%;background-color:#00675F;border:none;color:#DEEAE9">
                    ADD POLL
                </button>
            </a>
            <div style="overflow-y:scroll;max-height:70vh;">

                <div class="btn-group-vertical btn-group-lg" role="group" style="width:100%;">
                    <button class="btn btn-primary btn-resident" id="settings1" type="button" onclick="settingsButton(this.id)">
                        <div class="resident-button">
                            <img class="profilePic" src="<?=base_url() ?>assets/photos/profilePicTest.jpg" alt="Avatar">
                            <span style="font-weight:100">
                                FOOD
                            </span>
                        </div>
                    </button>
                    <button class="btn btn-primary btn-resident" id="settings2" type="button" onclick="settingsButton(this.id)">
                        <div class="resident-button">
                            <img class="profilePic" src="<?=base_url() ?>assets/photos/profilePicTest.jpg" alt="Avatar">
                            <span style="font-weight:100">
                                ACTIVITIES
                            </span>
                        </div>
                    </button>
                </div>
            </div>







        </div>
        <div class="col-3 hiddendiv" id="div3" style="background-color:#009489;padding:0;">
            <div style="height:5%;"></div>
            <h2 class="floornumber" style="padding:15px"><?php echo $this->lang->line('personal');?></h2>
            <div style="overflow-y:scroll;max-height:70vh;">
                <div class="btn-group-vertical btn-group-lg" role="group" style="width:100%;">
                    <button class="btn btn-primary btn-resident" id="settings1" type="button" onclick="settingsButton(this.id)">
                        <div class="resident-button">
                            <img class="profilePic" src="<?=base_url() ?>assets/photos/profilePicTest.jpg" alt="Avatar">
                            <span style="font-weight:100">
                                <?php echo $this->lang->line('personal_settings');?>
                            </span>
                        </div>
                    </button>
                    <button class="btn btn-primary btn-resident" id="settings2" type="button" onclick="settingsButton(this.id)">
                        <div class="resident-button">
                            <img class="profilePic" src="<?=base_url() ?>assets/photos/profilePicTest.jpg" alt="Avatar">
                            <span style="font-weight:100">
                                <?php echo $this->lang->line('grouping');?>
                            </span>
                        </div>
                    </button>
                    <button class="btn btn-primary btn-resident" id="settings2" type="button" onclick="settingsButton(this.id)">
                        <div class="resident-button">
                            <img class="profilePic" src="<?=base_url() ?>assets/photos/profilePicTest.jpg" alt="Avatar">
                            <span style="font-weight:100">
                                <?php echo $this->lang->line('register_button');?>
                            </span>
                        </div>
                    </button>
                </div>
            </div>
            <div style="height:50vh; padding:60% 10%;">
            <a href="<?=base_url()?>Dashboard/logout" style="padding:20% 10%;">
                <button class="btn btn-primary btn-lg" type="button" style="width:80%;background-color:#00675F;border:none;color:#DEEAE9">
                    <?php echo $this->lang->line('dash_logout'); ?>
                </button>
            </a>
            </div>






        </div>
        <div class="col-3 hiddendiv" id="div4" style="background-color:#009489;padding:0;">
        </div>
        <div class="col-6" style="background-color:#f9f9f9;padding:0px;">
            <div style="width:100%;">
                <ul class="nav nav-tabs" style="text-align:center;border:none;">
                    <li class="nav-item" style="width:25%;"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1" style="border:none;" onclick="loadDiv1()"><?php echo $this->lang->line('dash_questionnaire'); ?></a></li>
                    <li class="nav-item" style="width:25%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2" style="border:none;" onclick="loadDiv2()"><?php echo $this->lang->line('dash_poll'); ?></a></li>
                    <li class="nav-item" style="width:25%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-3" style="border:none;" onclick="loadDiv3()"><?php echo $this->lang->line('dash_personal'); ?></a></li>
                    <li class="nav-item" style="width:25%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-4" style="border:none;" onclick="loadDiv4()"><?php echo $this->lang->line('dash_register'); ?></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="tab-1" style="padding:5%;max-height:94vh;overflow-y:scroll;">
                        <div class="card questionnaire-card">
                            <div class="card-body">
                                <div class="card-top">
                                    <div class="card-head">
                                        <img class="card-picture" src="<?=base_url() ?>assets/photos/profilePicTest.jpg" alt="Avatar">
                                        <span class="card-name" id="residentName"></span>
                                    </div>
                                </div>
                                <div class="card-text">
                                    <div class="card-birthdate"><?php echo $this->lang->line('birthday'); ?><span id="card-birthdate">22/06/1996</span></div>
                                    <div class="card-room"><?php echo $this->lang->line('roomnum'); ?><span id="card-room">502</span></div>
                                    <div class="card-bed"><?php echo $this->lang->line('bednum'); ?><span id="card-bed">1</span></div>
                                    <div class="card-privileges"><?php echo $this->lang->line('privileges'); ?><span id="card-privileges">: can go outside</span></div>
                                </div>
                                <div class="radarChart"></div>

                                <script src="../../assets/js/radarChart.js"></script>
                                <script type="text/javascript">
                                    var data = <?php echo json_encode($data1); ?>;
                                </script>

                                <script>
                                    //////////////////////////////////////////////////////////////
                                    //////////////////////// Set-Up //////////////////////////////
                                    //////////////////////////////////////////////////////////////


                                    //var margin = {top: 150, right: 70, bottom: 100, left: 100},

                                    var margin = {top: 120, right: 60, bottom: 40, left: 60},
                                        legendPosition = {x: 220, y: 10},
                                        width = Math.min(400, window.innerWidth - 10) - margin.left - margin.right,
                                        height = Math.min(width, window.innerHeight - margin.top - margin.bottom - 20); //////////////////////////////////////////////////////////////
                                    //////////////////// Draw the Chart //////////////////////////
                                    //////////////////////////////////////////////////////////////

                                    var color = d3.scale.ordinal()
                                        .range(["#42f4b0","#CCCC00","#00A0B0","#EDC951"]);


                                    var radarChartOptions = {
                                        w: width,
                                        h: height,
                                        margin: margin,
                                        legendPosition: legendPosition,
                                        maxValue: 0.5,
                                        wrapWidth: 60,
                                        levels: 5,
                                        roundStrokes: true,
                                        color: color,
                                        axisName: "category",
                                        areaName: "timestampStart",
                                        value: "answer"
                                        /*axisName: "reason",
                                         areaName: "device",
                                         value: "value"*/
                                    };

                                    //Load the data and Call function to draw the Radar chart
                                    RadarChart(".radarChart", data, radarChartOptions);
                                </script>
                            </div>
                        </div>
                        <div class="card questionnaire-card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $this->lang->line('dash_outliers'); ?></h4>
                                <p class="card-text">Super trouper beams are gonna blind me. But I won't feel blue. Like I always do. 'Cause somewhere in the crowd there's you. I was sick and tired of everything. When I called you last night from Glasgow. All I do is eat and sleep and sing. Wishing every show was the last show (wishing every show was the last show). So imagine I was glad to hear you're coming (glad to hear you're coming). Suddenly I feel all right. (And suddenly it's gonna be). And it's gonna be so different. When I'm on the stage tonight. Tonight the super trouper lights are gonna find me. Shining like the sun (sup-p-per troup-p-per). Smiling, having fun (sup-p-per troup-p-per). Feeling like a number one. Tonight the super trouper beams are gonna blind me. But I won't feel blue (sup-p-per troup-p-per). Like I always do (sup-p-per troup-p-per). 'Cause somewhere in the crowd there's you.</p>
                            </div>
                        </div>
                        <div class="card questionnaire-card">
                            <div class="card-body">
                                </br>
                                <h4 class="card-title"><?php echo $this->lang->line('dash_answers'); ?></h4>
                                <!--<h3><?php echo $this->lang->line('category_title2'); ?></h3>-->
                                <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
                                <script src="//d3js.org/d3.v4.min.js"></script>
                                <script src="https://d3js.org/d3.v4.min.js"></script>
                                <div class='container'>
                                    <div class='row'>
                                        <div class='radio'>

                                            </br>

                                            <div class = "date" style="float:left;">
                                                <select >
                                                    <option value="100">Please Select Date</option>

                                                    </select>
                                            </div>
                                            <div class = "category"; style="float:right;">
                                            <select >
                                                <option value="all" onclick='change(this.value)'>Please Select Category</option>
                                                <option name="name" value="all" onclick='change(this.value)'><?php echo $this->lang->line('category_all'); ?></option>
                                                <option name="name" value="0" onclick='change(this.value)'><?php echo $this->lang->line('category_0'); ?></option>
                                                <option name="name" value="1" onclick='change(this.value)'><?php echo $this->lang->line('category_1'); ?></option>
                                                <option name="name" value="2" onclick='change(this.value)'><?php echo $this->lang->line('category_2'); ?></option>
                                                <option name="name" value="3" onclick='change(this.value)'><?php echo $this->lang->line('category_3'); ?></option>
                                                <option name="name" value="4" onclick='change(this.value)'><?php echo $this->lang->line('category_4'); ?></option>
                                                <option name="name" value="5" onclick='change(this.value)'><?php echo $this->lang->line('category_5'); ?></option>
                                                <option name="name" value="6" onclick='change(this.value)'><?php echo $this->lang->line('category_6'); ?></option>
                                                <option name="name" value="7" onclick='change(this.value)'><?php echo $this->lang->line('category_7'); ?></option>
                                                <option name="name" value="8" onclick='change(this.value)'><?php echo $this->lang->line('category_8'); ?></option>
                                                <option name="name" value="9" onclick='change(this.value)'><?php echo $this->lang->line('category_9'); ?></option>
                                                <option name="name" value="10" onclick='change(this.value)'><?php echo $this->lang->line('category_10'); ?></option>
                                                </select>
                                            </div>
                                            </br>
                                            </br>

                                        </div>
                                        <svg class='chart'>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="tab-2">
                        <p>Content for tab 2.</p>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="tab-3">
                        <div class="container" >
                            <div class="row" style="padding-top: 40px";>
                                <div class="col-8">
                                    <p class="personal_text"> <?php echo $this->lang->line('hello'); if ($firstName->num_rows() > 0)
                                        {
                                            $row = $firstName->row();
                                            echo $row->firstName;
                                        } ?>!</p>
                                </div>
                                <div class="col-4">
                                    <img class="profilePic" style="width:130px;height:130px;" src="<?=base_url() ?>assets/photos/profilePicTest_caregiver.jpg" alt="Profielfoto">
                                </div>
                            </div>
                            <div class="row" style="padding-top: 40px;">
                                <div class="col-8">
                                   <p class="personal_text"> <?php echo $this->lang->line('dash_chooselang'); ?> </p>
                                </div>
                                <div class="col-4" style="padding-top: 12px;">
                                    <select style="width:100%" onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
                                        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
                                        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Nederlands</option>
                                    </select>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="personal_text"> <?php echo $this->lang->line('dash_email'); ?></p>
                                    </div>
                                    <div class="col-6">
                                        <p class="personal_text" style="text-align: right;"> <?php if ($email->num_rows() > 0)
                                            {
                                                $row = $email->row();
                                                echo $row->email;
                                            }  ?></p>
                                    </div>

                            </div>
                            <!--                            <div class="row" style="padding-top: 40px;">-->
                            <!--                                <div class="col-12">-->
                            <!--                                     <a href="--><?//=base_url()?><!--Dashboard/logout">-->
                            <!--                                       <button class="btn btn-primary btn-lg" type="button" style="min-width:100%;background-color:#009489;border:none;">-->
                            <!--                                            --><?php //echo $this->lang->line('dash_logout'); ?>
                            <!--                                        </button>-->
                            <!--                                    </a>-->
                            <!--                                </div>-->
                            <!---->
                            <!--                            </div>-->

                        </div>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="tab-4" style="padding:5%;max-height:94vh;overflow-y:scroll;">
                        <div class="card register-card">

                                <h3 class="title_registration"><?php echo $this->lang->line('title'); ?></h3>

                            <form method="post" action="<?= site_url('Dashboard/dashboard_reg') ?>">
                                <table align="center" cellpadding = "10">
                                    <tr>
                                        <td><?php echo $this->lang->line('first'); ?></td>
                                        <td><input type="text" name="firstname" maxlength="30" placeholder="<?php echo $this->lang->line('firstname_placeholder_register'); ?>"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><?php echo $this->lang->line('last'); ?></td>
                                        <td><input type="text" name="name" maxlength="30" placeholder="<?php echo $this->lang->line('lastname_placeholder_register'); ?>"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><?php echo $this->lang->line('birth'); ?></td>

                                        <td>
                                            <select name="Birthday_day" id="Birthday_day" style="width: 29%" required>
                                                <option value="-1"><?php echo $this->lang->line('day'); ?></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>

                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>

                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>

                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>

                                                <option value="31">31</option>
                                            </select>

                                            <select id="Birthday_Month" name="Birthday_Month" style="width: 35%" required>
                                                <option value="-1"><?php echo $this->lang->line('month'); ?></option>
                                                <option value="January"><?php echo $this->lang->line('januari_register'); ?></option>
                                                <option value="February"><?php echo $this->lang->line('februari_register'); ?></option>
                                                <option value="March"><?php echo $this->lang->line('march_register'); ?></option>
                                                <option value="April"><?php echo $this->lang->line('april_register'); ?></option>
                                                <option value="May"><?php echo $this->lang->line('may_register'); ?></option>
                                                <option value="June"><?php echo $this->lang->line('june_register'); ?></option>
                                                <option value="July"><?php echo $this->lang->line('july_register'); ?></option>
                                                <option value="August"><?php echo $this->lang->line('august_register'); ?></option>
                                                <option value="September"><?php echo $this->lang->line('september_register'); ?></option>
                                                <option value="October"><?php echo $this->lang->line('october_register'); ?></option>
                                                <option value="November"><?php echo $this->lang->line('november_register'); ?></option>
                                                <option value="December"><?php echo $this->lang->line('december_register'); ?></option>
                                            </select>

                                            <select name="Birthday_Year" id="Birthday_Year" style="width: 30%" required>

                                                <option value="-1"><?php echo $this->lang->line('year'); ?></option>
                                                <option value="1990">1990</option>

                                                <option value="1989">1989</option>
                                                <option value="1988">1988</option>
                                                <option value="1987">1987</option>
                                                <option value="1986">1986</option>
                                                <option value="1985">1985</option>
                                                <option value="1984">1984</option>
                                                <option value="1983">1983</option>
                                                <option value="1982">1982</option>
                                                <option value="1981">1981</option>
                                                <option value="1980">1980</option>

                                                <option value="1979">1979</option>
                                                <option value="1978">1978</option>
                                                <option value="1977">1977</option>
                                                <option value="1976">1976</option>
                                                <option value="1975">1975</option>
                                                <option value="1974">1974</option>
                                                <option value="1973">1973</option>
                                                <option value="1972">1972</option>
                                                <option value="1971">1971</option>
                                                <option value="1970">1970</option>

                                                <option value="1969">1969</option>
                                                <option value="1968">1968</option>
                                                <option value="1967">1967</option>
                                                <option value="1966">1966</option>
                                                <option value="1965">1965</option>
                                                <option value="1964">1964</option>
                                                <option value="1963">1963</option>
                                                <option value="1962">1962</option>
                                                <option value="1961">1961</option>
                                                <option value="1960">1960</option>

                                                <option value="1959">1959</option>
                                                <option value="1958">1958</option>
                                                <option value="1957">1957</option>
                                                <option value="1956">1956</option>
                                                <option value="1955">1955</option>
                                                <option value="1954">1954</option>
                                                <option value="1953">1953</option>
                                                <option value="1952">1952</option>
                                                <option value="1951">1951</option>
                                                <option value="1950">1950</option>

                                                <option value="1949">1949</option>
                                                <option value="1948">1948</option>
                                                <option value="1947">1947</option>
                                                <option value="1946">1946</option>
                                                <option value="1945">1945</option>
                                                <option value="1944">1944</option>
                                                <option value="1943">1943</option>
                                                <option value="1942">1942</option>
                                                <option value="1941">1941</option>
                                                <option value="1940">1940</option>

                                                <option value="1939">1939</option>
                                                <option value="1938">1938</option>
                                                <option value="1937">1937</option>
                                                <option value="1936">1936</option>
                                                <option value="1935">1935</option>
                                                <option value="1934">1934</option>
                                                <option value="1933">1933</option>
                                                <option value="1932">1932</option>
                                                <option value="1931">1931</option>
                                                <option value="1930">1930</option>

                                                <option value="1929">1929</option>
                                                <option value="1928">1928</option>
                                                <option value="1927">1927</option>
                                                <option value="1926">1926</option>
                                                <option value="1925">1925</option>
                                                <option value="1924">1924</option>
                                                <option value="1923">1923</option>
                                                <option value="1922">1922</option>
                                                <option value="1921">1921</option>
                                                <option value="1920">1920</option>

                                                <option value="1919">1919</option>
                                                <option value="1918">1918</option>
                                            </select>
                                            </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('contact'); ?></td>
                                        <td>
                                            <input type="number" name="Mobile_Number" maxlength="10" placeholder="number" />
                                        </td>
                                    </tr>

                                    <!--<tr>
                                        <td>GENDER</td>
                                        <td>
                                            Male <input type="radio" name="Gender" value="Male" />
                                            Female <input type="radio" name="Gender" value="Female" />
                                        </td>
                                    </tr>-->

                                    <tr>
                                        <td>PIN CODE</td>
                                        <td><input type="password" name="Pin_Code" maxlength="4" placeholder="pin"/>
                                        </td>
                                    </tr>


                                    <!-- <tr>
                                         <td>NATIONALITY</td>
                                         <td><input type="text" name="Nationality" value="Belgium" readonly="readonly" /></td>
                                     </tr>-->

                                    <tr>
                                        <br/>
                                        <td><?php echo $this->lang->line('language'); ?></td>
                                        <td>

                                            <input type="radio" name="Radio" value="Dutch" checked>
                                            <?php echo $this->lang->line('dutch'); ?>
                                            <input type="radio" name="Radio" value="English" >
                                            <?php echo $this->lang->line('english'); ?>
                                            <input type="radio" name="Radio" value="French">
                                            <?php echo $this->lang->line('french'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('room'); ?></td>
                                        <td><input type="text" name="Room_Id" maxlength="100" placeholder="room id" /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('bed'); ?></td>
                                        <td><input type="text" name="Bed_Id" maxlength="10" placeholder="bed id" /></td>
                                    </tr>

                                    <!--<tr>
                                         <td>EMAIL</td>
                                         <td>
                                             <input type="text" name="email" maxlength="30" />
                                         </td>
                                     </tr>-->



                                    <tr>
                                        <td><?php echo $this->lang->line('floor'); ?></td>
                                        <td>

                                            <input type="radio" name="floor" value="GroundFloor" checked>
                                            <?php echo $this->lang->line('floor1'); ?>
                                            <input type="radio" name="floor" value="FirstFloor">
                                            <?php echo $this->lang->line('floor2'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>        </td>
                                        <td>
                                            <input type="radio" name="floor" value="SecondFloor">
                                            <?php echo $this->lang->line('floor3'); ?>
                                            <input type="radio" name="floor" value="ThirdFloor">
                                            <?php echo $this->lang->line('floor4'); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('privileges'); ?></td>
                                        <td>
                                            <input type="text" name="Privileges" maxlength="200" placeholder="<?php echo $this->lang->line('privileges_optional'); ?>" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" align="center">
                                            <input type="submit" value="Save"  >
                                            <input type="reset" value="Reset">

                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-3" style="background-color:#c7de6e;padding:0;">
            <div style="height:5%;"></div>
            <div class="searchdiv" style="text-align:center;margin:15px;">
                <h2 class="notes-title"><?php echo $this->lang->line('dash_notes'); ?></h2>

                <a  href=<?=base_url()?>index.php/Caregiver_controller/add_note class="link1">
                    <button class="btn btn-primary btn-lg" type="button" style="min-width:100%;background-color:#009489;border:none;"><?php echo $this->lang->line('dash_add'); ?></button></div>
            </a>

            <div style="height:2%;"></div>

            <div role="tablist" id="accordion-1" style="border:none;text-align:right;">
                <div class="card notes-card active">
                    <div class="card-header notes-card-head" role="tab">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="div#accordion-1 .item-1" class="btn-notes">
                                <?php echo $this->lang->line('dash_today'); ?>&nbsp;</a>
                        </h5>
                    </div>
                    <div class="collapse show item-1 notes-content" role="tabpanel" data-parent="#accordion-1">
                        <div class="card-body">
                            <?php
                            foreach ($result->result_array() as $row) {
                                if((time()+3600)-strtotime($row['timestamp']) < 86400){
                                    ?><div class="note-box"><?php
                                    ?><p class="note-heading"><b><?php
                                        echo $row['firstName'];
                                        ?></b><span class="note-timestamp"><?php
                                    for($i = 0; $i < 11; $i++) {
                                        $row['timestamp'][$i] = ' ';
                                    }
                                    $row['timestamp'][16] = ' ';
                                    $row['timestamp'][17] = ' ';
                                    $row['timestamp'][18] = ' ';
                                    echo $row['timestamp'];
                                    ?></span><?php
                                    ?></p><?php
                                    echo $row['noteText'];
                                    ?></div><?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card notes-card">
                    <div class="card-header notes-card-head" role="tab">
                        <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-2" href="div#accordion-1 .item-2" class="btn-notes"><?php echo $this->lang->line('dash_this_week'); ?>&nbsp;</a></h5>
                    </div>
                    <div class="collapse item-2 notes-content" role="tabpanel" data-parent="#accordion-1">
                        <div class="card-body">
                            <?php
                            foreach ($result->result_array() as $row) {
                                if((time()+3600)-strtotime($row['timestamp']) < 604800){
                                    ?><div class="note-box"><?php
                                    ?><p class="note-heading"><b><?php
                                        echo $row['firstName'];
                                        ?></b><span class="note-timestamp"><?php
                                    for($i = 11; $i < 20; $i++) {
                                        $row['timestamp'][$i] = ' ';
                                    }
                                    echo $row['timestamp'];
                                    ?></span><?php
                                    ?></p><?php
                                    echo $row['noteText'];
                                    ?></div><?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card notes-card">
                    <div class="card-header notes-card-head" role="tab">
                        <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-3" href="div#accordion-1 .item-3" class="btn-notes"><?php echo $this->lang->line('dash_archive'); ?>&nbsp;</a></h5>
                    </div>
                    <div class="collapse item-3 notes-content" role="tabpanel" data-parent="#accordion-1">
                        <div class="card-body">
                            <?php
                            foreach ($result->result_array() as $row) {
                                ?><div class="note-box"><?php
                                ?><p class="note-heading"><b><?php
                                    echo $row['firstName'];
                                    ?></b><span class="note-timestamp"><?php
                                for($i = 11; $i < 20; $i++) {
                                    $row['timestamp'][$i] = ' ';
                                }
                                echo $row['timestamp'];
                                ?></span><?php
                                ?></p><?php
                                echo $row['noteText'];
                                ?></div><?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>


<script>
    var currentButtonID
    function loadResident(id){
        if(currentButtonID){
            var previous = document.getElementById(currentButtonID)
            previous.classList.remove("btn-active")
        }

        var element = document.getElementById(id)
        element.classList.add("btn-active")
        currentButtonID = id

        document.getElementById("residentName").innerText = id + "<?php echo $this->lang->line('dash_profile'); ?>"
    }

</script>

<script>
    var currentButtonID
    function settingsButton(id){
        if(currentButtonID){
            var previous = document.getElementById(currentButtonID)
            previous.classList.remove("btn-active")
        }

        var element = document.getElementById(id)
        element.classList.add("btn-active")
        currentButtonID = id
    }

</script>

<script>
    function loadDiv1(){
        document.getElementById("div2").classList.add("hiddendiv")
        document.getElementById("div3").classList.add("hiddendiv")
        document.getElementById("div4").classList.add("hiddendiv")
        var element = document.getElementById("div1")
        element.classList.remove("hiddendiv")
    }
    function loadDiv2(){
        document.getElementById("div1").classList.add("hiddendiv")
        document.getElementById("div3").classList.add("hiddendiv")
        document.getElementById("div4").classList.add("hiddendiv")
        var element = document.getElementById("div2")
        element.classList.remove("hiddendiv")
    }
    function loadDiv3(){
        document.getElementById("div1").classList.add("hiddendiv")
        document.getElementById("div2").classList.add("hiddendiv")
        document.getElementById("div4").classList.add("hiddendiv")
        var element = document.getElementById("div3")
        element.classList.remove("hiddendiv")
    }
    function loadDiv4(){
        document.getElementById("div1").classList.add("hiddendiv")
        document.getElementById("div2").classList.add("hiddendiv")
        document.getElementById("div3").classList.add("hiddendiv")
        var element = document.getElementById("div4")
        element.classList.remove("hiddendiv")
    }

</script>

<script type="text/javascript">
    var bothData = <?php echo json_encode($data_each1); ?>;
</script>

<script>

    var data_1 = [];
    var data_2 = [];
    var data_3 = [];
    var data_4 = [];
    var data_5 = [];
    var data_6 = [];
    var data_7 = [];
    var data_8 = [];
    var data_9 = [];
    var data_10 = [];
    var data_11 = [];


    for (var i = 0; i < bothData.length; i++) {
        if (bothData[i]["catergoryID"] === "0") {
            data_1.push(bothData[i]);
        } else if (bothData[i]["catergoryID"] === "1") {
            data_2.push(bothData[i]);
        }
        else if (bothData[i]["catergoryID"] === "2") {
            data_3.push(bothData[i]);
        }
        else if (bothData[i]["catergoryID"] === "3") {
            data_4.push(bothData[i]);
        }
        else if (bothData[i]["catergoryID"] === "4") {
            data_5.push(bothData[i]);
        }
        else if (bothData[i]["catergoryID"] === "5") {
            data_6.push(bothData[i]);
        }
        else if (bothData[i]["catergoryID"] === "6") {
            data_7.push(bothData[i]);
        }
        else if (bothData[i]["catergoryID"] === "7") {
            data_8.push(bothData[i]);
        }
        else if (bothData[i]["catergoryID"] === "8") {
            data_9.push(bothData[i]);
        }
        else if (bothData[i]["catergoryID"] === "9") {
            data_10.push(bothData[i]);
        }
        else if (bothData[i]["catergoryID"] === "10") {
            data_11.push(bothData[i]);
        }
    }

    //functions for toggling between data
    function change(value) {

        if (value === '0') {
            update(data_1);
        } else if (value === '1') {
            update(data_2);
        } else if (value === '2') {
            update(data_3);
        }
        else if (value === '3') {
            update(data_4);
        }
        else if (value === '4') {
            update(data_5);
        }
        else if (value === '5') {
            update(data_6);
        }
        else if (value === '6') {
            update(data_7);
        }
        else if (value === '7') {
            update(data_8);
        }
        else if (value === '8') {
            update(data_9);
        }
        else if (value === '9') {
            update(data_10);
        }
        else if (value === '10') {
            update(data_11);
        }
        else {
            xChart.domain(bothData.map(function (d) {
                return d.category;
            }));
            //set domain for y axis
            yChart.domain([0, d3.max(bothData, function (d) {
                return d.answer;
            })]);

            //get the width of each bar
            var barWidth = width / bothData.length;

            //select all bars on the graph, take them out, and exit the previous data set.
            //then you can add/enter the new data set
            var bars = chart.selectAll(".bar")
                .remove()
                .exit()
                .data(bothData)
            //now actually give each rectangle the corresponding data
            bars.enter()
                .append("rect")
                .attr("class", "bar")
                .attr("x", function (d, i) {
                    return i * barWidth + 1
                })
                .attr("y", function (d) {
                    return yChart(d.answer);
                })
                .attr("height", function (d) {
                    return height - yChart(d.answer);
                })
                .attr("width", barWidth - 1)
                .attr("fill", function (d) {
                    if (d.catergoryID === "0") {
                        return "rgb(216,230,173)";
                    } else if (d.catergoryID === "1") {
                        return "rgb(173,216,230)";
                    }
                    else if (d.catergoryID === "2") {
                        return "rgb(230,187,173)";
                    }
                    else if (d.catergoryID === "3") {
                        return "rgb(138,149,240)";
                    }
                    else if (d.catergoryrID === "4") {
                        return "rgb(200,235,208)";
                    }
                    else if (d.catergoryID === "5") {
                        return "rgb(133,266,246)";
                    }
                    else if (d.catergoryID === "6") {
                        return "rgb(187,187,187)";
                    }
                    else if (d.catergoryID === "7") {
                        return "rgb(193,226,204)";
                    }
                    else if (d.catergoryID === "8") {
                        return "rgb(234,145,152)";
                    }
                    else if (d.catergoryID === "9") {
                        return "rgb(252,244,144)";
                    }
                    else if (d.catergoryID === "10") {
                        return "rgb(157,174,147)";
                    }
                    else {
                        return "rgb(14,174,294)";
                    }
                });
            //left axis
            chart.select('.y')
                .call(yAxis)
            //bottom axis
            chart.select('.xAxis')
                .attr("transform", "translate(0," + height + ")")
                .call(xAxis)
                .selectAll("text")
                .style("text-anchor", "end")
                .attr("dx", "-.8em")
                .attr("dy", ".15em")
                .attr("transform", function (d) {
                    return "rotate(-65)";
                });


        }
    }


    function update(data) {
        //set domain for the x axis
        xChart.domain(data.map(function (d) {
            return d.question;
        }));
        //set domain for y axis
        yChart.domain([0, d3.max(data, function (d) {
            return +d.answer;
        })]);

        //get the width of each bar
        var barWidth = width / data.length;

        //select all bars on the graph, take them out, and exit the previous data set.
        //then you can add/enter the new data set
        var bars = chart.selectAll(".bar")
            .remove()
            .exit()
            .data(data)
        //now actually give each rectangle the corresponding data
        bars.enter()
            .append("rect")
            .attr("class", "bar")
            .attr("x", function (d, i) {
                return i * barWidth + 1
            })
            .attr("y", function (d) {
                return yChart(d.answer);
            })
            .attr("height", function (d) {
                return height - yChart(d.answer);
            })
            .attr("width", barWidth - 1)
            .attr("fill", function (d) {
                if (d.catergoryID === "0") {
                    return "rgb(216,230,173)";
                } else if (d.catergoryID === "1") {
                    return "rgb(173,216,230)";
                }
                else if (d.catergoryID === "2") {
                    return "rgb(230,187,173)";
                }
                else if (d.catergoryID === "3") {
                    return "rgb(138,149,240)";
                }
                else if (d.catergoryrID === "4") {
                    return "rgb(200,235,208)";
                }
                else if (d.catergoryID === "5") {
                    return "rgb(133,266,246)";
                }
                else if (d.catergoryID === "6") {
                    return "rgb(187,187,187)";
                }
                else if (d.catergoryID === "7") {
                    return "rgb(193,226,204)";
                }
                else if (d.catergoryID === "8") {
                    return "rgb(234,145,152)";
                }
                else if (d.catergoryID === "9") {
                    return "rgb(252,244,144)";
                }
                else if (d.catergoryID === "10") {
                    return "rgb(157,174,147)";
                }
                else {
                    return "rgb(14,174,294)";
                }
            });
        //left axis
        chart.select('.y')
            .call(yAxis)
        //bottom axis
        chart.select('.xAxis')
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis)
            .selectAll("text")
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", function (d) {
                return "rotate(-65)";
            });


    }//end update


    //set up chart
    var margin = {top: 20, right:20, bottom: 280, left: 60};
    var width = 430;
    var height = 300;

    var chart = d3.select(".chart")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    var xChart = d3.scaleBand()
        .range([0, width]);

    var yChart;
    yChart = d3.scaleLinear()
        .range([height, 0]);


    var xAxis = d3.axisBottom(xChart);

    var yAxis = d3.axisLeft(yChart)
        .ticks(5)
        .tickValues([0, 1, 2, 3, 4, 5]);


    //set up axes
    //left axis
    chart.append("g")
        .attr("class", "y axis")
        .call(yAxis)


    //bottom axis
    chart.append("g")
        .attr("class", "xAxis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis)
        .selectAll("text")
        .style("text-anchor", "end")
        .attr("dx", "-.8em")
        .attr("dy", ".15em")
        .attr("transform", function (d) {
            return "rotate(-65)";
        });

    //add labels
    chart
        .append("text")
        .attr("transform", "translate(-35," + (height + margin.bottom) / 2 + ") rotate(-90)")
        .text("<?php echo $this->lang->line('category_score'); ?>");

    chart
        .append("text")
        .attr("transform", "translate(" + (width / 2) + "," + (height + margin.bottom - 5) + ")")
        .text("<?php echo $this->lang->line('category_ans'); ?>");


    //use bothData to begin with
    //update(bothData);
    xChart.domain(bothData.map(function (d) {
        return d.category;
    }));
    //set domain for y axis
    //yChart.domain( [0, d3.max(bothData, function(d){ return +d.answer; },)] );
    yChart.domain([0, d3.max(bothData, function (d) {
        return d.answer;
    })]);

    //get the width of each bar
    var barWidth = width / bothData.length;

    //select all bars on the graph, take them out, and exit the previous data set.
    //then you can add/enter the new data set
    var bars = chart.selectAll(".bar")
        .remove()
        .exit()
        .data(bothData)
    //now actually give each rectangle the corresponding data
    bars.enter()
        .append("rect")
        .attr("class", "bar")
        .attr("x", function (d, i) {
            return i * barWidth + 1
        })
        .attr("y", function (d) {
            return yChart(d.answer);
        })
        .attr("height", function (d) {
            return height - yChart(d.answer);
        })
        .attr("width", barWidth - 1)
        .attr("fill", function (d) {
            if (d.catergoryID === "0") {
                return "rgb(216,230,173)";
            } else if (d.catergoryID === "1") {
                return "rgb(173,216,230)";
            }
            else if (d.catergoryID === "2") {
                return "rgb(230,187,173)";
            }
            else if (d.catergoryID === "3") {
                return "rgb(138,149,240)";
            }
            else if (d.catergoryrID === "4") {
                return "rgb(200,235,208)";
            }
            else if (d.catergoryID === "5") {
                return "rgb(133,266,246)";
            }
            else if (d.catergoryID === "6") {
                return "rgb(187,187,187)";
            }
            else if (d.catergoryID === "7") {
                return "rgb(193,226,204)";
            }
            else if (d.catergoryID === "8") {
                return "rgb(234,145,152)";
            }
            else if (d.catergoryID === "9") {
                return "rgb(252,244,144)";
            }
            else if (d.catergoryID === "10") {
                return "rgb(157,174,147)";
            }
            else {
                return "rgb(14,174,294)";
            }
        });

    //left axis
    chart.select('.y')
        .call(yAxis)

    //bottom axis
    chart.select('.xAxis')
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis)
        .selectAll("text")
        .style("text-anchor", "end")
        .attr("dx", "-.8em")
        .attr("dy", ".1em")
        .attr("transform", function (d) {
            return "rotate(-65)";
        });


</script>

</html>


