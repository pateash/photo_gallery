<?php 
/*
* 
*/
abstract class DatabaseObject
{
    #this class is here for allowing interaction of any kind of object with
    #database (example- users etc), we will create class and make it to inherited by it

 protected static $table_name='users';#default table_name each class will have its own
 /* PUBLIC METHODS
  *  these methods will be called after creating Object 
  */
protected abstract function create();
     #this method will create use
     #user object has been already created and all info has been 
     #pushed into it except id(not known)
     #abstract as each Object has its own different types
     #protected so that could not be called directly
protected abstract function update();
 #update info of object in DB updated already in Object
 #protected so that could not be called directly
 public function save(){
     #this is a combination of create() and update()
     #will update if this id already created because 
     # one id will notbe assigned again
     # willbe same for all objects
     if(isset($this->id)){
         $this->update();
     }else{
         $this->create();
     }
 }
 
 public function delete(){
     global $database;
     #this will delete data give by id
     $sql= "DELETE FROM ".static::$table_name;
     $sql.=" WHERE id=".$database->escape_value($this->id);
     $sql.=" LIMIT 1";
     $database->query($sql);
      return ($database->affected_rows()==1)?true:false;
     #in insert true/false return, in others we have to 
      # check by affected rows
     }

 
     # delete the data of caller Object from database
 /*STATIC METHODS
 these methods will be used to get the information about an Object
 from DB and giving them as an object.
    */
    public static function find_all()
  
    {
        #this method return all users as objects
        $sql="SELECT * FROM ".static::$table_name;
        return static::find_by_sql($sql);
        /*
        due to static binding the static::$table_name turns out to be DatabaseObject::$table_name which is always 'users' and not the class inheriting it.
        so we have to use static in place of self which will make it to generate class name at runtime.
        */
    }

 public static function find_by_id($id)
    {
        #this method return returns information of a user
        global $database;//database comes from global
        $sql="SELECT * FROM ".static::$table_name." WHERE id={$id} LIMIT 1 ";
        $object_array = static::find_by_sql($sql);
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
            $object_array[]=static::instantiate($result);
            //this will return the object which will be appended to $Object_array
     } 
       return $object_array;
    }
 
  
    
    
    
//PRIVATE METHODS
//this fn will not be called from outside of class
 private  static function instantiate($result){
        //this function create a object of user and assign all value of $result to $object and return
      
      /* THIS WAS SPECIALLY FOR USER, SO WE ARE MAKING IT FOR ALL TYPES
        $object->id=$result['id'];
        $object->username=$result['username'];
        $object->password=$result['password'];
        $object->first_name=$result['first_name'];
        $object->last_name=$result['last_name'];
      */
     /*  $object=new self;//ex- object=new User()
        DUE TO EARLY STATIC BINDING WE HAVE TO CONVERT INTO FOLLOWING
     */
        $class_name=get_called_class();//name of class is returned from which we are calling that function
        $object=new $class_name;//class object is made by name
         foreach ($result as $key => $value) {
            if($object->has_attribute($key)){
                $object->$key=$value;
            }
        }
       return $object;//
    }
 
 private function has_attribute($attribute){
        //get_object_vars() return an associative array with attribute_name and value for an object
        $attribute_array=get_object_vars($this);
         return array_key_exists($attribute, $attribute_array);
        }


}



 ?>