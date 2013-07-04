<?php
error_reporting(0);
$page = file_get_contents('http://www.engadget.com/2013/03/18/gmail-update-jelly-bean/');
$doc = new DOMDocument(); 
$doc->loadHTML($page);
$images = $doc->getElementsByTagName('img'); 
//echo($images[0]->getAttribute('src') . '<br />');
foreach($images as $image) {
   echo("<img src = ");
   echo $image->getAttribute('src');
   echo(" /> <br />");
   break;
}
?>