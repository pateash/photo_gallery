

<?php
/*
 * PAGE TO DISPLAY COMMENTS ON A IMAGE
 * it also lets admin to delete the comment 
 */

require_once("../../includes/includes.php");?>
<?php if(!$session->is_logged_in()) redirect_to("login.php") ?>



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
  $comments=$photo->comments();
 ?>   

<?php include_layout("admin_header.php") ?>
   
<a href="list_photos.php">&laquo;Back</a><br><br>
<?php output_message($message);?>
<!-- LIST COMMENTS HERE-->

<h3> Comments on <?php echo $photo->filename;?></h3>
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
        <div class="actions" style="font-size:0.8em;">
            <a href="delete_comment.php?id=<?php echo $comment->id;?>">Delete Comment</a>
        </div>
    </div>
    <hr>
    <?php  endforeach;?>
    <?php if(empty($comments)){echo "No comments.";}?>
</div>

    

<?php include_layout("admin_footer.php") ?>