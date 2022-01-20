<?php
session_start();

if( !empty( $_GET['website_url'] ) ){

    require_once __DIR__.'/functions.php';

    unsetSessionVariables('data', 'newdata');

    $url = $_GET['website_url']; 

    //Run validation for the url
    $filtered_url = makeValidUrl($url);

    if($filtered_url !== false){
        //Get data for filtered URL
        $data = getData($filtered_url);
        
        //If current URL has data, then store it otherwise store Invalid URI error message
        $data = ($data !== false)? $data: ['error' => 'Invalid URI or no data found'];            
    }
    else{
        $data = ['error' => 'Invalid URI'];
    }

    $_SESSION['data'] = $data;
    
    //If the referer page is not rawdata.php then redirect to the index.php
    if((preg_match('/\/rawdata.php\?/', $_SERVER['REQUEST_URI'])) != true){
        header("Location: ../?website_url=$url");
        exit;
    }
}