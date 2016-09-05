<?php require_once("../../includes/includes.php");?>
<?php if(!$session->is_logged_in()) redirect_to("login.php") ?>

<?php 
//find all the photes from database
$photos=Photograph::find_all();
?>

<?php include_layout("admin_header.php") ?>
       
<h2> Photographs</h2>
<?php output_message($message) ?> 
<table class="bordered">
    <tr>
        <th>Image</th>
        <th>Filename</th>
        <th>Caption</th>
        <th>Size</th>
        <th>Type</th>
     </tr>
     <?php foreach($photos as $photo):?>
     <tr>
         <td><img src="../<?php echo $photo->image_path(); ?>" width="100" height="80"></td>
     <td><?php echo $photo->filename;?></td>
     <td><?php echo $photo->caption;?></td>
     <td><?php echo $photo->size_to_text();?></td>
     <td><?php echo $photo->type;?></td>
     </tr>
         <?php     endforeach;?>
</table>
<br/>
<a href="photo_upload.php">Upload a file</a>

<?php include_layout("admin_footer.php") ?>