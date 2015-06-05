<?php 
$data = "test: ".$_GET["info"];
$txtFile = file_put_contents("joblist.txt", $data.PHP_EOL, FILE_APPEND);
echo "<h2 id=\"sqlGood\">Successfully updated joblist.txt.</h2>";
?>