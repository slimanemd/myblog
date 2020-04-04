<?php

include_once "Config.php";
include_once("utiles/Utile.php");
include_once("utiles/Database.php");   Database_main();
include_once("utiles/Sqlquery.php");

//Dispatcher
if(isset($_GET['api'])){
    $args =  explode("/", $_GET['api']);
    if( in_array($args[0], ["category","post"]) && 
        in_array($args[1], ["read", "create","delete","update"])){            
            include_once("models/". ucfirst($args[0]) . "Manager.php");
            include_once("api/EntityCRUD.php");
            
            $entity = ucfirst($args[0]);
            $OPR = $args[1];
            $idSelected = (isset($args[2]))? ['id' => $args[2]] : [];
            
            //
            operation_main();    
    }
}

?>
