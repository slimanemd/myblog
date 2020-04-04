<?php
//
class Category{
    // Properties
    public $id;
    public $name;
    public $created_at;
    
    //
    public function __construct()  {  }
    
    //
    public function setEntityProperties($row){
        foreach(array_keys($row) as $key) $this->$key = $row[$key];
    }
    
    //
    public function toString(){
        return $this->id . " ; " . $this->name;
    }
}
