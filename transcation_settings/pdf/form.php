<?php
if(!isset($option)){
	return;
}
$page = $option['page'];
$transaction_id = (int)base64_decode($option[2]);

$transaction = findOne("SELECT * FROM erp_transaction_settings WHERE id=$transaction_id");
$printsettings = findOne("SELECT * FROM erp_print_formats WHERE transaction_id=".$transaction_id);
$style = unserialize($printsettings['style']);
$item_table = unserialize($printsettings['item_table']);
$settings = unserialize($printsettings['settings']);

$custom_pdf_enabled = $transaction['custom_pdf_enabled'];

$voucher_guid = $transaction['voucher_guid'];
$voucher_type_name = rowValue($voucher_guid, 'erp_vouchers', 'name');
$other_transactions = findQuery("SELECT * FROM  erp_transaction_settings WHERE voucher_guid=$voucher_guid ORDER BY FIELD(id, $transaction_id) DESC");

$item_table_cols = PDFSettings::get_item_table_cols($voucher_guid);
$get_voucher_data = PDFSettings::get_voucher_data($voucher_guid);
?>
<form class="card" id="form_printsettings">
	<?php if(!$custom_pdf_enabled){ ?>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-12">
					<input type="checkbox" name="custom_format" onchange="toggle_pdf_form(this)" <?php if($custom_pdf_enabled) echo 'checked' ?>>
					<label for="custom_format">Custom print format</label>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<input type="hidden" name="custom_format" value="1">
	<?php } ?>

	<div class="card-body print_settings_wrapper" style="<?php if(!$custom_pdf_enabled) echo 'display:none;' ?>">
		<div class="row">
			<div class="col-sm-4">
				<div class="row formrow">
					<div class="col-sm-4">Paper Size</div>
					<div class="col-sm-8">
						<select name="papersize" id="papersize" class="form-control form-control-sm" onchange="pdf_show_paper_dimension()">
							<option value="A4" data-ratio="1.41" data-width="210" data-height="297" <?php if($printsettings['papersize'] == 'A4') echo 'selected' ?>>A4</option>
							<option value="A5" data-ratio="1.41" data-width="148.5" data-height="210" <?php if($printsettings['papersize'] == 'A5') echo 'selected' ?>>A5</option>
							<option value="Letter" data-ratio="1.29" data-width="215.9" data-height="279.4" <?php if($printsettings['papersize'] == 'Letter') echo 'selected' ?>>Letter</option>
						</select>
						<span id="paper_dimension"></span>
					</div>
				</div>

				<b><small>* All dimensions should be in Millimeter (mm) </small></b>

				<h6>Margins</h6>
				<div class="row formrow">
					<div class="col-sm-3">
						Top
						<input type="number" name="margin_top" class="form-control form-control-sm" value="<?= $printsettings ? $printsettings['margin_top'] : 8 ?>">
					</div>
					<div class="col-sm-3">
						Bottom
						<input type="number" name="margin_bottom" class="form-control form-control-sm" value="<?= $printsettings ? $printsettings['margin_bottom'] : 8 ?>">
					</div>
					<div class="col-sm-3">
						Left
						<input type="number" name="margin_left" class="form-control form-control-sm" value="<?= $printsettings ? $printsettings['margin_left'] : 8 ?>">
					</div>
					<div class="col-sm-3">
						Right
						<input type="number" name="margin_right" class="form-control form-control-sm" value="<?= $printsettings ? $printsettings['margin_right'] : 8 ?>">
					</div>
				</div>

				<div class="row formrow mt-2">
					<div class="col-sm-3">
						Font Size
					</div>
					<div class="col-sm-9">
						<input type="number" name="style[fontsize]" class="form-control form-control-sm" value="<?= $style['fontsize'] ?: 12 ?>">
					</div>
				</div>

				<div class="row formrow mt-2">
					<div class="col-sm-3">
						Font Style
					</div>
					<div class="col-sm-9">
						<select name="style[fontstyle]" class="form-control form-control-sm">
							<option value="" <?php if($style['fontstyle'] == '') echo 'selected' ?>>Default</option>
							<option value="calibri" <?php if($style['fontstyle'] == 'calibri') echo 'selected' ?>>Calibri</option>
							<option value="worksans" <?php if($style['fontstyle'] == 'worksans') echo 'selected' ?>>WorkSans</option>
						</select>
					</div>
				</div>

				<h6>Item table settings</h6>
				<div class="row formrow mt-1">
					<div class="col-sm-3">
						Header Background
					</div>
					<div class="col-sm-9">
						<input type="text" name="style[items_header_bg]" class="form-control form-control-sm" value="<?= $style['items_header_bg'] ?: '#c6eaff' ?>">
					</div>
				</div>

				<div class="row formrow mt-1">
					<div class="col-sm-3">
						Header Font Color
					</div>
					<div class="col-sm-9">
						<input type="text" name="style[items_header_font_color]" class="form-control form-control-sm" value="<?= $style['items_header_font_color'] ?: 'black' ?>">
					</div>
				</div>

				<div class="row formrow mt-1">
					<div class="col-sm-3">
						Item Column Spacing
					</div>
					<div class="col-sm-9">
						<input type="text" name="style[items_padding]" class="form-control form-control-sm" value="<?= $style['items_padding'] ?>">
					</div>
				</div>

				<div class="row formrow mt-1">
					<div class="col-sm-3">
						Border (top & bottom)
					</div>
					<div class="col-sm-9">
						<input type="text" name="style[items_border_top]" class="form-control form-control-sm" value="<?= $style['items_border_top'] ?>">
					</div>
				</div>

				<div class="row formrow mt-1">
					<div class="col-sm-3">
						Border (left & right)
					</div>
					<div class="col-sm-9">
						<input type="text" name="style[items_border_left]" class="form-control form-control-sm" value="<?= $style['items_border_left'] ?>">
					</div>
				</div>

				<div class="row formrow mt-2">
					<div class="col-sm-3">
						Item Code
					</div>
					<div class="col-sm-9">
						<select name="settings[code_to_print]" class="form-control form-control-sm">
							<option value="" <?php if($settings['code_to_print'] == '') echo 'selected' ?>>Default</option>
							<option value="code" <?php if($settings['code_to_print'] == 'code') echo 'selected' ?>>Code</option>
							<option value="print_code" <?php if($settings['code_to_print'] == 'print_code') echo 'selected' ?>>Print Code</option>
						</select>
					</div>
				</div>

				<?php if(in_array($voucher_guid, array(2,3,4,5,12))){ ?>
					<div class="row formrow mt-1">
						<div class="col-sm-9">
							<input type="checkbox" name="settings[hide_total_border]" value="1" <?= (isset($settings['hide_total_border'])) ? 'checked' : ''; ?>>
							Hide border on totals
						</div>
					</div>
				<?php } ?>

				<div class="row formrow mt-1">
					<div class="col-sm-9">
						<input type="checkbox" name="settings[show_item_totals]" value="1" <?= (!$printsettings || isset($settings['show_item_totals'])) ? 'checked' : ''; ?>>
						Show items total
					</div>
				</div>

				<div class="row formrow mt-1">
					<div class="col-sm-9">
						<input type="checkbox" name="settings[center_align_item_header]" value="1" <?= (isset($settings['center_align_item_header'])) ? 'checked' : ''; ?>>
						Center Align Items Header
					</div>
				</div>

				<?php if(in_array($voucher_guid, array(3,5))){ ?>
					<div class="row formrow mt-1">
						<div class="col-sm-9">
							<input type="checkbox" name="settings[show_paid_n_balance]" value="1" <?= (isset($settings['show_paid_n_balance'])) ? 'checked' : ''; ?>>
							Show paid amount and balance due
						</div>
					</div>

					<div class="row formrow mt-1">
						<div class="col-sm-9">
							<input type="checkbox" name="settings[show_paid_stamp]" value="1" <?= (isset($settings['show_paid_stamp'])) ? 'checked' : ''; ?>>
							Show paid stamp
						</div>
					</div>
				<?php } ?>

				<?php if(in_array($voucher_guid, array(3,5))){ ?>
					<!-- <div class="row formrow mt-1">
						<div class="col-sm-9">
							<input type="checkbox" name="settings[group_non_inv]" value="1" <?= (isset($settings['group_non_inv'])) ? 'checked' : ''; ?>>
							Group Non-inventory item and show subtotal
						</div>
					</div> -->

					<div class="row formrow mt-1">
						<div class="col-sm-9">
							<input type="checkbox" name="settings[hide_items_total]" value="1" <?= (isset($settings['hide_items_total'])) ? 'checked' : ''; ?>>
							Hide items total
						</div>
					</div>
				<?php } ?>

				<!-- <div class="row formrow">
					<div class="col-sm-6">
						Header Height
						<input type="number" name="header_h" class="form-control form-control-sm" value="<?= $printsettings['header_h'] ?>">
					</div>

					<div class="col-sm-6">
						Footer Height
						<input type="number" name="footer_h" class="form-control form-control-sm" value="<?= $printsettings['footer_h'] ?>">
					</div>
				</div> -->

				<!-- <h6>Items Table</h6>
				<div class="row formrow">
					<div class="col-sm-12">
						<table width="100%">
							<tr><th>Field</th>
								<th>Col. Name</th>
								<th width="75px">Width (%)</th>
							</tr>
						<?php //foreach($item_table_cols as $key=>$col){
							// $checked = (!$printsettings || isset($item_table[$key]['show'])) ? 'checked' : '';
							// $name = $item_table[$key]['name'] ?: $col['name'];
							// $width = $item_table[$key]['width'];
						?>
							<tr>
								<td><input type="checkbox" name="item_table_cols[<?= $key ?>][show]" value="show" <?= $checked ?>> <?= $col['name'] ?></td>
								<td><input type="text" class="form-control form-control-sm" name="item_table_cols[<?= $key ?>][name]" value="<?= $name ?>"> </td>
								<td><input type="number" class="form-control form-control-sm" name="item_table_cols[<?= $key ?>][width]" value="<?= $width ?>">
									<input type="hidden" name="item_table_cols[<?= $key ?>][total]" value="<?= $col['total'] ?>">
								</td>
							</tr>
						<?php //} ?>
						</table>
					</div>
				</div> -->
			</div>

								<!-- <td data-col-id="h<?= uniqid() ?>"><?php page($page.'/action_menu') ?></td> -->
			<div class="col-sm-8">
				<div class="pdf-container">
					<small>Header</small>
					<div class="pdf-section pdf-header">
						<?php if($printsettings){ echo $printsettings['header']; } else { ?>
							<table><tr>
								<?php if($get_voucher_data['entity_type'] == 1){} ?>
								<td data-col-id="h1<?= uniqid() ?>" data-content-type="field"><table><tbody><tr><td contenteditable="true"><?php if($get_voucher_data['entity_type'] == 1){ echo '{{customer_name}}'; } else if($get_voucher_data['entity_type'] == 2){ echo '{{supplier_name}}'; } ?></td></tr><tr><td contenteditable="true"><?php if($get_voucher_data['entity_type'] == 1){ echo '{{customer_address}}'; } else if($get_voucher_data['entity_type'] == 2){ echo '{{supplier_address}}'; } ?></td></tr></tbody></table></td>
								<td data-col-id="h2<?= uniqid() ?>" data-content-type="field" width="33%"><table><tbody><tr><td contenteditable="true" align="right"><?= $get_voucher_data['doc_ref'] ?></td><td contenteditable="true">: {{doc_ref}}</td></tr><tr><td contenteditable="true" align="right">Date</td><td contenteditable="true">: {{date}}</td></tr></tbody></table></td>
							</tr></table>
						<?php } ?>
					</div>

					<small>Content</small>
					<div class="pdf-section pdf-body-1">
						<?php if($printsettings){ echo $printsettings['body_1']; } else { ?>
							<table><tr><td data-col-id="b1<?= uniqid() ?>" align="center" style="font-size:16px; font-weight:bold;"><?php page($page.'/action_menu') ?><p contenteditable="true">{{voucher_title}}</p></td></tr></table>
						<?php } ?>
					</div>
					<div class="item-table">
						<table>
							<thead>
								<tr>
									<?php foreach($item_table_cols as $key=>$col){
										$name = $col['name'];
										$display = (!$printsettings || isset($item_table[$key]['show'])) ? '' : 'dis-none';
										echo "<th class='$key $display'>$name</th>";
									} ?>
								</tr>
								</thead>
							<tbody>
								<tr>
									<?php foreach($item_table_cols as $key=>$col){
										$display = (!$printsettings || isset($item_table[$key]['show'])) ? '' : 'dis-none';
										echo "<td class='$key $display'>#</td>";
									} ?>
								</tr>
							</tbody>
							<!-- <tfoot>
								<tr>
									<?php //foreach($item_table_cols as $col){
									// 	if($col['total']){
									// 		echo "<td>###</td>";
									// 	} else {
									// 		echo "<td></td>";
									// 	}
									// } ?>
								</tr>
							</tfoot> -->
						</table>
					</div>
					<div class="pdf-section pdf-body-2">
						<?php if($printsettings){ echo $printsettings['body_2']; } else { ?>
							<table><tr><td data-col-id="b2<?= uniqid() ?>"><?php page($page.'/action_menu') ?></td></tr></table>
						<?php } ?>
					</div>

					<small>Footer Last Page</small>
					<div class="pdf-section pdf-footer-last-page">
						<?php if($printsettings){ echo $printsettings['footer_last_page']; } else { ?>
							<table><tr><td data-col-id="flp<?= uniqid() ?>"><?php page($page.'/action_menu') ?></td></tr></table>
						<?php } ?>
					</div>

					<small>Footer</small>
					<div class="pdf-section pdf-footer">
						<?php if($printsettings){ echo $printsettings['footer']; } else { ?>
							<table><tr><td data-col-id="f<?= uniqid() ?>" align="right"><?php page($page.'/action_menu') ?><p contenteditable="true">Page {{page_num}} of {{page_count}}</p></td></tr></table>
						<?php } ?>
					</div>
				</div>

				<h6>Items Table</h6>
				<div class="row formrow">
					<div class="col-sm-12">
						<table width="100%" id="item-cols">
							<thead>
							<tr>
								<th width="10px">
								<th>Column</th>
								<th>Print Name</th>
								<th width="75px">Width (%)</th>
								<th width="75px" class="center hidden">View On Form</th>
								<th width="75px" class="center">View On Print</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach($item_table_cols as $key=>$col){
								$show_in_form = (!$printsettings || isset($item_table[$key]['show_in_form'])) ? 'checked' : '';
								$checked = (!$printsettings || isset($item_table[$key]['show'])) ? 'checked' : '';
								$name = $item_table[$key]['name'] ?: $col['name'];
								$width = ($item_table[$key]['width'] != '') ? (float)$item_table[$key]['width'] : '';
							?>
							<tr>
								<td><!-- <i class="fas fa-arrows-alt-v idrag"></i> --></td>
								<td><?= $col['name'] ?></td>
								<td><input type="text" class="form-control form-control-sm" name="item_table_cols[<?= $key ?>][name]" value="<?= $name ?>"> </td>
								<td><input type="number" class="form-control form-control-sm" name="item_table_cols[<?= $key ?>][width]" value="<?= $width ?>">
									<!-- <input type="hidden" name="item_table_cols[<?= $key ?>][total]" value="<?php //$col['total'] ?>"> -->
								</td>
								<td class="center hidden"><input type="checkbox" name="item_table_cols[<?= $key ?>][show_in_form]" value="show" <?= $show_in_form ?>></td>
								<td class="center"><input type="checkbox" name="item_table_cols[<?= $key ?>][show]" value="show" data-key="<?= $key ?>" onclick="pdf_toggle_print_cols(this)" <?= $checked ?>></td>
							</tr>
							<?php } ?>
							<tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="row mt-2">
			<div class="col-sm-12">
				<h6>Save To Other <?= $voucher_type_name ?> Vouchers</h6>
				<?php foreach($other_transactions as $t){
					if($t['id'] == $transaction_id){
						echo '<input type="checkbox" checked disabled> '.$t['title'].'<br>';
						echo '<input type="hidden" name="transaction_ids[]" value="'.$t['id'].'">';
					} else {
						echo '<input type="checkbox" name="transaction_ids[]" value="'. $t['id'].'"> '.$t['title'].'<br>';
					}
				} ?>
			</div>
		</div>
	</div>

	<input type="hidden" name="voucher_guid" value="<?= $voucher_guid ?>">

	<div class="image_inputs hidden"></div>

	<div class="text-right card-footer">
		<!-- <button class="btn btn-success" type="button" onclick="pdf_save_settings(this)" data-preview="1"><i class="far fa-paper-plane"></i> Preview </button> -->
		<button class="btn btn-success" type="button" onclick="pdf_save_settings(this)"><i class="fa fa-plus-circle"></i> Save </button>
		<button class="btn btn-danger" type="button" onclick="history.back()"><i class="fa fa-ban"></i> Close</button>
	</div>
</form>

<script>
	function pdf_get_action_menu(){
		return `<?php page($page.'/action_menu') ?>`;
	}
</script>