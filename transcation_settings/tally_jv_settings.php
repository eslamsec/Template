<?php
$guid = $option['guid'];
$data = $option['data'];
$voucher_guid = (int)$data['voucher_guid'];
$vouchers = get_option("erp_transaction_settings", "title", "status = '1' and  voucher_guid = 27");
$setID = (int)$data['id'];
$tallyid = (int)$data['tallyid'];
$sett = findOne("SELECT * from journal_settings where setting_id = $setID and id=$tallyid");
?>
<input type="hidden" name="tallyid"  value="<?= $tallyid ?>"/>
<div class="row">
    <div class="col-sm-4  pb-2">
        <label class="pb-2"><i>Select JV Vouchers </i></label><br>
        <select class="form-control form-control-sm " name="jv0">
            <?php foreach ($vouchers as $key => $v) { ?>
                <option value="<?= $key ?>" <?= ($key  == $sett['jv0']) ? 'selected' : '' ?>><?= $v ?></option>
            <?php } ?>
        </select>
    </div>
	<div class="col-sm-8"></div>
	<div class="col-sm-4"></div>
    <div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Credit Ledger (Spirit )</label>
					<select class="form-control form-control-sm" name="cr_ledger00">
						<?php 
							if($sett['cr_ledger00s']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['cr_ledger00s']})");
								echo "<option value='{$sett['cr_ledger00s']}' selected>{$journal_ledgers[$sett['cr_ledger00s']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Debit Ledger (HF 100%)</label>
					<select class="form-control form-control-sm" name="dr_ledger00">
						<?php 
							if($sett['dr_ledger00hf100']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['dr_ledger00hf100']})");
								echo "<option value='{$sett['dr_ledger00hf100']}' selected>{$journal_ledgers[$sett['dr_ledger00hf100']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4"></div>
	 <div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Credit Ledger (Wine )</label>
					<select class="form-control form-control-sm" name="cr_ledger01">
						<?php 
							if($sett['cr_ledger01w']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['cr_ledger01w']})");
								echo "<option value='{$sett['cr_ledger01w']}' selected>{$journal_ledgers[$sett['cr_ledger01w']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Debit Ledger (HF 150%)</label>
					<select class="form-control form-control-sm" name="dr_ledger01">
						<?php 
							if($sett['dr_ledger01hf150']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['dr_ledger01hf150']})");
								echo "<option value='{$sett['dr_ledger01hf150']}' selected>{$journal_ledgers[$sett['dr_ledger01hf150']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4"></div>
	 <div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Credit Ledger (Beer)</label>
					<select class="form-control form-control-sm" name="cr_ledger02">
						<?php 
							if($sett['cr_ledger02b']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['cr_ledger02b']})");
								echo "<option value='{$sett['cr_ledger02b']}' selected>{$journal_ledgers[$sett['cr_ledger02b']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
  
</div>
<div class="row">
    <div class="col-sm-4  pb-2">
        <label class="pb-2"><i>Select  JV Vouchers </i></label><br>
        <select class="form-control form-control-sm " name="jv1">
            <?php foreach ($vouchers as $key => $v) { ?>
                <option value="<?= $key ?>" <?= ($key  == $sett['jv1']) ? 'selected' : '' ?>><?= $v ?></option>
            <?php } ?>
        </select>
    </div>
   <div class="col-sm-8"></div>
	<div class="col-sm-4"></div>
    <div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Credit Ledger (Spirit )</label>
					<select class="form-control form-control-sm jv1" name="cr_ledger11">
						<?php 
							if($sett['cr_ledger11s']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['cr_ledger11s']})");
								echo "<option value='{$sett['cr_ledger11s']}' selected>{$journal_ledgers[$sett['cr_ledger11s']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Debit Ledger (Surcharge B2C D L1)</label>
					<select class="form-control form-control-sm jv1" name="dr_ledger11">
						<?php 
							if($sett['dr_ledger11b2cd']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['dr_ledger11b2cd']})");
								echo "<option value='{$sett['dr_ledger11b2cd']}' selected>{$journal_ledgers[$sett['dr_ledger11b2cd']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4"></div>
	 <div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Credit Ledger (Wine )</label>
					<select class="form-control form-control-sm jv1" name="cr_ledger12">
						<?php 
							if($sett['cr_ledger12w']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['cr_ledger12w']})");
								echo "<option value='{$sett['cr_ledger12w']}' selected>{$journal_ledgers[$sett['cr_ledger12w']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Debit Ledger (Surcharge B2C E L0)</label>
					<select class="form-control form-control-sm jv1" name="dr_ledger12">
						<?php 
							if($sett['dr_ledger12b2ce0']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['dr_ledger12b2ce0']})");
								echo "<option value='{$sett['dr_ledger12b2ce0']}' selected>{$journal_ledgers[$sett['dr_ledger12b2ce0']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4"></div>
	 <div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Credit Ledger (Beer)</label>
					<select class="form-control form-control-sm jv1" name="cr_ledger13">
						<?php 
							if($sett['cr_ledger13b']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['cr_ledger13b']})");
								echo "<option value='{$sett['cr_ledger13b']}' selected>{$journal_ledgers[$sett['cr_ledger13b']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Debit Ledger (Surcharge B2C E L1)</label>
					<select class="form-control form-control-sm jv1" name="dr_ledger13">
						<?php 
							if($sett['dr_ledger13b2ce1']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['dr_ledger13b2ce1']})");
								echo "<option value='{$sett['dr_ledger13b2ce1']}' selected>{$journal_ledgers[$sett['dr_ledger13b2ce1']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
  
