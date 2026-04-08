<?php
header("Access-Control-Allow-Origin: *");
header("content-type:application/json");
require('../../../lib/settings.php');
require(root.'site/auth/validate.php');
require_once(root.'classes/class/PDF.php');
require_once(root.'classes/class/Voucher.php');

$settings = (array)$_REQUEST['settings'];

$voucher_type = (int)$settings['voucher_guid'];

$type = Voucher::get_type($voucher_type);
$formats = PDF::get_url($type, 'all', 0, $settings);

$json = [
   'settings' => $settings,
   'formats' => $formats
];

echo json_encode($json); 
exit;