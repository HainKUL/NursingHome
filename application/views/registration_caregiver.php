<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Elderly Registration Form</title>
    <link href="<?=base_url() ?>assets/css/password_forgot.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php if(isset($_SESSION)) {
    echo $this->session->flashdata('flash_data');
} ?>

<h3>CAREGIVER REGISTRATION FORM</h3>
<form method="post" action="<?= site_url('Caregiver_controller/registration_caregiver') ?>">
    <table align="center" cellpadding = "10">
    registration_cargiver.php
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
                <input type="text" name="email" maxlength="30" />
            </td>
        </tr>

        <tr>
            <td>PASSWORD</td>
            <td>
                <input type="text" name="password_1" maxlength="30" />
            </td>
        </tr>

        <tr>
            <td>PASSWORD CONFIRM</td>
            <td>
                <input type="text" name="password_2" maxlength="30" />
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

</body>
</html>