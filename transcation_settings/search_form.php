<?php
if(!isset($option)){
	return;
}
$privilage = (int)$option['privilages']['transcation_settings']['privilage'];
?>
<input type="hidden" name="privilage" id="privilage" value="<?php echo $privilage ?>">
<input type="hidden" name="voucher_guid" id="voucher_guid" value="0">
<input type="hidden" name="counter" id="counter" value="0">