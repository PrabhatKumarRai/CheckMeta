<?php 

//Funtion to validate the url
function makeValidUrl($url){
    //Check if the URL has Protocol (https or http) added or not and if not found, then add https to it
    $url = (preg_match("/https:\/\/|http:\/\//", $url) != false)? $url: "https://".$url;
    // Remove all illegal characters from a url
    $url = filter_var($url, FILTER_SANITIZE_URL);
    // Validate the URL
    return (filter_var($url, FILTER_VALIDATE_URL))? $url: false;
}

//Function to get the data and modified the data for printing the output
function getData($url){

    $file_content = @file_get_contents( $url );  // '@' disables the warnings  retured by the function to be disaplyed on the frontend

    //If a warning is detected and no data is returned by the function i.e, if the URL is not found, then as the function ran properly, it only retuns true
    // Otherwise it will return an array of data
    if( is_bool($file_content) !== true ){
        $data = [];
                    
        $patterns = [
            'seo_title' => '/<title.*?>(.*?)<\/title>/',
            'meta_description' => '/<meta.*?name="description".*?content="(.*?)".*?>/',
            'og_image' => '/<meta.*?property="og:image".*?content="(.*?)".*?>/',
            'og_url' => '/<meta.*?property="og:url".*?content="(.*?)".*?>/',
            'og_title' => '/<meta.*?property="og:title".*?content="(.*?)".*?>/',
            'og_description' => '/<meta.*?property="og:description".*?content="(.*?)".*?>/'
        ];        

        foreach( $patterns as $tag => $pattern ){
            preg_match($pattern, $file_content, $temp);
            $data[$tag] = !empty($temp)? $temp[1]: '';
        }
        
        return $data + [
            'original_response' => htmlentities($file_content),
            'url' => strtolower($url)
        ];
    }
    
    //Invalid URI
    return false; 

}

//Function to unset all session variables (not destroy)
function unsetSessionVariables(...$variable_names){
    if(isset($_SESSION)){
        foreach($variable_names as $key => $value){
            if(isset($_SESSION[$value])) unset($_SESSION[$value]);
        }
    }
    return;
}