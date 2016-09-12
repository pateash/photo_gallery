
<?php require_once('../../includes/includes.php');?>
<?php if(!$session->is_logged_in()){redirect_to("login.php");}?>
<?php
//$message="";
/*
 * new we can't do that as  it will override the value taken by $message 
 * taken from session in session.php
 */
if(isset($_POST['submit']))
{
   $photo=new Photograph();
  $photo->caption=$_POST['caption'];
  if(trim($photo->caption)==""){
      $photo->errors[]="Caption can't be empty";
      //now the save() function automatically see this error and return false
     }
      $photo->attach_file($_FILES['file_upload']);
/*
 * attach all information and set errors
 * attach file also return true/false but as it sets all errors
 * and we are checking errors in save() we do not need to utilize the true/false
 * of attach_file() of function that will be automatically done by save() method
 */
  if($photo->save()){
      //success
      //setting message for later use in list_photos.php
       $session->message("Photo uploaded successfully");
       redirect_to('list_photos.php');
     }
  else{
      //failure show errors[] array
          $message=join("<br>",$photo->errors);//
  }
}

?>
<?php include_layout('admin_header.php')?>
<h2>Photo Upload</h2>
<?php echo output_message($message)?>
<form action="photo_upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="3145728"/>
    <p><input type="file" name="file_upload"/></p>
    <p><input type="text" name="caption" value=""/></p>
    <input type="submit" name="submit" value="Upload"/>
</form>
<a href="list_photos.php">View Photos</a>
<?php include_layout('admin_footer.php')?>
