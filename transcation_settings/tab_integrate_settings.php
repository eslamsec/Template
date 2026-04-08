<?php
	$guid = $option['guid'];
	$data = $option['data'];
	if($data['voucher_guid'] == 15){
		$vouchers = get_option("erp_transaction_settings","title","status = '1' and  voucher_guid = 9");
?>
<div class="row">
	<div class="col-sm-4 pt-4 pb-2">
		<label class="pb-2"><i>Select PO Autocreate  Integration Vouchers </i></label><br>
		<select class="form-control form-control-sm " name="autocreate_po"  >
			<?php foreach($vouchers as $key=>$v){ ?>
					<option value="<?= $key ?>" <?= ($key  == $data['autocreate_po']) ? 'selected' : '' ?> ><?= $v?></option>
			<?php } ?>
		</select>
	</div>
</div>
<?php
	}
	// $integrate = array();
	// if($guid){
	// 	$integrate = findQuery("SELECT * from erp_integrate_settings where voucher_id=$guid and type = 0 ");
	// 	$integrate = $printdata[0];
	// }
	// $host = get_subdomain();
	// if($host  == 1010    ||  $host == 1011 || $host == 1012 || $host  == 'ghcuae'    ||  $host == 'ghcksa' || $host == 'ghcbah') {}else return;
	// $vouchers = get_option("erp_transaction_settings","title", " status  ='1'  and voucher_guid = 15  ");
	// unset($vouchers[0]);

	if($data['voucher_guid'] != 3) return;
	require("config/db.php");
	$branch = get_erp_branch();
	if($branch == '1010' ){
		try {
			$con_1012 = mysqli_connect($DB_HOST_1025, $DB_USER_1025, $DB_PASS_1025, $DB_NAME_1025);
		}catch(mysqli_sql_exception $e){
			$json['saveStatus'] = 0;
			$json['msg'] = $e->getMessage();
			echo json_encode($json);
			exit;
		}
		if ($con_1012->connect_error) {
			$json['saveStatus'] = 0;
			$json['msg'] = 'Not able to connect to branch database.';
			echo json_encode($json);
			exit;
		}else{
			$sql="SELECT * FROM $DB_NAME_1025.erp_transaction_settings 
							where $DB_NAME_1025.erp_transaction_settings.status = '1'
							and     $DB_NAME_1025.erp_transaction_settings.voucher_guid = 15   ";
			$vouchers = mysqli_query($con_1012,$sql);
		}
	}else if($branch == 'ghcbah' ){
		try {
			$con_ksa = mysqli_connect($DB_HOST_KSA, $DB_USER_KSA, $DB_PASS_KSA, $DB_NAME_KSA);
		}catch(mysqli_sql_exception $e){
			$json['saveStatus'] = 0;
			$json['msg'] = $e->getMessage();
			echo json_encode($json);
			exit;
		}
		if ($con_ksa->connect_error) {
			$json['saveStatus'] = 0;
			$json['msg'] = 'Not able to connect to branch database.';
			echo json_encode($json);
			exit;
		}else{
			$sql="SELECT * FROM $DB_NAME_KSA.erp_transaction_settings 
						where $DB_NAME_KSA.erp_transaction_settings.status = '1'  
						and     $DB_NAME_KSA.erp_transaction_settings.voucher_guid = 15   ";
			$vouchers = mysqli_query($con_ksa,$sql);
		}
	}else if($branch == 'localhost1'){
		$sql="SELECT * FROM erp_transaction_settings 
							where erp_transaction_settings.status = '1'
							and     erp_transaction_settings.voucher_guid = 15   ";
			$vouchers = findQuery($sql);
	}else{
		return;
	}
	$selectedPRs = [];
	$selectedPR = $data['intgrt_pr'];
	if(!empty($selectedPR)){
		$selectedPR = json_decode(base64_decode($selectedPR),true);
		if(is_array($selectedPR)) $selectedPRs  = array_keys($selectedPR);
	}
?>
<div class="row">
	<div class="col-sm-12 pt-4 pb-2">
		<label class="pb-2"><i>Select KSA PR Integration Vouchers </i></label><br>
		<select class="form-control form-control-sm hidden" id="intgrt_pr_select" multiple="multiple" >
			<?php foreach($vouchers as $v){ ?>
					<option value="<?= $v['id'] ?>" <?= (in_array($v['id'],$selectedPRs)) ? 'selected' : '' ?> data-label="<?= $v['title']?>"><?= $v['title']?></option>
			<?php } ?>
		</select>
		<input type="hidden" name="intgrt_pr_keyval" id="intgrt_pr_keyval" value="<?= $data['intgrt_pr'] ?>">
	</div>
