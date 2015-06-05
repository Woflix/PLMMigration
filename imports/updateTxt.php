<?php 
// Get URL Variable \\
$data = $_GET["info"];
// Append Contents of URL Variable with New Line to 'joblist.txt' \\
$txtFile = file_put_contents("joblist.txt", $data.PHP_EOL, FILE_APPEND);
// Show Status Message \\
echo "<h2 id=\"sqlGood\">Successfully updated joblist.txt.</h2>";
?>