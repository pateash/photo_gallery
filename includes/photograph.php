<?php

/*
 * incapsulates a photograph
 *  */
class Photograph extends DatabaseObject {
    //staric data used by common methods
    protected static $table_name='photographs';
    protected static $db_fields=  ['id','filename','type','size','caption'];
    
    //data fields
    public $id,$filename,$type,$size,$caption;
    
    //all common methods have came here
    
    //we are going to use $temp_path and $upload_dir so lets make them attributete
    private $temp_path;
    protected $upload_dir="images";
    public $errors=[];//empty array which will store the errors found
    protected $upload_errors=array(//we can also append our error
    UPLOAD_ERR_OK => "No Errors.",
    UPLOAD_ERR_INI_SIZE => 'Larger than allowed in php.ini',
    UPLOAD_ERR_FORM_SIZE => 'Larger than MAX_FILE_SIZE',
    UPLOAD_ERR_PARTIAL => 'Partial Upload',
    UPLOAD_ERR_NO_FILE => 'No file ',
    UPLOAD_ERR_NO_TMP_DIR => 'No temperaty director',
    UPLOAD_ERR_CANT_WRITE => " Can't write to disk, Permission denied",
    UPLOAD_ERR_EXTENSION => "File upload stopped by extension"
  );
   
    
    
   /*
    * METHODS specific for photograph
    */
    //pass $_FILES['uploaded_file'] as an argument
    public function attach_file($file){
         //perform error checking on form parameters
         //set object attributes to form parameters
         //return true and false, if attchment was
        if(!$file || empty($file)||!is_array($file)){
              //error: nothing uploaded or wrong argument usage
            $this->errors[]="No file was uploaded.";//append to error
            return false;
        }
        elseif($file['error']!=0){
            //if there was error in uploading
            $error_num=$file['error'];
            $this->errors[]=$this->upload_errors[$error_num];//append to eror
         return false;
         }
        else{
            //if uploadation was perfect,set object attributes from form parameters
            
        $this->temp_path=$file['tmp_name'];//$file==$_FILES['uploaded_file']
        $this->filename=basename($file['name']);//give base also checks sql injection
        $this->type=$file['type'];
        $this->size=$file['size'];
        return true;//successful attachment
        }
    }
    
    /*OVERRIDING   save method because here we have to do two things
     * 1- moving the file (only if create)
     * 2- then save the record (in both create() and update() case)
     */
    public function save(){
        /*
         * this function tries to create() and update() photograph object
         * in db and return true/false on success/failure
         */
        
        if(isset($this->id))
        {
             $this->update();
        }
        else{
            //making sure no error
           if(!empty($this->errors))//if any preexisting error in $errors[]
               return false;
            if(strlen($this->caption)>255){
             $this->errors[]="The caption can only be 255 characters long.";   
             return false;
             }
             //can't save with out name of file or temp_path
             if(empty($this->filename)||empty($this->temp_path))
             {
                 $this->errors[]="The file location was not available";
                 return false;
             }
             //finding target_path, we are in includes now
             $target_path=
             
             
            //moving file
            //saving data to db
            $this->create();
        }
    }

  
    
  
    
    
    
    
}