</div>
<div class="row hidden" style="margin-top:15px;">
	<div class="col-sm-12">
		<input type="checkbox" value="1" onchange="(this.checked === true) ? $('.remote-div').removeClass('hidden') :  $('.remote-div').addClass('hidden'); " name="integrate" id="integrate" <?php if($integrate) echo 'checked' ?> >
		<label for="integrate">Integrate</label>
	</div>
	<div class="col-sm-12">
		<input type="checkbox" value="1" onchange="(this.checked === true) ? $('.autocreate-div').removeClass('hidden') :  $('.autocreate-div').addClass('hidden'); " name="autocreate" id="autocreate" <?php if($autocreate) echo 'checked' ?> >
		<label for="integrate">Auto Create</label>
	</div>
</div>
<div class="row remote-div hidden" style="margin-top:15px;">
	<div class="col-sm-3">
		<label for="integrate">Remote Branch</label>
	</div>
    <div class="col-sm-3">
        <select name="remote_branch" data-siteurl="<?php echo base64_encode(siteurl.'site/transcation_settings/ajax/get-vouchers.php')?>" class="form-control form-control-sm" onchange="get_remote_vouchers(this)">
                <option value="0">Select Branch</option>    
               <?php if($host == 1011 || $host == 1012) { ?> <option value="1010"  data-db="db_1023">1010</option><?php } ?>
				<?php if($host == 1010 || $host == 1012) { ?><option value="1011" data-db="db_1024">1011</option><?php } ?>
					<?php if($host == 1010 || $host == 1011) { ?> <option value="1012"  data-db="db_1025">1012</option><?php } ?>
					<?php if($host == 'ghcuae' || $host == 'ghcbah') { ?> <option value="ghcksa"  data-db="db_1023">GHC-KSA</option><?php } ?>
				<?php if($host ==  'ghcuae' || $host ==  'ghcksa') { ?><option value="ghcbah" data-db="db_1024">GHC-BAH</option><?php } ?>
					<?php if($host ==  'ghcksa' || $host ==  'ghcbah') { ?> <option value="ghcuae"  data-db="db_1025">GHC-UAE</option><?php } ?>
        </select>
    </div>
</div>
<div class="row remote-div hidden" style="margin-top:15px;">
	<div class="col-sm-3">
		<label for="integrate">Remote Voucher</label>
	</div>
    <div class="col-sm-3">
        <select class="form-control form-control-sm" name="remote_voucher_guid" id="remote_vouchers" >
            
        </select>
    </div>
</div>
<div class="row remote-div hidden" style="margin-top:15px;">
	<div class="col-sm-3">
		<label for="integrate">Remote Customer</label>
	</div>
    <div class="col-sm-3">
        <select class="form-control form-control-sm" name="remote_customer_guid" id="remote_customers" >
            
        </select>
    </div>
</div>
<div class="row remote-div hidden" style="margin-top:15px;">
	<div class="col-sm-3">
		<label for="integrate">Remote Supplier</label>
	</div>
    <div class="col-sm-3">
        <select class="form-control form-control-sm" name="remote_vendor_guid" id="remote_vendors" >
            
        </select>
    </div>
</div>
<div class="row autocreate-div hidden" style="margin-top:15px;">
	<div class="col-sm-3">
		<label for="integrate"> Select Voucher to Create</label>
	</div>
    <div class="col-sm-3">
        <select class="form-control form-control-sm" name="autocreate_voucher_id" >
            <option value="0" >Select AutoCreate Voucher</option>
			<?php foreach($vouchers as $vid=>$voucher){ ?>
            	<option value="<?php echo $vid?>" >AutoCreate -<?php echo $voucher?></option>
			<?php } ?>
        </select>
    </div>
</div>
<div class="row remote-div hidden" style="margin-top:15px;">
	<div class="col-sm-3">
		<label for="integrate">Remote User</label>
	</div>
    <div class="col-sm-3">
        <select class="form-control form-control-sm" name="remote_user_guid" id="remote_users" >
            
        </select>
    </div>
</div>
<script>
	$(document).ready(function () {
    $('#intgrt_pr_select').multiselect({
        buttonWidth: '300px',
        enableFiltering: true,
        maxHeight: 200,
        onChange: function (option, checked) {
            updateKeyValField();
        },
        onDropdownHide: function () {
            updateKeyValField(); // Also update when user closes dropdown
        }
    });

    function updateKeyValField() {
        var keyValObj = {};
        $('#intgrt_pr_select option:selected').each(function () {
            var id = $(this).val();
            var label = $(this).data('label') || $(this).text();
            keyValObj[id] = label;
        });
        $('#intgrt_pr_keyval').val(btoa(JSON.stringify(keyValObj)));
    }
});
</script>

