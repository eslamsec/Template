<?php
header("Access-Control-Allow-Origin: *");
header("content-type:application/json");
require('../../lib/settings.php');
require(root.'site/auth/validate.php');
require_once('autoAccess.php');
$data = $_POST;
$id = (int)$data['edit_guid'];
$trn_ref_id = (int)$data['trn_ref_id'];
$purch_filter_vid = (array)$data['purch_filter_vid'];
$copy = $data['copy'];
$outletID = (int)$data['outlet_id'];
$voucher_type = (int)$data['voucher_guid'];
// print_r($data);
// exit;
unset($data['copy']);
unset($data['purch_filter_vid']);
unset($data['outlet_id']);
if($copy == 1) {
	$id = 0;
	$trn_ref_id = 0;
}

// print_r($data);
// exit;

if(!$data['name']){
	$json['saveStatus']=0;
	$json['errormsg']='Please specify title';
	$json['input'] = 'name';
	echo json_encode($json);
	exit;
}
if(!$data['voucher_guid']){
	$json['saveStatus']=0;
	$json['errormsg']='Please specify voucher type';
	$json['input'] = 'voucher_guid';
	echo json_encode($json);
	exit;
}

// if(($data['req_confirmation'] == 1) && ($data['temp_transaction_number'] == 0))
// {
// 	$json['saveStatus']=0;
// 	$json['errormsg']='Please select Temporary voucher Number';
// 	$json['input'] = 'temp_transaction_number';
// 	echo json_encode($json);
// 	exit;
// }

if($data['name']){
	// $and = '';
	$voucherGuid = (int)$data['voucher_guid'];
	$title = trim($data['name']);
	// $count_name = findQuery("SELECT COUNT(*) as total from erp_transaction_settings where TRIM(title) = '$title' $and ");
	// if($count_name[0]['total'] > 0) {
	$ch = erp_duplicate_field_check('erp_transaction_settings', 'title', $title, $id, " voucher_guid = $voucherGuid ");
	if($ch){
		$json['saveStatus']=0;
		$json['errormsg']='Please Change title';
		$json['input'] = 'name';
		echo json_encode($json);
		exit;
	}
}

if ($data['voucher_guid'] == 11     ||  $data['voucher_guid'] == 10) {
	if(!$data['lc_process_voucher']){
		$json['saveStatus']=0;
		$json['errormsg']='Please specify process Purchase  voucher type';
		$json['input'] = 'lc_process_voucher';
		echo json_encode($json);
		exit;
	}
}
$cashGL = (int)$data['cash_gl'];
$creditGL = implode(',',$data['creditc_gl'] ?? []);
$debitGL = implode(',',$data['debitc_gl'] ?? []);
$walletGL = implode(',',$data['wallet_gl'] ?? []);
if ($data['voucher_guid'] == 17 || $data['voucher_guid'] == 18) {
	if($data['voucher_guid'] == 18 && isset($data['kot'])){
		if(!$data['def_cust_grp']){
			$json['saveStatus']=0;
			$json['errormsg']='Please specify def Customer Group.';
			$json['input'] = 'def_cust_grp';
			echo json_encode($json);
			exit;
		}
	}else{
	if(!$data['sales_return_voucher_guid']){
		$json['saveStatus']=0;
		$json['errormsg']='Please specify sales return (Credit Note ) voucher type';
		$json['input'] = 'sales_return_voucher_guid';
		echo json_encode($json);
		exit;
	}}
	if(!$cashGL || $cashGL == 0){
		// $json['saveStatus']=0;
		// $json['errormsg']='Please specify cash ledger';
		// $json['input'] = 'cash_gl';
		// echo json_encode($json);
		// exit;
	}
	if(!$creditGL || !$debitGL ){
		$json['saveStatus']=0;
		$json['errormsg']='Please specify Credit Card/Debit Card ledger';
		$json['input'] = 'cash_gl';
		echo json_encode($json);
		exit;
	}
}

if ($data['voucher_guid'] == 18) {
	if(isset($data['kot'])){}else{
		if(!$data['kot_voucher']){
			$json['saveStatus']=0;
			$json['errormsg']='Select KOT Voucher  for FnB .';
			$json['input'] = 'kot_voucher';
			echo json_encode($json);
			exit;
		}
	}
	$inArray['non_inv_item'] = $data['tb_rsrv_item'];
	$inArray['rsrv_item_type'] = isset($data['rsrv_item_type']) ? $data['rsrv_item_type'] : 0;

}

if ($data['voucher_guid'] == 12  ) {
	if((int)$data['auto_purchase_delivery_note'] && !(int)$data['auto_deliverynote_voucher']){
		$json['saveStatus']=0;
		$json['errormsg']='Select Voucher Type for Auto Delivery Note';
		$json['input'] = 'auto_deliverynote_voucher';
		echo json_encode($json);
		exit;
	}
}


if ($data['voucher_guid'] == 10  ) {
	if((int)$data['auto_purchase_delivery_note'] && !(int)$data['auto_deliverynote_voucher']){
		$json['saveStatus']=0;
		$json['errormsg']='Select Voucher  for Auto Delivery Note';
		$json['input'] = 'auto_deliverynote_voucher';
		echo json_encode($json);
		exit;
	}
}

