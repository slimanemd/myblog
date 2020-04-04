<?php

function getData01($args=[]){
    require_once("curl_helper.php");
    
    //
    $action = $args['action']?:"GET";
    $url = $args['url']?:"http://localhost/ews01/myblog03/?api=post/read";
    $parameters = $args['params']?:[];
    
    //call
    $result = CurlHelper::perform_http_request($action, $url, $parameters);    //echo($result);
    return  json_decode($result, true)['data'];
}

//print_r(getData01("GET", "http://localhost/ews01/myblog03/?api=post/read", array("id" => "2")));
//print_r(getData01("GET", "http://localhost/ews01/myblog03/?api=post/read", []));
//print_r(getData01(array('params' => array("id" => "3"))));
print_r(getData01());


?>