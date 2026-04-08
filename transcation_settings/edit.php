<?php
require('../../lib/settings.php');
extract($_POST);
$filter_param = json_decode(base64_decode($_REQUEST['jsondata']),true);
$guid = base64_decode($filter_param['guid']);
$edit_page = base64_decode($filter_param['edit_page']);
$option['page'] = basename(dirname(__FILE__));
$option['filter'] = $filter_param;
$option['guid'] = $guid;
$option['copy'] = (int)$filter_param['copy'];
$edit_page = $filter_param['edit_page'];
if($edit_page == 'ledger'){
	page($option['page'].'/ledger/form',$option);
	return;
}

if($edit_page == 'quotationmaster' || $edit_page==''){
	page($option['page'].'/form',$option);
	return;
}


?>	   
