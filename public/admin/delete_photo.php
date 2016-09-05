<?php require_once("../../includes/includes.php");?>
<?php if(!$session->is_logged_in()) redirect_to("login.php") ?>

<?php
if(empty($_GET['id']))
{ //setting session for index.php file
    $session->message("No photograph ID was provided."); 
    redirect_to('index.php');
}
//geting photograph object so that we can apply the methods
$photo=Photograph::find_by_id($_GET['id']);

if($photo!=null && $photo->destroy()){
    //SUCCESS
    //photo was present in db and destroy gives true
    $session->message($photo->filename." deleted.");
    /*
     * even if the destroy destroy all the db entry and 
     * file in folder object will be still around and we can use it as
     * we are doing now
     */
    redirect_to('list_photos.php');
}else{
    //FAILURE
    $session->message("Photo could not be deleted.");
    redirect_to('index.php');
}
?>