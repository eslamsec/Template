<?php
require('../../lib/settings.php');
extract($_POST);
$json = array();
$guid = (int)$_REQUEST['guid'];
$type = (int)$_REQUEST['type'];
$owner_guid = owner_guid();
if(!$owner_guid){
	echo json_encode($json);
	return;
}
if($type == 1){
	$sql = "SELECT id as id,name FROM erp_quotation_master where id !=$guid "; 
	$data = findQuery($sql);
	if(!$data){
		$json['data'] = array();
		echo json_encode($json);
		return;
	}
	$json['load_status'] = 1;
	$json['data'] = $data;
	echo json_encode($json);
	return;
}


?>	   