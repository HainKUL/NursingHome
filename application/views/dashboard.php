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
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon.png" type="image/gif" sizes="16x16">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom CSS-->
    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
    </select>
    <link href="<?= base_url()?>assets/css/dashboard.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<?php
$this->load->database();
$query = "SELECT Notes.noteText, Notes.author, Notes.timestamp, Caregivers.firstName FROM Notes INNER JOIN Caregivers on Notes.author = Caregivers.idCaregivers;";
$result = $this->db->query($query);
$query = "SELECT firstName, name, idResidents, YEAR(CURRENT_TIMESTAMP) - YEAR(dateOfBirth) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(dateOfBirth, 5)) as age FROM Residents;";
$residents = $this->db->query($query);
?>


<div class="container-fluid">


    <div class="row" style="height:100vh;">
        <div class="col-3" style="background-color:#009489;padding:0;">
            <div style="height:5%;"></div>
            <div class="searchdiv" style="text-align:center;margin:15px;">
                <h2 class="floornumber"><?php echo $this->lang->line('dash_floor'); ?> 1</h2><input type="search" placeholder="<?php echo $this->lang->line('search'); ?>" style="width:100%;height:40px;"></div>
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
                    <li class="nav-item" style="width:33%;"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1" style="border:none;"><?php echo $this->lang->line('dash_questionnaire'); ?></a></li>
                    <li class="nav-item" style="width:34%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2" style="border:none;"><?php echo $this->lang->line('dash_poll'); ?></a></li>
                    <li class="nav-item" style="width:33%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-3" style="border:none;"><?php echo $this->lang->line('dash_personal'); ?></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="tab-1" style="padding:5%;max-height:94vh;overflow-y:scroll;">
                        <div class="card questionnaire-card">
                            <div class="card-body">
                                <h4 class="card-title" id="residentTitle"></h4>
                                <p class="card-text">We're talking away. I don't know what. I'm to say I'll say it anyway. Today's another day to find you. Shying away. I'll be coming for your love, okay?. Take on me (take on me). Take me on (take on me). I'll be gone. In a day or two. So needless to say. I'm odds and ends. But I'll be stumbling away. Slowly learning that life is okay. Say after me. It's no better to be safe than sorry. Take on me (take on me). Take me on (take on me). I'll be gone. In a day or two.</p>
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
                        <p>Content for tab 3.</p>
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
                                <?php echo $this->lang->line('dash_today'); ?></a><i class="fa fa-star"></i></h5>
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
                        <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-2" href="div#accordion-1 .item-2" class="btn-notes"><?php echo $this->lang->line('dash_this_week'); ?></a></h5>
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
                        <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-3" href="div#accordion-1 .item-3" class="btn-notes"><?php echo $this->lang->line('dash_archive'); ?></a></h5>
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
<a href="<?= site_url('Caregiver_controller/login') ?>"><p><?php echo $this->lang->line('dash_logout'); ?></p></a>
</body>


<script>
    function loadResident(id){
        document.getElementById("residentTitle").innerText = id + "<?php echo $this->lang->line('dash_profile'); ?>"
    }


</script>

<script>
    // $('#accordion .panel-collapse').on('shown.bs.collapse', function () {
    //     $(this).prev().find(".glyphicon").removeClass("glyphicon-chevron-right").addClass("glyphicon-chevron-down");
    // });
    //
    // //The reverse of the above on hidden event:
    //
    // $('#accordion .panel-collapse').on('hidden.bs.collapse', function () {
    //     $(this).prev().find(".glyphicon").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-right");
    // });
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