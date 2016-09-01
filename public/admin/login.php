<?php 
require_once('../../includes/includes_admin.php');
  if($session->is_logged_in()){
  	//if already logged in then no need to do this
  	redirect_to('index.php');
 }
 $message="Enter Your data to login";
 if(isset($_POST['submit'])){
 	//if post is submitted
 	$username=trim($_POST['username']);
 	$password=trim($_POST['password']);

 	//check database to see if username/password exists
 	$found_user=User::authenticate($username,$password);

 	if($found_user){
            $session->login($found_user);
            #doing log action after logging in 
            # so that we can get data
            log_action("logged in ",$session->user_id);
            redirect_to("index.php");
 	}else{
 		//username/ password not found
 		$message ="Username/Password is incorrect<br>";
 	}
}
 else{
  //if post is not submitted
  $username="";
  $password="";
  //just initialising the value 
}
?>

<?php include_once('../layouts/admin_header.php') ?>
    <h2 class="main-heading">Staff Login</h2>
    <?php echo output_message($message); ?>
    <!-- form of login -->
      <form action="login.php" method="post">
      	<table>
      		<tr>
      			<td>Username:</td>
      			<td>
                            <input type="text" name="username" maxlength="30" autofocus value="<?php echo htmlentities($username); ?>">
                </td>
      		</tr>
               <tr>
      			<td>Password:</td>
      			<td>
      				<input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>">
      			</td>
      		</tr>
            <tr>
            	<td colspan="2">
            		<input type="submit" name="submit" value="login">
            	</td>


            </tr>

      	</table>

      </form>


 <?php include_once('../layouts/admin_footer.php') ?>    
 <?php if(isset($database)){unset($database);} ?>