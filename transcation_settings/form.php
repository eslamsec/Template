<?php
if(!isset($option)){
	return;
}
$settings = $_SESSION['ERP_SETTINGS'];
$guid = $option['guid'];
if($option['data']){
	$data = $option['data'];
}else if($guid){
	$voucher = findQuery("select *from erp_transaction_settings where id=$guid");
	$data = $voucher[0];
	
}
$option['data'] = $data;
$edit_guid = (int)$data['id'];

?>

<?php page('transcation_settings/settings_form',$option); return; ?>
	  


