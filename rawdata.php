<?php 
if(isset($_GET['website_url'])){    
    include_once __DIR__."/process/process.php";
    echo '<pre>'; print_r($data); echo '</pre>';
}