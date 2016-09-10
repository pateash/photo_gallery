<?php require_once('../includes/includes.php');
/*
 * we can't use constants like DS, LIB_PATH etc here as they haven't been initiallised
 * yet they will get initialised in includes.php and after that all will be able to use them
 * except the one who initialise them(that file's path) 
 */
?>
<?php  $photos=  Photograph::find_all(); ?>   
 <?php include_layout('header.php');?>
<?php  foreach($photos as $photo):?>
<div style="float:left;margin-left:20px;">
    <a href="photo.php?id=<?php echo $photo->id;?>"><img src="<?php echo $photo->image_path();?>" width="200"/></a>
<!--    only image_path is needed as we are already in public-->
    <p><?php echo $photo->caption;?></p>
 </div>
<?php endforeach;?>
 <?php include_layout('footer.php');?>