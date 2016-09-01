

<?php /*function for stripping zeroes from date,
   because windows do not support some of the formate*/
   function strip_zeroes_from_date($marked_string=''){
    /*  in marked string we will have * before % so that if *0 comes 
      we can replace it by ''*/
    $no_zero_string=str_replace('*0', '', $marked_string);
    #cleaning extra *
    $cleaned_string=str_replace('*', '', $no_zero_string);
    return $cleaned_string;           
   }
   ?>

<?php  #function for redirecting
  function redirect_to($location){
      if($location!=null){
      	header('Location: '.$location);
      }
  }
  ?>

<?php 
  # __autoload() function is called automatically by PHP when 
  # PHP could not able to find some class or function 
  # we can use this to write some code that will automatically include 
  # if something is missing

  function __autoload($class_name){
   $class_name=strtolower($class_name);
   $path="../includes/{$class_name}.php";
   if(file_exists($path)){
     require_once($path);
   }
   $path="../../includes/{$class_name}.php";
 if(file_exists($path)){
     require_once($path);
   }
   
   else{
   die("The Class {$class_name}.php not found...");
 }


  }
  ?> 

<?php 
 # this will going to write the log function 
 function log_action($action,$message){
  echo "log action message: ".$message."<br>";
  #called from admin folder
   $log_file="../../logs/logfile.txt";
   $content=strftime("%c",time());
   $content.="  | {$action} : by User Id: {$message}\n";
   if($handle=fopen($log_file,'a')){
        fwrite($handle, $content);
        fclose($handle);
   }else{
     echo "could not open Log file!!!<br>";
  }
}
 ?>

<?php
  function output_message($message){
      if(trim($message)!=""){
      echo "<p class='message'>";
      echo $message;
      echo "</p>";
      }
      
      
  }
 ?>
