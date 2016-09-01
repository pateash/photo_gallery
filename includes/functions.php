

<?php /*function for stripping zeroes from date,
   because windows do not support some of the formate*/
   function strip_zeroes_from_date($marked_string=''){
    /*  in marked string we will have * before % so that if *0 comes 
      we can replace it by ''
    */
    $no_zero_string=str_replace('*0','', $marked_string);
    #cleaning extra *(if present) ex- *04-*5-*2016 =>after replacing *0 =>4-*5-*2016=>replacing extra * =>4-5-2016
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
  # we can use this to write some code that will automatically include some class 
  # if something is missing
  # we can search this class in any location
  function __autoload($class_name){
   $class_name=strtolower($class_name);
   //search in location 1
   $path="../includes/{$class_name}.php";
   if(file_exists($path)){
       // if found
     require_once($path);
   }
   //search in location 2
   $path="../../includes/{$class_name}.php";
 if(file_exists($path)){
     #if found
     require_once($path);
   }
   
   else{
       //if not found in any classes
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
   $content=strftime("%c",time());//%c will give format like tue feb 5 00:45:10 2009 
   $content.="  | {$action} : by User Id: {$message}\n";
   if($handle=fopen($log_file,'a')){
       //handle will have null if not able to open the file
        fwrite($handle, $content);//write this content to the file
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
      //we do not have to do any thing if message is empty
      
  }
 ?>
