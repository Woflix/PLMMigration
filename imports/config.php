<?php
// SQL Server Data \\
define('DB_SERVER', 'plmtrcsc5');
define('DB_USERNAME', 'jcmig');
define('DB_PASSWORD', 'jcmig');
define('DB_DATABASE', 'jcmig');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
mysql_query ("set character_set_results='utf8'");   
?>