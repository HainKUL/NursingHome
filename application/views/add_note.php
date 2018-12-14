<?php if(!isset($_SESSION['id']))
{
    header("Location:./index.php?msg=YouMustLoginFirst");
    exit();
}
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title><?php echo $this->lang->line('add_note_title'); ?></title>
    <link href="<?=base_url() ?>assets/css/features.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php if(isset($_SESSION)) {
    echo $this->session->flashdata('flash_data');
} ?>

<h3><?php echo $this->lang->line('add_note_form'); ?></h3>
<form method="post" action="<?= site_url('Caregiver_controller/add_note') ?>">
    <table align="center" cellpadding = "10">

        <tr>
            <td><?php echo $this->lang->line('add_note_id'); ?></td>
            <td><input type="text" name="id" maxlength="5"/>
            </td>
        </tr>

        <tr>
            <td><?php echo $this->lang->line('add_note_note'); ?></td>
            <td>
                <textarea type="text" name="note" maxlength="1023" ></textarea>
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