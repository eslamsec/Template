<?php
if(!isset($option)){
	return;
}
$page = basename(dirname(__FILE__));
$id = $option['data'];
$id = base64_encode((int)$id);
$delete_url = base64_encode(siteurl.'site/'.$page.'/delete.php');
$edit_url = base64_encode(siteurl.'site/'.$page.'/edit.php');
$param = array();
$param['guid'] = $id;
$parameter = base64_encode(json_encode($param));
$paramCopy = array();
$paramCopy['guid'] = $id;
$paramCopy['copy'] = 1;
$parameterCopy = base64_encode(json_encode($paramCopy));
$action_url = siteurl.'site/'.$page.'/save.php';
$action = base64_encode($action_url);
$privilage = (int)$_SESSION['privilages']['transcation_settings']['privilage'];
if($privilage<4){
	echo '<div class="right">#&nbsp;&nbsp;&nbsp;</div>';
	return;
}

$voucher_guid = $option['voucher_guid'];
$custom_pdf_vouchers = array(1,2,3,4,5,8,9,10,12,14,15,22);
?>

<li class="dropdown notification-list dropdown d-lg-inline-block ml-2">
	<a class=" btaction" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
		Action <i class="icon-arrow-down-circle"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right profile-dropdown ">
		<a href="#" class="dropdown-item notify-item" 
			data-id="<?php echo $id ?>" 
			data-url="<?php echo $edit_url ?>"
			data-param="<?php echo $parameter ?>"
			data-title="Update Transaction Settings"
			data-action="<?php echo $action ?>"
			data-btnlabel = "Update"
			data-modalwidth = "75"
			onclick="return edit_form(this)">
		<i class="ti-pencil"></i>  Edit Settings
		</a>
		<a href="#" class="dropdown-item notify-item" 
			data-id="<?php echo $id ?>" 
			data-url="<?php echo $edit_url ?>"
			data-param="<?php echo $parameterCopy ?>"
			data-title="Create Transaction Settings"
			data-action="<?php echo $action ?>"
			data-btnlabel = "Save"
			data-modalwidth = "75"
			onclick="return edit_form(this)">
		<i class="ti-pencil"></i>  Copy Settings
		</a>
		<?php if(in_array($voucher_guid, $custom_pdf_vouchers)){ ?>
			<!-- <a href="transcation_settings/pdf/<?= $id ?>" class="dropdown-item notify-item">
				<i class="far fa-file-pdf"></i>  Print Settings
			</a> -->
		<?php } else { ?>
			<!-- <a href="#" class="dropdown-item notify-item" onclick="errormsg('Option not available for this voucher type.')" style="color:#c1c1c1">
				<i class="far fa-file-pdf"></i>  Print Settings
			</a> -->
		<?php } ?>
		<?php if($privilage>4){?>
		<a href="#" class="dropdown-item notify-item" 
		<?php if (strtolower($_SESSION['TALLY_ADMIN_PROFILE']['username']) !== 'finexadmin') { ?>
					style="pointer-events:none;filter:opacity(0.4)"
					<?php } ?>
			data-id="<?php echo $id ?>" 
			data-url="<?php echo $delete_url ?>"
			data-param="<?php echo $parameter ?>"
			onclick="return delete_data(this)">
		<i class="ti-trash"></i>Delete
		</a>
		<?php } ?>
	</div>
</li>