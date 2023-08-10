<?php

echo "Så virker det kraftedme - bøh - hallllloooooo kom frem for helvede ";

/*
//if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
    $url = "https://";   
//else  
    $url = "http://";   
// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL   
$url.= $_SERVER['REQUEST_URI'];    

echo $url;  


//$url = 

$url_components = parse_url( $url, $component = -1 )

parse_str($url_components['query'], $params);
*/

// Display result
echo ' Hi '.$_GET['code'];

?>