</div>


<div class="row">
    <div class="col-sm-4  pb-2">
        <label class="pb-2"><i>Select income  JV Vouchers </i></label><br>
        <select class="form-control form-control-sm " name="jv2">
            <?php foreach ($vouchers as $key => $v) { ?>
                <option value="<?= $key ?>" <?= ($key  == $sett['jv2']) ? 'selected' : '' ?>><?= $v ?></option>
            <?php } ?>
        </select>
    </div>
   <div class="col-sm-8"></div>
	<div class="col-sm-4"></div>
    <div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Credit Ledger (Spirit )</label>
					<select class="form-control form-control-sm jv1" name="cr_ledger21">
						<?php 
							if($sett['cr_ledger21s']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['cr_ledger21s']})");
								echo "<option value='{$sett['cr_ledger21s']}' selected>{$journal_ledgers[$sett['cr_ledger21s']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Debit Ledger (Surcharge B2C D L1)</label>
					<select class="form-control form-control-sm jv1" name="dr_ledger21">
						<?php 
							if($sett['dr_ledger21b2cd']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['dr_ledger21b2cd']})");
								echo "<option value='{$sett['dr_ledger21b2cd']}' selected>{$journal_ledgers[$sett['dr_ledger21b2cd']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4"></div>
	 <div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Credit Ledger (Wine )</label>
					<select class="form-control form-control-sm jv1" name="cr_ledger22">
						<?php 
							if($sett['cr_ledger22w']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['cr_ledger22w']})");
								echo "<option value='{$sett['cr_ledger22w']}' selected>{$journal_ledgers[$sett['cr_ledger22w']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Debit Ledger (Surcharge B2C E L0)</label>
					<select class="form-control form-control-sm jv1" name="dr_ledger22">
						<?php 
							if($sett['dr_ledger22b2ce0']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['dr_ledger22b2ce0']})");
								echo "<option value='{$sett['dr_ledger22b2ce0']}' selected>{$journal_ledgers[$sett['dr_ledger22b2ce0']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4"></div>
	 <div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Credit Ledger (Beer)</label>
					<select class="form-control form-control-sm jv1" name="cr_ledger23">
						<?php 
							if($sett['cr_ledger23b']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['cr_ledger23b']})");
								echo "<option value='{$sett['cr_ledger23b']}' selected>{$journal_ledgers[$sett['cr_ledger23b']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
	<div class="col-sm-4  pb-2">
        <div class=" form-group related-field-blocks  17" <?php if(in_array($voucher_guid, [17]) ) echo 'style="display:block"'; ?>>
					<label>Journal Debit Ledger (Surcharge B2C E L1)</label>
					<select class="form-control form-control-sm jv1" name="dr_ledger23">
						<?php 
							if($sett['dr_ledger23b2ce1']){
								$journal_ledgers = find_rows("SELECT id,name FROM erp_ledgers WHERE id IN ({$sett['dr_ledger23b2ce1']})");
								echo "<option value='{$sett['dr_ledger23b2ce1']}' selected>{$journal_ledgers[$sett['dr_ledger23b2ce1']]['name']}</option>";
							}
						?>
					</select>
				</div>
    </div>
  
</div>