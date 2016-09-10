<?php require_once('../includes/includes.php');?>
<?php 
  if(empty($_GET['id'])){
      $session->message("No photograph Id was provided.");
      redirect_to("index.php");
  }
  $photo=Photograph::find_by_id($_GET['id']);
  if(!$photo){
      //if photo was not found
      $session->message("The photo could not be located");
      redirect_to("index.php");     
  }  
?>   
<?php include_layout('header.php');?>
<a href="index.php">&laquo; Back </a><br><br>

<div style="margin-left:20px;">
    <img src='<?php echo $photo->image_path()?>' width="80%" height="80%"/>
    <p><?php  echo $photo->caption;?></p>
</div>
     
<?php include_layout('footer.php');?>