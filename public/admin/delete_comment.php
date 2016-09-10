<?php require_once("../../includes/includes.php");?>
<?php if(!$session->is_logged_in()) redirect_to("login.php") ?>

<?php
if(empty($_GET['id']))
{ //setting session for index.php file
    $session->message("No Comment ID was provided."); 
    redirect_to('comment.php');
}
//geting comment object so that we can apply the methods
$comment=Comment::find_by_id($_GET['id']);

if($comment!=null && $comment->delete()){
    //here only deletion required nothng more required
    //SUCCESS
    //comment was present in db and destroy gives true
    $session->message("comment was deleted.");
    /*
     * even if the destroy destroy all the db entry and 
     * file in folder object will be still around and we can use it as
     * we are doing now
     */
    redirect_to('comments.php?id='.$comment->photograph_id);
    //although comment was deleted from database object have its info
}
else{
    //FAILURE
    $session->message("comment could not be deleted.");
    redirect_to('comments.php?id='.$comment->photograph_id);
}
?>