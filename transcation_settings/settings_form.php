<?php
if (!isset($option)) {
	return;
}
function accountGroupOnly($parent = 0, $spacing = '-', $category_tree_array = '', $sp = 1)
{
	if (!is_array($category_tree_array))
		$category_tree_array = array();
	$link = dblink();
	$were = '';
	if ($parent == 0) $were = " and id  in(1,2,3,5,6,7,8,9,10,11,12,13,14,17,18,4,15,16,19,20,21,22,23,26,29,30,32,31) ";
	$sqlCategory = "SELECT id,name,parent_guid FROM erp_ledgers WHERE parent_guid = $parent  $were and is_ledger=0 ORDER BY id ASC";
	$resCategory = mysqli_query($link, $sqlCategory);

	if (mysqli_num_rows($resCategory) > 0) {

		while ($rowCategories = mysqli_fetch_assoc($resCategory)) {
			if ($sp) {
				$name = $spacing . $rowCategories['name'];
			} else {
				$name = $rowCategories['name'];
			}

			$category_tree_array[] = array(
				"id" => $rowCategories['id'],
				"ledger" => $name, // $rowCategories['name'],
				"parent_guid" => $rowCategories['parent_guid'],
				"name" => $name,
				"is_ledger" => 0
			);
			$category_tree_array = accountGroupOnly($rowCategories['id'], '&nbsp;&nbsp;&nbsp;' . $spacing . '&nbsp;&nbsp;', $category_tree_array, $sp);
		}
	}
	return $category_tree_array;
}
$onlyGroup = accountGroupOnly();
function accountGroupTree($parent = 0, $spacing = '', $category_tree_array = '', $sp = 1)
{
	if (!is_array($category_tree_array))
		$category_tree_array = array();
	$link = dblink();
	$sqlCategory = "SELECT id,name,code,parent_guid,is_default,nature,is_ledger FROM erp_ledgers WHERE parent_guid = $parent ORDER BY id ASC";
	$resCategory = mysqli_query($link, $sqlCategory);

	if (mysqli_num_rows($resCategory) > 0) {

		while ($rowCategories = mysqli_fetch_assoc($resCategory)) {
			if ($sp) {
				$name = ' ' . $spacing . ' ' . $rowCategories['name'];
			} else {
				$name = $rowCategories['name'];
			}

			$category_tree_array[] = array(
				"id" => $rowCategories['id'],
				"ledger" => $rowCategories['name'],
				"default_ledger" => $rowCategories['is_default'],
				"parent_guid" => $rowCategories['parent_guid'],
				"nature" => $rowCategories['nature'],
				"name" => $name,
				"code" => $rowCategories['code'],
				"is_ledger" => $rowCategories['is_ledger']

			);
			$category_tree_array = accountGroupTree($rowCategories['id'], '  ' . $spacing . ' ', $category_tree_array, $sp);
		}
	}
	return $category_tree_array;
}
$guid = (int)$option['guid'];
$currency = $option['currency_symbol'];
$data = $option['data'];
$coating_voucher = (int)$data['coating_voucher'];
$only_mobile = (int)$data['only_mobile'];
$is_ktn = (int)$data['is_ktn'];
$voucher_guid = (int)$data['voucher_guid'];
$show_sales_rate_n_disc = (int)$data['show_sales_rate_n_disc'];
$repeat_item_pos = (int)$data['repeat_item_pos'];
$negative_stock = (int)$data['negative_stock_pos'];
$is_round_off = (int)$data['is_round_off'];
$round_off = (float)$data['round_off'];
$kot = (int)$data['kot'];
$credit_sales_control = (int)$data['credit_sales_control'];
$control_stock = (int)$data['control_stock'];
$change_store_during_txn = (int)$data['change_store_during_txn'];
$only_manufacture_item = (int)$data['only_manufacture_item'];
$manufacture_on_sales = (int)$data['manufacture_on_sales'];
$sales_vouchers2 = get_option("erp_transaction_settings", "title", "  voucher_guid IN (4,5,17,18) and status = '1' ");
$mfg_sales_vouchers = explode(',', $data['manufacture_sales_vouchers']);
$commonVouchers = array_intersect($mfg_sales_vouchers, array_keys($sales_vouchers2));
$pull_grn = ($data['pull_grn']) ? explode(',', $data['pull_grn']) : array();
$pull_pr =  ($data['pull_pr']) ? explode(',', $data['pull_pr']) : array();
$default_sales_ledger = (int)$data['default_sales_ledger'];
$default_purchase_ledger = (int)$data['default_purchase_ledger'];
$credit_sales_checked = '';
$auto_delivered = (int)$data['auto_delivered'];
$cr_lmt_check_so_disabled = (int)$data['cr_lmt_check_so_disabled'];
$cr_lmt_check_dn_disabled = (int)$data['cr_lmt_check_dn_disabled'];
$sales_return_voucher_guid = (int)$data['transaction_settings_guid'];
$outlet_guid = (int)$data['outlet_guid'];
if ($repeat_item_pos == 1) {
	$repeat_item_pos = 'checked';
}
$employee_is_mandatory = ((int)$data['employee_is_mandatory'] == 1) ? 'checked' : '';
if ($negative_stock == 1) {
	$negative_stock = 'checked';
}
$round_off_up_checked = $round_off_down_checked = '';
if ($is_round_off == 1) {
	$is_round_off = 'checked';
	$round_off_str = (array)unserialize($data['round_off_str']);
	if ($round_off_str['decimal']) $round_off_decimal = (int)$round_off_str['decimal'];
	if ($round_off_str['up'] && $round_off_str['up'] == 1) $round_off_up_checked = 'checked';
	if ($round_off_str['down'] && $round_off_str['down'] == 1) $round_off_down_checked = 'checked';
}
if ($show_sales_rate_n_disc == 1) {
	$show_sales_rate_n_disc = 'checked';
}
if ($coating_voucher == 1) {
	$show_coating_voucher = 'checked';
	$display_coating_voucher = 1;
}
if ($coating_voucher == 2) {
	$show_coating_al_voucher = 'checked';
	$display_coating_voucher = 1;
}
if ($control_stock == 1) {
	$control_stock = 'checked';
}
if ($change_store_during_txn == 1) {
	$change_store_during_txn = "checked";
}
if ($only_manufacture_item == 1) {
	$only_manufacture_item = "checked";
}
if ($manufacture_on_sales == 1) $manufacture_on_sales = 'checked';
if ($credit_sales_control == 1) {
	$credit_sales_checked = 'checked';
}
if ($auto_delivered == 1) {
	$auto_delivered = 'checked';
}
if ($cr_lmt_check_so_disabled == 1) {
	$cr_lmt_check_so_disabled = 'checked';
}
if ($cr_lmt_check_dn_disabled == 1) {
	$cr_lmt_check_dn_disabled = 'checked';
}

$debit_purchase_array = array(9, 10, 11, 12); //dev-6
$purchase_array = array(9, 10, 11, 12, 13, 28); //dev-6
$is_job_card_checked = ((int)$data['is_job_card'] == 1) ? 'checked' : '';


$is_pull_qty_cost_checked = ((int)$data['is_pull_qty_cost'] == 1) ? 'checked' : '';
$is_wholesale = ((int)$data['is_wholesale'] == 1) ? 'checked' : '';
$is_contract = ((int)$data['is_contract'] == 1) ? 'checked' : '';
$is_margin = ((int)$data['is_margin'] == 1) ? 'checked' : '';

$item_control = (int)$data['item_control'];
$nt_transaction = (int)$data['nt_transaction']; //dev-
$recurring = (int)$data['recurring']; //dev-6
$inv_items = (int)$data['inv_items'];
$non_inv_items = (int)$data['non_inv_items'];
$fa_items = (int)$data['fa_items'];

$voucher_type_for_sales_switch = 0;
$voucher_type_for_credit_sales_switch = 0;
$voucher_type_for_coating_voucher = 0;

if ($voucher_guid) {
	$voucher_type_for_sales_switch = (int)rowvalue($voucher_guid, 'erp_vouchers', 'voucher_type');
	$voucher_type_for_credit_sales_switch = (int)rowvalue($voucher_guid, 'erp_vouchers', 'voucher_type');
	$voucher_type_for_coating_voucher = (int)rowvalue($voucher_guid, 'erp_vouchers', 'voucher_type');
}

$store_guid = (int)$data['store_guid'];
$consumption_store_guid = (int)$data['consumption_store_guid'];
$production_store_guid = (int)$data['production_store_guid'];
$scrap_store_guid = (int)$data['scrap_store_guid'];
$salesman_guid = (int)$data['salesman_guid'];

$credit_ledgers = unserialize($data['credit_ledgers']);

$credit_ledgers_guid = '';
$creditLedgers = $creditLedgers2 =  array();
$credit_groupname = array();
if ($credit_ledgers && $credit_ledgers[0]) {
	$credit_ledgers_guid = implode(',', $credit_ledgers);
	$ledger_data = findQuery("select name,id,is_ledger from erp_ledgers where id in($credit_ledgers_guid)");
	for ($i = 0; $i < count($ledger_data); $i++) {
		array_push($creditLedgers, $ledger_data[$i]['name']);
		if ($ledger_data[$i]['is_ledger'] == 0) {
			array_push($credit_groupname, $ledger_data[$i]['name']);
		}
		if ($ledger_data[$i]['is_ledger'] == 1) $creditLedgers2[$ledger_data[$i]['id']] =  $ledger_data[$i]['name'];
	}
}

$debit_ledgers = unserialize($data['debit_ledgers']);
$debit_ledgers_guid = '';
$debitLedgers = $debitLedgers2 = array();
$debit_groupname = array();
if ($debit_ledgers && $debit_ledgers[0]) {
	$debit_ledgers_guid = implode(',', $debit_ledgers);
	$ledger_data = findQuery("select name,id,is_ledger from erp_ledgers where id in($debit_ledgers_guid)");
	for ($i = 0; $i < count($ledger_data); $i++) {
		array_push($debitLedgers, $ledger_data[$i]['name']);
		if ($ledger_data[$i]['is_ledger'] == 0) {
			array_push($debit_groupname, $ledger_data[$i]['name']);
		}
		if ($ledger_data[$i]['is_ledger'] == 1) $debitLedgers2[$ledger_data[$i]['id']] =  $ledger_data[$i]['name'];
	}
}

$vat_ledgers = unserialize($data['vat_ledgers']);
$vat_ledgers_guid = '';
$vatLedgers = array();
$vat_groupname = array();
if ($vat_ledgers && $vat_ledgers[0]) {
	$vat_ledgers_guid = implode(',', $vat_ledgers);
	$ledger_data = findQuery("select name,is_ledger from erp_ledgers where id in($vat_ledgers_guid)");
	for ($i = 0; $i < count($ledger_data); $i++) {
		array_push($vatLedgers, $ledger_data[$i]['name']);
		if ($ledger_data[$i]['is_ledger'] == 0) {
			array_push($vat_groupname, $ledger_data[$i]['name']);
		}
	}
}

$other_ledgers = unserialize($data['other_ledgers']);
$other_ledgers_guid = '';
$otherLedgers = array();
$otherLedgers_groupname = array();
if ($other_ledgers && $other_ledgers[0]) {
	$other_ledgers_guid = implode(',', $other_ledgers);
	$ledger_data = findQuery("select name,is_ledger from erp_ledgers where id in($other_ledgers_guid)");
	for ($i = 0; $i < count($ledger_data); $i++) {
		array_push($otherLedgers, $ledger_data[$i]['name']);
		if ($ledger_data[$i]['is_ledger'] == 0) {
			array_push($otherLedgers_groupname, $ledger_data[$i]['name']);
		}
	}
}

$cash_bank_ledgers = unserialize($data['view_on_invoice']);
$cash_bank_ledgers_guid = '';
$cashBankLedgers = array();
$cashBankLedgers_groupname = array();
if ($cash_bank_ledgers && $cash_bank_ledgers[0]) {
	$cash_bank_ledgers_guid = implode(',', $cash_bank_ledgers);
	$cash_bank_data = findQuery("select name,is_ledger from erp_ledgers where id in($cash_bank_ledgers_guid)");
	for ($i = 0; $i < count($cash_bank_data); $i++) {
		array_push($cashBankLedgers, $cash_bank_data[$i]['name']);
		if ($cash_bank_data[$i]['is_ledger'] == 0) {
			array_push($cashBankLedgers_groupname, $cash_bank_data[$i]['name']);
		}
	}
}

$store_option['table'] = 'erp_stores';
$store_option['were'] = ' id!=0 AND project_store=0';
$storeArray = get_option_array($store_option);
$storeArray[0] = 'Select Store';

$pricelist_option['table'] = 'erp_pricelist';
$pricelist_option['were'] = ' status = 1';
$priceList = get_option_array($pricelist_option);
$priceList[0] = 'Select Price List';

$promo_option['table'] = 'erp_promotions';
$promo_option['were'] = ' status = 1';
$promoList = get_option_array($promo_option);
$promoList[0] = 'Select Promotion';

$voucherType = array();
$voucherType[1] = 'Sales';
$voucherType[2] = 'Purchase';
$voucherType[3] = 'Other Sales';
$promotion = findQuery("select id,name from erp_promotions where status=1");
$sales_data = findQuery("select id,name,code from erp_clinic_employee where is_salesman = 1");
$outlet_data = findQuery("SELECT id,name,code from erp_outlet where is_active = 1");
$cost_categories = findQuery("SELECT id,name,code from erp_cost_category where is_active = 1 order by id desc");
$cost_centers = findQuery("SELECT * from erp_cost_centre where is_active = 1 order by id desc");
$current_cost_categories = explode(',', $data['cost_category_guid']);
$current_cost_centers = explode(',', $data['cost_center_guid']);
$sales_return_data = findQuery("SELECT id,title,result from erp_transaction_settings where voucher_guid = 6");
$copy = (int)$option['copy'];
$all_vouchers_list = findQuery("SELECT id,title, voucher_guid as type from erp_transaction_settings where voucher_guid IN (15,10) ");
$purchase_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid = 12 AND status = '1'");

if (!$copy) {
	$reff = findQuery("SELECT * FROM erp_transaction_ref WHERE voucher_id=$guid ORDER BY date DESC");
}
?>
<style>
	.list-group-item {
		padding: 0px;
	}

	.dropdown-menu li:hover {
		background: whitesmoke;
	}
	.atabs{
		font-size: 12px;
	}