if((int)$_SESSION['menu']['room_reservation']){
	if($data['voucher_guid'] == 3 && !(int)$data['auto_deliverynote_voucher']){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Select Voucher Type for Auto Delivery Note';
		$json['input'] = 'auto_deliverynote_voucher';
		echo json_encode($json);
		exit;
	}
}

if(!$id || $trn_ref_id || $data['new_trn_ref']){
	if((int)$data['start_num'] < 1){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Voucher start number should be greater than or equal to 1';
		$json['input'] = 'start_num';
		echo json_encode($json);
		exit;
	}
	if(!$data['date']){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Date is required';
		$json['input'] = 'date';
		echo json_encode($json);
		exit;
	} else {
		$ch = findOne("SELECT id FROM erp_transaction_ref WHERE date='".$data['date']."' AND voucher_id=$id AND id!=".(int)$trn_ref_id);
		if($ch){
			$json['saveStatus'] = 0;
			$json['errormsg'] = 'Voucher reference already exists for the selected date. Please choose a different date.';
			$json['input'] = 'date';
			echo json_encode($json);
			exit;
		}
	}
}

if($data['voucher_guid'] == 19){
	if($data['stocktransfer_type'] == 0 && !$data['transit_store_guid']){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Select Transit Store';
		echo json_encode($json);
		exit;
	}
}

if(in_array($data['voucher_guid'], [21]) || ($data['voucher_guid'] == 19 && in_array($data['stocktransfer_type'], [2,4]))){
	if(!$data['journal_voucher']){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Select Journal Voucher';
		echo json_encode($json);
		exit;
	}
	// if(!$data['journal_credit_ledger']){
	// 	$json['saveStatus'] = 0;
	// 	$json['errormsg'] = 'Select Journal Credit Ledger';
	// 	echo json_encode($json);
	// 	exit;
	// }
}

if(($data['voucher_guid'] == 21 && $data['project_physicalstock']) || ($data['voucher_guid'] == 19 && $data['stocktransfer_type'] == 4 && $data['project_stock_consumption'])){
	if(!$data['journal_debit_ledger_group']){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Select Journal Debit Ledger Group';
		echo json_encode($json);
		exit;
	}
}

// if(($data['voucher_guid'] == 21 && !$data['project_physicalstock'])){
// 	if(!$data['journal_debit_ledgers']){
// 		$json['saveStatus'] = 0;
// 		$json['errormsg'] = 'Select Debit Ledger';
// 		echo json_encode($json);
// 		exit;
// 	}
// }

if($data['voucher_guid'] == 19 && ($data['stocktransfer_type'] == 2 || $data['stocktransfer_type'] == 4) && !$data['project_stock_consumption']){
	$journal_debit_ledgers = implode(',', (array)$data['journal_debit_ledgers']);
} else if($data['voucher_guid'] == 21 && !$data['project_physicalstock']){
	$journal_debit_ledgers = implode(',', (array)$data['journal_debit_ledgers']);
}

if($data['store_guid']){
	$store = find_one($data['store_guid'], 'erp_stores');
	if($data['voucher_guid'] == 19){
		if($data['stocktransfer_type'] == 1 && $store['dimage_disposal'] != 0){
			$json['saveStatus'] = 0;
			$json['errormsg'] = 'Cannot select damage or transit store';
			$json['input'] = 'store_guid';
			echo json_encode($json);
			exit;
		}
		else if($data['stocktransfer_type'] == 2 && $store['dimage_disposal'] != 1){
			$json['saveStatus'] = 0;
			$json['errormsg'] = 'Select Damage Store';
			$json['input'] = 'store_guid';
			echo json_encode($json);
			exit;
		}
		else if($data['stocktransfer_type'] == 3 && $store['transit_store'] == 0){
			$json['saveStatus'] = 0;
			$json['errormsg'] = 'Select Transit Store';
			$json['input'] = 'store_guid';
			echo json_encode($json);
			exit;
		}
	} else {
		if($store['dimage_disposal'] || $store['transit_store']){
			$json['saveStatus'] = 0;
			$json['errormsg'] = 'Cannot select damage or transit store';
			$json['input'] = 'store_guid';
			echo json_encode($json);
			exit;
		}
	} 
}

// if($data['voucher_guid'] == 5 && !isset($data['credit_sales_control']) && !$data['receipt_voucher']){
// 	$json['saveStatus'] = 0;
// 	$json['errormsg'] = 'Receipt Voucher is required';
// 	$json['input'] = 'receipt_voucher';
// 	echo json_encode($json);
// 	exit;
// }

if(!isset($data['credit_sales_control'])){
	if($data['voucher_guid'] == 5 && !$data['receipt_voucher']){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Receipt Voucher is required';
		$json['input'] = 'receipt_voucher';
		echo json_encode($json);
		exit;
	}

	if($data['voucher_guid'] == 12 && !$data['def_payment_voucher']){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Payment Voucher is required';
		$json['input'] = 'def_payment_voucher';
		echo json_encode($json);
		exit;
	}
}

if(in_array($voucher_type,[3]) && isset($data['coating_voucher']) && ($data['coating_voucher'] == 2)){
	if(!$data['trf_guid'] || !$data['recv_guid']){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Stock trnasfer store is required';
		$json['input'] = 'receipt_voucher';
		echo json_encode($json);
		exit;
	}
}

if($data['voucher_guid'] == 29){
	if($data['store_guid'] && $data['project_id']){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Select either Store or Project';
		echo json_encode($json);
		exit;
	}
}

