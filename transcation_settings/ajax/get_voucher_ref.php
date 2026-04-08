<?php
header("Access-Control-Allow-Origin: *");
header("content-type:application/json");
require('../../../lib/settings.php');

$voucher_guid = (int)$_REQUEST['voucher_id'];
$date = $_REQUEST['date'];

$voucher_type = rowvalue($voucher_guid, 'erp_transaction_settings', 'voucher_guid');
if(in_array($voucher_type, [2,3,4,5,6,13,28])){
    $json['type'] = 'options';

    $master_tables[2] = 'erp_quotation_master';
    $master_tables[3] = 'erp_salesorder_master';
    $master_tables[4] = 'erp_deliverynote_master';
    $master_tables[5] = 'erp_sales_sales_master';
    $master_tables[6] = 'erp_sales_return_master';
    $master_tables[13] = 'erp_purchase_return_master';
    $master_tables[28] = 'erp_purchase_return_master';

    $table = $master_tables[$voucher_type];
    $rows = get_voucher_num_from_master($table, $voucher_guid, $date);
    foreach($rows as $r){
        $ref .= '<option value="'.$r['id'].'">'.$r['result'].'</option>';
    }
} else {
    $ref = erp_voucher_ref($voucher_guid, $date);
}

$json['voucher_type'] = $voucher_type;
$json['ref'] = $ref;
echo json_encode($json);
exit;
?>