<?php 
// Get URL Variable \\
$data = $_GET["info"];
// Append Contents of URL Variable with New Line to 'joblist.txt' \\
$txtFile = file_put_contents("c:/jccatx_work/job_list/joblist.txt", $data.PHP_EOL, FILE_APPEND);
//$txtFile = file_put_contents("//10.114.49.223/tcplan/jccatx_work/job_list/joblist.txt", $data.PHP_EOL, FILE_APPEND);
?>
<script type="text/javascript">showGoodSuccess();</script>