<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/ >
    <title>Smoothed D3.js Radar Chart</title>

    <title>Dashboard</title>


    <!-- Google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

    <!-- D3.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/1.3.0/d3-legend.js" charset="utf-8"></script>


   <!-- <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script src="//d3js.org/d3.v4.min.js"></script>
    <script src="https://d3js.org/d3.v4.min.js"></script>-->

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 11px;
            font-weight: 300;
            fill: #242424;
            text-align: center;
            text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, -1px 0 0 #fff, 0 -1px 0 #fff;
            cursor: default;
        }
        .tooltip {
            fill: #333333;
        }
        .radio{
            text-align:left;
        }
    </style>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon.png" type="image/gif" sizes="16x16">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS-->
    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
    </select>
</head>
<body>

<?php
$this->load->database();
$query = "SELECT noteText, author, timestamp FROM Notes;";
$result = $this->db->query($query);
?>


<div class="container-fluid">


    <div class="row">
        <div class="col-3" style="background-color:#00948A">
        </div>
        <div class="col-7">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-questionnaire-tab" data-toggle="tab" href="#nav-Questionnaire" role="tab" aria-controls="nav-Questionnaire" aria-selected="true"><?php echo $this->lang->line('dash_questionnaire'); ?></a>
                    <a class="nav-item nav-link" id="nav-poll-tab" data-toggle="tab" href="#nav-Poll" role="tab" aria-controls="nav-Poll" aria-selected="false"><?php echo $this->lang->line('dash_poll'); ?></a>
                    <a class="nav-item nav-link" id="nav-personal-tab" data-toggle="tab" href="#nav-Personal" role="tab" aria-controls="nav-Personal" aria-selected="false"><?php echo $this->lang->line('dash_personal'); ?></a>
                </div>
            </nav>
        </div>
        <div class="col-2" style="background-color:#C7DE6E">
        </div>


    </div>



    <div class="row">
        <div class="col-3" style="background-color:#00948A">
            <h5><p><?php echo $this->lang->line('dash_notes'); ?></p></h5>
            <a  href=<?=base_url()?>index.php/Caregiver_controller/add_note class="link1">
                <button type="button" class="btn btn-light" style="background-color:#C7DE6E"><p><?php echo $this->lang->line('dash_add'); ?></p></button>
            </a>
            <div class="accordion" id="accordionNotes">
                <div class="card">
                    <div class="card-header" id="headingToday">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseToday" aria-expanded="true" aria-controls="collapseToday">
                                <p><?php echo $this->lang->line('dash_today'); ?></p>
                            </button>
                        </h5>
                    </div>

                    <div id="collapseToday" class="collapse show" aria-labelledby="headingToday" data-parent="#accordionNotes">
                        <div class="card-body">
                            <p>
                                <?php
                                foreach ($result->result_array() as $row) {
                                    if((time()+3600)-strtotime($row['timestamp']) < 86400){
                                        echo $row['noteText'];
                                        ?><br><?php
                                        echo $row['author'];
                                        echo str_repeat('&nbsp;', 5);
                                        echo $row['timestamp'];
                                        $time = strtotime($row['timestamp']);
                                        ?><br><br><?php
                                    }
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingWeek">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseWeek" aria-expanded="false" aria-controls="collapseWeek">
                                <p><?php echo $this->lang->line('dash_this_week'); ?></p>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseWeek" class="collapse" aria-labelledby="headingWeek" data-parent="#accordionNotes">
                        <div class="card-body">
                            <p>
                                <?php
                                foreach ($result->result_array() as $row) {
                                    if((time()+3600)-strtotime($row['timestamp']) < 604800){
                                        echo $row['noteText'];
                                        ?><br><?php
                                        echo $row['author'];
                                        echo str_repeat('&nbsp;', 5);
                                        echo $row['timestamp'];
                                        $time = strtotime($row['timestamp']);
                                        ?><br><br><?php
                                    }
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingAll">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseAll" aria-expanded="false" aria-controls="collapseAll">
                                <p><?php echo $this->lang->line('dash_archive'); ?></p>
                            </button>
                        </h5>
                    </div>
                    <div id="collapseAll" class="collapse" aria-labelledby="headingAll" data-parent="#accordionNotes">
                        <div class="card-body">
                            <p>
                                <?php
                                foreach ($result->result_array() as $row) {
                                    echo $row['noteText'];
                                    ?><br><?php
                                    echo $row['author'];
                                    echo str_repeat('&nbsp;', 5);
                                    echo $row['timestamp'];
                                    ?><br><br><?php
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7">
            <nav>
                <!--<div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-questionnaire-tab" data-toggle="tab" href="#nav-Questionnaire" role="tab" aria-controls="nav-Questionnaire" aria-selected="true">Questionnaire</a>
                    <a class="nav-item nav-link" id="nav-poll-tab" data-toggle="tab" href="#nav-Poll" role="tab" aria-controls="nav-Poll" aria-selected="false">Poll</a>
                    <a class="nav-item nav-link" id="nav-personal-tab" data-toggle="tab" href="#nav-Personal" role="tab" aria-controls="nav-Personal" aria-selected="false">Personal</a>
                </div>-->
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-Questionnaire" role="tabpanel" aria-labelledby="nav-Questionnaire-tab">
                    <div class="accordion" id="accordionQuestionnaire">
                        <div class="card">
                            <div class="card-header" id="headingProfile">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile">
                                        <p><?php echo $this->lang->line('dash_profile'); ?></p>
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseProfile" class="collapse show" aria-labelledby="headingProfile" data-parent="#accordionQuestionnaire">
                                <div class="card-body">
                                    <h3><?php echo $this->lang->line('category_title'); ?></h3>

                                    <div class="radarChart"></div>

                                    <script src="../../assets/js/radarChart.js"></script>
                                    <script>
                                        //////////////////////////////////////////////////////////////
                                        //////////////////////// Set-Up //////////////////////////////
                                        //////////////////////////////////////////////////////////////

                                        var margin = {top: 100, right: 70, bottom: 100, left: 100},
                                            legendPosition = {x: 300, y: 15},
                                            width = Math.min(500, window.innerWidth - 10) - margin.left - margin.right,
                                            height = Math.min(width, window.innerHeight - margin.top - margin.bottom - 20);
                                        //////////////////////////////////////////////////////////////
                                        //////////////////// Draw the Chart //////////////////////////
                                        //////////////////////////////////////////////////////////////

                                        var color = d3.scale.ordinal()
                                            .range(["#42f4b0","#41b2f4","#00A0B0"]);
                                        var data = [
                                            {
                                                "key":"<?php echo $this->lang->line('category_time2'); ?>",
                                                "values":[
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_0'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":4

                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_1'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_2'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":2
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_3'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":4
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_4'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_5'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":1
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_6'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_7'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":4
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_8'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_8'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_9'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":4
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_10'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time2'); ?>",
                                                        "value":3
                                                    },
                                                ]
                                            },
                                            {
                                                "key":"<?php echo $this->lang->line('category_time1'); ?>",
                                                "values":[
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_0'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_1'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":1
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_2'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":4
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_3'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_4'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":5
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_5'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_6'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_7'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":2
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_8'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":5
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_9'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_9'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":2
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_10'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time1'); ?>",
                                                        "value":5
                                                    }
                                                ]
                                            },
                                            {
                                                "key":"<?php echo $this->lang->line('category_time3'); ?>",
                                                "values":[
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_0'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value":5
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_1'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_2'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value":5
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_3'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value":3
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_4'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value":5
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_5'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value":5
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_6'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value":4
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_7'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value":2
                                                    },
                                                    {
                                                        "reason": "<?php echo $this->lang->line('category_8'); ?>",
                                                        "device": "<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value": 5
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_8'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value":4
                                                    },
                                                    {
                                                        "reason":"<?php echo $this->lang->line('category_9'); ?>",
                                                        "device":"<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value":2
                                                    },
                                                    {
                                                        "reason": "<?php echo $this->lang->line('category_10'); ?>",
                                                        "device": "<?php echo $this->lang->line('category_time3'); ?>",
                                                        "value": 5
                                                    }

                                                ]
                                            }
                                        ]

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
                                            axisName: "reason",
                                            areaName: "device",
                                            value: "value"
                                        };

                                        //Load the data and Call function to draw the Radar chart
                                        RadarChart(".radarChart", data, radarChartOptions);



                                    </script>
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingOutliers">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOutliers" aria-expanded="false" aria-controls="collapseOutliers">
                                        <p><?php echo $this->lang->line('dash_outliers'); ?></p>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOutliers" class="collapse" aria-labelledby="headingOutliers" data-parent="#accordionQuestionnaire">
                                <div class="card-body">

                                </div>

                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingAnswers">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseAnswers" aria-expanded="false" aria-controls="collapseAnswers">
                                    <p><?php echo $this->lang->line('dash_answers'); ?></p>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseAnswers" class="collapse" aria-labelledby="headingAnswers" data-parent="#accordionQuestionnaire">
                            <div class="card-body">
                                <h3><?php echo $this->lang->line('category_title2'); ?></h3>
                                <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
                                <script src="//d3js.org/d3.v4.min.js"></script>
                                <script src="https://d3js.org/d3.v4.min.js"></script>
                                <div class='container'>
                                    <div class='row'>
                                        <div class='radio'>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryA" onclick='change(this.value)'><?php echo $this->lang->line('category_0'); ?>
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryB" onclick='change(this.value)'><?php echo $this->lang->line('category_1'); ?>
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryC" onclick='change(this.value)'><?php echo $this->lang->line('category_2'); ?>
                                            </label>
                                            </br>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryD" onclick='change(this.value)'><?php echo $this->lang->line('category_3'); ?>
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryE" onclick='change(this.value)'><?php echo $this->lang->line('category_4'); ?>
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryF" onclick='change(this.value)'><?php echo $this->lang->line('category_5'); ?>
                                            </label>
                                            </br>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryG" onclick='change(this.value)'><?php echo $this->lang->line('category_6'); ?>
                                            </label>
                                            </br>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryH" onclick='change(this.value)'><?php echo $this->lang->line('category_7'); ?>
                                            </label>
                                            </br>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryI" onclick='change(this.value)'><?php echo $this->lang->line('category_8'); ?>
                                            </label>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryJ" onclick='change(this.value)'><?php echo $this->lang->line('category_9'); ?>
                                            </label>
                                            </br>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="categoryK" onclick='change(this.value)'><?php echo $this->lang->line('category_10'); ?>
                                            </label>
                                            </br>
                                            <label class='radio-inline'>
                                                <input type="radio" name="gender" value="all" onclick='change(this.value)'><?php echo $this->lang->line('category_all'); ?>
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
                </div>
                <div class="tab-pane fade" id="nav-Poll" role="tabpanel" aria-labelledby="nav-Poll-tab">Poll</div>
                <div class="tab-pane fade" id="nav-Personal" role="tabpanel" aria-labelledby="nav-contact-tab"><p><?php echo $this->lang->line('dash_personal'); ?></p></div>
            </div>
        </div>
        <div class="col-2" style="background-color:#C7DE6E">
            <h5><p><?php echo $this->lang->line('dash_floor'); ?></p></h5>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <p><?php echo $this->lang->line('dash_floor'); ?></p>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuFloor">
                    <button class="dropdown-item" type="button">1</button>
                    <button class="dropdown-item" type="button">2</button>
                    <button class="dropdown-item" type="button">3</button>
                    <button class="dropdown-item" type="button">4</button>
                    <button class="dropdown-item" type="button">5</button>
                    <button class="dropdown-item" type="button">6</button>
                </div>
            </div>
            <h5><p><?php echo $this->lang->line('dash_person'); ?></p></h5>
            <input type="search" class="form-control ds-input" id="search-input" placeholder="Search..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" style="position: relative; vertical-align: top;" dir="auto">
            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-light">Jan</button>
                <button type="button" class="btn btn-light">Maria</button>
                <button type="button" class="btn btn-light">Jef</button>
                <button type="button" class="btn btn-light">Rene</button>
                <button type="button" class="btn btn-light">Marie-Jean</button>
            </div>
        </div>
    </div>
