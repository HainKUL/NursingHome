<!DOCTYPE html>
<html>
<head>
    <title>{page_title}</title>
    <link href="<?=base_url() ?>assets/css/older_adult.css" rel="stylesheet" type="text/css"/>
    <meta charset="UTF-8" />
    <link href="https:/>/fonts.googleapis.com/css?family=Dosis:400,500,600,700" rel="stylesheet">
    <!--  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.1/less.min.js">
      </script> -->
    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
    </select>
</head>

<body>
<header>
    <div id="logo">
        <h1><?php echo $this->lang->line('home_er'); ?></h1>
        <h2><?php echo $this->lang->line('home_u'); ?></h2>
    </div>
</header>
<main>
    <section>
        <h2><?php echo $this->lang->line('home_who'); ?></h2>
        <button><?php echo $this->lang->line('home_resident'); ?></button><a href=/a18ux04/index.php/Caregiver_controller/login><?php echo $this->lang->line('home_caregiver'); ?></a
    </section>
</main>
<footer>
    <p><?php echo $this->lang->line('text_copyright_footer'); ?>
        <a href="#"><?php echo $this->lang->line('text_copyright_privacy'); ?></a> | <a href="#"><?php echo $this->lang->line('text_copyright_term'); ?>e</a>
    </p>
</footer>
</body>
</html>

