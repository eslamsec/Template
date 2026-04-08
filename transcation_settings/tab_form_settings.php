<?php
	$data = $option['data'];
	$voucher_guid = $data['voucher_guid'];
	$form_settings = unserialize($data['form_settings']);
	$form_item_settings = unserialize($data['form_item_settings']);
?>

<div style="padding:15px;">
	<h6>Select fields which needs to hidden in the voucher form</h6>
	<h6>Header</h6>
	<div class="row">
		<div class="col-sm-4">
			<div class="checkbox-group mb-2 form-settings 5 6" <?php if(!in_array($voucher_guid, [5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[sales_type]" id="form_settings[sales_type]" value="1" <?php if($form_settings['sales_type']) echo 'checked' ?> />
				<label for="form_settings[sales_type]">Local/Overseas Sales</label>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[exchange]" id="form_settings[exchange]" value="1" <?php if($form_settings['exchange']) echo 'checked' ?> />
				<label for="form_settings[exchange]">Exchange</label>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[brokerage_sales]" id="form_settings[brokerage_sales]" value="1" <?php if($form_settings['brokerage_sales']) echo 'checked' ?> />
				<label for="form_settings[brokerage_sales]">Brokerage Sales</label>
			</div>
		</div>
	</div>

	<hr />
	<h6>Form</h6>
	<div class="row">
		<div class="col-sm-4">
			<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[enq_ref]" id="form_settings[enq_ref]" value="1" <?php if($form_settings['enq_ref']) echo 'checked' ?> />
				<label for="form_settings[enq_ref]">Enq Ref</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[quote_ref]" id="form_settings[quote_ref]" value="1" <?php if($form_settings['quote_ref']) echo 'checked' ?> />
				<label for="form_settings[quote_ref]">Quote Ref</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[so_ref]" id="form_settings[so_ref]" value="1" <?php if($form_settings['so_ref']) echo 'checked' ?> />
				<label for="form_settings[so_ref]">SO Ref</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[dn_ref]" id="form_settings[dn_ref]" value="1" <?php if($form_settings['dn_ref']) echo 'checked' ?> />
				<label for="form_settings[dn_ref]">DN Ref</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 5 6" <?php if(!in_array($voucher_guid, [5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[currency]" id="form_settings[currency]" value="1" <?php if($form_settings['currency']) echo 'checked' ?> />
				<label for="form_settings[currency]">Currency</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 6" <?php if(!in_array($voucher_guid, [6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[supplier_code]" id="form_settings[supplier_code]" value="1" <?php if($form_settings['supplier_code']) echo 'checked' ?> />
				<label for="form_settings[supplier_code]">Supplier Code</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 5 6" <?php if(!in_array($voucher_guid, [5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[branch]" id="form_settings[branch]" value="1" <?php if($form_settings['branch']) echo 'checked' ?> />
				<label for="form_settings[branch]">Branch</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[deliver_to]" id="form_settings[deliver_to]" value="1" <?php if($form_settings['deliver_to']) echo 'checked' ?> />
				<label for="form_settings[deliver_to]">Deliver To</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 1" <?php if(!in_array($voucher_guid, [1])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[req_priority]" id="form_settings[req_priority]" value="1" <?php if($form_settings['req_priority']) echo 'checked' ?> />
				<label for="form_settings[req_priority]">Request Priority</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 1" <?php if(!in_array($voucher_guid, [1])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[margin_perc]" id="form_settings[margin_perc]" value="1" <?php if($form_settings['margin_perc']) echo 'checked' ?> />
				<label for="form_settings[margin_perc]">Margin %</label>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[customer_ref]" id="form_settings[customer_ref]" value="1" <?php if($form_settings['customer_ref']) echo 'checked' ?> />
				<label for="form_settings[customer_ref]">Customer Ref</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 6" <?php if(!in_array($voucher_guid, [6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[doc_num]" id="form_settings[doc_num]" value="1" <?php if($form_settings['doc_num']) echo 'checked' ?> />
				<label for="form_settings[doc_num]">Doc/Voucher No</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[payment_terms]" id="form_settings[payment_terms]" value="1" <?php if($form_settings['payment_terms']) echo 'checked' ?> />
				<label for="form_settings[payment_terms]">Payment Terms</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 1 5 ,6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[delivery_terms]" id="form_settings[delivery_terms]" value="1" <?php if($form_settings['delivery_terms']) echo 'checked' ?> />
				<label for="form_settings[delivery_terms]">Delivery Terms</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[salesman]" id="form_settings[salesman]" value="1" <?php if($form_settings['salesman']) echo 'checked' ?> />
				<label for="form_settings[salesman]">Sales Man/Code</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[store]" id="form_settings[store]" value="1" <?php if($form_settings['store']) echo 'checked' ?> />
				<label for="form_settings[store]">Store</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 5 6" <?php if(!in_array($voucher_guid, [5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[ledger]" id="form_settings[ledger]" value="1" <?php if($form_settings['ledger']) echo 'checked' ?> />
				<label for="form_settings[ledger]">Ledger</label>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[po_num]" id="form_settings[po_num]" value="1" <?php if($form_settings['po_num']) echo 'checked' ?> />
				<label for="form_settings[po_num]">Purchase Order No</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[supp_code]" id="form_settings[supp_code]" value="1" <?php if($form_settings['supp_code']) echo 'checked' ?> />
				<label for="form_settings[supp_code]">Supplier/Vendor Code</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[contract_no]" id="form_settings[contract_no]" value="1" <?php if($form_settings['contract_no']) echo 'checked' ?> />
				<label for="form_settings[contract_no]">Contract No.</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[vehicle]" id="form_settings[vehicle]" value="1" <?php if($form_settings['vehicle']) echo 'checked' ?> />
				<label for="form_settings[vehicle]">Vehicle No</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 6" <?php if(!in_array($voucher_guid, [6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[check_num]" id="form_settings[check_num]" value="1" <?php if($form_settings['check_num']) echo 'checked' ?> />
				<label for="form_settings[check_num]">Check No.</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 6" <?php if(!in_array($voucher_guid, [6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[check_date]" id="form_settings[check_date]" value="1" <?php if($form_settings['check_date']) echo 'checked' ?> />
				<label for="form_settings[check_date]">Check Date</label>
			</div>

			<div class="checkbox-group mb-2 form-settings 6" <?php if(!in_array($voucher_guid, [6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[issue_date]" id="form_settings[issue_date]" value="1" <?php if($form_settings['issue_date']) echo 'checked' ?> />
				<label for="form_settings[issue_date]">Issue Date</label>
			</div>

			<?php if(erp_insurance_enabled()){ ?>
				<div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
					<input type="checkbox" name="form_settings[create_purchase]" id="form_settings[create_purchase]" value="1" <?php if($form_settings['create_purchase']) echo 'checked' ?> />
					<label for="form_settings[create_purchase]">Create Purchase</label>
				</div>
			<?php } ?>

			<div class="checkbox-group mb-2 form-settings 1" <?php if(!in_array($voucher_guid, [1])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_settings[user_code]" id="form_settings[user_code]" value="1" <?php if($form_settings['user_code']) echo 'checked' ?> />
				<label for="form_settings[user_code]">User Code</label>
			</div>
		</div>
	</div>

	<hr />
	<h6>Items Table</h6>
	<div class="row">
		<div class="col-sm-4">
			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[sl_no]" id="form_item_settings[sl_no]" value="1" <?php if($form_item_settings['sl_no']) echo 'checked' ?> />
				<label for="form_item_settings[sl_no]">Sl No</label>
			</div>
			
			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[code]" id="form_item_settings[code]" value="1" <?php if($form_item_settings['code']) echo 'checked' ?> />
				<label for="form_item_settings[code]">Item Code</label>
			</div>
			
			<div class="checkbox-group mb-2 form-settings 1" <?php if(!in_array($voucher_guid, [1])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[manufacturer]" id="form_item_settings[manufacturer]" value="1" <?php if($form_item_settings['manufacturer']) echo 'checked' ?> />
				<label for="form_item_settings[manufacturer]">Manufacturer</label>
			</div>
			
			<div class="checkbox-group mb-2 form-settings 1 5" <?php if(!in_array($voucher_guid, [1,5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[department]" id="form_item_settings[department]" value="1" <?php if($form_item_settings['department']) echo 'checked' ?> />
				<label for="form_item_settings[department]">Department</label>
			</div>
			
			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[qty]" id="form_item_settings[qty]" value="1" <?php if($form_item_settings['qty']) echo 'checked' ?> />
				<label for="form_item_settings[qty]">Qty</label>
			</div>
			
			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[unit]" id="form_item_settings[unit]" value="1" <?php if($form_item_settings['unit']) echo 'checked' ?> />
				<label for="form_item_settings[unit]">Unit</label>
			</div>
			
			<!-- <div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[rate_incl_vat]" id="form_item_settings[rate_incl_vat]" value="1" <?php if($form_item_settings['rate_incl_vat']) echo 'checked' ?> />
				<label for="form_item_settings[rate_incl_vat]">Rate Incl. VAT</label>
			</div> -->
			
			<div class="checkbox-group mb-2 form-settings 5 6" <?php if(!in_array($voucher_guid, [5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[tot_bef_disc]" id="form_item_settings[tot_bef_disc]" value="1" <?php if($form_item_settings['tot_bef_disc']) echo 'checked' ?> />
				<label for="form_item_settings[tot_bef_disc]">Total Before Discount</label>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[disc_perc]" id="form_item_settings[disc_perc]" value="1" <?php if($form_item_settings['disc_perc']) echo 'checked' ?> />
				<label for="form_item_settings[disc_perc]">Discount %</label>
			</div>
			
			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[disc_per_unit]" id="form_item_settings[disc_per_unit]" value="1" <?php if($form_item_settings['disc_per_unit']) echo 'checked' ?> />
				<label for="form_item_settings[disc_per_unit]">Discount/Unit</label>
			</div>
			
			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[unit_price_aft_disc]" id="form_item_settings[unit_price_aft_disc]" value="1" <?php if($form_item_settings['unit_price_aft_disc']) echo 'checked' ?> />
				<label for="form_item_settings[unit_price_aft_disc]">Unit Price After Discount/Net Unit Price</label>
			</div>
			
			<div class="checkbox-group mb-2 form-settings 5 6" <?php if(!in_array($voucher_guid, [5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[total_disc]" id="form_item_settings[total_disc]" value="1" <?php if($form_item_settings['total_disc']) echo 'checked' ?> />
				<label for="form_item_settings[total_disc]">Total Discount</label>
			</div>
			
			<div class="checkbox-group mb-2 form-settings 1 5" <?php if(!in_array($voucher_guid, [1,5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[gross_tot]" id="form_item_settings[gross_tot]" value="1" <?php if($form_item_settings['gross_tot']) echo 'checked' ?> />
				<label for="form_item_settings[gross_tot]">Gross Total</label>
			</div>
		</div>

		<div class="col-sm-4">
			<!-- <div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[vat_perc]" id="form_item_settings[vat_perc]" value="1" <?php if($form_item_settings['vat_perc']) echo 'checked' ?> />
				<label for="form_item_settings[vat_perc]">VAT %</label>
			</div> -->
			
			<!-- <div class="checkbox-group mb-2 form-settings 5" <?php if(!in_array($voucher_guid, [5])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[vat_amount]" id="form_item_settings[vat_amount]" value="1" <?php if($form_item_settings['vat_amount']) echo 'checked' ?> />
				<label for="form_item_settings[vat_amount]">VAT Amount</label>
			</div> -->
			
			<div class="checkbox-group mb-2 form-settings 1 5 6" <?php if(!in_array($voucher_guid, [1,5,6])) echo 'style="display:none"' ?>>
				<input type="checkbox" name="form_item_settings[remarks]" id="form_item_settings[remarks]" value="1" <?php if($form_item_settings['remarks']) echo 'checked' ?> />
				<label for="form_item_settings[remarks]">Remarks</label>
			</div>
		</div>
	</div>
</div>