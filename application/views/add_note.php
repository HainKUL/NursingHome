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

<h3>ADD NOTE FORM</h3>
<form method="post" action="<?= site_url('Caregiver_controller/add_note') ?>">
    <table align="center" cellpadding = "10">
    registration_cargiver.php
        <tr>
            <td>USER ID (int)</td>
            <td><input type="text" name="id" maxlength="5"/>
            </td>
        </tr>

        <tr>
            <td>NOTE</td>
            <td>
                <input type="text" name="note" maxlength="100" /> //TODO change to db max, define somewhere
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