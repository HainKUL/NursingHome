<!DOCTYPE html>
<?php
if(!isset($_SESSION['caregiver'])) {
    echo "<script> 
                        alert('You are not logged in!'); 
                        window.location.href='".base_url()."Caregiver_controller/login';
              </script>";
    exit();
}
?>


<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/ >

    <!-- Google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

    <!-- D3.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.6/d3.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3-legend/1.3.0/d3-legend.js" charset="utf-8"></script>

    <!-- JQuery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!--    <script src="--><?//= base_url()?><!--assets/js/trail.js"></script>-->


    <!-- TODO move to some css file!-->
    <style>
        body {
            font-family: "Helvetica Neue";
            font-size: 11px;
            font-weight: 300;
            fill: #242424;
            text-align: center;
            cursor: default;
        }
        .bar:hover{
            fill: red;
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
            font: 13px/1 'Avenir Next Condensed';
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
        .category{
            margin: 0 0 0 80px;
            width: 210px;
        }

        select {
            font-family:  "Helvetica Neue";
            font-size: 30px;
            background: none repeat scroll 0 0 #FFFFFF;
            border: 1px solid #E5E5E5;
            border-radius: 5px 5px 5px 5px;
            box-shadow: 0 0 10px #E8E8E8 inset;
            height: 40px;
            padding: 8px;
            width: 210px;
            margin-left:100px;}
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
//TODO probably move queries to controller?
$currentID = $_SESSION['id'];
$this->load->database();
$query = "SELECT Notes.noteText, Notes.author, Notes.timestamp, Caregivers.firstName FROM Notes ".
            "INNER JOIN Caregivers on Notes.author = Caregivers.idCaregivers ORDER BY Notes.timestamp DESC;";
$result = $this->db->query($query);
$query = "SELECT firstName, name, idResidents, YEAR(CURRENT_TIMESTAMP) - YEAR(dateOfBirth) - (RIGHT(CURRENT_TIMESTAMP, 5) < RIGHT(dateOfBirth, 5)) as age FROM Residents ORDER BY firstName;";
$residents = $this->db->query($query);
$query = "SELECT firstName FROM Caregivers WHERE $currentID = Caregivers.idCaregivers;";
$firstName = $this->db->query($query);
//$query = "SELECT email FROM Caregivers WHERE Caregivers.idCaregivers = $currentID;";
//$email = $this->db->query($query);
$query = "SELECT firstName, name FROM Residents ORDER BY firstName;";
$residentsFirstname = $this->db->query($query);
?>


<script>
    $(function() {
        var availableTags =
        <?php
            echo "[";
            foreach ($residentsFirstname->result_array() as $row) echo '"' . $row['firstName']." ".$row['name'] . '",';
            echo "]";
        ?>
        $( "#tags" ).autocomplete( {source: availableTags } );
    });
</script>



<div class="container-fluid">
    <div class="row easteregg hiddendiv" id="easteregg">
        <div class="col-3"> </div>
        <div class="col-6">
            <i class="fa fa-exclamation-circle rotating"></i> ANTI HACKER MODE ACTIVATED <i class="fa fa-exclamation-circle rotating"></i>
        </div>
        <div class="col-3">
            <button class="btn-easteregg" onclick="enableInput()">I'm sorry <br> please take me back</button>
        </div>
    </div>

    <div class="row" style="height:100vh;">
        <div class="col-3" id="div1" style="background-color:#009489;padding:0;">

            <div style="height:5%;"></div>
            <div class="searchdiv" style="text-align:center;margin:15px;">
                <h2 class="floornumber"><?php echo $this->lang->line('dash_floor'); ?> </h2>
                <div class="ui-widget" >
                    <form name="form" action="" method="get">
                        <input id="tags" name="filter" for="tags" class ="searchbar" oninput="checkInput(this.id)" type="search" placeholder="<?php echo $this->lang->line('search'); ?>">
                    </form>
                </div>
            </div>
            <div style="overflow-y:scroll;max-height:68vh;">
                <div class="btn-group-vertical btn-group-lg" role="group" style="width:100%;">
                    <?php displayResidents($residents); ?>
                </div>
            </div>
        </div>

        <div class="col-3 hiddendiv" id="div2" style="background-color:#009489;padding:0;">
            <div style="height:5%;"></div>
            <h2 class="floornumber" style="padding:15px"><?php echo $this->lang->line('polls');?></h2>
            <a href="#" style="padding:10%">
                <button class="btn btn-primary btn-lg" type="button" style="

                width:80%;background-color:#00675F;border:none;color:#DEEAE9">
                    <?php echo $this->lang->line('add_poll'); ?>
                </button>
            </a>
            <div style="overflow-y:scroll;max-height:70vh;">
                <div class="btn-group-vertical btn-group-lg" role="group" style="width:100%;">
                    <button class="btn btn-primary btn-resident" id="settings1" type="button" onclick="settingsButton(this.id)">
                        <div class="resident-button">
                            <img class="profilePic" src="<?=base_url() ?>assets/photos/food.png" alt="Avatar">
                            <span style="font-weight:100">
                                <?php echo $this->lang->line('food'); ?>
                            </span>
                        </div>
                    </button>
                    <button class="btn btn-primary btn-resident" id="settings2" type="button" onclick="settingsButton(this.id)">
                        <div class="resident-button">
                            <img class="profilePic" src="<?=base_url() ?>assets/photos/activity.jpeg" alt="Avatar">
                            <span style="font-weight:100">
                                <?php echo $this->lang->line('activities'); ?>
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
                    <button class="btn btn-primary btn-resident " id="settings11" type="button" onclick="settingsButton(this.id)">
                        <div class="resident-button">
                            <img class="profilePic" src="<?=base_url() ?>assets/photos/setting.png" alt="Avatar">
                            <span style="font-weight:100">
                                <?php echo $this->lang->line('personal_settings');?>
                            </span>
                        </div>
                    </button>

                    <button class="btn btn-primary btn-resident  btn-info btn-lg" id="settings22" type="button" onclick="settingsButton(this.id);"data-toggle="modal" data-target="#myModal2">
                        <div class="resident-button">
                            <img class="profilePic" src="<?=base_url() ?>assets/photos/add.png" alt="Avatar">
                            <span style="font-weight:100">
                                <?php echo $this->lang->line('register_button');?>
                            </span>
                        </div>
                    </button>
                </div>
            </div>

        </div>

        <form method="post" action="<?= site_url('Dashboard/dashboard_reg') ?>">
            <div id="myModal2" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?php echo $this->lang->line('register_button'); ?></h4>
                        </div>
                        <div class="modal-body">
                            <table align="center" cellpadding = "5">
                                <tr>
                                    <td>*<?php echo $this->lang->line('first'); ?>:  </td>
                                    <td><input type="text" id="inputfirst" oninput="checkInput(this.id)" pattern="[a-z A-Z'éèëï-]{1,20}" name="firstname" maxlength="30" placeholder="<?php echo $this->lang->line('firstname_placeholder_register'); ?>" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>*<?php echo $this->lang->line('last'); ?>: </td>
                                    <td><input type="text" id="inputlast" oninput="checkInput(this.id)" pattern="[a-z A-Z'éèëï-]{1,20}" name="name" maxlength="30" placeholder="<?php echo $this->lang->line('lastname_placeholder_register'); ?>"required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $this->lang->line('birth'); ?>:</td>
                                    <td>
                                    <p><input type="date" id="birthday" name="birthDay" placeholder="dd-mm-yyyy"></p></td>


                                </tr>
                                <tr>
                                    <td><?php echo $this->lang->line('contact'); ?>: </td>
                                    <td>
                                        <input type="text" id="inputcontact" oninput="checkInput(this.id)" pattern="[0-9]{0,10}" name="Mobile_Number" maxlength="15" placeholder="0478704235" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>*<?php echo $this->lang->line('pin'); ?>: </td>
                                    <td><input type="password" id="password" oninput="checkInput(this.id)" pattern="[0-9]{0,4}" name="Pin_Code" maxlength="4" placeholder="1234" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>*<?php echo $this->lang->line('confirm'); ?>: </td>
                                    <td><input type="password" id="password_confirm" pattern="[0-9]{0,4}" name="Pin_Code_2" maxlength="4" placeholder="1234" oninput="check(this)" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <br>
                                    <td>*<?php echo $this->lang->line('language'); ?>: </td>
                                    <td>
                                        <input type="radio" name="Radio" value="Dutch" checked>
                                        <?php echo $this->lang->line('dutch'); ?>
                                            <input type="radio" name="Radio" value="English" >
                                        <?php echo $this->lang->line('english'); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>*<?php echo $this->lang->line('room'); ?>: </td>
                                    <td><input type="text" id="inputroom" oninput="checkInput(this.id)" pattern="[A-Z a-z0-9]{0,4}" name="Room_Id" maxlength="100" placeholder="room id" required/></td>
                                </tr>
                                <tr>
                                    <td>*<?php echo $this->lang->line('bed'); ?>: </td>
                                    <td><input type="text" id="inputbed" oninput="checkInput(this.id)" pattern="[A-Z a-z0-9]{0,4}" name="Bed_Id" maxlength="10" placeholder="bed id" required/></td>
                                </tr>
                                <tr>
                                    <td><?php echo $this->lang->line('floor'); ?>: </td>
                                    <td>

                                        <input type="radio" name="floor" value="GroundFloor" checked>
                                        <?php echo $this->lang->line('floor1'); ?>
                                            <input type="radio" name="floor" value="FirstFloor">
                                        <?php echo $this->lang->line('floor2'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td>
                                        <input type="radio" name="floor" value="SecondFloor">
                                        <?php echo $this->lang->line('floor3'); ?>
                                            <input type="radio" name="floor" value="ThirdFloor">
                                        <?php echo $this->lang->line('floor4'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $this->lang->line('privileges'); ?>: </td>
                                    <td>
                                        <input type="text" id="inputprivileges" oninput="checkInput(this.id)" pattern="[A-Z a-z0-9'éèëï-]{0,200}" name="Privileges" maxlength="200" placeholder="<?php echo $this->lang->line('privileges_optional'); ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="submit" value="Send">
                                    </td>
                                </tr>
                                <tr>
                                    <td> * =  <?php echo $this->lang->line('required'); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



        <div class="col-3 hiddendiv" id="div4" style="background-color:#009489;padding:0;"></div>
        <div class="col-6" style="background-color:#f9f9f9;padding:0;">
            <div style="width:100%;">
                <ul class="nav nav-tabs" style="text-align:center;border:none;">
                    <li class="nav-item" style="width:33%;"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-1" style="border:none;" onclick="loadDiv(1)"><?php echo $this->lang->line('dash_questionnaire'); ?></a></li>
                    <li class="nav-item" style="width:33%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-2" style="border:none;" onclick="loadDiv(2)"><?php echo $this->lang->line('dash_poll'); ?></a></li>
                    <li class="nav-item" style="width:34%;"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-3" style="border:none;" onclick="loadDiv(3)"><?php echo $this->lang->line('admin'); ?></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="tab-1" style="padding:5%;max-height:94vh;overflow-y:scroll;">
                        <div class="card questionnaire-card">
                            <div class="card-body">
                                <div class="card-top">
                                    <div class="card-head">
                                        <img class="card-picture" src="<?=base_url() ?>assets/photos/elder1.jpg" alt="Avatar">
                                        <span class="card-name" id="residentName"> <?php echo $theFirstName." ".$name; ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="card-text">
                                    <div class="card-birthdate"><?php echo $this->lang->line('birthday'); ?><span id="card-birthdate"> <?php echo $dateOfBirth ?> </span></div>
                                    <div class="card-room"><?php echo $this->lang->line('roomnum'); ?><span id="card-room"> <?php echo $roomNumber ?> </span></div>
                                    <div class="card-bed"><?php echo $this->lang->line('bednum'); ?><span id="card-bed"> <?php echo $bedNumber ?> </span></div>
                                    <div class="card-privileges"><?php echo $this->lang->line('privileges'); ?><span id="card-privileges">: can go outside</span></div>
                                </div>
                                <div class="radarChart"></div>
                                <script src="<?=base_url() ?>assets/js/radarChart.js"></script>
                                <script type="text/javascript">
                                    var data = <?php echo json_encode($data1); ?>;
                                    var data2 = <?php echo json_encode($data2); ?>;
                                </script>
                                <script>
                                    if(data !== null && data !== '')
                                    {
                                        RadarChart(".radarChart", data);
                                    }
                                    else
                                    {
                                        RadarChart1(".radarChart", data2);
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="card questionnaire-card">
                            <div class="card-body">
                                <br>
                                <h2 class="answer"><?php echo $this->lang->line('dash_answers'); ?></h2>
                                <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
                                <script src="//d3js.org/d3.v4.min.js"></script>
                                <script src="https://d3js.org/d3.v4.min.js"></script>

                                <div class='container'>
                                    <div class='row'>
                                        <div class='radio'>
                                            <br>
                                            <div class = "date" style="float:left;">
                                                <select onchange="change(this.value,'all');"  name = "date" id = "date" class="input">
                                                    <option disabled selected><?php echo $this->lang->line('dash_select_date'); ?></option>
                                                    <?php
                                                    if(isset($one))
                                                    {
                                                        foreach($data_each1 as $row)
                                                        {
                                                            echo '<option value="'.$row['key'].'">'.$row['key'].'</option>';
                                                        }
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                            <script type="text/javascript">
                                                var bothData = <?php echo json_encode($one); ?>;
                                            </script>

                                            <div class = "category" style="float:right;">
                                                <select onchange="change('0',this.value);"  name = "cate" id = "cate" class="input">
                                                    <option disabled selected><?php echo $this->lang->line('dash_select_cat'); ?></option>
                                                    <option value="0" ><?php echo $this->lang->line('category_0'); ?></option>
                                                    <option value="1" ><?php echo $this->lang->line('category_1'); ?></option>
                                                    <option  value="2" ><?php echo $this->lang->line('category_2'); ?></option>
                                                    <option  value="3" ><?php echo $this->lang->line('category_3'); ?></option>
                                                    <option  value="4" ><?php echo $this->lang->line('category_4'); ?></option>
                                                    <option  value="5" ><?php echo $this->lang->line('category_5'); ?></option>
                                                    <option  value="6" ><?php echo $this->lang->line('category_6'); ?></option>
                                                    <option  value="7" ><?php echo $this->lang->line('category_7'); ?></option>
                                                    <option  value="8" ><?php echo $this->lang->line('category_8'); ?></option>
                                                    <option value="9" ><?php echo $this->lang->line('category_9'); ?></option>
                                                    <option  value="10" ><?php echo $this->lang->line('category_10'); ?></option>
                                                    <option  value="all" ><?php echo $this->lang->line('category_all'); ?></option>
                                                </select>
                                            </div>
                                            <br>
                                            <br>
                                        </div>
                                        <svg class='chart' viewBox="0 0 530 400"
                                             perserveAspectRatio="xMinYMid"> </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="tab-2">
                        <p><?php echo $this->lang->line('poll_content'); ?></p>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="tab-3">
                        <div class="container" >
                            <div class="row" style="padding-top: 40px">
                                <div class="col-8">
                                    <p class="personal_text"> <?php echo $this->lang->line('hello'); if ($firstName->num_rows() > 0)
                                        {
                                        $row = $firstName->row();
                                        echo $row->firstName;
                                        }
                                    ?></p>
                                </div>
                                <div class="col-4">
                                    <img class="profilePic" style="width:130px;height:130px;" src="<?=base_url() ?>assets/photos/Caregiver-center.jpg" alt="Profielfoto">
                                </div>
                            </div>
                            <div class="row" style="padding-top: 40px; vertical-align: bottom;">
                                <div class="col-8" style="vertical-align: central;">
                                    <p class="personal_text_2" style="padding-top: 4vh;"> <?php echo $this->lang->line('dash_chooselang'); ?> </p>
                                </div>
                                <div class="col-4" style="padding-top: 12px;">
                                    <select style="width:100%" onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
                                        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Nederlands</option>
                                        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 40px;">
                                <div class="col-4">
                                    <p class="personal_text_2" style="padding-top: 0.5vh;"> <?php echo $this->lang->line('dash_email'); ?></p>
                                </div>
                                <div class="col-8">
                                    <p class="personal_text_2" style="text-align: end;"> <?php if ($email->num_rows() > 0)
                                        {
                                            $row = $email->row();
                                            echo $row->email;
                                        }
                                    ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-3" style="background-color:#c7de6e;padding:0;">
            <div style="height:5%;">
                <span id="openfullscreen" class="fa fa-expand btn-fullscreen" onclick="openFullscreen()"></span>
                <span id="closefullscreen" class="fa fa-compress btn-fullscreen hiddendiv" onclick="closeFullscreen()"></span>
            </div>
            <div class="searchdiv" style="text-align:center;margin:15px;">
                <h2 class="notes-title"><?php echo $this->lang->line('dash_notes'); ?></h2>
                <button class="btn btn-primary btn-lg" type="button" style="min-width:100%;background-color:#009489;border:none;" data-toggle="modal" data-target="#myModal"><?php echo $this->lang->line('dash_add'); ?></button>
                <!--Modal-->
                <form method="post" action="<?= site_url('Caregiver_controller/add_note') ?>">
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?php echo $this->lang->line('dash_add'); ?></h4>
                                </div>
                                <div class="modal-body" >
                                    <textarea class="form-control" id="inputnote" oninput="checkInput(this.id)" pattern="[A-Z a-z0-9'()+!-]{1,1023}" style="min-width: 100%" type="text" name="note" maxlength="1023" ></textarea>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" value="Save" class="btn btn-default">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div style="height:2%;"></div>

            <div role="tablist" id="accordion-1" style="border:none;text-align:right;">
                <div class="card notes-card active">
                    <div id="cardhead1" class="card-header notes-card-head card-head-active" role="tab">
                        <h5 class="mb-0">
                            <a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="div#accordion-1 .item-1" class="btn-notes" onclick="rotate(1)">
                                <?php echo $this->lang->line('dash_today'); ?>&nbsp;<span id="caret1" class="fa fa-caret-left activefa"></span>
                            </a>
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
                                                    for($i = 0; $i < 11; $i++) $row['timestamp'][$i] = ' ';
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
                    <div id="cardhead2" class="card-header notes-card-head" role="tab">
                        <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-2" href="div#accordion-1 .item-2" class="btn-notes" onclick="rotate(2)">
                            <?php echo $this->lang->line('dash_this_week'); ?>&nbsp;<span id="caret2" class="fa fa-caret-left"></span></a>
                        </h5>
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
                    <div id="cardhead3" class="card-header notes-card-head" role="tab">
                        <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-3" href="div#accordion-1 .item-3" class="btn-notes" onclick="rotate(3)">
                            <?php echo $this->lang->line('dash_archive'); ?>&nbsp;<span id="caret3" class="fa fa-caret-left"></span></a>
                        </h5>
                    </div>
                    <div class="collapse item-3 notes-content" role="tabpanel" data-parent="#accordion-1">
                        <div class="card-body">
                            <?php
                                foreach ($result->result_array() as $row) {
                                    ?><div class="note-box"><?php
                                        ?><p class="note-heading"><?php
                                            ?><b><?php
                                                echo $row['firstName'];
                                            ?></b><?php
                                            ?><span class="note-timestamp"><?php
                                                for($i = 11; $i < 20; $i++) $row['timestamp'][$i] = ' ';
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
                <div style="margin-top: 5%">
                    <a href="<?=base_url()?>index.php/Dashboard/logout" style="padding:20% 10%;">
                        <button class="btn btn-primary btn-lg" type="button" style="width:80%;background-color:#009489;;border:none;">
                            <?php echo $this->lang->line('dash_logout'); ?>
                        </button>
                    </a>
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
    /* Get the documentElement (<html>) to display the page in fullscreen */
    var elem = document.documentElement;

    /* View in fullscreen */
    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
        }
        document.getElementById("openfullscreen").classList.add("hiddendiv");
        document.getElementById("closefullscreen").classList.remove("hiddendiv");
    }

    /* Close fullscreen */
    function closeFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) { /* Firefox */
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { /* IE/Edge */
            document.msExitFullscreen();
        }
        document.getElementById("openfullscreen").classList.remove("hiddendiv");
        document.getElementById("closefullscreen").classList.add("hiddendiv");
    }
</script>


<script>
    function check(input) {
        if (input.value != document.getElementById('password').value) {
            input.setCustomValidity('<?php echo $this->lang->line('pin_match'); ?>');
        } else {
            input.setCustomValidity('');
        }
        checkInput('password_confirm');
    }
</script>


<script>
    var currentButtonID;
    function loadResident(id) {
        if(currentButtonID) {
            var previous = document.getElementById(currentButtonID);
            previous.classList.remove("btn-active");
        }

        var element = document.getElementById(id);
        element.classList.add("btn-active");
        currentButtonID = id;

        let base_url = window.location.origin.concat("/a18ux04");
        console.log(base_url);
        if(!base_url.includes("localhost"))
            base_url = "https://a18ux04.studev.groept.be";

        let newUrl = base_url.concat("/index.php/Dashboard/dashboard/").concat(id);
        window.location.href = newUrl;
        //document.getElementById("residentName").innerText = id + "<?php echo $this->lang->line('dash_profile'); ?>"
    }
</script>


<?php function displayResidents($residents) {
    if (isset($_GET['filter'])) $input = $_GET['filter'];
    else $input ='';

    foreach ($residents->result_array() as $row) {
        $fullname = $row['firstName']." ".$row['name'];
        if($input== '' || strpos($fullname, $input) !== false) {
            ?>
            <button class="btn btn-primary btn-resident" id="<?php echo $row['idResidents'] ?>" type="button"
                onclick="loadResident(this.id)">
                <div class="resident-button">
                    <img class="profilePic" src="<?= base_url() ?>assets/photos/id.png" alt="Avatar">
                    <div class="resident-nameage">
                        <div class="button-name">
                            <?php echo $row['firstName']." ".$row['name']; ?>
                        </div>
                        <div class="button-age">
                            <?php echo $row['age'] ?>
                        </div>
                    </div>
                </div>
            </button><?php
        }
    }
} ?>


<script>
    var face_changers = document.querySelectorAll('.btnFlip'),
        f1_container = document.getElementById('register-card');

    for(var i = 0; i < face_changers.length; i++){
        face_changers[i].addEventListener('click', function(e) {
            f1_container.classList.toggle('hover_effect');
            e.preventDefault();
        }, false)
    }
</script>


<script>
    var currentButtonID;
    function settingsButton(id) {
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
    attempts = 0;
    function checkInput(id){
        input = document.getElementById(id).value
        if(input.includes("<")||input.includes(">")||input.includes("\;")) {
            if(attempts > 0) {
                alert("Are you still trying to inject code? \nWe are going to have to disable your keyboard to prevent future attacks.")
                input = input.slice(0, -1);
                document.getElementById(id).value = input;
                $("body").keydown(false);
                document.getElementById("easteregg").classList.remove("hiddendiv")
            } else{
                alert("code injection not yet supported. \nBecause this is your first attempt, we'll just remove this from your input.")
                input = input.slice(0, -1);
                document.getElementById(id).value = input;
                attempts = 1;
            }
        }
    }

    function enableInput(){
        location.reload()
    }
</script>


<script>
    currentTab = 1;
    function rotate(id){
        if(currentTab != id) {
            if(currentTab != 0) { //close currently open tab, if any
                document.getElementById("caret".concat(currentTab)).classList.remove("activefa")
                document.getElementById("cardhead".concat(currentTab)).classList.remove("card-head-active")
            }
            document.getElementById("caret".concat(id)).classList.add("activefa")
            document.getElementById("cardhead".concat(id)).classList.add("card-head-active")
            currentTab = id;
        } else {    //close this tab, it was already open when clicked
            document.getElementById("caret".concat(currentTab)).classList.remove("activefa")
            document.getElementById("cardhead".concat(currentTab)).classList.remove("card-head-active")
            currentTab = 0;
        }
    }
</script>


<script>
    amountOfTabs = 0;
    function loadDiv(id){
        if(id > amountOfTabs) amountOfTabs = id;
        for(var i = 1; i < amountOfTabs + 1; i++)   {
            if(i == id) {
                var element = document.getElementById("div".concat(i.toString()));
                element.classList.remove("hiddendiv");
            }
            else document.getElementById("div".concat(i.toString())).classList.add("hiddendiv");
        }
    }
</script>


<script type="text/javascript">
    //set up chart
    var margin = {top: 10, right:0, bottom: 280, left: 25};
    var width = 490;
    var height = 200;

    var chart = d3.select(".chart")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    var xChart = d3.scaleBand()
        .range([0, width]);
    //.nice();

    var yChart;
    yChart = d3.scaleLinear()
        .range([height, 0]);

    //set up axes
    var xAxis = d3.axisBottom(xChart);
    var yAxis = d3.axisLeft(yChart)
        .ticks(5)
        .tickValues([1, 2, 3, 4, 5]);

    chart.append("g")
        .attr("class", "y axis")

    chart.append("g")
        .attr("class", "xAxis")

    //add labels
    chart
        .append("text")
        .attr("transform", "translate(-35," + (height -140+ margin.bottom) / 2 + ") rotate(-90)")
        .style("font-size", "18px")
        .style("padding", "8px")
        .style("font-weight", "400")
        .style("font-family", "Avenir Next Condensed")
        .text("<?php echo $this->lang->line('category_score'); ?>");
    update(bothData, true);

    //function for toggling between data
    function change(date,category) {
        var data5 = <?php echo json_encode($data_each1); ?>;

        for (var index = 0; index < data5.length; ++index) {
            if (data5[index]['key'] === date) {
                bothData = data5[index]['values'];
                break;
            }
        }

        if(category !== 'all') {
            var data = [];
            for (var i = 0; i < bothData.length; i++) {
                if (bothData[i]["categoryID"] == category) data.push(bothData[i]);
            }
            update(data, false);
        } else update(bothData, true);
    }


    function update(data, overview) {
        if(overview) xChart.domain(data.map(function(d) { return d.category; })); //set domain for x axis (overview graph)
        else         xChart.domain(data.map(function(d) { return d.question; })); // '' (category graph
        yChart.domain([1, d3.max(data, function (d) { return d.answer; })]);   //set domain for y axis
        var barWidth = width / data.length; //get the width of each bar

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
                switch (d.categoryID) {
                    case "0" : return "rgb(216,230,173)";
                    case "1" : return "rgb(173,216,230)";
                    case "2" : return "rgb(230,187,173)";
                    case "3" : return "rgb(138,149,240)";
                    case "4" : return "rgb(200,235,208)";
                    case "5" : return "rgb(133,266,246)";
                    case "6" : return "rgb(187,187,187)";
                    case "7" : return "rgb(193,226,204)";
                    case "8" : return "rgb(234,145,152)";
                    case "9" : return "rgb(252,244,144)";
                    case "10": return "rgb(157,174,147)";
                    default  : return "rgb(014,174,294)";
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



</script>


</html>


