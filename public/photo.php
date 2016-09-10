<?php require_once('../includes/includes.php');?>
<?php 
# code for handling get requiest in url to display a given image
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
<?php
//code section for handling post of commenting
if(isset($_POST['submit']))
{
    $author=trim($_POST['author']);
    $body=trim($_POST['body']);   
    $new_comment=  Comment::make($photo->id, $author, $body);
   //here author and body are of comment
   if($new_comment&&$new_comment->save()){
       //comment successfully created and saved(save() of database object)
       $message=["You have commented Successfully",true];
       $author="";
       $body="";
   }
   else{
       $message="Comment failed";
   }
}
else{
    //default value if not submitted
 $author="";
  $body="";
}
?>
<?php include_layout('header.php');?>
<a href="index.php">&laquo; Back </a><br><br>

<div style="margin-left:20px;">
    <img src='<?php echo $photo->image_path()?>' width="80%" height="80%"/>
    <p><?php  echo $photo->caption;?></p>
</div>
<!-- LIST COMMENTS HERE-->
<div id="comment-form">
    <h3>New Comment </h3>
    <?php echo output_message($message);?> 
    <form action="photo.php?id=<?php echo $photo->id ?>" method="post">
        <table>
            <tr>
                <td>Your name:</td>
                <td><input type="text" name="author" value="<?php echo $author;?>"/></td>
                <!-- 
                   $author and $body are the value to be shown 
                   and populated so that if error comes and we come back to that page again
                   we find those value again and not need to write them again;
                -->
            </tr>
            <tr>
                <td>Your Comment:</td>
                <td><textarea name="body" cols="40" rows="8"><?php echo $body;?></textarea></td>
            </tr>
             <tr>
                 <td>&nbsp;</td>
                 <td><input type="submit" name="submit" value="Comment"/></td>
            </tr>
           
            
            
        </table>
            
    
    
    </form>
    
</div>
     
<?php include_layout('footer.php');?>