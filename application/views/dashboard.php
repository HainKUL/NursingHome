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






    <!--    <script src="--><?//= base_url()?><!--assets/js/trail.js"></script>-->


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
                                    <a href="<?=base_url()?>Dashboard/logout">
                                        <button type = "button" style="font-size: 2vw">
                                            <?php echo $this->lang->line('dash_logout'); ?>
                                        </button>
                                    </a>
                                </div>

                            </div>

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


