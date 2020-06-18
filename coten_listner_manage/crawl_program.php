<?php

require('./phpQuery-onefile.php');
 
$url = 'https://podcasts.google.com/?feed=aHR0cHM6Ly9hbmNob3IuZm0vcy84YzIwODhjL3BvZGNhc3QvcnNz';
$html = file_get_contents($url);
 
$doc = phpQuery::newDocument($html);
$title = $doc->find('#D9uPgd');
var_dump($title);

?>