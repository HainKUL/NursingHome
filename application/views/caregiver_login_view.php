<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $this->lang->line('caregiver_login_title'); ?></title>
    <link href="<?=base_url()?>assets/css/caregiver_login.css" rel="stylesheet" type="text/css"/>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon3.ico" type="image/gif" sizes="16x16">

</head>

<body style="background-repeat:no-repeat;background-size: cover;" background="<?=base_url() ?>assets/photos/background_remy.png">
<?php if(isset($_SESSION)) {
    echo $this->session->flashdata('flash_data');
} ?>

<div class="container-fluid" id="card-outside" >

    <div class="row" style="padding-top: 7%">
        <div class="col-2">
        </div>
        <div class="col-8">


            <div class="container" id="card-inside">
                <form method="post" action="<?=base_url()?>index.php/Caregiver_controller/login">
                <div class="row" >
                    <div class="col-2">
                    </div>
                    <div class="col-8">

                            <h1 style="padding-top: 15%; font-size: 40px;"><?php echo $this->lang->line('login_title'); ?> </h1>

                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row" >
                    <div class="col-2">
                    </div>
                    <div class="col-8">

                        <p style="padding-top: 15%; font-size: 32px; padding-right: 12px; padding-left: 7px;"><?php echo $this->lang->line('login_username'); ?>:</p>
                        <p style="padding-right: 12px; padding-left: 7px;"> <input pattern="[@.a-z A-Z'éèëï-]{1,20}" style="line-height: 32px; padding-left: 7px; width: 15vw;" type="text" oninput="checkInput(this.id)" name="email" id="email" class="form-control" name="email" /></p>

                    </div>
                    <div class="col-2">
                    </div>
                </div>
                <div class="row" >
                    <div class="col-2">
                    </div>
                    <div class="col-8" style="align-content: end;">

                        <p style="padding-top: 10%; font-size: 32px; padding-right: 12px; padding-left: 7px;"><?php echo $this->lang->line('login_password'); ?>:</p>
                        <p style="padding-right: 12px; padding-left: 7px;"><input  style="line-height: 32px; padding-left: 7px; width: 15vw;" type="password" oninput="checkInput(this.id)" name="password" id="password" class="form-control" name="password" /></p>

                    </div>
                    <div class="col-2">
                    </div>
                </div>

                <div class="row" >
                    <div class="col-2">
                    </div>
                    <div class="col-8">
                            <p style="padding-top: 10%">
                                <input type="submit" id="submit" value="<?php echo $this->lang->line('login_button'); ?>" />
                            </p>

                    </div>
                    <div class="col-2">
                    </div>
                </div>


                </form>

                <div class="row" >
                    <div class="col-2">
                    </div>
                    <div class="col-8">
                        <br /><br /><br /><br /><br /><br />
                        <p style="padding-top: 15%"><?php echo $this->lang->line('login_forgot'); ?> <a href="forgot"><?php echo $this->lang->line('login_click'); ?></a></p>

                    </div>
                    <div class="col-2">
                    </div>
                </div>

            </div>

        <div class="col-2">
        </div>
    </div>
</div>



<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

</body>
<script>
    function checkInput(id){
        input = document.getElementById(id).value
        if(input.includes("<")||input.includes(">")||input.includes("\;")) {
            alert("code injection not yet supported")
            input = input.slice(0, -1);
            document.getElementById(id).value = input
        }
    }
</script>
</html>
