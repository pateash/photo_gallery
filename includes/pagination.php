<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pagination
 *
 * @author ashish_patel
 */
class pagination {
   public $current_page;
   public $per_page;
   public $total_count;
   
   public function __construct($page=1,$per_page=20,$total_count=0){
       $this->current_page=(int)$page;
       $this->per_page=(int)$per_page;
       $this->total_count=(int)$total_count;
   }
   public function total_pages(){
       return ceil($this->total_count/$this->per_page);
   }
   public function previous_page(){
       return $this->current_page-1;
   }
   public function next_page(){
       return $this->current_page+1;
   }
   public function offset(){
    //this function returns offset for this page
       /*
        *if we have  20 items per page
        * 1st page  (offset 0)<-(1-1)*20
        * 2nd page  (offset20)<-(2-1)*20
        * nth page offset<-(n-1)*20
        */
       return ($this->current_page-1)*$this->per_page;
  }
  public function has_next_page(){
      return $this->current_page!=$this->total_pages(); 
  }
  public function has_previous_page(){
      return $this->current_page!=1;
      //always have previous page if current page is more than 1
  }   
   
    
}
