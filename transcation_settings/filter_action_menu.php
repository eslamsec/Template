<?php
if(!isset($option)){
	return;
}
$filter = $option['filter'];
$vocher_guid = (int)$filter['voucher_guid'];
if($option['voucher']){
	$data = $option['voucher'];
}else{
	$voucher_option['table'] = 'erp_vouchers';
	$voucher_option['were'] = ' id != 0 ';
	$data = get_option_array($voucher_option);
}
$data[0] = 'Áll';
$voucherType = array();
$voucherType[1] = 'Sales';
$voucherType[2] = 'Purchase';
$voucherType[2] = 'Purchase';
?>
<button <?php if(17==$vocher_guid) echo 'style="color:blue"';?>  type="button" class="mr-2 btn btn-sm btn-light  m-0 p-1 tsfilter" data-name="Retail POS" data-status="17" >Retail POS</button>
<button <?php if(18==$vocher_guid) echo 'style="color:blue"';?>  type="button" class="mr-2 btn btn-sm btn-light  m-0 p-1 tsfilter" data-name="FnB" data-status="18" >FnB POS</button>
<button <?php if(12==$vocher_guid) echo 'style="color:blue"';?>  type="button" class="mr-2 btn btn-sm btn-light  m-0 p-1 tsfilter" data-name="Purchase" data-status="12" >Purchase</button>

<button <?php if(5==$vocher_guid) echo 'style="color:blue"';?>  type="button" class="mr-2 btn btn-sm btn-light  m-0 p-1 tsfilter" data-name="Sales" data-status="5" >Sales</button>
<button  <?php if(4==$vocher_guid) echo 'style="color:blue"';?> type="button" class="mr-2 btn btn-sm btn-light  m-0 p-1 tsfilter" data-name="Delivery Note" data-status="4" >Delivery Note</button>
<button <?php if(3==$vocher_guid) echo 'style="color:blue"';?>  type="button" class="mr-2 btn btn-sm btn-light  m-0 p-1 tsfilter" data-name="Sales Order" data-status="3" >Sales Order</button>
<button <?php if(2==$vocher_guid) echo 'style="color:blue"';?>  type="button" class="mr-2 btn btn-sm btn-light  m-0 p-1 tsfilter" data-name="Quotation" data-status="2" >Quotation</button>
<button <?php if(!$vocher_guid) echo 'style="color:blue"';?>  type="button" class="mr-2 btn btn-sm btn-light  m-0 p-1 tsfilter" data-name="All" data-status="0" >All</button>

<li class="dropdown notification-list dropdown d-lg-inline-block ml-2">
	<a class=" btaction" data-toggle="dropdown" href="#" id="fmenu" role="button" aria-haspopup="false" aria-expanded="false">
		<?php if($vocher_guid) echo $data[$vocher_guid]; else echo "All"; ?>  
		<i class="icon-arrow-down-circle"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right profile-dropdown " style="width:500px">
		<?php if($vocher_guid){?>
			<a href="#" class="dropdown-item notify-item tsfilter" style="color:red"
					data-name="All"
					data-status="0">
					<i class="ti-eye"></i>  All
				</a>
		<?php } ?>
		<div class="row">
			<div class="col-md-4">
				<a>Sales</a>
				<hr>
				<?php 
					$voucherData = findQuery("SELECT id,name from erp_vouchers where voucher_type=1 order by serial_no asc");
					for($i=0;$i<count($voucherData);$i++){ 
						$id = $voucherData[$i]['id'];
				?>	
				<a href="#" class="dropdown-item notify-item tsfilter" <?php if($id==$vocher_guid) echo 'style="color:blue"';?>
					data-name="<?php echo $voucherData[$i]['name']; ?>"
					data-status="<?php echo $voucherData[$i]['id']; ?>">
					<i class="ti-eye"></i>  <?php echo $voucherData[$i]['name']; ?>
				</a>
				<?php }  ?>
			</div>
			<div class="col-md-4" style="overflow: hidden;">
				<a>Purchase</a>
				<hr>
				<?php
					$voucherData = findQuery("SELECT id,name from erp_vouchers where voucher_type=2 order by serial_no asc");
					for($i=0;$i<count($voucherData);$i++){ 
						$id = $voucherData[$i]['id'];
				?>	
				<a href="#" class="dropdown-item notify-item tsfilter" <?php if($id==$vocher_guid) echo 'style="color:blue"';?>
					data-name="<?php echo $voucherData[$i]['name']; ?>"
					data-status="<?php echo $voucherData[$i]['id']; ?>">
					<i class="ti-eye"></i>  <?php echo $voucherData[$i]['name']; ?>
				</a>
				<?php  } ?>
			</div>
			<div class="col-md-4">
				<a>Other Sales</a>
				<hr>
				<?php
					$voucherData = findQuery("SELECT id,name from erp_vouchers where voucher_type=3 order by serial_no asc");
					for($i=0;$i<count($voucherData);$i++){ 
						$id = $voucherData[$i]['id'];
				?>	
				<a href="#" class="dropdown-item notify-item tsfilter" <?php if($id==$vocher_guid) echo 'style="color:blue"';?>
					data-name="<?php echo $voucherData[$i]['name']; ?>"
					data-status="<?php echo $voucherData[$i]['id']; ?>">
					<i class="ti-eye"></i>  <?php echo $voucherData[$i]['name']; ?>
				</a>
				<?php  } ?>
			</div>
		</div>
	</div>
</li>