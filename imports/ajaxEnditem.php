<?php
// Updates Database from Table Input for #enditem \\
if(!empty($_POST)){
	include "config.php";
	foreach($_POST as $field_name => $val){
		//echo $field_name;
		$field_userid = strip_tags(trim($field_name));
		//$field_userid = $field_name;
		$val = strip_tags(trim(mysql_real_escape_string($val)));
		if ($val == "Close") { $value = "Completed"; } 
		if ($val == "Load") { $value = "Cleaning"; }
		
		$split_data = explode(':', $field_userid);
		
		$jobfolder1 = $split_data[2];
		$user_id = $split_data[1];
		$field_name = $split_data[0];
		
		$jobroot = explode('/', $jobfolder1,4);
		$jobfolder='//'.str_replace("_",".",$jobroot[2]).'/'.$jobroot[3];
		
		if(!empty($user_id) && !empty($field_name) && !empty($value)){
			//mysql_query("UPDATE enditem SET $field_name = '$value' WHERE ID = $user_id") or mysql_error();
			mysql_query("UPDATE enditem SET $field_name = '$value' WHERE enditemfn = '$user_id' AND jobfolder = '$jobfolder'") or mysql_error();
			//echo "UPDATE enditem SET $field_name = '$value' WHERE enditemfn = '$user_id' AND jobfolder = '$jobfolder'";
			//UPDATE enditem SET status = 'Complete' WHERE enditemfn = 'T80__6802010_7V2_C02_ASY_H_R_SLEVE_BUTTON_2249670_02_001_TRM_G_20131017_LCH_CATProduct';
			echo "Updated";
			//echo "UPDATE enditem SET $field_name = '$value' WHERE enditemfn = $user_id";
		} else {
			echo "Invalid Requests";
		}
	}
} else {
	echo "Invalid Requests";
}
?>