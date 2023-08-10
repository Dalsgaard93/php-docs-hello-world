<?php

echo "Så virker det kraftedme - bøh - hallllloooooo kom frem for helvede ";

$url_components = parse_url( $url, $component = -1 )

parse_str($url_components['query'], $params);
     
// Display result
echo ' Hi '.$params['code'];

?>
