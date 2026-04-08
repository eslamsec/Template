<?php
header("Access-Control-Allow-Origin: *");
header("content-type:application/json");
require('../../../lib/settings.php');

$outlet_guid = (int)$_REQUEST['outlet_guid'];
 $transaction = findQuery("select id,title from erp_transaction_settings where outlet_guid=$outlet_guid and kot=1");
echo json_encode($transaction);