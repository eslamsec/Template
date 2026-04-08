<?php
header("Access-Control-Allow-Origin: *");
header("content-type:application/json");
require('../../../lib/settings.php');

$voucher_type = (int)$_REQUEST['voucher_type'];
$voucher_ids = (array)$_REQUEST['voucher_ids'];

foreach($voucher_ids as $i=>$voucher_id){
    updateQuery("UPDATE erp_transaction_settings SET sl_no=".($i+1)." WHERE id=$voucher_id");
}

$json['status'] = 1;
$json['msg'] = 'Saved successfully';

echo json_encode($json);
exit;
?>