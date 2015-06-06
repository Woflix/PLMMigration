<?php 
// Get URL Variable \\
$data = $_GET["info"];
// Append Contents of URL Variable with New Line to 'joblist.txt' \\
$txtFile = file_put_contents("joblist.txt", $data.PHP_EOL, FILE_APPEND);
?>
<script type="text/javascript">showGoodSuccess();</script>