</div>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<a href="<?= site_url('Caregiver_controller/login') ?>"><p><?php echo $this->lang->line('dash_logout'); ?></p></a>
</body>

<script>
    //set up data
    var bothData = [
        {
            "categoryType": "categoryA",
            "questionNum": "I can be alone when I wish.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "3.3",
            "scores": "2"
        },
        {
            "categoryType": "categoryA",
            "questionNum": "My privacy is respected when people care for me",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "12.8",
            "scores": "5"
        },
        {
            "categoryType": "categoryB",
            "questionNum": "I get my favorite foods here.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryB",
            "questionNum": "I can eat when I want.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryB",
            "questionNum": "I have enough variety in my meals.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryB",
            "questionNum": "I enjoy mealtimes.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryB",
            "questionNum": "Food is the right temperature when I get to eat it.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryC",
            "questionNum": "If I need help right away, I can get it.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "3.3",
            "scores": "2"
        },
        {
            "categoryType": "categoryC",
            "questionNum": "I feel my possessions are secure.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "12.8",
            "scores": "5"
        },
        {
            "categoryType": "categoryC",
            "questionNum": "feel safe when I am alone.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryD",
            "questionNum": "get the services I need.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryD",
            "questionNum": "would recommend this site or organization to others.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryD",
            "questionNum": "This place feels like home to me.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryD",
            "questionNum": "I can easily go outdoors if I want.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryD",
            "questionNum": "I am bothered by the noise here.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "I can have a bath or shower as often as I want.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "I decide when to get up.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "I decide when to go to bed.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "I can go where I want on the “spur of the moment.”",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "I control who comes into my room.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "I decide which clothes to wear.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryE",
            "questionNum": "decide how to spend my time.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryF",
            "questionNum": "I am treated with respect by staff.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryF",
            "questionNum": "Staff pay attention to me.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryF",
            "questionNum": "I can express my opinion without fear of consequences.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryF",
            "questionNum": "Staff respect what I like and dislike.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "The care and support I get help me live my life the way I want.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "Staff respond quickly when I ask for assistance.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "staff respond to my suggestions.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "I get the health services I need.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "I get the health services I need.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "Staff know what they are doing.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryG",
            "questionNum": "My services are delivered when I want them.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "Some of the staff know the story of my life.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "consider a staff member my friend.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "I have a special relationship with a staff member.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "Staff take the time to have a friendly conversation with me.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "Staff ask how my needs can be met.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "2"
        },
        {
            "categoryType": "categoryH",
            "questionNum": "Staff ask how my needs can be met.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "I have enjoyable things to do here on weekends.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "I have enjoyable things to do here in the evenings.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "participate in meaningful activities.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "2"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "If I want, I can participate in religious activities that have meaning to me.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "I have opportunities to spend time with other like-minded residents.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "5"
        },
        {
            "categoryType": "categoryI",
            "questionNum": "I have the opportunity to explore new skills and interests.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryJ",
            "questionNum": "Another resident here is my close friend.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "1"
        },
        {
            "categoryType": "categoryJ",
            "questionNum": "People ask for my help or advice.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryJ",
            "questionNum": "I have opportunities for affection or romance.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "2"
        },
        {
            "categoryType": "categoryJ",
            "questionNum": "It is easy to make friends here.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryJ",
            "questionNum": "have people who want to do things together with me.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "scores": "5"
        },
        {
            "categoryType": "categoryK",
            "questionNum": "I am part of a couple.",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "scores": "5"
        },
        {
            "categoryType": "categoryK",
            "questionNum": "My gender is",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "scores": "4"
        },
        {
            "categoryType": "categoryK",
            "questionNum": "My age in years is . .",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "scores": "3"
        },
        {
            "categoryType": "categoryK",
            "questionNum": "My health is",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "scores": "5"
        },
        {
            "categoryType": "categoryK",
            "questionNum": "I have lived at",
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
        else if(value === 'categoryK'){
            update(data_11);
        }
        else {
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
                        return "rgb(244, 65, 124)";
                    }
                    else if(d.categoryType === "categoryD"){
                        return "rgb(244, 103, 65)";
                    }
                    else if(d.categoryType === "categoryE"){
                        return "rgb(244, 202, 65)";
                    }
                    else if(d.categoryType === "categoryF"){
                        return "rgb(65, 244, 181)";
                    }
                    else if(d.categoryType === "categoryG"){
                        return "rgb(65, 139, 244)";
                    }
                    else if(d.categoryType === "categoryH"){
                        return "rgb(190, 65, 244)";
                    }
                    else if(d.categoryType === "categoryI"){
                        return "rgb(244, 65, 121)";
                    }
                    else if(d.categoryType === "categoryJ"){
                        return "rgb(244, 65, 65)";
                    }
                    else {
                        return "rgb(65, 226, 244)";
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
                    return "rgb(204,153,255)";
                }
                else if(d.categoryType === "categoryC"){
                    return "rgb(244, 65, 124)";
                }
                else if(d.categoryType === "categoryD"){
                    return "rgb(244, 103, 65)";
                }
                else if(d.categoryType === "categoryE"){
                    return "rgb(244, 202, 65)";
                }
                else if(d.categoryType === "categoryF"){
                    return "rgb(65, 244, 181)";
                }
                else if(d.categoryType === "categoryG"){
                    return "rgb(65, 139, 244)";
                }
                else if(d.categoryType === "categoryH"){
                    return "rgb(190, 65, 244)";
                }
                else if(d.categoryType === "categoryI"){
                    return "rgb(244, 65, 121)";
                }
                else if(d.categoryType === "categoryJ"){
                    return "rgb(244, 65, 65)";
                }
                else {
                    return "rgb(65, 226, 244)";
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
    var margin = {top: 20, right: 20, bottom: 195, left: 50};
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
                return "rgb(244, 65, 124)";
            }
            else if(d.categoryType === "categoryD"){
                return "rgb(244, 103, 65)";
            }
            else if(d.categoryType === "categoryE"){
                return "rgb(244, 202, 65)";
            }
            else if(d.categoryType === "categoryF"){
                return "rgb(65, 244, 181)";
            }
            else if(d.categoryType === "categoryG"){
                return "rgb(65, 139, 244)";
            }
            else if(d.categoryType === "categoryH"){
                return "rgb(190, 65, 244)";
            }
            else if(d.categoryType === "categoryI"){
                return "rgb(244, 65, 121)";
            }
            else if(d.categoryType === "categoryJ"){
                return "rgb(244, 65, 65)";
            }
            else {
                return "rgb(65, 226, 244)";
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
