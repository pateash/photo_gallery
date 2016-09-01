<?php 
#this class is going to do all thing related to login and log out
# it is not advisable to store to object in sessions
class Session{
	//attributes
	//when user is logged in $logged_in contain -true and $user_id will have id of user
   private $logged_in=false;#flag for user, only assesible inside class 
   public $user_id;#store id of user


  // methods
  public function __construct(){
  	/*
  	as soon as session object is made we wanted to 
    start session
  	*/
  	session_start();
  	$this->check_login();//check if already logged in
   }
    private function check_login(){
        /*
        this method is called as session object is created,
        this will going to instantiate the attributes
        if the user is already logged in(session me hai store)
        */
         if(isset($_SESSION['user_id']))  {
         	//initialise both
         	$this->user_id=$_SESSION['user_id'];
         	$this->logged_in=true;
         }
         else{
         	//already unset hoge phir bhi kar do
         	unset($this->user_id);
         	$this->logged_in=false;

         }
  }

   public function is_logged_in(){
     //this public function is used to find if the user is logged in or not
   	return $this->logged_in;


   }
   public function login($user_object){
     //function which will used to log in a user
     if($user_object){//if not null
       $this->user_id=$_SESSION['user_id']=$user_object->id;
      //session me bhi store do value
       $this->logged_in=true;
     }
   }
   public function logout(){
      unset($this->user_id);
      unset($_SESSION['user_id']);
      $this->logged_in=false;
  }
 }

$session=new Session();
//this is same like $database object which will be always in global scope to use
 ?>