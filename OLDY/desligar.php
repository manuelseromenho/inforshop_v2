<?php
$myfile = fopen("ligar.txt", "w") or die("Unable to open file!");
$txt = "0\n";
fwrite($myfile, $txt);
fclose($myfile);
?>
