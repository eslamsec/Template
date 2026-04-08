<?php
    require('../../../lib/settings.php');

	$voucher_groups = array();
	$voucher_groups[1] = 'Sales';
	$voucher_groups[2] = 'Purchase';
	$voucher_groups[3] = 'Others';
?>

<div class="row">
	<div class="col-md-12">
		<select class="form-control form-control-sm voucher-type" name="voucher_type">
			<option value="">Select Voucher Type</option>
			<?php 
				foreach($voucher_groups as $i=>$group){
					echo "<optgroup label='$group'>";
					$voucher_types = findQuery("SELECT * FROM erp_vouchers WHERE voucher_type=$i ORDER BY serial_no");
					foreach($voucher_types as $v){
						if(!in_array($v['id'], [2,3,4,5,6,19,21])) continue;

						$id = $v['id'];
						$name = $v['name'];
						echo "<option value='$id'>$name</option>";
					}
					echo "</optgroup>";
				}
			?>
		</select>
	</div>

	<div class="col-md-12 voucher-list mt-2"></div>
</div>