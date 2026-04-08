<?php
require('../../lib/settings.php');
$data = $_POST;
$voucher_guid = $data['vouchertype'];
$link = dblink();
$getdata = findQuery("SELECT id,result as voucher_number FROM erp_transaction_settings where temp_transaction = 1 and  voucher_guid = ".$voucher_guid);

	$val['temp_vouchers'] = $getdata;
		echo json_encode($val);
		return;
?>