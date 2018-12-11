<?php
if(!isset($_SESSION['id']))
{

    header("Location:./index.php?msg=YouMustLoginFirst");
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
    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script src="//d3js.org/d3.v4.min.js"></script>

    <script src="https://d3js.org/d3.v4.min.js"></script>
<!--    <script src="--><?//= base_url()?><!--assets/js/trail.js"></script>-->


    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 11px;
            font-weight: 300;
            fill: #242424;
            text-align: center;
            /*text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, -1px 0 0 #fff, 0 -1px 0 #fff;*/
            /*cursor:url(http://www.rw-designer.com/cursor-view/104989.png), auto;*/
        }
        .bar {
            fill: #2f996e;
        }

        .tooltip {
            fill: #333333;
        }
        .radio{
            text-align: center;
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
?>


<div class="container-fluid">


    <div class="row" style="height:100vh;">
        <div class="col-3" style="background-color:#009489;padding:0;">
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
                <input class ="searchbar" type="search" placeholder="<?php echo $this->lang->line('search'); ?>"></div>
            <div style="height:5%;"></div>
            <div style="overflow-y:scroll;max-height:73vh;">
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
        <div class="col-6" style="background-color:#f9f9f9;padding:0px;">
            <div style="width:100%;">
                <ul class="nav nav-tabs" style="text-align:center;border:none;">
                    <li class="nav-item" style="width:25%;"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1" style="border:none;"><?php echo $this->lang->line('dash_questionnaire'); ?></a></li>
                    <li class="nav-item" style="width:25%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2" style="border:none;"><?php echo $this->lang->line('dash_poll'); ?></a></li>
                    <li class="nav-item" style="width:25%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-3" style="border:none;"><?php echo $this->lang->line('dash_personal'); ?></a></li>
                    <li class="nav-item" style="width:25%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-4" style="border:none;"><?php echo $this->lang->line('dash_register'); ?></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="tab-1" style="padding:5%;max-height:94vh;overflow-y:scroll;">
                        <div class="card questionnaire-card">
                            <div class="card-body">
                                <div class="card-top">
                                    <div class="card-head">
                                        <img class="card-picture" src="<?=base_url() ?>assets/photos/profilePicTest.jpg" alt="Avatar">
                                        <span class="card-name">Jan Buskens</span>
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
                                <script>

                                    var margin = {top: 30, right: 100, bottom: 100, left: 100},
                                        legendPosition = {x: 25, y: 25},
                                        width = Math.min(500, window.innerWidth - 10) - margin.left - margin.right,
                                        height = Math.min(width, window.innerHeight - margin.top - margin.bottom - 20);

                                    var data = [
                                        [
                                            {axis:"<?php echo $this->lang->line('category_0'); ?>",value:2},
                                            {axis:"<?php echo $this->lang->line('category_1'); ?>",value:4.3},
                                            {axis:"<?php echo $this->lang->line('category_2'); ?>",value:5},
                                            {axis:"<?php echo $this->lang->line('category_3'); ?>",value:2.1},
                                            {axis:"<?php echo $this->lang->line('category_4'); ?>",value:4.5},
                                            {axis:"<?php echo $this->lang->line('category_5'); ?>",value:3.3},
                                            {axis:"<?php echo $this->lang->line('category_6'); ?>",value:5},
                                            {axis:"<?php echo $this->lang->line('category_7'); ?>",value:3},
                                            {axis:"<?php echo $this->lang->line('category_8'); ?>",value:1},
                                            {axis:"<?php echo $this->lang->line('category_9'); ?>",value:4},
                                            {axis:"<?php echo $this->lang->line('category_10'); ?>",value:2}

                                        ],[
                                            {axis:"<?php echo $this->lang->line('category_0'); ?>",value:3},
                                            {axis:"<?php echo $this->lang->line('category_1'); ?>",value:4},
                                            {axis:"<?php echo $this->lang->line('category_2'); ?>",value:5},
                                            {axis:"<?php echo $this->lang->line('category_3'); ?>",value:3.6},
                                            {axis:"<?php echo $this->lang->line('category_4'); ?>",value:2.1},
                                            {axis:"<?php echo $this->lang->line('category_5'); ?>",value:1.3},
                                            {axis:"<?php echo $this->lang->line('category_6'); ?>",value:4},
                                            {axis:"<?php echo $this->lang->line('category_7'); ?>",value:5},
                                            {axis:"<?php echo $this->lang->line('category_8'); ?>",value:3},
                                            {axis:"<?php echo $this->lang->line('category_9'); ?>",value:2},
                                            {axis:"<?php echo $this->lang->line('category_10'); ?>",value:4}
                                        ]
                                    ];

                                    var color = d3.scale.ordinal()
                                        .range(["#82686a","#2f996e"]);

                                    var radarChartOptions = {
                                        w: width,
                                        h: height,
                                        margin: margin,
                                        legendPosition: legendPosition,
                                        maxValue: 0.5,
                                        wrapWidth: 50,
                                        levels: 5,
                                        roundStrokes: true,
                                        color: color,
                                        axisName: "category",
                                        areaName: "times",
                                        value: "value"
                                    };
                                    //Call function to draw the Radar chart
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
                                <h4 class="card-title"><?php echo $this->lang->line('dash_answers'); ?></h4>
                                <h3><?php echo $this->lang->line('category_title2'); ?></h3>

                                <div class='container'>
                                    <div class='row'>
                                        <div class='radio'>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryA" onclick='change(this.value)'>categoryA
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryB" onclick='change(this.value)'>categoryB
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryC" onclick='change(this.value)'>categoryC
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryD" onclick='change(this.value)'>categoryD
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryE" onclick='change(this.value)'>categoryE
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryF" onclick='change(this.value)'>categoryF
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryG" onclick='change(this.value)'>categoryG
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryH" onclick='change(this.value)'>categoryH
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryI" onclick='change(this.value)'>categoryI
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryJ" onclick='change(this.value)'>categoryJ
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryK" onclick='change(this.value)'>categoryK
                                            </label>

                                        </div>
                                        <svg class='chart'>
                                        </svg>
                                    </div>
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
                                    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
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
                            <div class="row" style="padding-top: 40px;">
                                <div class="col-12">
                                    <a href="<?=base_url()?>Caregiver_controller/registration">
                                        <button class="btn btn-primary btn-lg" type="button" style="min-width:100%;background-color:#009489;border:none;">
                                            <?php echo $this->lang->line('register'); ?>
                                        </button>
                                    </a>
                                </div>

                            </div>
                            <div class="row" style="padding-top: 40px;">
                                <div class="col-12">
                                     <a href="<?=base_url()?>Dashboard/logout">
                                       <button class="btn btn-primary btn-lg" type="button" style="min-width:100%;background-color:#009489;border:none;">
                                            <?php echo $this->lang->line('dash_logout'); ?>
                                        </button>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="tab-4">
                        <div class="card register-card">

                                <h3 class="title_registration"><?php echo $this->lang->line('title'); ?></h3>


                                <table align="center" cellpadding = "10">
                                    <tr>
                                        <td><?php echo $this->lang->line('first'); ?></td>
                                        <td><input type="text" name="firstname" maxlength="30"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><?php echo $this->lang->line('last'); ?></td>
                                        <td><input type="text" name="name" maxlength="30"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><?php echo $this->lang->line('birth'); ?></td>

                                        <td>
                                            <select name="Birthday_day" id="Birthday_Day">
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

                                            <select id="Birthday_Month" name="Birthday_Month">
                                                <option value="-1"><?php echo $this->lang->line('month'); ?></option>
                                                <option value="January">Jan</option>
                                                <option value="February">Feb</option>
                                                <option value="March">Mar</option>
                                                <option value="April">Apr</option>
                                                <option value="May">May</option>
                                                <option value="June">Jun</option>
                                                <option value="July">Jul</option>
                                                <option value="August">Aug</option>
                                                <option value="September">Sep</option>
                                                <option value="October">Oct</option>
                                                <option value="November">Nov</option>
                                                <option value="December">Dec</option>
                                            </select>

                                            <select name="Birthday_Year" id="Birthday_Year">

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
                                            <input type="text" name="Mobile_Number" maxlength="10" />
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
                                        <td><input type="text" name="Pin_Code" maxlength="6" />
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

                                            <input type="radio" name="Dutch" value="Dutch">
                                            <?php echo $this->lang->line('dutch'); ?>
                                            <input type="radio" name="English" value="English">
                                            <?php echo $this->lang->line('english'); ?>
                                            <input type="radio" name="French" value="French">
                                            <?php echo $this->lang->line('french'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('room'); ?></td>
                                        <td><input type="text" name="Room_Id" maxlength="100" /></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('bed'); ?></td>
                                        <td><input type="text" name="Bed_Id" maxlength="10" /></td>
                                    </tr>

                                    <!--<tr>
                                         <td>EMAIL</td>
                                         <td>
                                             <input type="text" name="email" maxlength="30" />
                                         </td>
                                     </tr>-->

                                    <!-- <tr>
                                         <td>PASSWORD</td>
                                         <td>
                                             <input type="text" name="password" maxlength="30" />
                                         </td>
                                     </tr>-->



                                    <tr>
                                        <td><?php echo $this->lang->line('floor'); ?></td>
                                        <td>

                                            <input type="radio" name="GroundFloor" value="GroundFloor">
                                            <?php echo $this->lang->line('floor1'); ?>
                                            <input type="radio" name="FirstFloor" value="FirstFloor">
                                            <?php echo $this->lang->line('floor2'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>        </td>
                                        <td>
                                            <input type="radio" name="SecondFloor" value="SecondFloor">
                                            <?php echo $this->lang->line('floor3'); ?>
                                            <input type="radio" name="ThirdFloor" value="ThirdFloor">
                                            <?php echo $this->lang->line('floor4'); ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('preferences'); ?></td>
                                        <td>
                                            <input type="text" name="Preferences" maxlength="200" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('privileges'); ?></td>
                                        <td>
                                            <input type="text" name="Mobile_Number" maxlength="200" />
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" align="center">
                                            <input type="submit" value="Save">
                                            <input type="reset" value="Reset">
                                        </td>
                                    </tr>
                                </table>
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
                        <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="div#accordion-1 .item-1" class="btn-notes">
                                <?php echo $this->lang->line('dash_today'); ?>&nbsp;</a></h5>
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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
    //set up data
    var bothData = [
        {
            "categoryType": "categoryA",
            "questionNum": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "3.3",
            "scores": "2"
        },
        {
            "categoryType": "categoryA",
            "questionNum": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "12.8",
            "scores": "5"
        },
        {
            "categoryType": "categoryB",
            "questionNum": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryB",
            "questionNum": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryB",
            "questionNum": "question 3",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryB",
            "questionNum": "question 4",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryB",
            "questionNum": "question 5",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryC",
            "questionNum": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "3.3",
            "scores": "2"
        },
        {
            "categoryType": "categoryC",
            "questionNum": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "12.8",
            "scores": "5"
        },
        {
            "categoryType": "categoryC",
            "questionNum": "question 3",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryD",
            "questionNum": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryD",
            "questionNum": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryD",
            "questionNum": "question 3",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryD",
            "questionNum": "question 4",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryD",
            "questionNum": "question 5",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "question 3",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "question 4",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "question 5",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "question 6",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "question 7",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryF",
            "questionNum": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryF",
            "questionNum": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryF",
            "questionNum": "question 3",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryF",
            "questionNum": "question 4",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "question 3",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "question 4",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "question 5",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "question 6",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "question 7",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "question 3",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "question 4",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "question 5",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "question 6",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "question 3",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "2"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "question 4",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "question 5",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "5"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "question 6",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryJ",
            "questionNum": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryJ",
            "questionNum": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryJ",
            "questionNum": "question 3",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "2"
        },
        {
            "categoryType": "categoryJ",
            "questionNum": "question 4",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryJ",
            "questionNum": "question 5",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "5"
        },
        {
            "categoryType": "categoryK",
            "questionNum": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "5"
        },
        {
            "categoryType": "categoryK",
            "questionNum": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryK",
            "questionNum": "question 3",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryK",
            "questionNum": "question 4",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryK",
            "questionNum": "question 5",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "3"
        },
    ];

    // var maleData = [];
    // var femaleData = [];
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

    for(var i = 0; i < bothData.length; i++){
        if(bothData[i]["categoryType"] === "categoryA"){
            data_1.push(bothData[i]);
        }else if(bothData[i]["categoryType"] === "categoryB"){
            data_2.push(bothData[i]);
        }
        else if(bothData[i]["categoryType"] === "categoryC"){
            data_3.push(bothData[i]);
        }
        else if(bothData[i]["categoryType"] === "categoryD"){
            data_4.push(bothData[i]);
        }
        else if(bothData[i]["categoryType"] === "categoryE"){
            data_5.push(bothData[i]);
        }
        else if(bothData[i]["categoryType"] === "categoryF"){
            data_6.push(bothData[i]);
        }
        else if(bothData[i]["categoryType"] === "categoryG"){
            data_7.push(bothData[i]);
        }
        else if(bothData[i]["categoryType"] === "categoryH"){
            data_8.push(bothData[i]);
        }
        else if(bothData[i]["categoryType"] === "categoryI"){
            data_9.push(bothData[i]);
        }
        else if(bothData[i]["categoryType"] === "categoryJ"){
            data_10.push(bothData[i]);
        }
        else if(bothData[i]["categoryType"] === "categoryK"){
            data_11.push(bothData[i]);
        }
    }

    //functions for toggling between data
    function change(value){

        if(value === 'categoryA'){
            update(data_1);
        }else if(value === 'categoryB'){
            update(data_2);
        }else if(value === 'categoryC'){
            update(data_3);
        }
        else if(value === 'categoryD'){
            update(data_4);
        }
        else if(value === 'categoryE'){
            update(data_5);
        }
        else if(value === 'categoryF'){
            update(data_6);
        }
        else if(value === 'categoryG'){
            update(data_7);
        }
        else if(value === 'categoryH'){
            update(data_8);
        }
        else if(value === 'categoryI'){
            update(data_9);
        }
        else if(value === 'categoryJ'){
            update(data_10);
        }
        else{
            update(data_11);
        }
    }

    function update(data){
        //set domain for the x axis
        xChart.domain(data.map(function(d){ return d.questionNum; }) );
        //set domain for y axis
        yChart.domain( [0, d3.max(data, function(d){ return +d.scores; })] );

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
            .attr("x", function(d, i){ return i * barWidth + 1 })
            .attr("y", function(d){ return yChart( d.scores); })
            .attr("height", function(d){ return height - yChart(d.scores); })
            .attr("width", barWidth - 1)
            .attr("fill", function(d){
                if(d.categoryType === "categoryB"){
                    return "rgb(251,180,174)";
                }else if(d.categoryType === "categoryB"){
                    return "rgb(179,205,227)";
                }
                else if(d.categoryType === "categoryC"){
                    return "rgb(251,180,174)";
                }
                else if(d.categoryType === "categoryD"){
                    return "rgb(179,205,227)";
                }
                else if(d.categoryType === "categoryE"){
                    return "rgb(251,180,174)";
                }
                else if(d.categoryType === "categoryF"){
                    return "rgb(179,205,227)";
                }
                else if(d.categoryType === "categoryG"){
                    return "rgb(251,180,174)";
                }
                else if(d.categoryType === "categoryH"){
                    return "rgb(179,205,227)";
                }
                else if(d.categoryType === "categoryI"){
                    return "rgb(251,180,174)";
                }
                else if(d.categoryType === "categoryJ"){
                    return "rgb(179,205,227)";
                }
                else {
                    return "rgb(251,180,174)";
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
            .attr("transform", function(d){
                return "rotate(-65)";
            });

    }//end update

    //set up chart
    var margin = {top: 20, right: 20, bottom: 95, left: 50};
    var width =500;
    var height = 400;

    var chart = d3.select(".chart")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    var xChart = d3.scaleBand()
        .range([0, width]);

    var yChart = d3.scaleLinear()
        .range([height, 0]);

    var xAxis = d3.axisBottom(xChart);
    var yAxis = d3.axisLeft(yChart);

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
        .attr("transform", function(d){
            return "rotate(-65)";
        });

    //add labels
    chart
        .append("text")
        .attr("transform", "translate(-35," +  (height+margin.bottom)/2 + ") rotate(-90)")
        .text("score of answer");

    chart
        .append("text")
        .attr("transform", "translate(" + (width/2) + "," + (height + margin.bottom - 5) + ")")
        .text("Answers");


    //use bothData to begin with
    //update(bothData);
    xChart.domain(bothData.map(function(d){ return d.categoryType; }) );
    //set domain for y axis
    yChart.domain( [0, d3.max(bothData, function(d){ return +d.scores; })] );

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
        .attr("x", function(d, i){ return i * barWidth + 1 })
        .attr("y", function(d){ return yChart( d.scores); })
        .attr("height", function(d){ return height - yChart(d.scores); })
        .attr("width", barWidth - 1)
        .attr("fill", function(d){
            if(d.categoryType === "categoryB"){
                return "rgb(251,180,174)";
            }else if(d.categoryType === "categoryB"){
                return "rgb(204,153,255)";
            }
            else if(d.categoryType === "categoryC"){
                return "rgb(251,180,174)";
            }
            else if(d.categoryType === "categoryD"){
                return "rgb(179,205,227)";
            }
            else if(d.categoryType === "categoryE"){
                return "rgb(251,180,174)";
            }
            else if(d.categoryType === "categoryF"){
                return "rgb(179,205,227)";
            }
            else if(d.categoryType === "categoryG"){
                return "rgb(251,180,174)";
            }
            else if(d.categoryType === "categoryH"){
                return "rgb(179,205,227)";
            }
            else if(d.categoryType === "categoryI"){
                return "rgb(251,180,174)";
            }
            else if(d.categoryType === "categoryJ"){
                return "rgb(179,205,227)";
            }
            else {
                return "rgb(251,180,174)";
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
        .attr("transform", function(d){
            return "rotate(-65)";
        });
</script>



</html>