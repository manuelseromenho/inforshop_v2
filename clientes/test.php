<?php

echo "hello THI IS SPARTA";
$xmlDoc = new DOMDocument();
$xmlDoc->load("note2.xml");

$xml_string = $xmlDoc->saveXML();

echo $xml_string;


?>