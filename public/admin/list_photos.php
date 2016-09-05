<?php require_once("../../includes/includes.php");?>
<?php if(!$session->is_logged_in()) redirect_to("login.php") ?>



<?php include_layout("admin_header.php") ?>
       
<?php include_layout("admin_footer.php") ?>