</style>
<input type="hidden" name="copy" value="<?php echo $copy ?>">
<input type="hidden" name="edit_guid" id="edit_guid" value="<?php echo $guid ?>">
<input type="hidden" name="order_type" id="order_type" value="2">
<h4 align="center " class="mt-0 mb-3">Transaction Settings</h4>
<ul class="nav nav-tabs" role="tablist" data-hidefooter="1">
	<li role="presentation" class="tabs active1">
		<a href="#transaction_settings" class="atabs active" aria-controls="transaction_settings" id="hometab" role="tab" data-toggle="tab" >
			<i class="mdi mdi-view-dashboard"></i>&nbsp; <span>General </span>
		</a>
	</li>
	<li role="presentation" class="tabs " style="width: 16%;">
		<a href="#integrate_settings" class="atabs p-2" aria-controls="integrate_settings" role="tab" data-toggle="tab">
			<i class="mdi mdi-printer"></i>&nbsp; <span>Integrate Settings </span>
		</a>
	</li>
	<li role="presentation" class="tabs ">
		<a href="#form_settings" class="atabs p-2" aria-controls="form_settings" role="tab" data-toggle="tab">
			<i class="fas fa-align-justify"></i>&nbsp; <span>Form Settings </span>
		</a>
	</li>
	<li role="presentation" class="tabs " style="width: 16%;">
		<a href="#voucher_settings" class="atabs p-2" aria-controls="voucher_settings" role="tab" data-toggle="tab">
			<i class="fas fa-link"></i>&nbsp; <span>Voucher Settings </span>
		</a>
	</li>
	<li role="presentation" class="tabs " style="width: 19%;">
		<a href="#st_trf_settings" class="atabs p-2" aria-controls="st_trf_settings" role="tab" data-toggle="tab">
			<i class="fas fa-link"></i>&nbsp; <span>Stock Transfer Settings </span>
		</a>
	</li>
	<li role="presentation" class="tabs <?= ($data['voucher_guid']==17) ? '':'hidden' ?> " style="width: 12%;">
		<a href="#tally_jv_settings" class="atabs p-2" aria-controls="tally_jv_settings" role="tab" data-toggle="tab">
			<i class="fas fa-link"></i>&nbsp; <span>JV  Settings </span>
		</a>
	</li>
	<li role="presentation" class="tabs hidden">
		<a href="#payment_ledgers" class="atabs p-2" aria-controls="payment_ledgers" role="tab" data-toggle="tab">
			<i class="fas fa-link"></i>&nbsp; <span> Payment Ledgers </span>
		</a>
	</li>
