<?php
//https://stackoverflow.com/questions/9802788/call-a-rest-api-in-php

// This class has all the necessary code for making API calls thru curl library

class CurlHelper {
    
    // This method will perform an action/method thru HTTP/API calls
    // Parameter description:
    // Method= POST, PUT, GET etc
    // Data= array("param" => "value") ==> index.php?param=value
    public static function perform_http_request($method, $url, $data = false)
    {
        $curl = curl_init();
        
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:  //GET
                if ($data)  $url = sprintf("%s/%s", $url, $data['id']);                    //echo($url . "<br>");
                //$url = sprintf("%s?%s", $url, http_build_query($data));
        }
        
        // Optional Authentication:
        //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //curl_setopt($curl, CURLOPT_USERPWD, "username:password");        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['content-type: application/json']);
        
        $result = curl_exec($curl);
        $error = curl_errno($curl);
        curl_close($curl);
        return ($error)? null : $result;
    }
}
?>