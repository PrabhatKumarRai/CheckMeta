<?php
session_start();

if (isset($_POST['submit']) || isset($_POST['seo_title'])) {

    include_once __DIR__.'/functions.php';

    //Unset all newdata session variable, if it is set
    unsetSessionVariables('newdata');

    extract($_POST);    
    
    $newdata = [
        'seo_title' => $seo_title,
        'meta_description' => $meta_description,
        'og_image' => $og_image     
    ];

    if($og_title === $seo_title_old){
        $newdata += ['og_title' => $seo_title];
    }
    if($og_description === $meta_description_old){
        $newdata += ['og_description' => $meta_description];
    }

    $_SESSION['newdata'] = $newdata;
    header("Location: ../?website_url=$url#generate-meta");
    exit;

}