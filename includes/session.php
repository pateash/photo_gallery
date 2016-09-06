<?php 
/*
   *this class is going to do all thing related to login and log out
   *it is not advisable to store to object in sessions
   *we have to manage session file (every thing in $_SESSION and also our attributes)
*/
class Session{
	//attributes
	//when user is logged in $logged_in contain -true and $user_id will have id of user
   private $logged_in=false;#flag for user, only assesible inside class 
   public $user_id;#store id of user
   public $message;//the message which may be used to send message between pages 

  // methods
  public function __construct(){
  	/*
  	as soon as session object is made we wanted to 
    start session
  	*/
  	session_start();
  	$this->check_login();
        $this->check_message();
          /*
           * check if already logged in
           * i.e. session file already have this id
           * if yes, then we have to instantiate our attributes here
           * if no,  then we are not logged in 
           */
   }
   private function check_login(){//for checking older login
        /*
        this method is called as session object is created,
        this will going to instantiate the attributes
        if the user is already logged in(session me hai store prev login ka after that he left the browser)
        */
         if(isset($_SESSION['user_id']))  { # if session file has user_id then already logged in 
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
   
   private function check_message(){//for checking older 
       if(isset($_SESSION['message'])){//if there is any older message in session file
           $this->message=$_SESSION['message'];//store this message in attribute
       unset($_SESSION['message']);
       /*
        * the message has been received by the session object and no longer needed
        */
       }
       else
           $this->message="";//set so that we never get error 
           
   }
   
   public function message($msg=""){
       //function for doing set and get both depend on value set or not
       if(!empty($msg)){//setting message if passed
           /*
            * here $this->message=$msg wouldn't work 
            * because this will not store in actual session and 
            * 
            * when new script starts a new object of session ($session)
            * get created and value of $_SESSION['message'] will be storeed
            * in $this->message and $_SESSION['message'] is unset
            * which can be used. 
            */
           $_SESSION['message']=$msg;
           
       }else{
        //getting message if not passed
        /*
         * as a new script starts session object created
         * and $this->message get initialised with 
         * $_SESSION['message'] in check_message()
         * 
         */
           return $this->message;
       }
   }
   public function is_logged_in(){
     //this public function is used to find if the user is logged in or not
   	return $this->logged_in;
    }
  
   public function login($user_object){//function for new login
     //function which will used to log in a passed user
     if($user_object){//if not null
         $this->user_id=$_SESSION['user_id']=$user_object->id;//we have to manage session files as well as our attributes
         $this->logged_in=true;
     }
     }
   
   public function logout(){
      unset($this->user_id);//manage both session files as well as our attributes 
      unset($_SESSION['user_id']);
      $this->logged_in=false;
  }
 }

$session=new Session();//global object os session
//this is same like $database object which will be always in global scope to use
$message=$session->message(); 
//now this variable will be availabe in any script(set to message or null)
//and we can also override it with any value
?>