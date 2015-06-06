<?php
// Updates Database from Table Input for #migration \\
if(!empty($_POST)){
	include "config.php";
	foreach($_POST as $field_name => $val){
		$field_userid = strip_tags(trim($field_name));
		$val = strip_tags(trim(mysql_real_escape_string($val)));
		
		$split_data = explode(':', $field_userid);
		$user_id = $split_data[1];
		$field_name = $split_data[0];
		if(!empty($user_id) && !empty($field_name) && !empty($val)){
			mysql_query("UPDATE program SET $field_name = '$val' WHERE ID = $user_id") or mysql_error();
			echo "Updated";
		} else {
			echo "Invalid Requests";
		}
	}
} else {
	echo "Invalid Requests";
}
?>