</ul>
<div class="tab-content p-0">
	<div class="tab-pane active" role="tabpanel" id="transaction_settings">

		<div class="row">
			<div class="col-lg-6">
				<div class="row" style="padding-bottom:17px">
					<div class="col-lg-6">
						<label for="company">Name</label>
						<div class="input-group" style="padding-top:10px">
							<input type="text" class="form-control form-control-sm " onblur="if(!$('#print_name').val()) $('#print_name').val(this.value)" value="<?php if ($data['title']) echo $data['title'] ?>" name="name" id="name" required>
						</div>
					</div>
					<div class="col-lg-6">
						<label for="company">Print Name</label>
						<div class="input-group" style="padding-top:10px">
							<input type="text" class="form-control form-control-sm " value="<?php if ($data['print_name']) echo $data['print_name'] ?>" name="print_name" id="print_name" required>
						</div>
					</div>
				</div>

				<div class="mb-2 mt-1" style="display:flex;justify-content: space-between;">
					<div style="
								width: 12pc;
								display: flex;
								justify-content: space-between;	
								align-items: flex-start;
							">
						<div class="mr-4 ml-0">
							<label>Only Mobile</label>
						</div>
						<div class="posCheckboxInner">


							<p style="margin: 0 8px;">No</p>
							<div class="custom-control custom-switch">
								<input type="checkbox" name="only_mobile" class="custom-control-input" id="only_mobile" <?php if ($only_mobile) echo 'checked'; ?>>
								<label class="custom-control-label" for="only_mobile">Yes</label>
							</div>

						</div>
					</div>
					<div style="
							width: 12pc;
							display: flex;
							margin-left:1pc;
							justify-content: space-between;
							align-items: flex-start;
						">
						<div class="mr-4 ml-0">
							<i> Kitchen</i>
						</div>
						<div class="posCheckboxInner">
							<p style="margin: 0 8px;">No</p>
							<div class="custom-control custom-switch">
								<input type="checkbox" name="is_ktn" class="custom-control-input" id="is_ktn" <?php if ($is_ktn) echo 'checked'; ?>>
								<label class="custom-control-label" for="is_ktn">Yes</label>
							</div>

						</div>
					</div>
				</div>
				<div class="mb-3">
					<label for="company">Voucher Type </label>
					<div class="input-group" style="padding-top:10px">
						<select class="form-control form-control-sm " id="voucher_guid" name="voucher_guid" data-siteurl="<?php echo siteurl ?>">
							<?php
							echo '<option value="0" data-type="0">Voucher Type</option>';
							foreach ($voucherType as $vtype => $type_label) {
								$voucherData = findQuery("select id,name from erp_vouchers where voucher_type=$vtype order by serial_no asc");
								echo '<optgroup label="' . $type_label . '">';
								for ($i = 0; $i < count($voucherData); $i++) {
									$id = $voucherData[$i]['id'];
									$name = $voucherData[$i]['name'];
									if ($id == $voucher_guid) {
										echo '<option value="' . $id . '" data-type="' . $vtype . '" selected>' . $name . '</option>';
									} else {
										echo '<option value="' . $id . '" data-type="' . $vtype . '">' . $name . '</option>';
									}
								}
								echo '</optgroup>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="mb-2" style="display: flex;justify-content: space-between;width: 40%;">
					<label>Allow Item Control</label>
					<input type="checkbox" onclick="changeItemControl(this);" value="1" name="item_control" <?php if ($item_control == 1) echo "checked" ?> />
				</div>
				<div class="mb-2  item-control-div " style="display: <?php if ($item_control == 1) {
																			echo 'flex';
																		} else echo 'none' ?>;justify-content: space-between;width: 40%;">
					<label>Inventory</label>
					<input type="checkbox" value="1" name="inv_items" <?php if ($inv_items == 1) echo "checked" ?> />
				</div>
				<div class="mb-2  item-control-div " style="display: <?php if ($item_control == 1) {
																			echo 'flex';
																		} else echo 'none' ?>;justify-content: space-between;width: 40%;">
					<label>Non Inventory</label>
					<input type="checkbox" value="1" name="non_inv_items" <?php if ($non_inv_items == 1) echo "checked" ?> />
				</div>
				<div class="mb-2 item-control-div  " style="display: <?php if ($item_control == 1) {
																			echo 'flex';
																		} else echo 'none' ?>;justify-content: space-between;width: 40%;">
					<label>Fixed Assets</label>
					<input type="checkbox" value="1" name="fa_items" <?php if ($fa_items == 1) echo "checked" ?> />
				</div>
				<!-- dev-6 -->
				<div class="mb-2" style="display: flex;justify-content: space-between;width: 40%;">
					<label>NT Transaction</label>
					<input type="checkbox" value="1" name="nt_transaction" <?php if ($nt_transaction == 1) echo "checked" ?> />
				</div>
				<div class="mb-2" id="recurringDiv" style="<?php if ($voucher_guid == 3) {
																echo 'display: flex';
															} else {
																echo 'display: none';
															} ?> ;justify-content: space-between;width: 40%;">
					<label>Recurring/Contract</label>
					<input type="checkbox" value="1" name="recurring" id="recurring" <?php if ($recurring == 1) echo "checked" ?> />
				</div>
				<!-- dev-6 -->
				<div class="mb-2 related-fields 5 4" style="justify-content:space-between ;width:40%; <?php if (in_array($voucher_guid, array(5, 4))) echo 'display:flex'; ?>">
					<label>Require Confirmation</label>
					<input type="checkbox" data-siteurl="<?php echo siteurl ?>"
						value="1" onclick="getTempTransactionVoucher(this);" id="req_confirmation" name="req_confirmation" <?php if ((int)$data['req_confirmation']) echo 'checked' ?> />
				</div>

				<div class="checkbox-group mb-2 related-fields 5" style="justify-content:space-between ;width:40%; <?php if (in_array($voucher_guid, array(5))) echo 'display:flex'; ?>">
					<label>Default Brokerage Commision Voucher</label>
					<input type="checkbox" name="def_brokerage_commision_voucher" value="1" <?php if ((int)$data['def_brokerage_commision_voucher']) echo 'checked' ?> />
				</div>

				<div class="checkbox-group mb-2 related-fields 10 12 32" style="justify-content:space-between ;width:40%; <?php if (in_array($voucher_guid, array(10, 12, 32))) echo 'display:flex'; ?>">
					<label>Default Consume Stock</label>
					<input type="checkbox" name="default_consume_stock" value="1" <?php if ((int)$data['default_consume_stock']) echo 'checked' ?> />
				</div>

				<!-- dev-6 -->
				<div class="mb-2" style="justify-content:space-between ;width:50%;">
					<label>Is Temporary Transaction?</label>
					<input type="checkbox" value="1" name="temp_transaction" <?php if ((int)$data['temp_transaction']) echo 'checked' ?> />
				</div>
				<?php
				$style = "display:none";
				if ((int)$data['req_confirmation']) {
					$style = "display:block";
				}
				?>
				<div class="mb-3 form-group tempVoucherDiv related-fields" style="<?php echo $style; ?>">
					<label for="def_sales_voucher">Select Temporary Voucher</label>
					<?php
					$get_voucher_ids = findQuery("SELECT id,result as voucher_number FROM erp_transaction_settings where temp_transaction = 1 and  voucher_guid = " . $voucher_guid);
					$temp_voucher_id = $data['temp_transaction_number'];
					?>
					<select class="form-control form-control-sm" id="temp_transaction_number" name="temp_transaction_number">
						<?php
						foreach ($get_voucher_ids as $key => $value) {
						?>
							<option <?php if ($temp_voucher_id == $key) echo "selected"; ?> value="<?php echo $value['id'] ?>"><?php echo $value['voucher_number'] ?></option>
						<?php
						}
						?>
					</select>
				</div>
				<!-- dev-6 -->
				<!-- dev-6 -->
				<div class="mb-3 sp-bw-center <?php if (in_array($voucher_guid, array(10)))  echo '';
												else echo 'hidden' ?>" id="pull-pr-list">
					<label>Pulling Vouchers</label>
					<select name="pull_pr[]" class="form-control form-control-sm hidden vouchers-select-2" multiple="multiple">
						<?php

						foreach ($all_vouchers_list as $sv) { ?>
							<?php
							if ($sv['type'] == 15) {
								$selected = '';
								if (in_array($sv['id'], $pull_pr)) $selected = ' selected="selected" ';
							?>
								<option value="<?= $sv['id'] ?>" <?= $selected ?>><?= $sv['title'] ?></option>
						<?php }
						} ?>
					</select>
				</div>
				<div class="mb-3 sp-bw-center <?php if (in_array($voucher_guid, array(9, 28)))  echo '';
												else echo 'hidden' ?>" id="pull-grn-list">
					<label>Pulling Vouchers</label>
					<select name="pull_grn[]" class="form-control form-control-sm hidden vouchers-select-2" multiple="multiple">
						<?php

						foreach ($all_vouchers_list as $sv) { ?>
							<?php
							if ($sv['type'] == 10) {
								$selected = '';

								if (in_array($sv['id'], $pull_grn)) $selected = ' selected="selected" ';
							?>
								<option value="<?= $sv['id'] ?>" <?= $selected ?>><?= $sv['title'] ?></option>
						<?php }
						} ?>
					</select>
				</div>
				<div class="mb-2 related-fields 5" style="justify-content:space-between ;width:40%; <?php if (in_array($voucher_guid, array(5))) echo 'display:flex'; ?>">
					<label>Require Confirmation</label>
					<input type="checkbox" value="1" name="req_confirmation" <?php if ((int)$data['req_confirmation']) echo 'checked' ?> />
				</div>

				<div class="mb-2 mt-1" style="display: flex;justify-content: space-between;width: 100%;">
					<div class="mb-3 " id="outlet_div" style="width: 48%; <?php if ($voucher_guid == 17  || $voucher_guid == 18) echo 'display:block'; ?>">
						<label for="outlet">Outlet</label>
						<div class="input-group" style="padding-top:10px">
							<select class="form-control form-control-sm " id="outlet_guid" name="outlet_guid">
								<option value="0">Select Outlet</option>
								<?php
								foreach ($outlet_data as $key => $outlets) {
									if ($outlets['id'] == $outlet_guid) {
										echo "<option value=" . $outlets['id'] . " selected >" . $outlets['name'] . "</option>";
									} else {
										echo "<option value=" . $outlets['id'] . " >" . $outlets['name'] . "</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="mb-3 " id="kot_voucher_div" style="width: 48%; <?php if ($voucher_guid == 18 && !$kot) echo 'display:block'; ?>">
						<label for="kot_voucher">KOT Linking</label>
						<div class="input-group" style="padding-top:10px">
							<select class="form-control form-control-sm " id="kot_voucher" name="kot_voucher">
								<?php if ($data['attached_kot'] > 0) {
									$transactionsKot = findQuery("select id,title from erp_transaction_settings where outlet_guid=$outlet_guid and kot=1");
									foreach ($transactionsKot as $kots) {
										$selectedKot = ($kots['id'] == $data['attached_kot']) ? 'selected' : '';
										echo '<option value="' . $kots['id'] . '" ' . $selectedKot . '>' . $kots['title'] . '</option>';
									}
								} ?>
							</select>
						</div>
					</div>
					<div class="mt-1" id="kot_div" <?php if ($voucher_guid == 18) echo 'style="display:flex;"';
													else echo 'style="display:none"' ?>>
						<div style="display:flex;/* justify-content: center; */flex-direction: column;align-items: center;">
							<label class="mb-2">KOT ?</label>
							<div class="posCheckboxInner" style="width: 9pc;">

								<p style="margin: 0 8px;">No</p>
								<div class="custom-control custom-switch">
									<input type="checkbox" name="kot" class="custom-control-input" id="kotCustomSwitches2" <?php if ($kot) echo 'checked'; ?>>
									<label class="custom-control-label" for="kotCustomSwitches2">Yes</label>
								</div>
							</div>
						</div>
					</div>
					<div class="mb-3 " id="sales_return_voucher_div" style="width: 48%; <?php if ($voucher_guid == 17 || $voucher_guid == 18) echo 'display:block'; ?>">
						<label>Sales Return Voucher</label>
						<div class="input-group" style="padding-top:10px">
							<select class="form-control form-control-sm" name="sales_return_voucher_guid" id="sales_return_voucher_guid">
								<option value="0">Select Sales Return Voucher</option>
								<?php
								foreach ($sales_return_data as $key => $sales_return) {
									if ($sales_return['id'] == $sales_return_voucher_guid) {
										echo "<option value=" . $sales_return['id'] . " selected >" . $sales_return['title'] . " - " . $sales_return['result'] . "</option>";
									} else {
										echo "<option value=" . $sales_return['id'] . " >" . $sales_return['title'] . " - " . $sales_return['result'] . "</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1" id="show_change_store_during_txn" <?php if ($voucher_guid == 118) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Pemitted to change the stores during Transaction</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="change_store_during_txn" class="custom-control-input" id="customSwitches_p1" <?php echo $change_store_during_txn ?>>
							<label class="custom-control-label" for="customSwitches_p1">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1" id="show_only_manufacture_item" <?php if ($voucher_guid == 118) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Select only manufacturing items</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="only_manufacture_item" class="custom-control-input" id="customSwitches_p2" <?php echo $only_manufacture_item ?>>
							<label class="custom-control-label" for="customSwitches_p2">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1" id="show_manufacture_on_sales" <?php if ($voucher_guid == 118) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Manufacture on Sales</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="manufacture_on_sales" class="custom-control-input" id="customSwitches_p212" <?php echo $manufacture_on_sales ?>>
							<label class="custom-control-label" for="customSwitches_p212">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-3 sp-bw-center <?php if ((int)$data['manufacture_on_sales'] == 1) echo '';
												else echo 'hidden' ?>" id="sales_voucher_list">
					<label>Sales Vouchers</label>
					<select name="mfg_sales_vouchers[]" class="form-control form-control-sm hidden" id="example-getting-started" multiple="multiple">
						<?php

						foreach ($sales_vouchers2 as $keyz => $sv) { ?>
							<?php
							$selected = '';

							if (in_array($keyz, $commonVouchers)) $selected = ' selected="selected" ';
							?>
							<option value="<?= $keyz ?>" <?= $selected ?>><?= $sv ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="mb-2 mt-1" id="showStockTransferCheckbox" <?php if ($voucher_guid == 19) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Control Negative Stock </label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="control_stock" class="custom-control-input" id="customSwitches" <?php echo $control_stock ?>>
							<label class="custom-control-label" for="customSwitches">Yes</label>
						</div>
					</div>
				</div>
				<!-- <div class="mb-2 mt-1 switch-box related-fields 25" <?php if ($voucher_guid == 25) echo 'style="display:flex"'; ?>>
			<div class="mr-4 ml-2">
				<label>Allow PDC</label>
			</div>
			<div class="posCheckboxInner">
				<p style="margin: 0 8px;">No</p>
				<div class="custom-control custom-switch">
					<input type="checkbox" name="allow_pdc" class="custom-control-input" id="customSwitches8" <?= $data['allow_pdc'] ? 'checked' : '' ?>>
					<label class="custom-control-label" for="customSwitches8">Yes</label>
				</div>
			</div>
		</div> -->
				<!-- <div class="mb-2 mt-1 switch-box related-fields 19" <?php if ($voucher_guid == 19) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Damage Stock Transfer</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="damage_stock_transfer" class="custom-control-input" id="customSwitches5" <?= $data['damage_stock_transfer'] ? 'checked' : '' ?>>
							<label class="custom-control-label" for="customSwitches5">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1 switch-box related-fields 19" <?php if ($voucher_guid == 19) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Damage Stock Disposal</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="damage_stock_disposal" class="custom-control-input" id="customSwitches6" <?= $data['damage_stock_disposal'] ? 'checked' : '' ?>>
							<label class="custom-control-label" for="customSwitches6">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1 switch-box related-fields 19" <?php if ($voucher_guid == 19) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Transit Store Transfer</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="transit_store_transfer" class="custom-control-input" id="customSwitches7" <?= $data['transit_store_transfer'] ? 'checked' : '' ?>>
							<label class="custom-control-label" for="customSwitches7">Yes</label>
						</div>
					</div>
				</div>
				<?php if (erp_menu('project_management')) { ?>
					<div class="mb-2 mt-1 switch-box related-fields 19" <?php if ($voucher_guid == 19) echo 'style="display:flex"'; ?>>
						<div class="mr-4 ml-2">
							<label>Stock Consumption</label>
						</div>
						<div class="posCheckboxInner">
							<p style="margin: 0 8px;">No</p>
							<div class="custom-control custom-switch">
								<input type="checkbox" name="stock_consumption" class="custom-control-input" id="stockConsumptionSwitch" <?= $data['stock_consumption'] ? 'checked' : '' ?>>
								<label class="custom-control-label" for="stockConsumptionSwitch">Yes</label>
							</div>
						</div>
					</div>
				<?php } ?> -->
				<div class="mb-2 mt-1 showposcheckbox" <?php if ($voucher_guid == 17) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Show Same Item in New Line</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="repeat_item_pos" class="custom-control-input" id="customSwitches2" <?php echo $repeat_item_pos ?>>
							<label class="custom-control-label" for="customSwitches2">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1 switch-box related-fields 17" <?php if ($voucher_guid == 17) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Employee is mandatory</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="employee_is_mandatory" class="custom-control-input" id="customSwitches4" <?php echo $employee_is_mandatory ?>>
							<label class="custom-control-label" for="customSwitches4">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1 showposcheckbox" id="showposcheckboxid" <?php if ($voucher_guid == 17 || $voucher_guid == 3 || $voucher_guid == 18)  echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Control Negative Stock </label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="negative_stock" class="custom-control-input" id="customSwitches3" <?php echo $negative_stock ?>>
							<label class="custom-control-label" for="customSwitches3">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1" id="showposcheckbox21" <?php if ($voucher_guid == 17) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Auto Round Off</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="is_round_off" class="custom-control-input" id="customSwitches333" <?php echo $is_round_off ?>>
							<label class="custom-control-label" for="customSwitches333">Yes</label>
						</div>
					</div>
					<input type="number" class="form-control form-control-sm ml-4" style="width:3pc" name="round_off_decimal" value="<?= $round_off_decimal ?>" />
					Down <input type="checkbox" style="width:5pc" name="down_only" value="1" <?php echo $round_off_down_checked ?> />
					Up <input type="checkbox" style="width:5pc" name="up_only" value="1" <?php echo $round_off_up_checked ?> />
				</div>
				<div class="mb-2 mt-1" id="showSalesDetailsCheckbox" <?php if ($voucher_type_for_sales_switch == 1) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Show Min Sales Rate & Discount (%)</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="show_sales_rate_n_disc" class="custom-control-input" id="salesSwitches" <?php echo $show_sales_rate_n_disc ?>>
							<label class="custom-control-label" for="salesSwitches">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1" id="showCreditSalesCheckbox" <?php if ($voucher_guid == 5 || $voucher_guid == 12) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Credit <span id='dual_name'><?= ($voucher_guid == 5) ? ' Sales' : (($voucher_guid == 12) ? 'Purchase' : '') ?> </span>Only</label>
					</div>
					<div class="posCheckboxInner mr-3">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="credit_sales_control" class="custom-control-input" id="creditSalesSwitch" <?php echo $credit_sales_checked ?>>
							<label class="custom-control-label" for="creditSalesSwitch">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1" id="showAutoDeliveredCheckbox" <?php if ($voucher_guid == 4 || $voucher_guid == 5 || $voucher_guid == 7) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Auto Delivered</label>
					</div>
					<div class="posCheckboxInner mr-3">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="auto_delivered" class="custom-control-input" id="auto_delivered_switch" <?php echo $auto_delivered ?>>
							<label class="custom-control-label" for="auto_delivered_switch">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1" id="showCrLmtCheckSOCheckbox" <?php if ($voucher_guid == 3) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Cr. Limit Check Disabled</label>
					</div>
					<div class="posCheckboxInner mr-3">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="cr_lmt_check_so_disabled" class="custom-control-input" id="cr_lmt_check_so_disabled_switch" <?php echo $cr_lmt_check_so_disabled ?>>
							<label class="custom-control-label" for="cr_lmt_check_so_disabled_switch">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1" id="showCrLmtCheckDNCheckbox" <?php if ($voucher_guid == 4) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Cr. Limit Check Disabled</label>
					</div>
					<div class="posCheckboxInner mr-3">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="cr_lmt_check_dn_disabled" class="custom-control-input" id="cr_lmt_check_dn_disabled_switch" <?php echo $cr_lmt_check_dn_disabled ?>>
							<label class="custom-control-label" for="cr_lmt_check_dn_disabled_switch">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1" id="showIsJobCardSetting" <?php if ($voucher_guid == 3) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Is Job Card - Garage</label>
					</div>
					<div class="posCheckboxInner mr-3">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="is_job_card" class="custom-control-input" id="isJobCardSwitch" <?php echo $is_job_card_checked ?>>
							<label class="custom-control-label" for="isJobCardSwitch">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1" id="showIsPullQtyCostSetting" <?php if ($voucher_guid == 3) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Pull Available Qty./Cost (CI to SO)</label>
					</div>
					<div class="posCheckboxInner mr-3">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="is_pull_qty_cost_checked" class="custom-control-input" id="isPullQtyCostSwitch" <?php echo $is_pull_qty_cost_checked ?>>
							<label class="custom-control-label" for="isPullQtyCostSwitch">Yes</label>
						</div>
					</div>
				</div>
				<input type="hidden" id="coating_voucher_value" value="<?php echo $coating_voucher; ?>" />
				<?php if ($_SESSION['ERP_SETTINGS']['trade_in_kg'] == 1) { ?>

					<div class="mb-2 mt-1" id="showVoucherCoatingCheckbox" <?php if ($voucher_type_for_coating_voucher == 1) echo 'style="display:flex"'; ?>>
						<div class="mr-4 ml-2">
							<label>Coating Voucher</label>
						</div>
						<div class="posCheckboxInner mr-4">
							<!-- <p style="margin: 0 8px;">No</p> -->
							<div class="custom-control custom-switch">
								<input type="checkbox" name="coating_voucher" value="1" class="custom-control-input" id="coating_voucher" <?php echo $show_coating_voucher ?>>
								<label class="custom-control-label" for="coating_voucher"></label>
							</div>
						</div>
						<div class="mr-4 ml-4">
							<label>Aluminum Voucher</label>
						</div>
						<div class="posCheckboxInner">
							<!-- <p style="margin: 0 8px;">No</p> -->
							<div class="custom-control custom-switch">
								<input type="checkbox" name="coating_voucher" class="custom-control-input" id="coating_voucher2" value="2" <?php echo $show_coating_al_voucher ?>>
								<label class="custom-control-label" for="coating_voucher2"></label>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php if (erp_menu('project_management')) { ?>
					<div class="mb-2 mt-1 switch-box related-fields 5" <?php if ($voucher_guid == 5) echo 'style="display:flex"'; ?>>
						<div class="mr-4 ml-2">
							<label>Default Project Sales</label>
						</div>
						<div class="posCheckboxInner">
							<p style="margin: 0 8px;">No</p>
							<div class="custom-control custom-switch">
								<input type="checkbox" name="default_project_sales" class="custom-control-input" id="customSwitches_dps" value="1" <?= $data['default_project_sales'] ? 'checked' : '' ?>>
								<label class="custom-control-label" for="customSwitches_dps">Yes</label>
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="mb-2 mt-1 switch-box related-fields 5" <?php if ($voucher_guid == 5) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Sub Form Is Mandatory</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="mandatory_sub_form" class="custom-control-input" id="customSwitches_subform" value="1" <?= $data['mandatory_sub_form'] ? 'checked' : '' ?>>
							<label class="custom-control-label" for="customSwitches_subform">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1 switch-box related-fields 5 6 12 13 19 21 25 26 27 32" <?php if (in_array($voucher_guid, [5, 6, 12, 13, 19, 21, 25, 26, 27, 32])) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Cost Center Is Mandatory</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="mandatory_cost_center" class="custom-control-input" id="customSwitches_cost" value="1" <?= $data['mandatory_cost_center'] ? 'checked' : '' ?>>
							<label class="custom-control-label" for="customSwitches_cost">Yes</label>
						</div>
					</div>
				</div>

				<div class="mb-2 mt-1" id="showWholeSales" <?php if ($voucher_guid == 3) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Wholesale Sales</label>
					</div>
					<div class="posCheckboxInner mr-3">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="is_wholesale" class="custom-control-input" id="isWholeSales" <?php echo $is_wholesale ?>>
							<label class="custom-control-label" for="isWholeSales">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1" id="showContractSalesOrder" <?php if ($voucher_guid == 3) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Contract Salesorder</label>
					</div>
					<div class="posCheckboxInner mr-3">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="is_contract" class="custom-control-input" id="is_contract" <?php echo $is_contract ?>>
							<label class="custom-control-label" for="is_contract">Yes</label>
						</div>
					</div>
				</div>

				<div class="mb-1 form-group related-field-blocks 19" <?php if ($voucher_guid == 19) echo 'style="display:block"'; ?>>
					<label>Stock Transfer Type</label>
					<select name="stocktransfer_type" class="form-control form-control-sm">
						<option value="0">Select Type</option>
						<option value="1" <?php if ($data['damage_stock_transfer']) echo 'selected' ?>>Damage Stock Transfer</option>
						<option value="2" <?php if ($data['damage_stock_disposal']) echo 'selected' ?>>Damage Stock Disposal</option>
						<option value="3" <?php if ($data['transit_store_transfer']) echo 'selected' ?>>Transit Store Transfer</option>
						<option value="4" <?php if ($data['stock_consumption']) echo 'selected' ?>>Stock Consumption</option>
					</select>
				</div>

				<div class="mb-1 form-group <?php if ($voucher_guid != 19 || $data['stocktransfer_type'] != 0) echo 'dis-none"'; ?>">
					<div class="checkbox-group">
						<input type="checkbox" name="def_accept_stocktransfer" value="1" <?php if ($data['def_accept_stocktransfer']) echo 'checked' ?>>
						<label>Default accept shipment on stock transfer</label>
					</div>
				</div>

				<div class="mb-1 form-group" <?php if ($voucher_guid == 19 && (!$data['damage_stock_transfer'] && !$data['damage_stock_disposal'] && !$data['transit_store_transfer'] && !$data['stock_consumption'])) echo 'style="display:block"';
												else echo 'style="display:none"'; ?>>
					<label>Transit Store</label>
					<select name="transit_store_guid" class="form-control form-control-sm">
						<option value="0">Select Transit Store</option>
						<?php
						$transit_stores = findQuery("SELECT id,name FROM erp_stores WHERE transit_store=1 AND is_active=1");
						foreach ($transit_stores as $s) {
							$id = $s['id'];
							$name = $s['name'];
							$selected = ($id == $data['transit_store_guid']) ? 'selected' : '';
							echo "<option value='$id' $selected>$name</option>";
						}
						?>
					</select>
				</div>

				<?php if (erp_menu('project_management')) { ?>
					<div class="switch-box mb-2 mt-2" id="showProjectStockConsumptionSwitch" <?php if ($voucher_guid == 19 && $data['stock_consumption']) echo 'style="display:flex"';
																								else echo 'style="display:none"'; ?>>
						<div class="mr-4 ml-2">
							<label>Project Consumption</label>
						</div>
						<div class="posCheckboxInner">
							<p style="margin: 0 8px;">No</p>
							<div class="custom-control custom-switch">
								<input type="checkbox" name="project_stock_consumption" class="custom-control-input" id="projectStockConsumptionSwitch" value="1" <?= $data['project_stock_consumption'] ? 'checked' : '' ?>>
								<label class="custom-control-label" for="projectStockConsumptionSwitch">Yes</label>
							</div>
						</div>
					</div>

					<div class="switch-box mb-2 mt-1 related-fields 21" <?php if ($voucher_guid == 21) echo 'style="display:flex"'; ?>>
						<div class="mr-4 ml-2">
							<label>Project Physical Stock</label>
						</div>
						<div class="posCheckboxInner">
							<p style="margin: 0 8px;">No</p>
							<div class="custom-control custom-switch">
								<input type="checkbox" name="project_physicalstock" class="custom-control-input" id="projectPhysicalStockSwitch" value="1" <?= $data['project_physicalstock'] ? 'checked' : '' ?>>
								<label class="custom-control-label" for="projectPhysicalStockSwitch">Yes</label>
							</div>
						</div>
					</div>
				<?php } ?>

				<div class="mb-3 related-field-blocks 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 20 21 22 27 28 29 118 119" <?php if(in_array($voucher_guid, [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,20,21,22,27,28,29,118,119])) echo 'style="display:block"'; ?>>
					<label for="company">Credit Group/Ledgers</label>
					<div class="input-group" style="padding-top:10px">
						<?php
						$edit_url = base64_encode(siteurl . 'site/ledger/edit.php');
						$action_url = base64_encode(siteurl . 'site/ledger/save.php');
						$param = array();
						$param['guid'] = 0;
						$param['edit_page'] = 'ledger';
						$parameter = base64_encode(json_encode($param));
						?>

						<input type="text" class="form-control form-control-sm ledgerdata" value="<?php echo implode(',', $credit_groupname); ?>" data-id="31" data-type="1" data-actualid="<?= $voucher_guid ?>" id="credit_ledgers" data-siteurl="<?php echo siteurl ?>" placeholder="Click here to add ledger" readonly="">
						<input type="hidden" class="hledgerdata" name="credit_ledgers" id="hidden_credit_ledgers" value="<?php echo $credit_ledgers_guid ?>">
						<input type="hidden" class="form-control form-control-sm ledgerdata1" value="<?php echo implode(',', $creditLedgers); ?>" data-id="31" data-type="1" id="m_credit_ledgers" data-actualid="<?= $voucher_guid ?>" data-siteurl="<?php echo siteurl ?>" placeholder="Click here to add ledger" readonly="">

						<small href="#" class="btn btn-primary plusbtn_small " title="Create Ledger" data-id="0" data-url="<?php echo $edit_url ?>" data-action="<?php echo $action_url ?>" data-param="<?php echo $parameter ?>" data-title="Create Ledger" data-btnlabel="Save" data-dynamic="1" data-modalwidth="90" onclick="return edit_form(this)">
							<i class="icon-plus"></i>
						</small>
					</div>
				</div>

				<div class="mb-3 related-field-blocks 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 20 21 22 27 28 29 118 119" <?php if(in_array($voucher_guid, [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,20,21,22,27,28,29,118,119])) echo 'style="display:block"'; ?>>
					<label for="company">Debit Group/Ledgers</label>
					<div class="input-group" style="padding-top:10px">
						<?php
						$param = array();
						$param['guid'] = 0;
						$parameter = base64_encode(json_encode($param));
						?>
						<input type="text" class="form-control form-control-sm ledgerdata" value="<?php echo implode(',', $debit_groupname); ?>" data-id="14" data-type="2" data-actualid="<?= $voucher_guid ?>" id="debit_ledgers" data-siteurl="<?php echo siteurl ?>" placeholder="Click here to add ledger" readonly="">
						<input type="hidden" class="hledgerdata" name="debit_ledgers" id="hidden_debit_ledgers" value="<?php echo $debit_ledgers_guid ?>">
						<input type="hidden" class="form-control form-control-sm ledgerdata2" value="<?php echo implode(',', $debitLedgers); ?>" data-id="14" data-type="2" id="m_debit_ledgers" data-actualid="<?= $voucher_guid ?>" data-siteurl="<?php echo siteurl ?>" placeholder="Click here to add ledger" readonly="">

						<small href="#" class="btn btn-primary plusbtn_small" title="Create Ledger" data-id="0" data-url="<?php echo $edit_url ?>" data-action="<?php echo $action_url ?>" data-param="<?php echo $parameter ?>" data-title="Debit Ledgers" data-btnlabel="Save" data-dynamic="1" onclick="return edit_form(this)">
							<i class="icon-plus"></i>
						</small>
					</div>
				</div>

				<div class="mb-3 dis-none">
					<label for="company">VAT Ledger</label>
					<div class="input-group" style="padding-top:10px">
						<?php

						$param = array();
						$param['guid'] = 0;
						$parameter = base64_encode(json_encode($param));
						?>
						<input type="text" class="form-control form-control-sm ledgerdata" value="<?php echo implode(',', $vat_groupname); ?>" data-id="14" data-type="3" id="vat_ledgers" data-siteurl="<?php echo siteurl ?>" placeholder="Click here to add ledger" readonly="">
						<input type="hidden" class="hledgerdata" name="vat_ledgers" id="hidden_vat_ledgers" value="<?php echo $vat_ledgers_guid ?>">
						<input type="hidden" class="form-control form-control-sm ledgerdata3" value="<?php echo implode(',', $vatLedgers); ?>" data-id="14" data-type="3" id="m_vat_ledgers" data-siteurl="<?php echo siteurl ?>" placeholder="Click here to add ledger" readonly="">

						<small href="#" class="btn btn-primary plusbtn_small" title="Create Ledger" data-id="0" data-url="<?php echo $edit_url ?>" data-action="<?php echo $action_url ?>" data-param="<?php echo $parameter ?>" data-title="Vat Ledgers" data-btnlabel="Save" data-dynamic="1" onclick="return edit_form(this)">
							<i class="icon-plus"></i>
						</small>
					</div>
				</div>

				<div class="mb-3 mt-1 related-field-blocks 1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 20 21 22 27 28 29 118 119" <?php if(in_array($voucher_guid, [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,20,21,22,27,28,29,118,119])) echo 'style="display:block"'; ?>>
					<label for="company">Other Group/Ledgers</label>
					<div class="input-group" style="padding-top:10px">
						<?php
						$param = array();
						$param['guid'] = 0;
						$parameter = base64_encode(json_encode($param));
						?>
						<input type="text" class="form-control form-control-sm ledgerdata" value="<?php echo implode(',', $otherLedgers_groupname); ?>" data-id="22" data-type="4" id="other_ledgers" data-siteurl="<?php echo siteurl ?>" placeholder="Click here to add ledger" readonly="">
						<input type="hidden" class="hledgerdata" name="other_ledgers" id="hidden_other_ledgers" value="<?php echo $other_ledgers_guid; ?>">
						<input type="hidden" class="form-control form-control-sm ledgerdata4" value="<?php echo implode(',', $otherLedgers); ?>" data-id="22" data-type="4" id="m_other_ledgers" data-siteurl="<?php echo siteurl ?>" placeholder="Click here to add ledger" readonly="">
						<small href="#" class="btn btn-primary plusbtn_small" title="Create Ledger" data-id="0" data-url="<?php echo $edit_url ?>" data-action="<?php echo $action_url ?>" data-param="<?php echo $parameter ?>" data-title="Other Ledgers" data-btnlabel="Save" data-dynamic="1" onclick="return edit_form(this)">
							<i class="icon-plus"></i>
						</small>
					</div>
				</div>
				<div class="mb-3" id="showLedgerOnInvoice2" <?php if (in_array($voucher_guid, array(3, 4, 5, 6, 7, 17, 18))) echo 'style="display:block"'; ?>>
					<label for="company">Default Sales Ledger</label>
					<select name="default_sales_ledger" id="default_sales_ledger" class="form-control form-control-sm">
						<option value="0">Select Ledger</option>
						<?php
						if (in_array($voucher_guid, array(3, 4, 5, 7, 17, 18))) {
							foreach ($creditLedgers2 as $clKey => $cL) { ?>
								<?php if ($default_sales_ledger == $clKey) {  ?>
									<option selected="selected" value="<?php echo $clKey ?>"><?php echo $cL ?></option>
								<?php } else { ?>
									<option value="<?php echo $clKey ?>"><?php echo $cL ?></option>
								<?php }
							}
						} else if ($voucher_guid == 6) {
							foreach ($debitLedgers2 as $clKey => $cL) { ?>
								<?php if ($default_sales_ledger == $clKey) {  ?>
									<option selected="selected" value="<?php echo $clKey ?>"><?php echo $cL ?></option>
								<?php } else { ?>
									<option value="<?php echo $clKey ?>"><?php echo $cL ?></option>
						<?php }
							}
						}
						?>
					</select>
					<div id="sales_ledger_allow_all" <?php if (in_array($voucher_guid, array(3))) echo 'style="display:block"'; ?>>
						<input type="checkbox" name="sales_ledger_allow_all" <?php if ($data['sales_ledger_allow_all']) echo 'checked' ?> /> Allow Other Ledgers
					</div>
				</div>

				<div class="mb-3 form-group related-field-blocks 5" <?php if (in_array($voucher_guid, [5])) echo 'style="display:block"'; ?>>
					<label>Default Bank Account</label>
					<select name="default_bank_ledger" class="form-control form-control-sm">
						<option value="0">Select Bank</option>
						<?php
							$bank_ledgers = findQuery("SELECT id,name FROM erp_ledgers WHERE is_bank=1");
							foreach($bank_ledgers as $l){ 
								$selected = ($data['default_bank_ledger'] == $l['id']) ? 'selected' : '';
								echo "<option value='{$l['id']}' $selected>{$l['name']}</option>";
							}
						?>
					</select>
				</div>

				<div class="mb-3" id="showLedgerOnInvoice3" <?php if (in_array($voucher_guid, $purchase_array)) echo 'style="display:block"'; ?>>
					<label for="company">Default Purchase Ledger</label>
					<select name="default_purchase_ledger" id="default_purchase_ledger" class="form-control form-control-sm">
						<option value="0">Select Ledger</option>

						<?php
						if (in_array($voucher_guid, $debit_purchase_array)) {
							foreach ($debitLedgers2 as $dlKey => $dL) { ?>
								<?php if ($default_purchase_ledger == $dlKey) {  ?>
									<option selected="selected" value="<?php echo $dlKey ?>"><?php echo $dL ?></option>
								<?php } else { ?>
									<option value="<?php echo $dlKey ?>"><?php echo $dL ?></option>
								<?php }
							}
						} elseif ($voucher_guid == 13 || $voucher_guid == 28) {
							foreach ($creditLedgers2 as $dlKey => $dL) { ?>
								<?php if ($default_purchase_ledger == $dlKey) {  ?>
									<option selected="selected" value="<?php echo $dlKey ?>"><?php echo $dL ?></option>
								<?php } else { ?>
									<option value="<?php echo $dlKey ?>"><?php echo $dL ?></option>
						<?php }
							}
						}
						?>
					</select>
				</div>
				<?php if (in_array($voucher_guid, array(0, 9, 10, 11, 12, 13, 28))) { ?>
					<table id="dynamicplTable" border="1" cellspacing="0" cellpadding="5" class="table table-bordered table-sm">
						<thead>
							<tr>
								<th class="center" style="min-width:9.5pc">Supplier Group</th>
								<th class="center" style="min-width:9.5pc">Purchase Ledger</th>
								<th class="center" style="min-width:2.5pc">Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select class="cgroup-demo form-control form-control-sm  hidden " data-selected="<?= 0 ?>">
										<?php
										echo '<option value="0" selected="selected">Select Group</option>';
										for ($i = 0; $i < count($onlyGroup); $i++) {
											$name = $onlyGroup[$i]['name'];
											$acc_id = (int)$onlyGroup[$i]['id'];

											$parent_guid_2  = (int)$onlyGroup[$i]['parent_guid'];
											if ($parent_guid_2 == 0) $color = "blue";
											else $color = 'grey';

											echo '<option data-color="' . $color . '"  value="' . $acc_id . '" >' . $name . '</option>';
										}
										?>
									</select>
								</td>
								<td>
									<select class=" form-control form-control-sm ledger hidden" data-selected="<?= 0 ?>">
										<!-- <option value="<?= $data['svc_item'] ?>"><?= rowvalue($data['svc_item'], "erp_products", "name") ?></option> -->
									</select>
								</td>
								<td>
									<button class="addplRow btn btn-sm btn-info" type="button">+</button>
								</td>
							</tr>
							<?php if ($data['sup_grp']) {
								$purLedgerArr = explode(',', (string)$data['pur_ledgr']);
								foreach (explode(',', (string)$data['sup_grp']) as $index => $supGrp) { ?>
									<tr>
										<td>
											<select name="sup_grp[]" class="cgroup-demo cgroup form-control form-control-sm   " data-selected="<?= 0 ?>">
												<?php
												echo '<option value="0" selected="selected">Select Group</option>';
												for ($i = 0; $i < count($onlyGroup); $i++) {
													$name = $onlyGroup[$i]['name'];
													$acc_id = (int)$onlyGroup[$i]['id'];

													$parent_guid_2  = (int)$onlyGroup[$i]['parent_guid'];
													if ($parent_guid_2 == 0) $color = "blue";
													else $color = 'grey';
													if ($supGrp == $acc_id) echo '<option data-color="' . $color . '"  value="' . $acc_id . '" selected>' . $name . '</option>';
													else 	echo '<option data-color="' . $color . '"  value="' . $acc_id . '" >' . $name . '</option>';
												}
												?>
											</select>
										</td>
										<td>
											<select name="pur_ledgr[]" class=" form-control form-control-sm ledger compliment-gl" data-selected="<?= $purLedgerArr[$index] ?>">
												<!-- <option value="<?= $data['svc_item'] ?>"><?= rowvalue($data['svc_item'], "erp_products", "name") ?></option> -->
											</select>
										</td>
										<td>
											<button class="removeplRow btn btn-sm btn-info" type="button">-</button>
										</td>
									</tr>
							<?php }
							} ?>
						</tbody>
					</table>

				<?php } ?>
				<div class="mb-3 form-group related-field-blocks 31" <?php if ($voucher_guid == 31) echo 'style="display:block"'; ?>>
					<label>Deliverable SO Voucher</label>
					<select name="salesorder_voucher" id="salesorder_voucher" class="form-control form-control-sm">
						<option value="0">Select Voucher</option>
						<?php
						$so_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid=3 AND status='1'");
						foreach ($so_vouchers as $v) {
							$id = $v['id'];
							$title = $v['title'];
							$selected = ($id == $data['salesorder_voucher']) ? 'selected' : '';
							echo "<option value='$id' $selected>$title</option>";
						}
						?>
					</select>
					<div class="checkbox-group">
						<input type="checkbox" name="project_ref_as_so_ref" value="1" <?php if ($data['project_ref_as_so_ref']) echo 'checked' ?>>
						<label>Use Project Code as SO Ref</label>
					</div>
				</div>

				<div class="mb-3 form-group dis-none" <?php if ($voucher_guid == 3 || $voucher_guid == 18 || ($voucher_guid == 5 && !$credit_sales_control)) echo 'style="display:block"'; ?>>
					<label>Receipt Voucher</label>
					<select name="receipt_voucher" id="receipt_voucher" class="form-control form-control-sm">
						<option value="0">Select Voucher</option>
						<?php
						$receipt_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid=25 AND status='1'");
						foreach ($receipt_vouchers as $v) {
							$id = $v['id'];
							$title = $v['title'];
							$selected = ($id == $data['receipt_voucher']) ? 'selected' : '';
							echo "<option value='$id' $selected>$title</option>";
						}
						?>
					</select>
				</div>

				<div class="mb-3 form-group related-field-blocks 5 10 12 21" <?php if(in_array($voucher_guid, [5,10,12,21]) || ($voucher_guid == 19 && ($data['damage_stock_disposal'] || $data['stock_consumption']))) echo 'style="display:block"'; ?>>
					<label>Journal Voucher</label>
					<select name="journal_voucher" id="journal_voucher" class="form-control form-control-sm">
						<option value="0">Select Voucher</option>
						<?php
						$journal_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid=27 AND status='1'");
						foreach ($journal_vouchers as $v) {
							$id = $v['id'];
							$title = $v['title'];
							$selected = ($id == $data['journal_voucher']) ? 'selected' : '';
							echo "<option value='$id' $selected>$title</option>";
						}
						?>
					</select>
				</div>

				<!-- <div class="mb-3 form-group related-field-blocks 21" <?php if(in_array($voucher_guid, [21])) echo 'style="display:block"'; ?>>
					<a class="clickable" onclick="ps_journal_ledgers(this)">Journal Debit & Credit Ledgers</a>
					<input type="text" class="ps-journal-ledgers" name="ps_journal_ledgers">
				</div> -->

				<?php $journal_ps_ledgers = json_decode($data['journal_ps_ledgers'], true); ?>
				<div class="mb-3 form-group related-field-blocks 5 10 12 21" <?php if(in_array($voucher_guid, [5,10,12,21]) || ($voucher_guid == 19 && ($data['damage_stock_disposal'] || $data['stock_consumption']))) echo 'style="display:block"'; ?>>
					<label>Journal Credit Ledger</label>
					<select class="form-control form-control-sm" name="journal_credit_ledger">
						<?php 
							if($data['journal_credit_ledger']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$data['journal_credit_ledger']})");
								echo "<option value='{$data['journal_credit_ledger']}' selected>{$journal_ledgers[$data['journal_credit_ledger']]['name']}</option>";
							}
						?>
					</select>
				</div>

				<?php if (erp_menu('project_management')) { ?>
					<div class="mb-3 form-group related-field-blocks 5 10 12" <?php if(in_array($voucher_guid, [5,10,12]) || ($voucher_guid == 19 && $data['stock_consumption'] && $data['project_stock_consumption']) || ($voucher_guid == 21 && $data['project_physicalstock'])) echo 'style="display:block"'; ?>>
						<label>Journal Debit Ledger Group</label>
						<select name="journal_debit_ledger_group" class="form-control form-control-sm">
							<option value="0">Select Ledger Group</option>
							<?php
							$project_ledger_groups = findQuery("SELECT id,name FROM erp_ledgers WHERE projects_group=1");
							foreach ($project_ledger_groups as $l) {
								$id = $l['id'];
								$name = $l['name'];
								$selected = ($id == $data['journal_debit_ledger_group']) ? 'selected' : '';
								echo "<option value='$id' $selected>$name</option>";
							}
							?>
						</select>
					</div>
				<?php } ?>

				<div class="mb-3 form-group related-field-blocks" <?php if(($voucher_guid == 19 && ($data['stock_consumption'] || $data['damage_stock_disposal']) && !$data['project_stock_consumption']) || ($voucher_guid == 21 && !$data['project_physicalstock'])) echo 'style="display:block"'; ?>>
					<label>Journal Debit Ledgers</label>
					<select class="form-control form-control-sm" name="journal_debit_ledgers[]" multiple>
						<?php 
							if($data['journal_debit_ledgers']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$data['journal_debit_ledgers']})");
								foreach($journal_ledgers as $l){
									echo "<option value='{$l['id']}' selected>{$l['name']}</option>";
								}
							}
						?>
					</select>
				</div>

				<div class="mb-3 form-group related-field-blocks 21" <?php if(in_array($voucher_guid, [21])) echo 'style="display:block"'; ?>>
					<label>Journal Credit Ledger (Stock Addition)</label>
					<select class="form-control form-control-sm" name="journal_ps_ledgers[cr_add][]">
						<?php
							if($ledger_ids = implode(',', (array)$journal_ps_ledgers['cr_add'])){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ($ledger_ids)");
								foreach($journal_ledgers as $l){
									echo "<option value='{$l['id']}' selected>{$l['name']}</option>";
								}
							}
						?>
					</select>
				</div>

				<div class="mb-3 form-group related-field-blocks" <?php if($voucher_guid == 21 && !$data['project_physicalstock']) echo 'style="display:block"'; ?>>
					<label>Journal Debit Ledgers (Stock Addition)</label>
					<select class="form-control form-control-sm" name="journal_ps_ledgers[dr_add][]" multiple>
						<?php 
							if($ledger_ids = implode(',', (array)$journal_ps_ledgers['dr_add'])){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ($ledger_ids)");
								foreach($journal_ledgers as $l){
									echo "<option value='{$l['id']}' selected>{$l['name']}</option>";
								}
							}
						?>
					</select>
				</div>

				<div class="mb-3 form-group related-field-blocks" <?php if(($voucher_guid == 19 && ($data['stock_consumption'] || $data['damage_stock_disposal']) && !$data['project_stock_consumption']) || ($voucher_guid == 21 && !$data['project_physicalstock'])) echo 'style="display:block"'; ?>>
					<div class="checkbox-group">
						<input type="checkbox" name="journal_debit_ledger_from_item_category" value="1" <?php if($data['journal_debit_ledger_from_item_category']) echo 'checked' ?>>
						<label>Debit Ledger from Item Group</label>
					</div>
				</div>

				<?php if (erp_menu('project_management')) { ?>
					<div class="mb-3 form-group related-field-blocks 5 10 12" <?php if(in_array($voucher_guid, [5,10,12]) || ($voucher_guid == 19 && $data['stock_consumption'] && $data['project_stock_consumption']) || ($voucher_guid == 21 && $data['project_physicalstock'])) echo 'style="display:block"'; ?>>
						<label>Admin OH Credit Ledger</label>
						<select name="journal_admin_oh_ledger" class="form-control form-control-sm">
							<option value="0">Select Ledger</option>
							<optgroup label="Direct Expense">
								<?php
								$direct_exp = accountGroupTree(19);
								foreach ($direct_exp as $l) {
									$id = $l['id'];
									$name = $l['name'];
									if (!$l['is_ledger']) {
										echo "<optgroup label='$name'>";
										continue;
									}
									$selected = ($id == $data['journal_admin_oh_ledger']) ? 'selected' : '';
									echo "<option value='$id' $selected>$name</option>";
								}
								?>
							</optgroup>
						</select>
					</div>

					<div class="mb-3 form-group related-field-blocks 5 10 12" <?php if(in_array($voucher_guid, [5,10,12]) || ($voucher_guid == 19 && $data['stock_consumption'] && $data['project_stock_consumption']) || ($voucher_guid == 21 && $data['project_physicalstock'])) echo 'style="display:block"'; ?>>
						<label>Factory OH Credit Ledger</label>
						<select name="journal_factory_oh_ledger" class="form-control form-control-sm">
							<option value="0">Select Ledger</option>
							<optgroup label="Direct Expense">
								<?php
								foreach ($direct_exp as $l) {
									$id = $l['id'];
									$name = $l['name'];
									if (!$l['is_ledger']) {
										echo "<optgroup label='$name'>";
										continue;
									}
									$selected = ($id == $data['journal_factory_oh_ledger']) ? 'selected' : '';
									echo "<option value='$id' $selected>$name</option>";
								}
								?>
							</optgroup>
						</select>
					</div>

					<div class="mb-3 form-group related-field-blocks 5 10 12" <?php if(in_array($voucher_guid, [5,10,12]) || ($voucher_guid == 19 && $data['stock_consumption'] && $data['project_stock_consumption']) || ($voucher_guid == 21 && $data['project_physicalstock'])) echo 'style="display:block"'; ?>>
						<label>Other OH Credit Ledger</label>
						<select name="journal_other_oh_ledger" class="form-control form-control-sm">
							<option value="0">Select Ledger</option>
							<optgroup label="Direct Expense">
								<?php
								foreach ($direct_exp as $l) {
									$id = $l['id'];
									$name = $l['name'];
									if (!$l['is_ledger']) {
										echo "<optgroup label='$name'>";
										continue;
									}
									$selected = ($id == $data['journal_other_oh_ledger']) ? 'selected' : '';
									echo "<option value='$id' $selected>$name</option>";
								}
								?>
							</optgroup>
						</select>
					</div>
				<?php } ?>

				<!-- <div class="form-check paddingbtm" <?php if ($voucher_guid != 12) echo 'style="display:none"'; ?>>
        	<input class="form-check-input" name="customer_details_on_purchase" type="checkbox" value="1" id="ShowCustomerDetails" <?php if ($data['customer_details_on_purchase'] == 1) echo 'checked'; ?>>
			<label class="form-check-label" for="ShowCustomerDetails">Show Customer Details</label>
       	</div> -->

				<div class="form-check paddingbtm" <?php if (!in_array($voucher_guid, [12, 10, 3])) echo 'style="display:none"'; ?>>
					<input class="form-check-input" name="auto_purchase_delivery_note" type="checkbox" value="1" id="AutoPurchaseDeliveryNote" <?php if ($data['auto_purchase_delivery_note'] == 1) echo 'checked'; ?> onchange="ShowAutoDeliveryNoteVoucher(this)">
					<label class="form-check-label" for="AutoPurchaseDeliveryNote">Auto Delivery Note</label>
				</div>

				<div class="mb-3 form-group" <?php if (!in_array($voucher_guid, [12, 10, 3])  && !$data['auto_deliverynote_voucher']) echo 'style="display:none"'; ?>>
					<label for="auto_deliverynote_voucher">Auto Delivery Note Voucher</label>
					<select name="auto_deliverynote_voucher" id="auto_deliverynote_voucher" class="form-control form-control-sm">
						<option value="0">Select Voucher Type</option>
						<?php
						$dn_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid = 4 AND status = '1'");
						foreach ($dn_vouchers as $vtype) {
							$selected = ($vtype['id'] == $data['auto_deliverynote_voucher']) ? 'selected' : '';
							echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
						} ?>
					</select>
				</div>
				<?php if ((int)$_SESSION['menu']['insurance_management']) { ?>

					<div class="mb-3 form-group related-field-blocks 4" <?php if ($voucher_guid == 4) echo 'style="display:block"'; ?>>
						<label for="auto_salesreturn_voucher">Brokerage Credit Note Voucher</label>
						<select name="auto_salesreturn_voucher" id="auto_salesreturn_voucher" class="form-control form-control-sm">
							<option value="0">Select Voucher Type</option>
							<?php
							$sr_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid = 6 AND status = '1'");
							foreach ($sr_vouchers as $vtype) {
								$selected = ($vtype['id'] == $data['auto_salesreturn_voucher']) ? 'selected' : '';
								echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
							} ?>
						</select>
					</div>
				<?php } ?>

				<?php //if((int)$_SESSION['menu']['room_reservation']){ 
				?>
				<!-- <div class="mb-3 form-group related-field-blocks 3" <?php //if(in_array($voucher_guid, [3])) echo 'style="display:block"'; 
																			?>>
			<label for="auto_deliverynote_voucher">Auto Delivery Note Voucher</label>
			<select name="auto_deliverynote_voucher" id="auto_deliverynote_voucher"class="form-control form-control-sm">
				<option value="0">Select Voucher Type</option>
				<?php
				// $dn_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid = 4 AND status = '1'");
				// foreach($dn_vouchers as $vtype){ 
				// 	$selected = ($vtype['id'] == $data['auto_deliverynote_voucher']) ? 'selected' : '';
				// 	echo "<option value='".$vtype['id']."' $selected>".$vtype['title']."</option>";
				// } 
				?>
			</select>
		</div> -->
				<?php // } 
				?>

				<div class="mb-3 form-group related-field-blocks 4" <?php if (in_array($voucher_guid, [4])) echo 'style="display:block"'; ?>>
					<label for="def_sales_voucher">Default Sales Voucher</label>
					<select name="def_sales_voucher" id="def_sales_voucher" class="form-control form-control-sm">
						<option value="0">Select Voucher Type</option>
						<?php
						$sales_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid = 5 AND status = '1'");
						foreach ($sales_vouchers as $vtype) {
							$selected = ($vtype['id'] == $data['def_sales_voucher']) ? 'selected' : '';
							echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
						} ?>
					</select>
				</div>

				<div class="mb-3 form-group related-field-blocks 6 12 17" <?php if (in_array($voucher_guid, [6,12,17])) echo 'style="display:block"'; ?>>
					<label for="def_payment_voucher">Payment Voucher</label>
					<select name="def_payment_voucher" id="def_payment_voucher" class="form-control form-control-sm">
						<option value="0">Select Voucher Type</option>
						<?php
						$sales_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid = 26 AND status = '1'");
						foreach ($sales_vouchers as $vtype) {
							$selected = ($vtype['id'] == $data['def_payment_voucher']) ? 'selected' : '';
							echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
						} ?>
					</select>
				</div>
				<div class="mb-3 form-group related-field-blocks  cash_gl_div" <?php if (in_array($voucher_guid, [17, 18, 5, 6, 25])) echo 'style="display:block"'; ?>>
					<div style="max-width:50%">
						<label for="cash_gl"> Cash Ledger</label>
						<select name="cash_gl" id="cash_gl" class="form-control form-control-sm">
							<option value="0">Select Ledger</option>
							<?php
							$cashLedgers = findQuery("SELECT id,name FROM erp_ledgers WHERE is_cash = 1 AND is_ledger =  1 ");
							foreach ($cashLedgers as $CashGL) {
								$selected = ($CashGL['id'] == $data['cash_gl']) ? 'selected' : '';
								echo "<option value='" . $CashGL['id'] . "' $selected>" . $CashGL['name'] . "</option>";
							} ?>
						</select>
					</div>
					<!-- <div> -->
					<!-- <label for="cheque_gl"> Cheque Ledger</label>
				<select name="cheque_gl" id="cheque_gl"class="form-control form-control-sm">
					<option value="0">Select Ledger</option>
					<?php
					// $chequeLedgers = findQuery("SELECT id,name FROM erp_ledgers WHERE is_check = 1 AND is_ledger =  1 ");
					// foreach($chequeLedgers as $ChequeGL){ 
					// 	$selected = ($ChequeGL['id'] == $data['cheque_gl']) ? 'selected' : '';
					// 	echo "<option value='".$ChequeGL['id']."' $selected>".$ChequeGL['name']."</option>";
					// }
					?>
				</select> -->
					<!-- </div> -->

				</div>
				<?php
				if ($voucher_guid == 18 || $voucher_guid == 17 || $voucher_guid == 0) {
					$groupsAR = accountGroupOnly(14);
				} ?>
				<div class="mb-3 related-field-blocks 18 17" id="def_cust_div" style="width: 48%; <?php if ($voucher_guid == 18 || $voucher_guid == 17) echo 'display:block';
																									else echo 'display:none'; ?>">
					<label>Default Customer Group <a href="javascript:void(0)"><i class="icon-info text-info " data-toggle="tooltip" title="Counter user can only create temporaryy customers."></i></a></label>
					<div class="input-group">
						<select class="form-control form-control-sm" name="def_cust_grp" id="def_cust_grp">
							<option value="0">Select Default Customer Group</option>
							<?php
							foreach ($groupsAR as $grp) {
								if ($grp['id'] == $data['def_cust_grp']) {
									echo "<option value=" . $grp['id'] . " selected >" . $grp['name'] . "</option>";
								} else {
									echo "<option value=" . $grp['id'] . " >" . $grp['name'] . "</option>";
								}
							}
							?>
						</select>
					</div>
				</div>
				<div id="process_purchase_voucher_div" class="mb-3 form-group related-field-blocks 17" <?php if (in_array($voucher_guid, [11, 10])) echo 'style="display:block"'; ?>>
					<label for="lc_process_voucher">Auto Purchase Voucher (Posting in Backend [GRN Expense]) </label>
					<select name="lc_process_voucher" id="lc_process_voucher" class="form-control form-control-sm">
						<option value="0">Select Purchase Voucher</option>
						<?php
						foreach ($purchase_vouchers as $vtype) {
							$selected = ($vtype['id'] == $data['lc_process_voucher']) ? 'selected' : '';
							echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
						} ?>
					</select>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="row">
					<?php
					if ($voucher_guid == 118) {
						$store_css = "display:none;";
					}
					?>
					<div class="mb-3 col-lg-6 store pr-0" style="<?= $store_css ?>">
						<div style="width: 8pc;display: inline-block;">
							<label for="company">Store</label>
							<div class="input-group" style="padding-top:10px">
								<select class="form-control form-control-sm " id="store_guid" name="store_guid">
									<?php echo array_options($storeArray, $store_guid);	?>
								</select>
							</div>
						</div>
						<label style="width: 4.5pc;display: inline-block;">
							<input type="checkbox" name="change_permitted" <?= ($data['change_perm'] == 1) ? 'checked' : '' ?> /> Change
						</label>
					</div>
					<div class="mb-3 col-lg-6 voucher118" style="<?php if ($voucher_guid == '118') echo 'display:block';
																	else echo 'display:none'; ?>">
						<label for="company">Consumption Store</label>
						<div class="input-group" style="padding-top:10px">
							<select class="form-control form-control-sm " id="consumption_store_guid" name="consumption_store_guid">
								<?php echo array_options($storeArray, $consumption_store_guid);	?>
							</select>
						</div>
					</div>
					<div class="mb-3 col-lg-6 voucher118" id="productionStore" style="<?php if ($voucher_guid == '118') echo 'display:block;';
																						else echo 'display:none;'; ?> <?php if ($data['manufacture_on_sales'] == 1) echo 'filter:blur(1px)'; ?> ">
						<label for="company">Production Store</label>
						<div class="input-group" style="padding-top:10px">
							<select class="form-control form-control-sm " id="production_store_guid" name="production_store_guid">
								<?php echo array_options($storeArray, $production_store_guid);	?>
							</select>
						</div>
					</div>
					<div class="mb-3 col-lg-6 voucher118" style="<?php if ($voucher_guid == '118') echo 'display:block';
																	else echo 'display:none'; ?>">
						<label for="company">Scrap Store</label>
						<div class="input-group" style="padding-top:10px">
							<select class="form-control form-control-sm " id="scrap_store_guid" name="scrap_store_guid">
								<?php echo array_options($storeArray, $scrap_store_guid);	?>
							</select>
						</div>
					</div>
					<div class="mb-3 col-lg-6">
						<label>Sales Man</label>
						<div class="input-group" style="padding-top:10px">
							<select class="form-control form-control-sm" name="salesman_guid" id="salesman_guid">
								<option>Select Sales Man</option>
								<?php
								foreach ($sales_data as $key => $data_sales) {
									if ($data_sales['id'] == $salesman_guid) {
										echo "<option value=" . $data_sales['id'] . " selected >" . $data_sales['name'] . "</option>";
									} else {
										echo "<option value=" . $data_sales['id'] . " >" . $data_sales['name'] . "</option>";
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="mb-3 col-lg-6 related-fields 5 12 25 26" style="<?php if (in_array($voucher_guid, [5, 12, 25, 26])) echo 'display:block';
																				else echo 'display:none'; ?>">
						<label>Cost Category</label>
						<div class="input-group " style="padding-top:10px">
							<select class="form-control form-control-sm hidden cateogy_cost" name="cost_category_guid[]" id="example-getting-started2" multiple="multiple" class="form-control">
								<?php
								foreach ($cost_categories as $cost_category) { ?>
									<?php
									$selected = '';

									if (in_array($cost_category['id'], $current_cost_categories)) $selected = ' selected="selected" ';
									?>
									<option value="<?= $cost_category['id'] ?>" <?= $selected ?>><?= $cost_category['name'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="mb-3 col-lg-6 related-fields 5 12 25 26" style="<?php if (in_array($voucher_guid, [5, 12, 25, 26]))  echo 'display:block';
																				else echo 'display:none'; ?>">
						<label>Cost Center</label>
						<div class="input-group" style="padding-top:10px">
							<select class="form-control form-control-sm hidden mlt example-getting-started" name="cost_center_guid[]" id="example-getting-started3" multiple="multiple" class="form-control">
								<?php
								foreach ($cost_centers as $cost_center) { ?>
									<?php
									$selected = '';

									if (in_array($cost_center['id'], $current_cost_centers)) $selected = ' selected="selected" ';
									?>
									<option value="<?= $cost_center['id'] ?>" <?= $selected ?>><?= $cost_center['name'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<?php if (erp_menu('project_management')) { ?>
					<div class="mb-2 form-group related-field-blocks 29" <?php if ($voucher_guid == 29) echo 'style="display:block"'; ?>>
						<label for="auto_salesreturn_voucher">Project</label>
						<select name="project_id" class="selectize-field" placeholder="Select Project">
							<option value=""></option>
							<?php
							$projects = findQuery("SELECT id,title FROM pm_projects ORDER BY date DESC, id DESC");
							foreach ($projects as $p) {
								$selected = ($p['id'] == $data['project_id']) ? 'selected' : '';
								echo "<option value='" . $p['id'] . "' $selected>" . $p['title'] . "</option>";
							}
							?>
						</select>
					</div>
				<?php } ?>

				<div class="row mb-2">
					<div class="col-md-6">
						<label for="company">Price List</label>
						<div class="input-group">
							<select class="form-control form-control-sm " id="pricelist_guid" name="pricelist_guid">
								<?php echo array_options($priceList, $data['pricelist_guid']); ?>
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<label>Cut-Off Date</label>
						<input type="text" class="form-control form-control-sm" name="cut_off_date" data-attr="date" value="<?= dp_date($data['cut_off_date']) ?>">
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="mb-2">
							<label for="company">Promotion</label>
							<!-- <div class="input-group" style="padding-top:10px">
						<select class="form-control form-control-sm " id= "promotion_guid" name="promotion_guid">
							<?php
							//echo array_options($promoList,$data['promotion_guid']);
							?>
						</select>
					</div> -->
							<?php
							$promotion_arr = explode(",", $data['promotion_guid']); ?>
							<div class="dropdown ">
								<button class="form-control dropdown-toggle text-left" type="button" data-toggle="dropdown">
									<span class="mdropdown-text text-dark"> <?php if (count($promotion_arr) > 0 && $promotion_arr[0] > 0) echo count($promotion_arr) . " Promotion Selected";
																			else echo "Select Promotion"; ?></span>
									<span class="caret"></span></button>
								<ul class="dropdown-menu " style="padding-left:5px;">
									<li><label><input type="checkbox" class="mselectall" <?php if (count($promotion) == count($promotion_arr)) echo "checked"; ?> /><span class="mselect-text"> Select</span> All</label></li>
									<li class="divider"></li>
									<?php

									foreach ($promotion as $promo) {
										$checked = "";
										if (in_array($promo['id'], $promotion_arr)) {
											$checked = "checked";
										} ?>
										<li><label><input name='moptions[]' type="checkbox" <?= $checked ?> class="moption justone" value="<?= $promo['id'] ?>" /> <?= $promo['name'] ?></label></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<div class="mb-2 related-field-blocks 19" <?php if (in_array($voucher_guid, [19])) echo 'style="display:block"'; ?>>
							<label>Product Groups</label>
							<select class="form-control form-control-sm product_groups" name="product_groups[]" multiple>
								<?php 
									$product_groups = find_rows("SELECT id,name FROM erp_product_groups WHERE is_active=1");
									$product_groups_selected = explode(',', $data['product_groups']);
									foreach($product_groups as $g){
										$selected = in_array($g['id'], $product_groups_selected) ? 'selected' : '';
										echo "<option value='{$g['id']}' $selected>{$g['name']}</option>";
									}
								?>
							</select>
						</div>
					</div>
				</div>

				<?php if (erp_menu('project_management')) { ?>
					<div class="mb-2 related-field-blocks 1 15 19 29 32" <?php if (in_array($voucher_guid, [1, 15, 19, 29, 32])) echo 'style="display:block"'; ?>>
						<label>Project Type</label>
						<?php
						$project_types = find_rows("SELECT id,name FROM pm_project_types");
						$ptypes_selected = $data['project_types'] ? explode(',', $data['project_types']) : array();
						?>
						<div class="dropdown">
							<button class="form-control from-control-sm dropdown-toggle text-left" type="button" data-toggle="dropdown">
								<span class="button-text text-dark">
									<?php
									if ($ptypes_selected) {
										if (count($ptypes_selected) == 1) {
											echo $project_types[$ptypes_selected[0]]['name'];
										} else {
											echo count($ptypes_selected) . ' Selected';
										}
									} else {
										echo 'Select Project Type';
									}
									?>
								</span>
								<span class="caret"></span>
							</button>

							<ul class="dropdown-menu pl-1">
								<?php
								foreach ($project_types as $ptype) {
									$checked = in_array($ptype['id'], $ptypes_selected) ? 'checked' : '';
								?>
									<li class="checkbox-group p-1">
										<input type="checkbox" name="project_types[]" class="ptype-select" value="<?= $ptype['id'] ?>" <?= $checked ?> />
										<label class="pl-1"><?= $ptype['name'] ?></label>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				<?php } ?>

				<div class="row" style="padding-bottom:8px">
					<div class="col-md-12">
						<?php if ($guid && !$copy) { ?>
							<label>Voucher Ref</label>
							<table class="table table-sm mb-1">
								<thead>
									<th class="center" style="font-size:12px;">Date</th>
									<th class="center" style="font-size:12px;">Prefix</th>
									<th class="center" style="font-size:12px;">Suffix</th>
									<th class="center" style="font-size:12px;">Start</th>
									<th class="center" style="font-size:12px;">Result</th>
									<th class="center" style="font-size:12px;">#</th>
								</thead>
								<tbody>
									<?php foreach ($reff as $r) { ?>
										<tr>
											<td class="center"><?= formatDate($r['date']) ?></td>
											<td class="center"><?= $r['prefix'] ?></td>
											<td class="center"><?= $r['suffix'] ?></td>
											<td class="center"><?= $r['start_num'] ?></td>
											<td class="center"><?= $r['result'] ?></td>
											<td class="center">
												<a href="#"
													data-id="<?= $r['id'] ?>"
													data-date="<?= $r['date'] ?>"
													data-prefix="<?= $r['prefix'] ?>"
													data-suffix="<?= $r['suffix'] ?>"
													data-start_num="<?= $r['start_num'] ?>"
													data-total_digit="<?= $r['total_digit'] ?>"
													data-prefilwithzero="<?= $r['prefilwithzero'] ?>"
													data-revision-prefix="<?= $r['revision_prefix'] ?>"
													data-result="<?= $r['result'] ?>"
													onclick="erp_edit_voucher_ref(this)"><i class="far fa-edit"></i>
												</a>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						<?php } ?>
					</div>
				</div>
				<div class="new_voucher_ref <?php if ($guid && !$copy) echo 'dis-none' ?>">
					<input type="hidden" name="new_trn_ref" id="new_trn_ref" value="0">
					<input type="hidden" name="trn_ref_id" id="trn_ref_id" value="0">
					<div class="row" style="padding-bottom:8px">
						<div class="col-lg-6">
							<label for="company">Date</label>
							<div class="input-group" style="padding-top:4px">
								<input type="date" class="form-control form-control-sm " value="<?php if ($reff) echo $reff[0]['date'];
																								else echo $_SESSION['COMPANY_SETTINGS']['financial_year']; ?>" name="date" id="date_qutref" required>
							</div>
						</div>
						<div class="col-lg-6 related-field-blocks 14" <?php if ($voucher_guid == 14) echo 'style="display:block"'; ?>>
							<label for="company">Revision Prefix</label>
							<div class="input-group" style="padding-top:4px">
								<input type="text" class="form-control form-control-sm" name="revision_prefix" id="revision_prefix">
							</div>
						</div>
					</div>
					<div class="row" style="padding-bottom:8px">
						<div class="col-lg-6">
							<label for="company">Prefix</label>
							<div class="input-group" style="padding-top:4px">
								<input type="text" class="form-control form-control-sm ts " name="prefix" id="prefix" required>
							</div>
						</div>
						<div class="col-lg-6">
							<label for="company">Sufix</label>
							<div class="input-group" style="padding-top:4px">
								<input type="text" class="form-control form-control-sm ts" name="suffix" id="suffix" class="suffix" required>
							</div>
						</div>
					</div>
					<div class="row" style="padding-bottom:8px">
						<div class="col-lg-6">
							<label for="company">Prefix With Zero</label>
							<div class="input-group" style="padding-top:4px">
								<select class="form-control form-control-sm ts" id="prefilwithzero" name="prefilwithzero">
									<option value="yes">Yes</option>
									<option value="no">No</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<label for="company">Starting Number</label>
							<div class="input-group" style="padding-top:4px">
								<input type="number" class="form-control form-control-sm ts" name="start_num" id="start_num" required>
							</div>
						</div>
					</div>
					<div class="row" style="padding-bottom:8px">
						<div class="mb-1 col-lg-6">
							<label for="company">Total Digit</label>
							<div class="input-group" style="padding-top:4px">
								<input type="number" class="form-control form-control-sm ts " name="total_digit" id="total_digit" required>
							</div>
						</div>
						<div class="col-lg-6">
							<label for="company">Result</label>
							<div class="input-group" style="padding-top:4px">
								<input type="text" class="form-control form-control-sm " name="result" id="result" readonly>
							</div>
						</div>
					</div>
				</div>
				<?php if ($guid && !$copy) { ?>
					<div class="pb-2 pt-2">
						<a class="text-primary" href="#" data-open="0" onclick="erp_new_voucher_ref(this)">New Voucher Ref</a>
					</div>
				<?php } ?>

				<div class="mb-3 checkbox-group related-field-blocks 25" <?php if ($voucher_guid == 25) echo 'style="display:block"'; ?>>
					<input type="checkbox" name="use_doc_ref" value="1" <?php if ($data['use_doc_ref']) echo 'checked' ?> />
					<label class="checkbox-label">Use Doc Ref as Receipt Ref in SO Advance/Non Credit Sales
				</div>

				<!--
		<div class="mb-2">
			<label for="company">Printer</label>
			<div class="input-group" style="padding-top:10px">
				<input type="text" class="form-control form-control-sm " value="<?php //if ($data['printer']) echo $data['printer'] 
																				?>" name="printer" id="printer" >
			</div>
		</div>
		-->
				<div class="mt-3" id="showLedgerOnInvoice" <?php if (in_array($voucher_guid, [5, 6, 3, 7, 25, 26, 30, 12]))  echo 'style="display:block"'; ?>>
					<label for="company">View On Invoice</label>
					<div class="input-group" style="padding-top:10px">
						<?php

						$param = array();
						$param['guid'] = 0;
						$parameter = base64_encode(json_encode($param));
						?>
						<input type="text"
							class="form-control form-control-sm ledgerdata"
							value="<?php echo implode(',', $cashBankLedgers_groupname); ?>"
							data-id="5"
							data-type="5"
							id="cash_bank_ledgers"
							data-siteurl="<?php echo siteurl ?>"
							placeholder="Click here to add ledger"
							readonly="">
						<input type="hidden" name="cash_bank_ledgers" id="hidden_cash_bank_ledgers" value="<?php echo $cash_bank_ledgers_guid ?>">
						<input type="hidden"
							class="form-control form-control-sm ledgerdata5"
							value="<?php echo implode(',', $cashBankLedgers); ?>"
							data-id="5"
							data-type="5"
							id="m_cash_bank_ledgers"
							data-siteurl="<?php echo siteurl ?>"
							placeholder="Click here to add ledger"
							readonly="">
						<small href="#" class="btn btn-primary plusbtn_small" title="Create Ledger" data-id="0" data-url="<?php echo $edit_url ?>" data-action="<?php echo $action_url ?>" data-param="<?php echo $parameter ?>" data-title="" data-btnlabel="Save" data-dynamic="1" onclick="return edit_form(this)">
							<i class="icon-plus"></i>
						</small>
					</div>
				</div>

				<div class="mb-3 related-field-blocks 25 26" <?php if (in_array($voucher_guid, [25,26])) echo 'style="display:block"'; ?>>
					<div class="checkbox-group">
						<input type="checkbox" name="allow_multiple_payment_method" value="1" <?php if ($data['allow_multiple_payment_method']) echo 'checked' ?> />
						<label>Allow multiple ledger selection</label>
					</div>
				</div>

				<?php
				$custom_pdf_vouchers = findQuery('SELECT voucher_guid FROM erp_print_formats GROUP BY voucher_guid');
				$custom_pdf_vouchers = array_column($custom_pdf_vouchers, 'voucher_guid');
				?>
				<div class="related-field-blocks 2 3 4 5 6 8 9 10 14 15 29" <?php if (in_array($voucher_guid, [2, 3, 4, 5, 6, 8, 9, 10, 12, 14, 15, 29])) echo 'style="display:block"'; ?>>
					<label for="company">Default PDF Format</label>
					<select class="form-control form-control-sm" name="default_pdf_format" id="default_pdf_format">
						<option value="0">Select Format</option>
						<?php
							if($default_pdf_format = $data['default_pdf_format']){
								echo "<option value='$default_pdf_format' selected> Format $default_pdf_format </option>";
							}
						?>
					</select>
					<!-- <select name="default_pdf_format" id="default_pdf_format" class="form-control form-control-sm">
						<option value="0">Select Format</option>
						<option value="1" <?php if ($data['default_pdf_format'] == '1') echo 'selected'; ?> data-vouchers="0,2,3,4,5,6,8,9,10,12,14,15,29">Format 1</option>
						<option value="2" <?php if ($data['default_pdf_format'] == '2') echo 'selected'; ?> data-vouchers="0,3,5,6,9,10,12,15">Format 2</option>
						<option value="3" <?php if ($data['default_pdf_format'] == '3') echo 'selected'; ?> data-vouchers="0,2,3,5,9,10,15">Format 3</option>
						<option value="4" <?php if ($data['default_pdf_format'] == '4') echo 'selected'; ?> data-vouchers="0,5,9">Format 4</option>
						<option value="5" <?php if ($data['default_pdf_format'] == '5') echo 'selected'; ?> data-vouchers="0,5,9">Format 5</option>
						<option value="6" <?php if ($data['default_pdf_format'] == '6') echo 'selected'; ?> data-vouchers="0,5,9">Format 6</option>
						<option value="7" <?php if ($data['default_pdf_format'] == '7') echo 'selected'; ?> data-vouchers="0,5">Format 7</option>
						<option value="8" <?php if ($data['default_pdf_format'] == '8') echo 'selected'; ?> data-vouchers="0,3,5,6,9,10,12,15">Format 8</option>
						<option value="9" <?php if ($data['default_pdf_format'] == '9') echo 'selected'; ?> data-vouchers="5">Format 9</option>
						<option value="Aluminium" <?php if ($data['default_pdf_format'] == 'Aluminium') echo 'selected'; ?> data-vouchers="2,3,5">Aluminium</option>
						<option value="Coating" <?php if ($data['default_pdf_format'] == 'Coating') echo 'selected'; ?> data-vouchers="2,3,5">Coating</option>

						<option value="Without_Price_Aluminium" <?php if ($data['default_pdf_format'] == 'Without_Price_Aluminium') echo 'selected'; ?> data-vouchers="4">Without_Price_Aluminium</option>
						<option value="With_Price_Aluminium" <?php if ($data['default_pdf_format'] == 'With_Price_Aluminium') echo 'selected'; ?> data-vouchers="4">With_Price_Aluminium</option>
						<option value="Without_Price_Coating" <?php if ($data['default_pdf_format'] == 'Without_Price_Coating') echo 'selected'; ?> data-vouchers="4">Without_Price_Coating</option>
						<option value="With_Price_Coating" <?php if ($data['default_pdf_format'] == 'With_Price_Coating') echo 'selected'; ?> data-vouchers="4">With_Price_Coating</option>
						<option value="Without_Price" <?php if ($data['default_pdf_format'] == 'Without_Price') echo 'selected'; ?> data-vouchers="4">Without Price Format 1</option>
						<option value="With_Price" <?php if ($data['default_pdf_format'] == 'With_Price') echo 'selected'; ?> data-vouchers="4">With Price Format 1</option>

						<option value="custom" <?php if ($data['default_pdf_format'] == 'custom') echo 'selected'; ?> data-vouchers="0,<?= implode(',', $custom_pdf_vouchers) ?>">Custom Format</option>
						<option value="arabic" <?php if ($data['default_pdf_format'] == 'arabic') echo 'selected'; ?> data-vouchers="0,2,3,5,6,8,9,10,12,14,15,29">Arabic Format</option>
						<option value="english_arabic" <?php if ($data['default_pdf_format'] == 'english_arabic') echo 'selected'; ?> data-vouchers="0,2,3,5,6,8,9,10,12,14,15,29">English With Arabic Format</option>
					</select> -->

					<div class="checkbox-group">
						<input type="checkbox" name="only_default_format" value="1" <?php if ($data['only_default_format']) echo 'checked' ?> />
						<label>Hide Other Formats</label>
					</div>
				</div>

				<div class="mb-3 related-field-blocks 2 3 4 5 6 9 10 12 15 29" <?php if (in_array($voucher_guid, [2,3,4,5,6,9,10,12,15,29])) echo 'style="display:block"'; ?>>
					<div class="checkbox-group">
						<input type="checkbox" name="print_non_inv_item_name" value="1" <?php if ($data['print_non_inv_item_name']) echo 'checked' ?> />
						<label>Print non-inventory item with name</label>
					</div>
				</div>

				<div class="mb-2 mt-1" id="showMargin" <?php if ($voucher_guid == 3) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Margin Percentage</label>
					</div>
					<div class="posCheckboxInner mr-3">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="is_margin" class="custom-control-input" id="isMargin" <?php echo $is_margin ?>>
							<label class="custom-control-label" for="isMargin">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-3 related-field-blocks 9 15" <?php if (in_array($voucher_guid, [9, 15])) echo 'style="display:block"'; ?>>
					<label for="company">Default Excel Format</label>
					<select name="default_excel_format" id="default_excel_format" class="form-control form-control-sm">
						<option value="0">Select Format</option>
						<option value="1" <?php if ($data['default_excel_format'] == '1') echo 'selected'; ?> data-vouchers="9,15">Format 1</option>
						<option value="2" <?php if ($data['default_excel_format'] == '2') echo 'selected'; ?> data-vouchers="9,15">Format 2</option>
					</select>
					<input type="checkbox" name="only_default_excel_format" <?php if ($data['only_default_excel_format']) echo 'checked' ?> /> Hide Other Formats
				</div>

				<div class="mb-2 mt-1 switch-box related-fields 5" <?php if ($voucher_guid == 5) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Default Brokerage Sales</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="default_brokerage_sales" class="custom-control-input" id="customSwitches_dcs" <?= ((int)$data['default_brokerage_sales'] == 1) ? 'checked' : ''; ?>>
							<label class="custom-control-label" for="customSwitches_dcs">Yes</label>
						</div>
					</div>
				</div>
				<div class="mb-2 mt-1 switch-box related-fields 10" <?php if (in_array($voucher_guid, array(10))) echo 'style="display:flex"'; ?>>
					<div class="mr-4 ml-2">
						<label>Default Brokerage Purchase</label>
					</div>
					<div class="posCheckboxInner">
						<p style="margin: 0 8px;">No</p>
						<div class="custom-control custom-switch">
							<input type="checkbox" name="default_brokerage_purchase" class="custom-control-input" id="customSwitches_dcp" <?= ((int)$data['default_brokerage_purchase'] == 1) ? 'checked' : ''; ?>>
							<label class="custom-control-label" for="customSwitches_dcp">Yes</label>
						</div>
					</div>
				</div>

				<div class="mb-3 form-group related-field-blocks 10" <?php if (in_array($voucher_guid, [10])) echo 'style="display:block"'; ?>>
					<label>Brokerage Purchase Voucher</label>
					<select name="brokerage_purchase_voucher" class="form-control form-control-sm">
						<option value="0">Select Purchase Voucher</option>
						<?php
						// $purchase_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid = 12 AND status = '1'");
						foreach ($purchase_vouchers as $vtype) {
							$selected = ($vtype['id'] == $data['auto_brokerage_purchase_voucher']) ? 'selected' : '';
							echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
						} ?>
					</select>
				</div>

				<div class="mb-3 form-group related-field-blocks 12" <?php if (in_array($voucher_guid, [12])) echo 'style="display:block"'; ?>>
					<label>Brokerage Purchase Return Voucher</label>
					<select name="brokerage_purchase_return_voucher" class="form-control form-control-sm">
						<option value="0">Select Purchase Voucher</option>
						<?php
						$purchase_return_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid = 13 AND status = '1'");
						foreach ($purchase_return_vouchers as $vtype) {
							$selected = ($vtype['id'] == $data['brokerage_purchase_return_voucher']) ? 'selected' : '';
							echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
						} ?>
					</select>
				</div>

				<?php if (erp_menu('project_management')) { ?>
					<div class="mb-3 form-group related-field-blocks 10 12 32" <?php if (in_array($voucher_guid, [10, 12, 32])) echo 'style="display:block"'; ?>>
						<label>Stock Consumption Voucher</label>
						<!-- <select name="stock_consumption_voucher" class="form-control form-control-sm">
							<option value="0">Select Voucher</option>
							<?php
							// $st_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid=19 AND stock_consumption=1 AND status='1'");
							// foreach ($st_vouchers as $vtype) {
							// 	$selected = ($vtype['id'] == $data['stock_consumption_voucher']) ? 'selected' : '';
							// 	echo "<option value='".$vtype['id']."' $selected>".$vtype['title']."</option>";
							// }
							?>
						</select> -->
						<table class="table table-sm table-bordered">
							<thead>
								<tr>
									<th>Project Type</th>
									<th>Consumption Voucher</th>
									<th class="center" style="width:30px">
										<button onclick="add_table_row_from_template(this)" class="btn btn-primary btn-xs" type="button"><i class="icon-plus"></i></button>
									</th>
								</tr>
							</thead>
							<tbody>
								<tr class="row-template hidden">
									<td>
										<select class="form-control form-control-sm" data-name="consumption_vouchers[p_type][]">
											<?php
											$project_types = findQuery("SELECT id,name FROM pm_project_types");
											foreach ($project_types as $type) {
												echo "<option value='" . $type['id'] . "'>" . $type['name'] . "</option>";
											}
											?>
										</select>
									</td>
									<td>
										<select class="form-control form-control-sm" data-name="consumption_vouchers[voucher_guid][]">
											<?php
											$st_vouchers = findQuery("SELECT id,title FROM erp_transaction_settings WHERE voucher_guid=19 AND stock_consumption=1 AND project_stock_consumption=1 AND status='1'");
											foreach ($st_vouchers as $vtype) {
												echo "<option value='" . $vtype['id'] . "'>" . $vtype['title'] . "</option>";
											}
											?>
										</select>
									</td>
									<td class="center">
										<a onclick="erp_delete_table_row(this)" class="btn btn-light btn-sm clickable"><i class="icon-close" style="color:red"></i></a>
									</td>
								</tr>
								<?php
								$stock_consumption_voucher = unserialize($data['stock_consumption_voucher']);
								foreach ($stock_consumption_voucher as $ptype => $vid) {
								?>
									<tr>
										<td>
											<select class="form-control form-control-sm" name="consumption_vouchers[p_type][]">
												<?php
												foreach ($project_types as $type) {
													$selected = ($type['id'] == $ptype) ? 'selected' : '';
													echo "<option value='" . $type['id'] . "' $selected>" . $type['name'] . "</option>";
												}
												?>
											</select>
										</td>
										<td>
											<select class="form-control form-control-sm" name="consumption_vouchers[voucher_guid][]">
												<?php
												foreach ($st_vouchers as $vtype) {
													$selected = ($vtype['id'] == $vid) ? 'selected' : '';
													echo "<option value='" . $vtype['id'] . "' $selected>" . $vtype['title'] . "</option>";
												}
												?>
											</select>
										</td>
										<td class="center">
											<a onclick="erp_delete_table_row(this)" class="btn btn-light btn-sm clickable"><i class="icon-close" style="color:red"></i></a>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				<?php } ?>

				<div class="row <?php if (!in_array($voucher_guid, array(17, 13))) echo 'hidden'; ?>" id="showComplimentButton">
					<div class="mt-2 col-sm-5 pr-0">
						<label id="dbn_gl_label"><?= ($voucher_guid == 17) ? 'Compliment' : 'DBN' ?> Ledger</label>
					</div>
					<div class="col-sm-7 ">
						<select name="compliment_gl" data-selected="<?= $data['compliment_gl'] ?>" id="compliment-gl" class="form-control form-control-sm  select2 compliment-gl">
						</select>

					</div>
				</div>
				<div class="mb-2 sp-bw-center" style="align-items: flex-start;">
					<div class="">
						<label for="discount_gl">Discount Ledger</label>
						<select name="discount_gl" data-selected="<?= $data['discount_gl'] ?>" id="discount_gl" class="form-control form-control-sm  select2 compliment-gl">
						</select>
					</div>
					<div class="">
						<label for="roundoff_gl">Round Off Ledger</label>
						<select name="roundoff_gl" data-selected="<?= $data['roundoff_gl'] ?>" id="roundoff_gl" class="form-control form-control-sm  select2 compliment-gl">
						</select>
					</div>
					<div class="">
						<label for="vat_gl">VAT Ledger</label>
						<select name="vat_gl" data-selected="<?= $data['vat_gl'] ?>" id="vat_gl" class="form-control form-control-sm  select2 compliment-gl">
						</select>
					</div>
				</div>

				<div class="row formrow related-fields 9" style="<?php if (in_array($voucher_guid, [9])) echo 'display:flex'; ?>">
					<div class="col-md-6">
						<label>Approving Person Name</label>
						<input type="text" class="form-control form-control-sm" name="def_approving_user" value="<?= $data['def_approving_user'] ?>">
					</div>
				</div>

				<div class="row ">
					<div class="mb-3 sp-bw-center <?= (!$guid) ? 'hidden' : '' ?> " style="align-items: flex-start;">
						<div class="">
							<a class="dropdown-item notify-item" data-id="<?= base64_encode($guid) ?>" onclick="user_signature(this,2)">
								<i class="fas fa-signature"></i> Voucher Stamp
							</a>
						</div>
					</div>
					<div class="mb-3 sp-bw-center <?= (!$guid) ? 'hidden' : '' ?> " style="align-items: flex-start;">
						<div class="">
							<a class="dropdown-item notify-item" data-id="<?= base64_encode($guid) ?>" onclick="logo_right(this,2)">
								<i class="fas fa-gem"></i> Logo (Right)
							</a>
						</div>
					</div>
					<div class="mb-3 sp-bw-center <?= (!$guid) ? 'hidden' : '' ?> " style="align-items: flex-start;">
						<div class="">
							<a class="dropdown-item notify-item" data-id="<?= base64_encode($guid) ?>" onclick="logo_left(this,2)">
								<i class="fas fa-gem"></i> Logo (Left)
							</a>
						</div>
					</div>
					<div class="mb-3 sp-bw-center <?= (!$guid) ? 'hidden' : '' ?> " style="align-items: flex-start;">
						<div class="">
							<a class="dropdown-item notify-item" data-id="<?= base64_encode($guid) ?>" onclick="footer(this,2)">
								<i class="fas fa-gem"></i> Footer
							</a>
						</div>
					</div>
					<div class="mb-3 sp-bw-center <?= (!$guid) ? 'hidden' : '' ?> " style="align-items: flex-start;">
						<div class="">
							<a class="dropdown-item notify-item" data-id="<?= base64_encode($guid) ?>" onclick="format_color(this,2)">
								<i class="fas fa-gem"></i> Format Color
							</a>
						</div>
					</div>
					<div class="mb-3 sp-bw-center <?= (!$guid) ? 'hidden' : '' ?> " style="align-items: flex-start;">
						<div class="">
							<a class="dropdown-item notify-item" data-id="<?= base64_encode($guid) ?>" onclick="format_settings(this,2)">
								<i class="fas fa-home"></i> Format Settings
							</a>
						</div>
					</div>
				</div>
				<div class="row mt-2 <?php if (!in_array($voucher_guid, [17,18])) echo 'hidden'; ?>" id="showSvcButton">
					<div class="mt-2 col-sm-5 pr-0">
						<label>Service Charges Item </label>
					</div>
					<div class="col-sm-7 ">
						<select name="svc_chg_item" data-selected="<?= $data['svc_item'] ?>" id="svc_chg_item" class="form-control form-control-sm  select2-item ">
							<option value="<?= $data['svc_item'] ?>"><?= rowvalue($data['svc_item'], "erp_products", "name") ?></option>
						</select>

					</div>
				</div>

				<div class="row related-fields 18 mt-2" style="<?php if (in_array($voucher_guid, array(18))) echo 'display:flex'; ?>">
					<div class="mt-2 col-sm-5 pr-0">
						<label>Discount Item</label>
					</div>
					<div class="col-sm-7">
						<select name="disc_item" data-selected="<?= $data['disc_item'] ?>" class="form-control form-control-sm select2-item">
							<option value="<?= $data['disc_item'] ?>"><?= rowvalue($data['disc_item'], 'erp_products', 'name') ?></option>
						</select>
					</div>
				</div>

				<div class="row mt-2  mb-2 related-fields 17  " style="<?php if (in_array($voucher_guid, array(17))) echo 'display:flex'; ?>">
					<div class="mt-2 col-sm-5 pr-0">
						<label>Select Format</label>
					</div>
					<div class="col-sm-7 ">
						<select name="pos_format" class="form-control form-control-sm  ">
							<option value="0" <?= ($data['default_pdf_format'] == 0) ? 'selected' : '' ?>>General Format (80 mm) </option>
							<option value="1" <?= ($data['default_pdf_format'] == 1) ? 'selected' : '' ?>>Format 1 </option>
							<option value="10" <?= ($data['default_pdf_format'] == 10) ? 'selected' : '' ?>>GHC </option>
							<!-- <option value="20" <?= ($data['default_pdf_format'] == 20) ? 'selected' : '' ?>>GHC - 20 </option> -->
							<!-- <option value="30" <?= ($data['default_pdf_format'] == 30) ? 'selected' : '' ?>>GHC - 30 </option> -->


						</select>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="tab-pane" role="tabpanel" id="integrate_settings">
		<?php
		page('transcation_settings/tab_integrate_settings', $option);
		?>
	</div>
	<div class="tab-pane" role="tabpanel" id="form_settings">
		<?php
		page('transcation_settings/tab_form_settings', $option);
		?>
	</div>
	<div class="tab-pane" role="tabpanel" id="voucher_settings">
		<?php $option['purchase_vouchers'] = $purchase_vouchers;
		$option['all_vouchers_list'] = $all_vouchers_list;
		page('transcation_settings/tab_voucher_linking', $option); ?>
	</div>
	<div class="tab-pane" role="tabpanel" id="st_trf_settings">
		<?php
		$option['storeArray'] = $storeArray;
		page('transcation_settings/tab_stock_trf', $option); ?>
	</div>
	<div class="tab-pane" role="tabpanel" id="tally_jv_settings">
		<?php
		 if($data['voucher_guid']==17) page('transcation_settings/tally_jv_settings', $option); ?>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#example-getting-started').multiselect({
			buttonWidth: '300px',
			enableFiltering: true,
			maxHeight: 200,
			buttonText: function(options, select) {
				if (options.length === 0) {
					return 'All Sales';
				} else if (options.length > 2) {
					return 'Multiple  Vouchers  selected!';
				} else {
					var labels = [];
					options.each(function() {
						if ($(this).attr('label') !== undefined) {
							labels.push($(this).attr('label'));
						} else {
							labels.push($(this).html());
						}
					});
					return labels.join(', ') + '';
				}
			}
		});
	});

	$(document).ready(function() {
		$('#example-getting-started2').multiselect({
			buttonWidth: '217px',
			enableFiltering: true,
			maxHeight: 200,
			buttonText: function(options, select) {
				if (options.length === 0) {
					return 'All Categoies';
				} else if (options.length > 2) {
					return 'Multiple  cost category  selected!';
				} else {
					var labels = [];
					options.each(function() {
						if ($(this).attr('label') !== undefined) {
							labels.push($(this).attr('label'));
						} else {
							labels.push($(this).html());
						}
					});
					return labels.join(', ') + '';
				}
			}
		});
	});
	$(document).ready(function() {
		$('#example-getting-started3').multiselect({
			buttonWidth: '217px',
			enableFiltering: true,
			maxHeight: 200,
			buttonText: function(options, select) {
				if (options.length === 0) {
					return 'All Center';
				} else if (options.length > 2) {
					return 'Multiple Cost Center selected!';
				} else {
					var labels = [];
					options.each(function() {
						if ($(this).attr('label') !== undefined) {
							labels.push($(this).attr('label'));
						} else {
							labels.push($(this).html());
						}
					});
					return labels.join(', ') + '';
				}
			}
		});
	});
	$(document).ready(function() {
		$('.vouchers-select-2').multiselect({
			buttonWidth: '300px',
			enableFiltering: true,
			maxHeight: 200,
			buttonText: function(options, select) {
				if (options.length === 0) {
					return 'Select ';
				} else if (options.length > 2) {
					return 'Multiple  Vouchers  selected!';
				} else {
					var labels = [];
					options.each(function() {
						if ($(this).attr('label') !== undefined) {
							labels.push($(this).attr('label'));
						} else {
							labels.push($(this).html());
						}
					});
					return labels.join(', ') + '';
				}
			}
		});
	});
	// erp_get_accounts_group();
	$(document).ready(function() {
		
		// $('.compliment-gl').each(function() {
		// 	erp_get_accounts_group($(this),0);
		// });
		// $('.compliment-gl-2').each(function() {
		// 	erp_get_accounts_group($(this),0);
		// });
		var ledgerOptions = erp_get_accounts_group($('<select>'), 1);
		$('.compliment-gl, .compliment-gl-2').each(function () {
			   var $select = $(this);
			$(this).append(ledgerOptions).attr('data-status', 1);
			var selectedVal = $select.data('selected');
				if (selectedVal !== undefined && selectedVal !== '') {
					$select.val(selectedVal).trigger('change');
				}
		});
		$('.compliment-gl').select2();
		$('.cgroup').select2();
		// Apply Select2 with multiple selection and AJAX for all dropdowns with class 'select2-ajax'
		$('.compliment-gl-2').select2({
			width: '100%',
			multiple: true, // Enable multiple selection
			closeOnSelect: false,
			escapeMarkup: function(markup) { return markup; }, // IMPORTANT!
			minimumResultsForSearch: 0,
			templateResult: function(data) {
					if (!data.element) return data.text;

					let color = $(data.element).data('color');
					if (color) {
						return '<span class="' + color + '-color">' + data.text + '</span>';
					}
					return data.text;
			},
			templateSelection: function(data) {
			 if (!data.element) return data.text;

				let color = $(data.element).data('color');
				if (color) {
					return '<span class="' + color + '-color">' + data.text + '</span>';
				}
				return data.text;
			},
			placeholder: "Search.....",
			minimumInputLength: 0, // Starts searching after 1 character input
			allowClear: true // Allows clear button
		});
		
	});
	setTimeout(()=>{
	$('.compliment-9gl').each(function () {

    let preselected = $(this).data('selected'); // "3,7,9"

    if (preselected) {
        
        $('#'+$(this).attr('data-idattr')).val(preselected);
    }
});},1500);
	$(document).on('change', '.compliment-9gl', function () {
		let selectedValues = $(this).val() || []; // array of selected IDs
		let commaSeparated = selectedValues.join(',');

		$('#'+$(this).attr('data-idattr')).val(commaSeparated);
	});
	erp_get_nt_items();

	function changeCostCenter() {
		var selectedCategories = $('.cateogy_cost').val() || [];
		if (selectedCategories) {

			let page = site_url + 'site/journal/get_cost_centers.php';

			$.ajax({
				url: page,
				method: 'POST',
				data: {
					category_ids: selectedCategories
				},
				success: function(response) {
					var costCenters = response;

					var $costCenterDropdown = $('.mlt.example-getting-started');
					$costCenterDropdown.empty();

					$.each(costCenters, function(index, center) {
						$costCenterDropdown.append(
							`<option value="${center.id}" data-name="${center.name}">
								${center.name}
							</option>`
						);
					});

					// Refresh the multiselect (if needed)
					$costCenterDropdown.multiselect('rebuild');
				},
				error: function(xhr, status, error) {
					console.error("Error fetching cost centers:", error);
				}
			});
		}
	}

	$('.cateogy_cost').multiselect({
		buttonWidth: '100%',
		enableFiltering: true,
		numberDisplayed: 1,
		enableCaseInsensitiveFiltering: true,
		maxHeight: 230,
		onChange: function() {
			changeCostCenter();
		}
	});

	$('.cateogy_cost').hide();

	$('[name="journal_credit_ledger"], [name="journal_debit_ledgers[]"], [name="journal_ps_ledgers[cr_add][]"], [name="journal_ps_ledgers[dr_add][]"] , [name="cr_ledger00"], [name="dr_ledger00"] , [name="cr_ledger01"], [name="dr_ledger01"] , [name="cr_ledger02"] , .jv1').select2({
        width: '100%',
		closeOnSelect: true,
        ajax: {
	        url: site_url + 'site/ledger/ajax/select2_ledgers.php',
    	    dataType: 'json',
    	    delay: 250,
        	data: function(params){
	            return { search:params.term, page:params.page || 1 };
	        },
    	    processResults: function(data, params){
	            params.page = params.page || 1;
    	        return {
        	        results: $.map(data.items, function(item){
        	            return item;
	                })
            	};
	        },
    	    cache: true
    	},
        placeholder: 'Search',
    	minimumInputLength: 0,
    	allowClear: true
	});
</script>