<?php
//to get all constants
/**
 * Created by PhpStorm.
 * User: ashish_patel
 * Date: 5/17/2016
 * Time: 2:43 AM
 */
class MySQLDatabase
{
    #we are writing database nuetral code so that if we have to change db
     #we can do it easily
    private $connection=null;
    public $last_query;//represent last performed sql_query (debugging)

    public  function __construct(){
        # constructor will create as well as check connectivity

        $this->connection=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        if(!$this->connection){
            echo "Error while connecting with database";
            mysqli_connect_errno();
            exit;

        }
    }

    public function __destruct(){
        #this fuction will automatically close connection
        if($this->connection!=null){
            mysqli_close($this->connection);
            unset($this->connection);
        }
        //we can unset($database) to call __destruct() any time
    }

    public function query($sql){
        $this->last_query=$sql;
      #perform query and also checks for error
        $result_set=mysqli_query($this->connection,$sql);
        if(!$result_set)
            die("Database Query:{$this->last_query}; failed, Error no.".mysqli_errno($this->connection));
        else
            return $result_set;
    }

    public function escape_value($val){
      #escape value for database
        return mysqli_real_escape_string($this->connection,$val);
    }

    public function fetch_array($result_set){
        //fetch associative array from database
        return mysqli_fetch_array($result_set);
    }

    public function fetch_assoc($result_set){
       //fetch associative array from database
        return mysqli_fetch_assoc($result_set);
    }

    public function affected_rows(){
        //returns the number of rows affected in last query
        return mysqli_affected_rows($this->connection);
    }

    public function num_rows($result_set){
        //return no. of rows present in result set
        return mysqli_num_rows($result_set);
    }
    
    public function insert_id(){
        //return last id inserted in database
        return mysqli_insert_id($this->connection);
    }
}
//making connection so that we need not to do in every page
$database=new MySQLDatabase();

?>


