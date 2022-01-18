<?php

if( !empty( $_GET['website_url'] ) ){

        $url = $_GET['website_url'];

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
                    "seo_title" => '/<title>(.*)<\/title>/',
                    "meta_description" => '/<meta name="description" content="(.*)"(.*)>/',
                    "og_image" => '/<meta property="og:image" content="(.*)"(.*)>/',
                    "og_url" => '/<meta property="og:url" content="(.*)"(.*)>/',
                    "og_title" => '/<meta property="og:title" content="(.*)"(.*)>/',
                    "og_description" => '/<meta property="og:description" content="(.*)"(.*)>/'
                ];

                foreach( $patterns as $tag => $pattern ){
                    preg_match($pattern, $file_content, $temp);
                    $data[$tag] = !empty($temp)? $temp[1]: '';
                }

                return $data + ["original response" => $file_content];
            }
            
            //Invalid URI
            return false; 

        }

        //Run validation for the url
        $filtered_url = makeValidUrl($url);

        if($filtered_url !== false){
            //Call the get data function for filtered url
            $data = getData($filtered_url);
            
            //If current URL has data, then store it otherwise store Invalid URI error message
            $data = ($data !== false)? $data: ['error' => 'Invalid URI or no data found'];            
        }
        else{
            $data = ['error' => 'Invalid URI'];
        }

    }

?>