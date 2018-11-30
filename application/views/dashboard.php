<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
</head>
<body>
<div class="container-fluid">


    <div class="row">
        <div class="col-3 border-left border-top">
        </div>
        <div class="col-7 border-left border-top border-right">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-questionnaire-tab" data-toggle="tab" href="#nav-Questionnaire" role="tab" aria-controls="nav-Questionnaire" aria-selected="true"><?php echo $this->lang->line('dash_questionnaire'); ?></a>
                    <a class="nav-item nav-link" id="nav-poll-tab" data-toggle="tab" href="#nav-Poll" role="tab" aria-controls="nav-Poll" aria-selected="false"><?php echo $this->lang->line('dash_poll'); ?></a>
                    <a class="nav-item nav-link" id="nav-personal-tab" data-toggle="tab" href="#nav-Personal" role="tab" aria-controls="nav-Personal" aria-selected="false"><?php echo $this->lang->line('dash_personal'); ?></a>
                </div>
            </nav>
        </div>
        <div class="col-2 border-right border-top">
        </div>


    </div>



    <div class="row">
        <div class="col-3 border-bottom border-left">
            <h5><p><?php echo $this->lang->line('dash_notes'); ?></p></h5>
            <button type="button" class="btn btn-light"><p><?php echo $this->lang->line('dash_add'); ?></p></button>
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
                            <p><?php echo $this->lang->line('dash_today_note'); ?></p>
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
                            <p><?php echo $this->lang->line('dash_this_week_note'); ?></p>
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
                            <p><?php echo $this->lang->line('dash_archive_note'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7 border-bottom border-left border-right">
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

                                    <div class='container'>
                                        <div class='row'>
                                            <div class='radio'>
                                                <label class='radio-inline'>
                                                    <input type="radio" name="gender" value="category_1" onclick='change(this.value)'> category1
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type="radio" name="gender" value="category_2" onclick='change(this.value)'> category2
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type="radio" name="gender" value="category_3" onclick='change(this.value)'> category3
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type="radio" name="gender" value="category_4" onclick='change(this.value)'> category4
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type="radio" name="gender" value="category_5" onclick='change(this.value)'> category5
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type="radio" name="gender" value="category_6" onclick='change(this.value)'> category6
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type="radio" name="gender" value="category_7" onclick='change(this.value)'> category7
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type="radio" name="gender" value="category_8" onclick='change(this.value)'> category8
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type="radio" name="gender" value="category_9" onclick='change(this.value)'> category9
                                                </label>
                                                <label class='radio-inline'>
                                                    <input type="radio" name="gender" value="category_10" onclick='change(this.value)'> category10
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
        <div class="col-2 border-bottom border-right">
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
            "viewer_gender": "category_1",
            "viewer_age": "question 1",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "3.3",
            "watch_time_minutes": "2"
        },
        {
            "viewer_gender": "category_1",
            "viewer_age": "question 2",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "12.8",
            "watch_time_minutes": "5"
        },
        {
            "viewer_gender": "category_1",
            "viewer_age": "question 3",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "7.1",
            "watch_time_minutes": "1"
        },
        {
            "viewer_gender": "category_1",
            "viewer_age": "question 4",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "37.1",
            "watch_time_minutes": "4"
        },
        {
            "viewer_gender": "category_1",
            "viewer_age": "question 5",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "2.7",
            "watch_time_minutes": "3"
        },
        {
            "viewer_gender": "category_1",
            "viewer_age": "question 6",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "23.5",
            "watch_time_minutes": "5"
        },
        {
            "viewer_gender": "category_1",
            "viewer_age": "question 7",
            "channel_display_name": "syncopika",
            "channel_id": "T2NUI3KLGK6sDILFbzUZZg",
            "views": "1.0",
            "watch_time_minutes": "2"
        },

    ];

    var maleData = [];
    var femaleData = [];

    for(var i = 0; i < bothData.length; i++){
        if(bothData[i]["viewer_gender"] === "MALE"){
            maleData.push(bothData[i]);
        }else{
            femaleData.push(bothData[i]);
        }
    }

    //functions for toggling between data
    function change(value){

        if(value === 'male'){
            update(maleData);
        }else if(value === 'female'){
            update(femaleData);
        }else{
            update(bothData);
        }
    }

    function update(data){
        //set domain for the x axis
        xChart.domain(data.map(function(d){ return d.viewer_age; }) );
        //set domain for y axis
        yChart.domain( [0, d3.max(data, function(d){ return +d.watch_time_minutes; })] );

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
            .attr("y", function(d){ return yChart( d.watch_time_minutes); })
            .attr("height", function(d){ return height - yChart(d.watch_time_minutes); })
            .attr("width", barWidth - 1)
            .attr("fill", function(d){
                if(d.viewer_gender === "FEMALE"){
                    return "rgb(251,180,174)";
                }else{
                    return "rgb(179,205,227)";
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
    var width = 400;
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
    update(bothData);
</script>



</html>