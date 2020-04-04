<?php
/*------------------------------------------------------------------*/
//
class Post{
    // Properties
    public $id;
    public $category_id;
    public $title;
    public $body;
    public $author;
    public $created_at;
    
    //ref
    public $category; //link with $category_id
    
    //
    public function __construct()  {  }
    
    //
    public function setEntityProperties($row){
        foreach(array_keys($row) as $key) $this->$key = $row[$key];
    }
    
    //
    public function toString(){
        return $this->id . " ; " . $this->title;
    }
}
