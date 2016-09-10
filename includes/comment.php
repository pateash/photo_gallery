<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of comment
 *
 * @author ashish_patel
 */
class Comment extends DatabaseObject{
    //static fields required by DatabaseObejct
    protected static $table_name="comments";
    protected static $db_fields=array('id','photograph_id','created'
              ,'author','body');
    
   //database fields required for functions
   
  public $id;
  public $photograph_id;
  public $created;
  public $author;
  public $body;
  
  //all functions from DatabaseObject are already here
  
  /*
   * METHODS OF COMMENT
   */
  
  /*
   * 1- make() this is factory method which returns comment object 
   *  from information
   */
  public static function make($photo_id,$author,$body){
     if(empty($photo_id)||empty($author)||empty($body))
         return null;//null and false are same
      $comment=new Comment();
      $comment->photograph_id=$photo_id;
      $comment->author=$author;
      $comment->body=$body;
      return $comment;
  }  

  /*
   * 2-find_comments_on()
   * this function returns all comments for a photo
   */
   public static function find_comments_on($photo_id=0){
       global $database;
       $photo_id=$database->escape_value($photo_id);
       //escaping for sql injection
       $sql="SELECT * FROM comments ";
       $sql.="WHERE photograph_id={$photo_id} ";
       $sql.=" ORDER by created ASC";
       return static::find_by_sql($sql);
  }
 }
 ?>
