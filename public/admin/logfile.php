<?php require_once('../../includes/includes_admin.php');?>
<?php 

  if(isset($_POST['clear-log'])){
       $log_file="../../logs/logfile.txt";
       file_put_contents($log_file,"");
       log_action("Log cleared ",$session->user_id);
  }
 ?>

 <?php include_once('../layouts/admin_header.php') ?>

  <a href="index.php">&laquo;Back</a><br>
    <h2 class="main-heading">Logfile</h2>
    <?php 
       $log_file="../../logs/logfile.txt";//taking from logfile inside admin
       if(file_exists($log_file)&&is_readable($log_file)&&$handle=fopen($log_file,'r')){
       echo "<ul class=\"log-entries\">";
    
        while(!feof($handle)){
        $log_data=fgets($handle);
        if(trim($log_data)!=""){
            echo "<li>{$log_data}</li>";
        } 
    }
       echo " </ul>";
      
   }else{
        echo "could not read from {$logfile}<br>";
       }
     ?>
     <!-- show clear log button is log exists -->
   <form method="post" action="logfile.php">
        
        <input type="submit" name="clear-log" value="clear log">

    </form>
    

    
 <?php include_once('../layouts/admin_footer.php') ?>