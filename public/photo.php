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
    $body=trim($_POST['body']);//nl2br  is used to that newline can be converted in to <br> and saved   
    $new_comment=  Comment::make($photo->id, $author, $body);
   //here author and body are of comment
   if($new_comment&&$new_comment->save()){
       //comment successfully created and saved(save() of database object)
       $session->message(["You have commented Successfully",true]);
       //here array is passed which will be stored in session's message and can be used by output_message()
       
/*
 *        $author="";   $body="";
 *  we are doing so that after success we are not getting the field filled
 *  with value, but there is a problem here which is that if we reload the page
 *  then we again post that comment, to remove this we can redirect to same page
 *  so that it becomes a GET request and automatically in 
 *  else os isset($_POST['submit']) we clear the $author and $body;
 * but to get get the $messaget again we have to use $_SESSION and for this we have to store them
 */
   redirect_to("photo.php?id=".$photo->id);
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
<?php
//CODE SECTION FOR GETTING COMMENTS FROM DATABASE 
/*
 * $comments=  Comment::find_comments_on($photo->id);
 * REPLACED WITH Object oriented way in which we have created method
 *  comments() in class Photograph
 */
$comments=$photo->comments();
?>

<?php include_layout('header.php');?>
<a href="index.php">&laquo; Back </a><br><br>

<div style="margin-left:20px;">
   <p style="color: #8D0D19;font-size: 30px"><?php  echo $photo->caption;?></p>
    <img src='<?php echo $photo->image_path()?>' width="60%" height="80%"/>
</div>
<br><br>
<!-- LIST COMMENTS HERE-->
<div id="comments">
     
    <?php foreach($comments as $comment):?>
    <div class="comment" style="margin-bottom:2em; color:blue">
        <div class="author" style="color: #8D0D19;font-family: sans-serif;font-size: large">
            <?php
            echo htmlentities((ucwords($comment->author)));//to make it writable to html
            ?> wrote:
        </div>
        <div class="body">
            <?php echo strip_tags($comment->body,'<strong><em><p>');?>
        </div>
        <div class="meta-info" style="font-size:0.8em;">
            <?php echo datetime_to_text($comment->created);?>
        </div>
    </div>
    <hr>
    <?php  endforeach;?>
    <?php if(empty($comments)){echo "No comments.";}?>
</div>
<hr>
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