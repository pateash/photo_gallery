<?php

/**
 * Created by PhpStorm.
 * User: ashish_patel
 * Date: 5/30/2016
 * Time: 9:48 PM
 */
class User extends DatabaseObject
{
    //members are being made so that we can work on data pulled by static mathods
    public $id; 
    public $username;//we are making public so that we can access
    public $password;
    public $first_name;
    public $last_name;
   
    static $table_name='users';//static (same for all)
    /* the $table_name override the $table_name in databaseObject class
    */

    public function full_name(){
        //return full_name of user
        return $this->first_name." ".$this->last_name;
    }
    
    public static function authenticate($usename="",$password=""){
       #return object of user if find, else return false
        global $database;
        $username=$database->escape_value($usename);
        $password=$database->escape_value($password);
      $sql="SELECT * FROM users WHERE username='{$username}' AND password='{$password}' LIMIT 1";
      $object_array=User::find_by_sql($sql);
      return !empty($object_array)?array_shift($object_array):false;
        //if array is empty return false else return object
       }

    public function create() {
        global $database;
        $sql= "INSERT INTO users (";
        $sql.="username,password,first_name,last_name ";
        $sql.=") VALUES (' ";
        $sql.=$database->escape_value($this->username);
        $sql.=" ' , ' ".$database->escape_value($this->password);
        $sql.=" ' , ' ".$database->escape_value($this->first_name);
        $sql.=" ' , ' ".$database->escape_value($this->last_name);
        $sql.=" ') ";
        if($database->query($sql)){
          #if successfully inserted return true
            $this->id=$database->insert_id();
            #id was not there in Object so we have to do this
        }
        #we need not to write else because script will die as the query fails 
        #from query() function
    }

    public function update() {
        #update the value in database from the values store in Object
     global $database;
        $sql= "UPDATE users SET ";
        $sql.="username='".$database->escape_value($this->username);
        $sql.="', password='".$database->escape_value($this->password);
        $sql.="', first_name='".$database->escape_value($this->first_name);
        $sql.="', last_name='".$database->escape_value($this->last_name)."'";
        $sql.="WHERE id=".$database->escape_value($this->id);
       
        #echo "the query is <br>".$sql;
       $database->query($sql);
         return ($database->affected_rows()==1)? true:false;
            #to know successfull update we have to use 
            # if affected rows in previous query is 1
       }
  
    
    //static methods because they only working on given data
 /* ALL THESE METHODS HAS BEEN MOVE IN DATABASEOBJECT.PHP
  BECAUSE THEY CAN BE COMMONLY USED FOR ANY OBJECT BUT WE HERE JUST USING THEM FOR USER
  //{hug generalize karna chahte hai, isiliye sari tables ke liye use kar sake isiliye unhe nayi class me bhej rahe hai taki sab me inherit kar sake}
 public static function find_all()
    {
        #this method return all users as objects
        return self::find_by_sql("SELECT * FROM users");
    }

    public static function find_by_id($id)
    {
        #this method return returns information of a user
        global $database;//database comes from global
        $object_array = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
        return !empty($object_array)?array_shift($object_array):false;
        //if array is empty return false else return first element
            }

    public static function find_by_sql($sql)
    {
        #this method return result from user table according to $sql
        global $database;//database connection comes from global
        $result_set = $database->query($sql);
        //        return $result_set;
        // now we are modifying the code to return object array in place
        // of records
     $object_array=array();
     while($result=$database->fetch_assoc($result_set)){
            $object_array[]=self::instantiate($result);
            //this will return the object which will be appended to $Object_array
     } 
       return $object_array;
    }
*/

}