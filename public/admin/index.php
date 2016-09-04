<?php require_once('../../includes/includes.php');
/*
 * we can't use constants like DS, LIB_PATH etc here as they haven't been initiallised
 * yet they will get initialised in includes.php and after that all will be able to use them
 * except the one who initialise them(that file's path) 
 */
?>
<?php 
 if(!$session->is_logged_in()){//if not logged in then redirect to login page 
 	redirect_to('login.php');
}
 if(isset($_POST['logout'])){//logout is requested
    log_action("logged out ",$session->user_id);
    $session->logout();//user_id has been vanished
    redirect_to('login.php');
 }
 if(isset($_POST['log'])){//if log file view requested
     redirect_to('logfile.php');
 }
?>
 
 <?php 
 include_once(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'admin_header.php');
 ?>
    <h2 class="main-heading">Menu</h2>
      <form method="post" action="index.php">
    	<!--the value $_POST['logout'] will be set when logout button will be clicked -->
    	<input type="submit" name="logout" value="Logout">
    	&nbsp;
    	<!--the value $_POST['clear-log'] will be set when cleag-log button will be clicked -->
    	
    	<input type="submit" name="log" value="Logs">

    </form>

    
 <?php 
 include_once(SITE_ROOT.DS.'public'.DS.'layouts'.DS.'admin_footer.php');
 ?>