$stock_consumption_voucher = array();
if(in_array($data['voucher_guid'], [10,12,32])){
	$consumption_vouchers = (array)$data['consumption_vouchers'];
	foreach($consumption_vouchers['p_type'] as $key=>$p_type){
		if(isset($stock_consumption_voucher[$p_type])){
			$json['saveStatus']=0;
			$json['errormsg'] = "Duplicate consumption voucher found for same project type";
			echo json_encode($json);
			exit;
		}
		$stock_consumption_voucher[$p_type] = $consumption_vouchers['voucher_guid'][$key];
	}
}

if($data['cost_center_guid']){
	if(in_array($voucher_type, [5,12]) && count($data['cost_center_guid']) > 1){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Select any one cost center';
		echo json_encode($json);
		exit;
	}
}

// TEMP TO GENERATE RECEIPT FOR OLD CASHMEMOS AND SALESORDERS
if(($data['voucher_guid'] == 5 && !isset($data['credit_sales_control'])) && $data['receipt_voucher']){
	$so_settlements = findQuery("SELECT sm.voucher_id
								 FROM erp_sales_settlement ss 
								 LEFT JOIN erp_salesorder so ON so.id=ss.salesorder_guid 
								 LEFT JOIN erp_salesorder_master sm ON sm.id=so.salesorder_ref 
								 LEFT JOIN erp_transaction_settings ts ON ts.id=sm.voucher_id 
								 WHERE so.net_total>0 AND ss.salesorder_guid>0 AND ss.amount>0 AND ss.so_auto_receipt_generated=2 AND ts.receipt_voucher=0
								 GROUP BY sm.voucher_id");
	if($so_settlements){
		$json['saveStatus'] = 0;
		$json['errormsg'] = 'Please update receipt voucher for salesorder first';
		echo json_encode($json);
		exit;
	}
}

// if(isset($data['custom_format'])){
// 	$fileinputs = array('header_left_f','header_middle_f','header_right_f','footer_left_f','footer_middle_f','footer_right_f');
// 	foreach($fileinputs as $i=>$file){
// 		if(isset($_FILES[$file]['name']) && $_FILES[$file]['name']){
// 			$FileType = strtolower(pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION));
// 			if(!in_array($FileType, array('png','jpg','jpeg'))) {
// 				$json['saveStatus']=0;
// 				$json['errormsg']='Please select a valid image file';
// 				$json['input'] = 'file';
// 				echo json_encode($json);
// 				exit;
// 			}
// 		}
// 	}
// }	
$only_mobile = $is_ktn = $aprovd_edit= 0;
$negative_stock_pos = 0;
$is_round_off = 0;
$repeat_item_pos = 0;
$show_sales_rate_n_disc = 0;
$coating_voucher = 0;
$control_stock = 0;
$change_store_during_txn=0;
$only_manufacture_item=0;
$manufacture_on_sales = 0;
$credit_sales_control = 0;
$kot = 0;
$auto_delivered = 0;
$cr_lmt_check_so_disabled = 0;
$cr_lmt_check_dn_disabled = 0;
$integrate = 0;
if(isset($data['integrate'])) $integrate = (int)$data['integrate'];
$autocreate = 0;
if(isset($data['autocreate'])) $autocreate = (int)$data['autocreate'];

if(isset($data['only_mobile'])) $only_mobile = 1;
if(isset($data['aprovd_edit'])) $aprovd_edit = 1;
if(isset($data['is_ktn'])) $is_ktn = 1;
if($only_mobile){
	if(!$data['store_guid'] || $data['store_guid']==0){
		$json['saveStatus']=0;
		$json['errormsg']='Please specify store';
		$json['input'] = 'store_guid';
		echo json_encode($json);
		exit;
	}
}
if(isset($data['negative_stock'])) $negative_stock_pos = 1;
if(isset($data['is_round_off'])) $is_round_off = 1;
if(isset($data['repeat_item_pos'])) $repeat_item_pos = 1;
if(isset($data['show_sales_rate_n_disc'])) $show_sales_rate_n_disc = 1;
if(isset($data['coating_voucher'])) $coating_voucher = $data['coating_voucher'];
if(isset($data['control_stock'])) $control_stock = 1;
if(isset($data['change_store_during_txn'])) $change_store_during_txn = 1;
if(isset($data['only_manufacture_item'])) $only_manufacture_item = 1;
if(isset($data['manufacture_on_sales'])) $manufacture_on_sales = 1;
if(isset($data['credit_sales_control'])) $credit_sales_control = 1;
if(isset($data['kot'])) $kot = 1;
if(isset($data['auto_delivered'])) $auto_delivered = 1;
if(isset($data['cr_lmt_check_so_disabled'])) $cr_lmt_check_so_disabled = 1;
if(isset($data['cr_lmt_check_dn_disabled'])) $cr_lmt_check_dn_disabled = 1;

$is_job_card = (isset($data['is_job_card'])) ? 1 : 0;

$is_pull_qty_cost_checked = (isset($data['is_pull_qty_cost_checked']))  ? 1 : 0;
$is_wholesale = (isset($data['is_wholesale']))  ? 1 : 0;
$is_contract = (isset($data['is_contract']))  ? 1 : 0;
$is_margin = (isset($data['is_margin']))  ? 1 : 0;
$inv_items = (isset($data['inv_items']))  ? 1 : 0;
$non_inv_items = (isset($data['non_inv_items']))  ? 1 : 0;
$fa_items = (isset($data['fa_items']))  ? 1 : 0;
$item_control = (isset($data['item_control']))  ? 1 : 0;
$nt_transaction = (isset($data['nt_transaction']))  ? 1 : 0; //dev-6
$temp_transaction = (isset($data['temp_transaction']))  ? 1 : 0; //dev-6
//current_index
$inArray['title'] = $data['name'];
$inArray['print_name'] = $data['print_name'];
$voucher_type = $inArray['voucher_guid'] = (int)$data['voucher_guid'];
if(!$id){
	$inArray['date'] = date('Y-m-d',strtotime($data['date']));
	$inArray['total_digit'] = (int)$data['total_digit'];
	$inArray['start_num'] = $data['start_num'];
	$inArray['prefilwithzero'] = $data['prefilwithzero'];
	$inArray['prefix'] = $data['prefix'];
	$inArray['suffix'] = $data['suffix'];
	$inArray['result'] = $data['result'];
}
$inArray['repeat_item_pos'] = $repeat_item_pos;
if(in_array($voucher_type, array(17))) {
	$inArray['compliment_gl'] = (int)$data['compliment_gl'];
	// $inArray['svc_item'] = (int)$data['svc_chg_item'];

}
if(in_array($voucher_type, [17,18])) {
	$inArray['svc_item'] = (int)$data['svc_chg_item'];
}
if(in_array($voucher_type, [18])) {
	$inArray['disc_item'] = (int)$data['disc_item'];
}
if(in_array($voucher_type,[13])){
	/* for Debit Note ledger */
	$inArray['compliment_gl'] = (int)$data['compliment_gl'];
}
$inArray['discount_gl'] = (int)$data['discount_gl'];
$inArray['sur_b2b_led'] = (!empty($data['sur_b2b_led'])) ? implode(',',$data['sur_b2b_led']) : '';
$inArray['sur_b2c_led'] = $data['sur_b2c_led_hidden'];//(!empty($data['sur_b2c_led'])) ? implode(',',$data['sur_b2c_led']) : '';
$inArray['sur_exe_led'] = $data['sur_exe_led_hidden'];//(!empty($data['sur_exe_led'])) ? implode(',',$data['sur_exe_led']) : '';
$inArray['disc_b2b_led'] = $data['disc_b2b_led_hidden'];//(!empty($data['disc_b2b_led'])) ? implode(',',$data['disc_b2b_led']) : '';
$inArray['disc_b2c_led'] = (!empty($data['disc_b2c_led'])) ? implode(',',$data['disc_b2c_led']) : '';
$inArray['disc_exe_led'] = (!empty($data['disc_exe_led'])) ? implode(',',$data['disc_exe_led']) : '';

$inArray['sur_inc_dip'] = $data['sur_inc_dip_hidden'];
$inArray['sur_inc_exe'] = $data['sur_inc_exe_hidden'];


$inArray['roundoff_gl'] = (int)$data['roundoff_gl'];
$inArray['vat_gl'] = (int)$data['vat_gl'];
$inArray['only_mobile'] = $only_mobile;
$inArray['aprovd_edit'] = $aprovd_edit;
$inArray['is_ktn'] = $is_ktn;
$inArray['negative_stock_pos'] = $negative_stock_pos;
$inArray['is_round_off'] = $is_round_off;
if($is_round_off == 1){
	$round_off_data['decimal'] = (int)$data['round_off_decimal'];
	$round_off_data['down'] =  (int)$data['down_only'];
	$round_off_data['up'] =  (int)$data['up_only'];
	 $inArray['round_off_str'] = serialize($round_off_data);
}
$inArray['show_sales_rate_n_disc'] = $show_sales_rate_n_disc;
$inArray['coating_voucher'] = $coating_voucher;
$inArray['trf_guid'] = $data['trf_guid'];
$inArray['recv_guid'] = $data['recv_guid'];
$inArray['trf_voucher'] = $data['trf_voucher'];
$inArray['control_stock'] = $control_stock;
$inArray['change_store_during_txn'] = $change_store_during_txn;
$inArray['only_manufacture_item'] = $only_manufacture_item;
$inArray['manufacture_on_sales'] = $manufacture_on_sales;
$inArray['manufacture_sales_vouchers'] = implode(',',(array)$data['mfg_sales_vouchers']);
$inArray['credit_sales_control'] = $credit_sales_control;
$inArray['cr_lmt_check_so_disabled'] = $cr_lmt_check_so_disabled;
$inArray['cr_lmt_check_dn_disabled'] = $cr_lmt_check_dn_disabled;
$inArray['outlet_guid'] = (int)$data['outlet_guid'];
if(in_array($voucher_type,[22])){
	$inArray['outlet_guid'] = $outletID;
}
$inArray['is_job_card'] = $is_job_card;
$inArray['is_pull_qty_cost'] = $is_pull_qty_cost_checked;
$inArray['is_wholesale'] = $is_wholesale;
$inArray['is_contract'] = $is_contract;
$inArray['is_margin'] = $is_margin;
$inArray['inv_items'] = (int)$inv_items;
$inArray['non_inv_items'] = (int)$non_inv_items;
$inArray['fa_items'] = (int)$fa_items;
$inArray['item_control'] = (int)$item_control;
$inArray['nt_transaction'] = (int)$nt_transaction; //dev-6
$inArray['temp_transaction'] = (int)$temp_transaction; //dev-6
$inArray['cash_gl'] = (int)$cashGL;
$inArray['debitc_gl'] = $debitGL;
$inArray['creditc_gl'] = $creditGL;
$inArray['wallet_gl'] = $walletGL;


$inArray['stocktransfer_type'] = (int)$data['stocktransfer_type'];
$inArray['damage_stock_transfer'] = $data['stocktransfer_type'] == 1 ? 1 : 0;
$inArray['damage_stock_disposal'] = $data['stocktransfer_type'] == 2 ? 1 : 0;
$inArray['transit_store_transfer'] = $data['stocktransfer_type'] == 3 ? 1 : 0;
$inArray['stock_consumption'] = $data['stocktransfer_type'] == 4 ? 1 : 0;
$inArray['transit_store_guid'] = (int)$data['transit_store_guid'];
$inArray['project_stock_consumption'] = (int)$data['project_stock_consumption'];
$inArray['project_physicalstock'] = (int)$data['project_physicalstock'];
$inArray['def_accept_stocktransfer'] = (int)$data['def_accept_stocktransfer'];

$inArray['employee_is_mandatory'] = (isset($data['employee_is_mandatory'])) ? 1 : 0;
$inArray['default_brokerage_sales'] = (isset($data['default_brokerage_sales'])) ? 1 : 0;
$inArray['default_brokerage_purchase'] = (isset($data['default_brokerage_purchase'])) ? 1 : 0;
$inArray['transaction_settings_guid'] = (int)$data['sales_return_voucher_guid'];
$inArray['lc_process_voucher'] = (int)$data['lc_process_voucher'];
$inArray['grn_sugg'] = (int)$data['grn_sugg'];
$inArray['po_sugg'] = (int)$data['po_sugg'];
$inArray['pr_sugg'] = (int)$data['pr_sugg'];
$inArray['purch_sugg_vid'] = (int)$data['purch_sugg_vid'];
$inArray['so_sugg_vid'] = (int)$data['so_sugg_vid'];
$inArray['dn_sugg_vid'] = (int)$data['dn_sugg_vid'];
$inArray['sales_sugg_vid'] = (int)$data['sales_sugg_vid'];
$inArray['allow_pdc'] = (isset($data['allow_pdc'])) ? 1 : 0;
$inArray['req_confirmation'] = (isset($data['req_confirmation'])) ? 1 : 0;
$inArray['recurring'] = (isset($data['recurring'])) ? 1 : 0;
$inArray['salesorder_voucher'] = (int)$data['salesorder_voucher'];
$inArray['attached_kot'] = (int)$data['kot_voucher'];
$inArray['def_cust_grp'] = (int)$data['def_cust_grp'];
$inArray['receipt_voucher'] = (int)$data['receipt_voucher'];
$inArray['journal_voucher'] = (int)$data['journal_voucher'];
$inArray['journal_debit_ledger_group'] = (int)$data['journal_debit_ledger_group'];
$inArray['journal_debit_ledgers'] = $journal_debit_ledgers;
$inArray['journal_debit_ledger_from_item_category'] = (int)$data['journal_debit_ledger_from_item_category'];
$inArray['journal_credit_ledger'] = (int)$data['journal_credit_ledger'];
$inArray['journal_admin_oh_ledger'] = (int)$data['journal_admin_oh_ledger'];
$inArray['journal_factory_oh_ledger'] = (int)$data['journal_factory_oh_ledger'];
$inArray['journal_other_oh_ledger'] = (int)$data['journal_other_oh_ledger'];
$inArray['journal_ps_ledgers'] = $data['journal_ps_ledgers'] ? json_encode($data['journal_ps_ledgers']) : '';
$inArray['auto_brokerage_purchase_voucher'] = (int)$data['brokerage_purchase_voucher'];
$inArray['brokerage_purchase_return_voucher'] = (int)$data['brokerage_purchase_return_voucher'];
$inArray['stock_consumption_voucher'] = serialize($stock_consumption_voucher);
$inArray['project_id'] = (int)$data['project_id'];
$inArray['use_doc_ref'] = (isset($data['use_doc_ref'])) ? 1 : 0;
$inArray['project_types'] = implode(',', (array)$data['project_types']);
$inArray['default_project_sales'] = (int)$data['default_project_sales'];
$inArray['mandatory_sub_form'] = (int)$data['mandatory_sub_form'];
$inArray['mandatory_cost_center'] = (int)$data['mandatory_cost_center'];
$inArray['project_ref_as_so_ref'] = (int)$data['project_ref_as_so_ref'];
$inArray['cut_off_date'] = db_date($data['cut_off_date']);

// $inArray['list_po_as_pr'] = (isset($data['list_po_as_pr'])) ? 1 : 0;
// $inArray['temp_transaction_number'] = (isset($data['temp_transaction_number'])) ? $data['temp_transaction_number'] : "";

$credit_ledgers =explode(',', $data['credit_ledgers']);
$inArray['credit_ledgers'] = serialize($credit_ledgers);

$debit_ledgers =explode(',', $data['debit_ledgers']);
$inArray['debit_ledgers'] = serialize($debit_ledgers);

$vat_ledgers =explode(',', $data['vat_ledgers']);
$inArray['vat_ledgers'] = serialize($vat_ledgers);

$other_ledgers =explode(',', $data['other_ledgers']);
$inArray['other_ledgers'] = serialize($other_ledgers);

$cash_bank_ledgers =explode(',', $data['cash_bank_ledgers']);
$inArray['view_on_invoice'] = serialize($cash_bank_ledgers);

$inArray['store_guid'] = (int)$data['store_guid'];
$inArray['change_perm'] = isset($data['change_permitted']) ? 1 : 0;
$inArray['consumption_store_guid'] = (int)$data['consumption_store_guid'];
$inArray['production_store_guid'] = (int)$data['production_store_guid'];
$inArray['scrap_store_guid'] = (int)$data['scrap_store_guid'];
$inArray['salesman_guid'] = (int)$data['salesman_guid'];

$inArray['pricelist_guid'] = (int)$data['pricelist_guid'];
//$inArray['promotion_guid'] = (int)$data['promotion_guid'];
$inArray['integrate'] = (int)$integrate;
$inArray['autocreate'] = (int)$autocreate;

$op_arr=array();
$op_arr=(array)$data['moptions'];
$inArray['promotion_guid'] = implode(",",(array)$op_arr);
if(in_array($voucher_type, array(3,4,5,6,7,17,18))) {
    $inArray['default_sales_ledger'] = (int)$data['default_sales_ledger'];
}
$inArray['sales_ledger_allow_all'] = isset($data['sales_ledger_allow_all']) ? 1 : 0;
if(in_array($voucher_type, array(12,9,10,11))) {
$inArray['default_purchase_ledger'] = (int)$data['default_purchase_ledger'];
$inArray['auto_purchase_delivery_note'] = (int)$data['auto_purchase_delivery_note'];
$inArray['customer_details_on_purchase'] = (int)$data['customer_details_on_purchase'];
$inArray['auto_deliverynote_voucher'] = (int)$data['auto_deliverynote_voucher'];
}
if(in_array($voucher_type, array(9,10,11,12,13,28))) {
	$inArray['sup_grp'] = implode(',',(array)$data['sup_grp']);
	$inArray['pur_ledgr'] = implode(',',(array)$data['pur_ledgr']);
}
if($voucher_type == 3) {
	$inArray['auto_deliverynote_voucher'] = (int)$data['auto_deliverynote_voucher'];
	$inArray['process_pr'] = (int)$data['process_pr'];
}
if($voucher_type == 4) {
	$inArray['auto_salesreturn_voucher'] = (int)$data['auto_salesreturn_voucher'];
}
if($voucher_type == 9 || $voucher_type== 28) {
	$inArray['pull_grn'] = implode(',',(array)$data['pull_grn']);
}
if($voucher_type == 10) {
	$inArray['pull_pr'] = implode(',',(array)$data['pull_pr']);
}
if(in_array($voucher_type, array(13))) {
	$inArray['default_purchase_ledger'] = (int)$data['default_purchase_ledger'];
}
if(in_array($voucher_type, array(28))) {
	$inArray['default_purchase_ledger'] = (int)$data['default_purchase_ledger'];
}
$inArray['def_sales_voucher'] = (int)$data['def_sales_voucher'];
$inArray['def_payment_voucher'] = (int)$data['def_payment_voucher'];
$inArray['default_pdf_format'] = $data['default_pdf_format'];
if(in_array($voucher_type, array(17))){
	$inArray['default_pdf_format'] = (int)$data['pos_format'];
	$inArray['price_checker'] = $data['price_checker'];
}
$inArray['only_default_format'] = (int)$data['only_default_format'];
$inArray['print_non_inv_item_name'] = (int)$data['print_non_inv_item_name'];
$inArray['default_excel_format'] = $data['default_excel_format'];
$inArray['only_default_excel_format'] = isset($data['only_default_excel_format']) ? 1 : 0;
$inArray['def_brokerage_commision_voucher'] = (int)$data['def_brokerage_commision_voucher'];
$inArray['default_consume_stock'] = (int)$data['default_consume_stock'];
$inArray['cost_category_guid'] = implode(',', (array)$data['cost_category_guid']);
$inArray['cost_center_guid'] = implode(',', (array)$data['cost_center_guid']);
$inArray['def_approving_user'] = $data['def_approving_user'];
$inArray['default_bank_ledger'] = (int)$data['default_bank_ledger'];
$inArray['product_groups'] = implode(',', (array)$data['product_groups']);
$inArray['allow_multiple_payment_method'] = (int)$data['allow_multiple_payment_method'];

$inArray['form_settings'] = serialize($data['form_settings']);
$inArray['form_item_settings'] = serialize($data['form_item_settings']);

$inArray['status'] = 1;
$inArray['kot'] = (int)$kot;
$inArray['printer'] = $data['printer'];

$inArray['pfilter_vid'] = (!empty($purch_filter_vid)) ? serialize($purch_filter_vid) : '';
$inArray['intgrt_pr'] = $data['intgrt_pr_keyval'];
$inArray['autocreate_po'] = $data['autocreate_po'];
$owner_guid = owner_guid();
$msg = 'Transaction settings successfully updated';
$edited = 1;

if(!$id){
	$inArray['current_index'] = $data['start_num'];
	$inArray['owner_guid'] = owner_guid();
	$msg = 'Transaction settings successfully added';
	$edited = 0;
}
$setting_guid = saveArray('erp_transaction_settings',$inArray,$id);

//---------------------------------------------
//Related item
if(!$setting_guid){
	$json['saveStatus']=0;
	$json['errormsg']='Please check your data';
	$json['input'] = 'name';
	echo json_encode($json);
	exit;
}

if(!$id || $trn_ref_id || $data['new_trn_ref']){
	$refArray['voucher_type'] = (int)$data['voucher_guid'];
	$refArray['voucher_id'] = $setting_guid;
	$refArray['date'] = date('Y-m-d',strtotime($data['date']));
	$refArray['total_digit'] = (int)$data['total_digit'];
	$refArray['start_num'] = (int)$data['start_num'];
	$refArray['prefilwithzero'] = $data['prefilwithzero'];
	$refArray['prefix'] = $data['prefix'];
	$refArray['suffix'] = $data['suffix'];
	$refArray['result'] = $data['result'];
	$refArray['revision_prefix'] = $data['revision_prefix'];
	if(!$trn_ref_id){
		$refArray['current_index'] = (int)$data['start_num'];
	}
	$trn_ref_id = saveArray('erp_transaction_ref', $refArray, $trn_ref_id);
}

if($integrate == 1) {
    $setArray['voucher_id'] = $setting_guid;
    $setArray['integrate'] = $integrate;
    $setArray['remote_branch'] = $data['remote_branch'];
    $setArray['remote_voucher_id'] = $data['remote_voucher_guid'];
	$setArray['customer_guid'] = (int)$data['remote_customer_guid'];
	$setArray['vendor_guid'] = (int)$data['remote_vendor_guid'];
	$setArray['remote_user_guid'] = (int)$data['remote_user_guid'];
    $setArray['remote_url'] = '';
	saveArray('erp_integrate_settings',$setArray,0);
}
if($autocreate == 1){
	$setArray['voucher_id'] = $setting_guid;
    $setArray['autocreate'] = $autocreate;
    // $setArray['remote_branch'] = $data['remote_branch'];
    $setArray['remote_voucher_id'] = $data['autocreate_voucher_id'];
	// $setArray['customer_guid'] = (int)$data['remote_customer_guid'];
	// $setArray['vendor_guid'] = (int)$data['remote_vendor_guid'];
    // $setArray['remote_url'] = '';
	$setArray['type'] = 1;
	saveArray('erp_integrate_settings',$setArray,0);
}

if(in_array($data['voucher_guid'], [2,3,4,5,6,7,13,20,28])){
	if(!$id || $trn_ref_id || $data['new_trn_ref']){
		if($data['voucher_guid'] == 20) { 
			$master_table = 'erp_inquiry_new_master'; 
		} else if($data['voucher_guid'] == 2) { 
			$master_table = 'erp_quotation_master';
		} else if($data['voucher_guid'] == 3) { 
			$master_table = 'erp_salesorder_master'; 
		} else if($data['voucher_guid'] == 4) { 
			$master_table = 'erp_deliverynote_master'; 
		} else if($data['voucher_guid'] == 5 || $data['voucher_guid'] == 7) { 
			$master_table = 'erp_sales_sales_master';
		} else if($data['voucher_guid'] == 6) { 
			$master_table = 'erp_sales_return_master';
		} else if($data['voucher_guid'] == 13) { 
			$master_table = 'erp_purchase_return_master';
		} else if($data['voucher_guid'] == 28) { 
			$master_table = 'erp_purchase_return_master';
		}


		$inArray2['voucher_id'] = $setting_guid;
		$inArray2['date'] = date('Y-m-d',strtotime($data['date']));
		$inArray2['total_digit'] = (int)$data['total_digit'];
		$inArray2['start_num'] = $data['start_num'];
		$inArray2['prefilwithzero'] = $data['prefilwithzero'];
		$inArray2['prefix'] = $data['prefix'];
		$inArray2['suffix'] = $data['suffix'];
		$inArray2['result'] = $data['result'];
		$inArray2['owner_guid'] = owner_guid();
		$inArray2['store_guid'] = (int)$data['store_guid'];
		$inArray2['applicable_date'] = date('Y-m-d',strtotime($data['date']));
		$inArray2['ref_id'] = $trn_ref_id;
	
		if((int)$data['trn_ref_id']){
			$start_num_arr = findQuery("SELECT start_num from $master_table where voucher_id = $id and ref_id = ".(int)$data['trn_ref_id']." and status = '1'");
			$start_num = (int)$start_num_arr[0]['start_num'];
			if(!$start_num) $start_num = 1;
			$inArray2['start_num'] = $start_num;
			$start_num = substr(str_repeat(0, $data['total_digit']).$start_num, - (int)$data['total_digit']); 
			$inArray2['result'] =  $data['prefix'].$start_num.$data['suffix'];
			$deleteQuery = "DELETE from $master_table where voucher_id = $id and ref_id = $trn_ref_id and status = '1'";
			updateQuery($deleteQuery);
		}
		saveArray($master_table,$inArray2,0); 
	}
}

$printsetting_id = (int)$data['printsetting_id'];
if($printsetting_id){
	$print_format = findQuery("SELECT * from erp_print_formats where id = $printsetting_id");
	$print_format = $print_format[0];

	$printArray['header_left_f'] = $print_format['header_left_f'];
	$printArray['header_middle_f'] = $print_format['header_middle_f'];
	$printArray['header_right_f'] = $print_format['header_right_f'];
	$printArray['footer_left_f'] = $print_format['footer_left_f'];
	$printArray['footer_middle_f'] = $print_format['footer_middle_f'];
	$printArray['footer_right_f'] = $print_format['footer_right_f'];
}

function copy_file($name){
	global $target, $data, $printsetting_id, $print_format;
	if($printsetting_id && $data[$name.'_type'] == 'image'){
		$FileName = $print_format[$name.'_f'];
	} else {
		$FileName = '';
	}
	if(isset($_FILES[$name.'_f']['name']) && $_FILES[$name.'_f']['name']){
		$FileType = strtolower(pathinfo($_FILES[$name.'_f']['name'],PATHINFO_EXTENSION));
		$FileName = $name.'_f'.'.'.$FileType;
		move_uploaded_file($_FILES[$name.'_f']['tmp_name'], $target.$FileName);
	}
	return $FileName;
}
if ($data['voucher_guid'] == 17) {
	if($data['jv0'] > 0 || $data['jv1'] > 0){
		saveJournals($data, $setting_guid, $data['tallyid']);
	}
}
if(isset($data['custom_format'])){
	$printArray['voucher_id'] = $setting_guid;
	$printArray['papersize'] = $data['papersize'];

	$printArray['margin_top'] = $data['margin_top'];
	$printArray['margin_bottom'] = $data['margin_bottom'];
	$printArray['margin_left'] = $data['margin_left'];
	$printArray['margin_right'] = $data['margin_right'];

	$printArray['header_h'] = $data['header_h'];
	$printArray['header_left_w'] = $data['header_left_w'];
	$printArray['header_middle_w'] = $data['header_middle_w'];
	$printArray['header_right_w'] = $data['header_right_w'];
	$printArray['footer_h'] = $data['footer_h'];
	$printArray['footer_left_w'] = $data['footer_left_w'];
	$printArray['footer_middle_w'] = $data['footer_middle_w'];
	$printArray['footer_right_w'] = $data['footer_right_w'];

	$printArray['header_left_t'] = $data['header_left_t'];
	$printArray['header_middle_t'] = $data['header_middle_t'];
	$printArray['header_right_t'] = $data['header_right_t'];
	$printArray['footer_left_t'] = $data['footer_left_t'];
	$printArray['footer_middle_t'] = $data['footer_middle_t'];
	$printArray['footer_right_t'] = $data['footer_right_t'];

	$target = upload_folder."printsettings/$setting_guid/";
	if(!file_exists($target)) {
		mkdir($target, 0777, true);
	}

	$printArray['header_left_f'] = copy_file('header_left');
	$printArray['header_middle_f'] = copy_file('header_middle');
	$printArray['header_right_f'] = copy_file('header_right');
	$printArray['footer_left_f'] = copy_file('footer_left');
	$printArray['footer_middle_f'] = copy_file('footer_middle');
	$printArray['footer_right_f'] = copy_file('footer_right');

	$printArray['item_cols'] = serialize($data['item_cols']);

	saveArray('erp_print_formats',$printArray,$printsetting_id);
}

// TEMP TO GENERATE RECEIPT FOR OLD CASHMEMOS
if(($data['voucher_guid'] == 5 && !isset($data['credit_sales_control'])) && $data['receipt_voucher']){
	$sales = findQuery("SELECT s.id FROM erp_sales_sales s LEFT JOIN erp_sales_sales_master sm ON sm.id=s.sales_ref WHERE sm.voucher_id=$setting_guid AND s.credit_sales_only=0 AND s.is_settled=0 AND s.net_total>0 AND s.temp_auto_rec_generated=2 LIMIT 1");
	if($sales){
		$json['generate_cashmemo_receipt'] = 1;
		$json['sales_voucher'] = $setting_guid;
		$json['receipt_voucher'] = $data['receipt_voucher'];
	}
}

// TEMP TO GENERATE RECEIPT FOR SALESORDER
if($data['voucher_guid'] == 3 && $data['receipt_voucher']){
	// $salesorders = findQuery("SELECT s.id FROM erp_salesorder s LEFT JOIN erp_salesorder_master sm ON sm.id=s.salesorder_ref WHERE sm.voucher_id=$setting_guid AND s.is_settled=0 AND s.net_total>0 LIMIT 1");
	$salesorders = findQuery("SELECT so.id 
							  FROM erp_sales_settlement ss 
							  LEFT JOIN erp_salesorder so ON so.id=ss.salesorder_guid 
							  LEFT JOIN erp_salesorder_master sm ON sm.id=so.salesorder_ref 
							  WHERE sm.voucher_id=$setting_guid AND so.net_total>0 AND ss.salesorder_guid>0 AND ss.amount>0 AND ss.so_auto_receipt_generated=2 LIMIT 1");
	if($salesorders){
		$json['generate_salesorder_receipt'] = 1;
		$json['salesorder_voucher'] = $setting_guid;
		$json['receipt_voucher'] = $data['receipt_voucher'];
	}
}

if(!$data['edit_guid']){
	updateRolesWithNewPermission($setting_guid);
}
else if(($data['edit_guid'] > 0) && ($copy == 1)){
	updateRolesWithNewPermission($setting_guid);
}
$json['edited'] = $setting_guid;
$json['saveStatus'] = 1;
$json['returnpage'] = 'transaction';
$json['successmsg'] = $msg;
$json['data'] = $data;
$json['trigger'] = 'transaction';
echo json_encode($json);
return;


?>
