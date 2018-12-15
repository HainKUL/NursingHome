<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>CAREGIVER REGISTRATION FORM</title>
    <!-- Custom CSS-->
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
                <form method="post" action="<?=base_url()?>/index.php/Caregiver_controller/registration_caregiver">
                    <div class="row" >
                        <div class="col-2">
                        </div>
                        <div class="col-8">

                            <h1 style="padding-top: 3%; font-size: 34px;">CAREGIVER REGISTRATION FORM </h1>

                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-2">
                        </div>
                        <div class="col-8">

                            <p style="padding-top: 7%; font-size: 20px;">
                                <label>FIRST NAME:</label>
                                <input style="line-height: 32px;" type="text" name="firstname" id="firstname" class="form-control" name="firstname" maxlength="30"/>

                            </p>

                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-2">
                        </div>
                        <div class="col-8">

                            <p style="padding-top: 3%; font-size: 20px; padding-right: 12px; padding-left: 7px;">
                                <label>LAST NAME:</label>
                                <input style="line-height: 32px;" type="text" name="name" id="name" class="form-control" name="name" maxlength="30" />
                            </p>

                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-2">
                        </div>
                        <div class="col-8">

                            <p style="padding-top: 3%; font-size: 20px; padding-right: 12px; padding-left: 7px;">
                                <label>EMAIL:</label>
                                <input style="line-height: 32px;" type="email" name="email" id="email" class="form-control" name="email" maxlength="30" />
                            </p>

                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-2">
                        </div>
                        <div class="col-8">

                            <p style="padding-top: 3%; font-size: 20px; padding-right: 12px; padding-left: 7px;">
                                <label>PASSWORD:</label>
                                <input style="line-height: 32px;" type="password" name="password_1" id="password_1" class="form-control" name="password_1" maxlength="30" />
                            </p>

                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-2">
                        </div>
                        <div class="col-8">

                            <p style="padding-top: 3%; font-size: 20px; padding-right: 12px; padding-left: 7px;">
                                <label>PASSWORD CONFIRM:</label>
                                <input style="line-height: 32px;" type="password" name="password_2" id="password_2" class="form-control" name="password_2" maxlength="30" />
                            </p>

                        </div>
                        <div class="col-2">
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-2">
                        </div>
                        <div class="col-8">
                            <p style="padding-top: 6%">
                                <input type="submit" id="submit" value="Submit" />
                            </p>

                        </div>
                        <div class="col-2">
                        </div>
                    </div>

                    <!--<div class="row" >
                        <div class="col-2">
                        </div>
                        <div class="col-8">
                            <p style="padding-top: 6%">
                                <input type="reset" id="reset" value="Reset" />
                            </p>

                        </div>
                        <div class="col-2">
                        </div>
                    </div>-->

                </form>



            </div>

            <div class="col-2">
            </div>
        </div>
    </div>



    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<!--
<h3>CAREGIVER REGISTRATION FORM</h3>
<form method="post" action="<?= site_url('Caregiver_controller/registration_caregiver') ?>">
    <table align="center" cellpadding = "10">
        <tr>
            <td>FIRST NAME</td>
            <td><input type="text" name="firstname" maxlength="30"/>
            </td>
        </tr>

        <tr>
            <td>LAST NAME</td>
            <td><input type="text" name="name" maxlength="30"/>
            </td>
        </tr>

        <tr>
            <td>EMAIL</td>
            <td>
                <input type="email" name="email" maxlength="30" />
            </td>
        </tr>

        <tr>
            <td>PASSWORD</td>
            <td>
                <input type="password" name="password_1" maxlength="30" />
            </td>
        </tr>

        <tr>
            <td>PASSWORD CONFIRM</td>
            <td>
                <input type="password" name="password_2" maxlength="30" />
            </td>
        </tr>


        <tr>
            <td colspan="2" align="center">
                <input type="submit" value="Save">
                <input type="reset" value="Reset">
            </td>
        </tr>
    </table>

</form>
-->
</body>
</html>