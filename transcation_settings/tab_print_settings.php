<?php
	$guid = $option['guid'];
	$data = $option['data'];
	$printdata = array();
	if($guid){
		$printdata = findQuery("select * from erp_print_formats where voucher_id=$guid");
		$printdata = $printdata[0];
		$item_cols = unserialize($printdata['item_cols']);
	}
	$custom_formats = findQuery("SELECT p.id, t.title 
								 FROM erp_print_formats p 
								 LEFT JOIN erp_transaction_settings t 
								 ON p.voucher_id = t.id");
?>

<div class="row" style="margin-top:15px;">
	<div class="col-sm-12">
		<input type="checkbox" name="custom_format" id="custom_format" <?php if($printdata) echo 'checked' ?>>
		<label for="custom_format">Custom print format</label>
	</div>
</div>

<div class="print_settings_wrapper" style="margin-top:15px; <?php if(!$printdata) echo 'display:none;' ?>">
	<div class="row hidden">
		<div class="col-sm-3">Copy From</div>
		<div class="col-sm-3 mb-1">
			<select id="copy_from" class="form-control form-control-sm">
				<?php foreach($custom_formats as $format){
					echo '<option value="'.$format['id'].'">'.$format['title'].'</option>';
				} ?>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 mb-1">
			<div class="row">
				<div class="col-sm-4">Paper Size</div>
				<div class="col-sm-8">
					<select name="papersize" id="papersize" class="form-control form-control-sm">
						<option value="A4" data-ratio="1.41" data-width="210" data-height="297" <?php if($printdata['papersize'] == 'A4') echo 'selected' ?>>A4</option>
						<option value="A5" data-ratio="1.41" data-width="148.5" data-height="210" <?php if($printdata['papersize'] == 'A5') echo 'selected' ?>>A5</option>
						<option value="Letter" data-ratio="1.29" data-width="215.9" data-height="279.4" <?php if($printdata['papersize'] == 'Letter') echo 'selected' ?>>Letter</option>
					</select>
					<span id="paper_dimension"></span>
				</div>
			</div>
		</div>
	</div>

	<b><small>* All dimensions should be in Millimeter (mm) </small></b>
	<div class="row">
		<div class="col-sm-4 mb-1">
			<h6>Margins</h6>
			<div class="row formrow">
				<div class="col-sm-4">Top</div>
				<div class="col-sm-8">
					<input type="number" name="margin_top" class="form-control form-control-sm" value="<?= $printdata['margin_top'] ?>">
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-4">Bottom</div>
				<div class="col-sm-8">
					<input type="number" name="margin_bottom" class="form-control form-control-sm" value="<?= $printdata['margin_bottom'] ?>">
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-4">Left</div>
				<div class="col-sm-8">
					<input type="number" name="margin_left" class="form-control form-control-sm" value="<?= $printdata['margin_left'] ?>">
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-4">Right</div>
				<div class="col-sm-8">
					<input type="number" name="margin_right" class="form-control form-control-sm" value="<?= $printdata['margin_right'] ?>">
				</div>
			</div>

			<div class="voucher-group 5" <?php if($data['voucher_guid'] != 5) echo 'style="display:none"' ?>>
				<h6 class="mt-3">Show/Hide Items Table Columns</h6>
				<input type="checkbox" name="item_cols[itemcode]" value="1" <?php if($item_cols['itemcode']) echo 'checked'; ?>> Item Code<br>
				<input type="checkbox" name="item_cols[qty]" value="1" <?php if($item_cols['qty']) echo 'checked'; ?>> Qty<br>
				<input type="checkbox" name="item_cols[unit]" value="1" <?php if($item_cols['unit']) echo 'checked'; ?>> Unit<br>
				<input type="checkbox" name="item_cols[rate]" value="1" <?php if($item_cols['rate']) echo 'checked'; ?>> Rate<br>
				<?php if((int)$_SESSION['menu']['insurance_management']){ ?>
					<input type="checkbox" name="item_cols[policy_num]" value="1" <?php if($item_cols['policy_num']) echo 'checked'; ?>> Policy #<br>
					<input type="checkbox" name="item_cols[policy_amount]" value="1" <?php if($item_cols['policy_amount']) echo 'checked'; ?>> Policy Amt<br>
					<input type="checkbox" name="item_cols[policy_client]" value="1" <?php if($item_cols['policy_client']) echo 'checked'; ?>> Client Name<br>
				<?php } ?>
			</div>
		</div>
		
		<div class="col-sm-4 mb-1">
			<h6>Header</h6>
			<div class="row formrow">
				<div class="col-sm-4">Height</div>
				<div class="col-sm-8">
					<input type="number" name="header_h" class="form-control form-control-sm" value="<?= $printdata['header_h'] ?>">
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-4">Left Width</div>
				<div class="col-sm-8">
					<input type="number" name="header_left_w" id="header_left_w" class="form-control form-control-sm" value="<?= $printdata['header_left_w'] ?>">
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-4">Middle Width </div>
				<div class="col-sm-8">
					<input type="number" name="header_middle_w" id="header_middle_w" class="form-control form-control-sm" value="<?= $printdata['header_middle_w'] ?>">
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-4">Right Width</div>
				<div class="col-sm-8">
					<input type="number" name="header_right_w" id="header_right_w" class="form-control form-control-sm" value="<?= $printdata['header_right_w'] ?>">
				</div>
			</div>
			<div class="row formrow wrapper">
				<div class="col-sm-4">Content Left</div>
				<div class="col-sm-8">
					<textarea name="header_left_t" class="form-control form-control-sm" <?php if($printdata['header_left_f'] != '') echo 'style="display:none"' ?>><?= $printdata['header_left_t'] ?></textarea>
					<input type="file" name="header_left_f" class="form-control form-control-sm" style="display:none;">
					<input type="hidden" name="header_left_type" class="content_type" value="<?= ($printdata['header_left_f'] != '') ? 'image' : 'text' ?>">
					<?php if($printdata['header_left_f'] != ''){ ?>
						<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['header_left_f'] ?>" style="height:50px; width:auto;" ></div>
						<span class="switch_content_type" data-type="image">Remove image</span>
					<?php } else { ?>
						<span class="switch_content_type" data-type="text">Insert image</span>
					<?php } ?>
				</div>
			</div>
			<div class="row formrow wrapper">
				<div class="col-sm-4">Content Middle</div>
				<div class="col-sm-8">
					<textarea name="header_middle_t" class="form-control form-control-sm" <?php if($printdata['header_middle_f'] != '') echo 'style="display:none"' ?>><?= $printdata['header_middle_t'] ?></textarea>
					<input type="file" name="header_middle_f" class="form-control form-control-sm" style="display:none;">
					<input type="hidden" name="header_middle_type" class="content_type" value="<?= ($printdata['header_middle_f'] != '') ? 'image' : 'text' ?>">
					<?php if($printdata['header_middle_f'] != ''){ ?>
						<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['header_middle_f'] ?>" style="height:50px; width:auto;" ></div>
						<span class="switch_content_type" data-type="image">Remove image</span>
					<?php } else { ?>
						<span class="switch_content_type" data-type="text">Insert image</span>
					<?php } ?>
				</div>
			</div>
			<div class="row formrow wrapper">
				<div class="col-sm-4">Content Right</div>
				<div class="col-sm-8">
					<textarea name="header_right_t" class="form-control form-control-sm" <?php if($printdata['header_right_f'] != '') echo 'style="display:none"' ?>><?= $printdata['header_right_t'] ?></textarea>
					<input type="file" name="header_right_f" class="form-control form-control-sm" style="display:none;">
					<input type="hidden" name="header_right_type" class="content_type" value="<?= ($printdata['header_right_f'] != '') ? 'image' : 'text' ?>">
					<?php if($printdata['header_right_f'] != ''){ ?>
						<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['header_right_f'] ?>" style="height:50px; width:auto;" ></div>
						<span class="switch_content_type" data-type="image">Remove image</span>
					<?php } else { ?>
						<span class="switch_content_type" data-type="text">Insert image</span>
					<?php } ?>
				</div>
			</div>
		</div>
		
		<div class="col-sm-4 mb-1">
			<h6>Footer</h6>
			<div class="row formrow">
				<div class="col-sm-4">Height</div>
				<div class="col-sm-8">
					<input type="number" name="footer_h" class="form-control form-control-sm" value="<?= $printdata['footer_h'] ?>">
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-4">Left Width</div>
				<div class="col-sm-8">
					<input type="number" name="footer_left_w" id="footer_left_w" class="form-control form-control-sm" value="<?= $printdata['footer_left_w'] ?>">
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-4">Middle Width </div>
				<div class="col-sm-8">
					<input type="number" name="footer_middle_w" id="footer_middle_w" class="form-control form-control-sm" value="<?= $printdata['footer_middle_w'] ?>">
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-4">Right Width</div>
				<div class="col-sm-8">
					<input type="number" name="footer_right_w" id="footer_right_w" class="form-control form-control-sm" value="<?= $printdata['footer_right_w'] ?>">
				</div>
			</div>
			<div class="row formrow wrapper">
				<div class="col-sm-4">Content Left</div>
				<div class="col-sm-8">
					<textarea name="footer_left_t" class="form-control form-control-sm" <?php if($printdata['footer_left_f'] != '') echo 'style="display:none"' ?>><?= $printdata['footer_left_t'] ?></textarea>
					<input type="file" name="footer_left_f" class="form-control form-control-sm" style="display:none;">
					<input type="hidden" name="footer_left_type" class="content_type" value="<?= ($printdata['footer_left_f'] != '') ? 'image' : 'text' ?>">
					<?php if($printdata['footer_left_f'] != ''){ ?>
						<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['footer_left_f'] ?>" style="height:50px; width:auto;" ></div>
						<span class="switch_content_type" data-type="image">Remove image</span>
					<?php } else { ?>
						<span class="switch_content_type" data-type="text">Insert image</span>
					<?php } ?>
				</div>
			</div>
			<div class="row formrow wrapper">
				<div class="col-sm-4">Content Middle</div>
				<div class="col-sm-8">
					<textarea name="footer_middle_t" class="form-control form-control-sm" <?php if($printdata['footer_middle_f'] != '') echo 'style="display:none"' ?>><?= $printdata['footer_middle_t'] ?></textarea>
					<input type="file" name="footer_middle_f" class="form-control form-control-sm" style="display:none;">
					<input type="hidden" name="footer_middle_type" class="content_type" value="<?= ($printdata['footer_middle_f'] != '') ? 'image' : 'text' ?>">
					<?php if($printdata['footer_middle_f'] != ''){ ?>
						<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['footer_middle_f'] ?>" style="height:50px; width:auto;" ></div>
						<span class="switch_content_type" data-type="image">Remove image</span>
					<?php } else { ?>
						<span class="switch_content_type" data-type="text">Insert image</span>
					<?php } ?>
				</div>
			</div>
			<div class="row formrow wrapper">
				<div class="col-sm-4">Content Right</div>
				<div class="col-sm-8">
					<textarea name="footer_right_t" class="form-control form-control-sm" <?php if($printdata['footer_right_f'] != '') echo 'style="display:none"' ?>><?= $printdata['footer_right_t'] ?></textarea>
					<input type="file" name="footer_right_f" class="form-control form-control-sm" style="display:none;">
					<input type="hidden" name="footer_right_type" class="content_type" value="<?= ($printdata['footer_right_f'] != '') ? 'image' : 'text' ?>">
					<?php if($printdata['footer_right_f'] != ''){ ?>
						<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['footer_right_f'] ?>" style="height:50px; width:auto;" ></div>
						<span class="switch_content_type" data-type="image">Remove image</span>
					<?php } else { ?>
						<span class="switch_content_type" data-type="text">Insert image</span>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<!-- <h6>Margins</h6>
	<div class="row">
		<div class="col-sm-3 mb-1">
			Top
			<input type="number" name="margin_top" class="form-control form-control-sm" value="<?= $printdata['margin_top'] ?>">
		</div>
		<div class="col-sm-3 mb-1">
			Bottom
			<input type="number" name="margin_bottom" class="form-control form-control-sm" value="<?= $printdata['margin_bottom'] ?>">
		</div>
		<div class="col-sm-3 mb-1">
			Left
			<input type="number" name="margin_left" class="form-control form-control-sm" value="<?= $printdata['margin_left'] ?>">
		</div>
		<div class="col-sm-3 mb-1">
			Right
			<input type="number" name="margin_right" class="form-control form-control-sm" value="<?= $printdata['margin_right'] ?>">
		</div>
	</div> -->
		
	<!-- <h6>Header</h6>
	<div class="row">
		<div class="col-sm-3 mb-1">
			Height
			<input type="number" name="header_h" class="form-control form-control-sm" value="<?= $printdata['header_h'] ?>">
		</div>
		<div class="col-sm-3 mb-1">
			Left Width
			<input type="number" name="header_left_w" id="header_left_w" class="form-control form-control-sm" value="<?= $printdata['header_left_w'] ?>">
		</div>
		<div class="col-sm-3 mb-1">
			Middle Width 
			<input type="number" name="header_middle_w" id="header_middle_w" class="form-control form-control-sm" value="<?= $printdata['header_middle_w'] ?>">
		</div>
		<div class="col-sm-3 mb-1">
			Right Width
			<input type="number" name="header_right_w" id="header_right_w" class="form-control form-control-sm" value="<?= $printdata['header_right_w'] ?>">
		</div>
	</div> -->
		
	<!-- <h6>Footer</h6>
	<div class="row">
		<div class="col-sm-3 mb-1">
			Height
			<input type="number" name="footer_h" class="form-control form-control-sm" value="<?= $printdata['footer_h'] ?>">
		</div>
		<div class="col-sm-3 mb-1">
			Left Width
			<input type="number" name="footer_left_w" id="footer_left_w" class="form-control form-control-sm" value="<?= $printdata['footer_left_w'] ?>">
		</div>
		<div class="col-sm-3 mb-1">
			Middle Width
			<input type="number" name="footer_middle_w" id="footer_middle_w" class="form-control form-control-sm" value="<?= $printdata['footer_middle_w'] ?>">
		</div>
		<div class="col-sm-3 mb-1">
			Right Width
			<input type="number" name="footer_right_w" id="footer_right_w" class="form-control form-control-sm" value="<?= $printdata['footer_right_w'] ?>">
		</div>
	</div> -->

	<!-- <h6>Contents Header</h6>
	<div class="row">
		<div class="col-sm-4 wrapper">
			Left
			<textarea name="header_left_t" class="form-control form-control-sm" <?php if($printdata['header_left_f'] != '') echo 'style="display:none"' ?>><?= $printdata['header_left_t'] ?></textarea>
			<input type="file" name="header_left_f" class="form-control form-control-sm" style="display:none;">
			<input type="hidden" name="header_left_type" class="content_type" value="<?= ($printdata['header_left_f'] != '') ? 'image' : 'text' ?>">
			<?php if($printdata['header_left_f'] != ''){ ?>
				<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['header_left_f'] ?>" style="height:50px; width:auto;" ></div>
				<span class="switch_content_type" data-type="image">Remove image</span>
			<?php } else { ?>
				<span class="switch_content_type" data-type="text">Insert image</span>
			<?php } ?>
		</div>

		<div class="col-sm-4 wrapper">
			Middle
			<textarea name="header_middle_t" class="form-control form-control-sm" <?php if($printdata['header_middle_f'] != '') echo 'style="display:none"' ?>><?= $printdata['header_middle_t'] ?></textarea>
			<input type="file" name="header_middle_f" class="form-control form-control-sm" style="display:none;">
			<input type="hidden" name="header_middle_type" class="content_type" value="<?= ($printdata['header_middle_f'] != '') ? 'image' : 'text' ?>">
			<?php if($printdata['header_middle_f'] != ''){ ?>
				<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['header_middle_f'] ?>" style="height:50px; width:auto;" ></div>
				<span class="switch_content_type" data-type="image">Remove image</span>
			<?php } else { ?>
				<span class="switch_content_type" data-type="text">Insert image</span>
			<?php } ?>
		</div>

		<div class="col-sm-4 wrapper">
			Right
			<textarea name="header_right_t" class="form-control form-control-sm" <?php if($printdata['header_right_f'] != '') echo 'style="display:none"' ?>><?= $printdata['header_right_t'] ?></textarea>
			<input type="file" name="header_right_f" class="form-control form-control-sm" style="display:none;">
			<input type="hidden" name="header_right_type" class="content_type" value="<?= ($printdata['header_right_f'] != '') ? 'image' : 'text' ?>">
			<?php if($printdata['header_right_f'] != ''){ ?>
				<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['header_right_f'] ?>" style="height:50px; width:auto;" ></div>
				<span class="switch_content_type" data-type="image">Remove image</span>
			<?php } else { ?>
				<span class="switch_content_type" data-type="text">Insert image</span>
			<?php } ?>
		</div>
	</div> -->

	<!-- <h6>Contents Footer</h6>
	<div class="row">
		<div class="col-sm-4 wrapper">
			Left
			<textarea name="footer_left_t" class="form-control form-control-sm" <?php if($printdata['footer_left_f'] != '') echo 'style="display:none"' ?>><?= $printdata['footer_left_t'] ?></textarea>
			<input type="file" name="footer_left_f" class="form-control form-control-sm" style="display:none;">
			<input type="hidden" name="footer_left_type" class="content_type" value="<?= ($printdata['footer_left_f'] != '') ? 'image' : 'text' ?>">
			<?php if($printdata['footer_left_f'] != ''){ ?>
				<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['footer_left_f'] ?>" style="height:50px; width:auto;" ></div>
				<span class="switch_content_type" data-type="image">Remove image</span>
			<?php } else { ?>
				<span class="switch_content_type" data-type="text">Insert image</span>
			<?php } ?>
		</div>

		<div class="col-sm-4 wrapper">
			Middle
			<textarea name="footer_middle_t" class="form-control form-control-sm" <?php if($printdata['footer_middle_f'] != '') echo 'style="display:none"' ?>><?= $printdata['footer_middle_t'] ?></textarea>
			<input type="file" name="footer_middle_f" class="form-control form-control-sm" style="display:none;">
			<input type="hidden" name="footer_middle_type" class="content_type" value="<?= ($printdata['footer_middle_f'] != '') ? 'image' : 'text' ?>">
			<?php if($printdata['footer_middle_f'] != ''){ ?>
				<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['footer_middle_f'] ?>" style="height:50px; width:auto;" ></div>
				<span class="switch_content_type" data-type="image">Remove image</span>
			<?php } else { ?>
				<span class="switch_content_type" data-type="text">Insert image</span>
			<?php } ?>
		</div>

		<div class="col-sm-4 wrapper">
			Right
			<textarea name="footer_right_t" class="form-control form-control-sm" <?php if($printdata['footer_right_f'] != '') echo 'style="display:none"' ?>><?= $printdata['footer_right_t'] ?></textarea>
			<input type="file" name="footer_right_f" class="form-control form-control-sm" style="display:none;">
			<input type="hidden" name="footer_right_type" class="content_type" value="<?= ($printdata['footer_right_f'] != '') ? 'image' : 'text' ?>">
			<?php if($printdata['footer_right_f'] != ''){ ?>
				<div><img src="<?= siteurl ?>upload/printsettings/<?= $printdata['voucher_id'] ?>/<?= $printdata['footer_right_f'] ?>" style="height:50px; width:auto;" ></div>
				<span class="switch_content_type" data-type="image">Remove image</span>
			<?php } else { ?>
				<span class="switch_content_type" data-type="text">Insert image</span>
			<?php } ?>
		</div>
	</div> -->
<!-- 
	<h6>Show/Hide Items Table Columns</h6>
	<div class="row">
		<div class="col-sm-12 mb-1">
			<input type="checkbox" name="item_cols[itemcode]" value="1" <?php if($item_cols['itemcode']) echo 'checked'; ?>>
			Item Code<br>
			<input type="checkbox" name="item_cols[qty]" value="1" <?php if($item_cols['qty']) echo 'checked'; ?>>
			Qty<br>
			<input type="checkbox" name="item_cols[unit]" value="1" <?php if($item_cols['unit']) echo 'checked'; ?>>
			Unit<br>
			<input type="checkbox" name="item_cols[rate]" value="1" <?php if($item_cols['rate']) echo 'checked'; ?>>
			Rate<br>
			<?php if((int)$_SESSION['menu']['insurance_management']){ ?>
				<input type="checkbox" name="item_cols[policy_num]" value="1" <?php if($item_cols['policy_num']) echo 'checked'; ?>>
				Policy #<br>
				<input type="checkbox" name="item_cols[policy_amount]" value="1" <?php if($item_cols['policy_amount']) echo 'checked'; ?>>
				Policy Amt<br>
				<input type="checkbox" name="item_cols[policy_client]" value="1" <?php if($item_cols['policy_client']) echo 'checked'; ?>>
				Client Name<br>
			<?php } ?>
		</div>
	</div> -->
</div>
<input type="hidden" name="printsetting_id" value="<?= $printdata['id'] ?>">
 <script>

/*$(document).on('change', '#papersize', function(e){
	var papersize = $(this).val();
	var width = $('#preview').width().toFixed(2);
	var ratio = $(this).find('option:selected').data('ratio');
	var height = (width * ratio).toFixed(2);
});

$(document).on('change', '#header_height', function(e){
	var header_height = $(this).val();
});*/

</script>