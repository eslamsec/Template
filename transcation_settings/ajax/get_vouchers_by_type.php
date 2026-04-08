<?php
header("Access-Control-Allow-Origin: *");
header("content-type:application/json");
require('../../../lib/settings.php');

$voucher_type = (int)$_REQUEST['voucher_type'];

$vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid=$voucher_type ORDER BY (sl_no=0), sl_no ASC");
$json['vouchers'] = $vouchers;

echo json_encode($json);
exit;
?>