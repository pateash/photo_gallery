<?php require_once('../includes/includes.php');
/*
 * we can't use constants like DS, LIB_PATH etc here as they haven't been initiallised
 * yet they will get initialised in includes.php and after that all will be able to use them
 * except the one who initialise them(that file's path) 
 */
?>
<?php //PAGINATION CODE
//if page is passed then set else it is first page
$page=!empty($_GET['page'])?(int)$_GET['page']:1;
$total_count=  Photograph::count_all();
//total record per page
$per_page=3;

//making pagination object so that we can do all things using it
$pagination=new pagination($page,$per_page,$total_count);

//find record for this page
$sql="SELECT * FROM photographs ";
$sql.="LIMIT {$per_page} ";
$sql.="OFFSET {$pagination->offset()} ";

//all photos needed to be displayed here
$photos=  Photograph::find_by_sql($sql);
?>
 <?php include_layout('header.php');?>

    <?php  foreach($photos as $photo):?>
<div style="float:left;margin-left:20px;">
    <a href="photo.php?id=<?php echo $photo->id;?>"><img src="<?php echo $photo->image_path();?>" width="200" height="160"/></a>
<!--    only image_path is needed as we are already in public-->
    <p><?php echo $photo->caption;?></p>
 </div>
<?php endforeach;?>
<br><br>
<div id="pagination " style="clear:both;">
    <?php
if($pagination->total_pages()>1){
    if($pagination->has_previous_page()){
      echo " <a href='index.php?page=";
      echo $pagination->previous_page();
      echo "'>Previous &laquo;</a> ";
  }  
 
    for($i=1;$i<=$pagination->total_pages();$i++){
        if($i==$page){//now show link if current
            echo "<span class='selected'>{$i}</span> ";
        }
        else
         echo "<a href='index.php?page={$i}'>{$i}</a>  ";
    }
    if($pagination->has_next_page()){
      echo " <a href='index.php?page=";
      echo $pagination->next_page();
      echo "'>Next &raquo;</a> ";
  }  
}
?>
</div>


 <?php include_layout('footer.php');?>