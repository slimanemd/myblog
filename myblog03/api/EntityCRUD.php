<?php

//
$oprs = array('read'=> 'GET', 'create'=>'POST', 'update'=>'PUT', 'delete'=>'DELETE');

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');   //read $OPR
header('Access-Control-Allow-Methods: '. $oprs[$OPR]);  //update
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

//---------------------------------------------------------------
//doCataegoryReading
function doCategoryReading($id0){
    //processing loop body & Push to "data"
    $entityProcessor = function($row, &$args){
        extract($row);
        $item = array(
            'id' => $id,
            'name' => $name );
        array_push($args['data'], $item );
    };
    
    //
    $result = Utile::readProcessEntity(
        $id0,                                                                    //$categoryParams
        CategoryManager::categoryFactory(),                                      // $categoryFactory
        function(){  $args = array(); $args['data'] = array(); return $args; },  //init
        $entityProcessor);                                                     //processing
        
    return $result;
}
//---------------------------------------------------------------
//doCataegoryReading
function doPostReading($id0){
    //processing loop body & Push to "data"
    $postProcessor = function($row, &$args){
        extract($row);
        $item =       array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id  //,            'category_name' => $category_name
        );
        array_push($args['data'], $item );
    };
    
    //
    $result = Utile::readProcessEntity(
        $id0,                                                                    //$categoryParams
        PostManager::postFactory(),                                      // $categoryFactory
        function(){  $args = array(); $args['data'] = array(); return $args; },  //init
        $postProcessor);                                                     //processing
        
        return $result;
}

//---------------------------------------------
//read_main       //api json encode / decode      // Get raw posted data
function operation_main(){  //$id=-1
    global $db;
    global $idSelected;
    global $OPR;
    global $oprs;
    global $entity;
    
    //
    if($OPR != "read") $data = json_decode(file_get_contents("php://input"));
    
    //
    if($OPR == "read"){
        
        //specific Category
        if($entity == 'Category') $result = doCategoryReading($idSelected);
        if($entity == 'Post')     $result = doPostReading($idSelected);
        
        //
        $result = ($result == null)? array('message' => 'No Found '. $entity) : $result;
        
    }
    else {
        //specific Category
        if($entity == 'Category'){
            $result = (CategoryManager::categoryFactory()($db))->crud($OPR,
                ($OPR != "create")? ['id'   => htmlspecialchars(strip_tags($data->id))]:[],  //update, delete
                ($OPR != "delete")? ['name' => htmlspecialchars(strip_tags($data->name))]:[] //create, update
            );
        }
        
        //
        if($entity == 'Post'){
            $result = (CategoryManager::categoryFactory()($db))->crud($OPR,
                ($OPR != "create")? ['id'   => htmlspecialchars(strip_tags($data->id))]:[],  //update, delete
                ($OPR != "delete")? ['title' => htmlspecialchars(strip_tags($data->title)),
                                     'body' => htmlspecialchars(strip_tags($data->body)),
                                     'author' => htmlspecialchars(strip_tags($data->author)),
                                     'category_id' => htmlspecialchars(strip_tags($data->category_id))]:[] //create, update
                );
        }
        
        //
        $result = array('message' => $entity . ' '. (($result == null )? 'Not ':'') . $OPR . 'd');
    }
    
    //
    echo(json_encode($result));
}
//---------------------------------------------
?>