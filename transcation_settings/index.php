<?php
if(!isset($option)){
	require('../../lib/settings.php');
	$option = json_decode(base64_decode($_REQUEST['jsondata']),true);
}
if($option[1] == 'pdf'){
	$option['page'] = $page.'/'.$option[1];
	page('transcation_settings/pdf',$option);
	return;
}
$counter_json = json_decode(base64_decode($option[2]));
$counter_page = $test->counter;
$page = basename(dirname(__FILE__));
$option['page'] = $page;
$option['modalTitle'] = 'Create Quotation Master';
$filter_param['counter'] = $counter_page;
$option['filter'] = $filter_param;
$privilage = (int)$option['privilages']['transcation_settings']['privilage'];
if(!$privilage){
	page('404/index',$option);
	return;
}

$voucher_option['table'] = 'erp_vouchers';
$voucher_option['were'] = ' id != 0';
$voucherArray = get_option_array($voucher_option);
$option['voucher'] = $voucherArray;
?>
<?php page($page.'/modal',$option);  ?>
<?php page($page.'/search_modal',$option);  ?>
<script src="<?php echo siteurl.'site/'.$page.'/js/js.js?time='.time() ?>"></script>
<script type="text/javascript" charset="utf8" src="<?php echo siteurl ?>assets/js/bootstrap-treeview.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<style type="text/css" id="treeview12-style"> 
.innerpopup{
	max-width:80%;
}
@font-face {
  font-family: 'Glyphicons Halflings';
  src: url('<?php echo siteurl ?>bootstrap/fonts/glyphicons-halflings-regular.eot');
  src: url('<?php echo siteurl ?>bootstrap/fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'), url('<?php echo siteurl ?>bootstrap/fonts/glyphicons-halflings-regular.woff') format('woff'), url('<?php echo siteurl ?>bootstrap/fonts/glyphicons-halflings-regular.ttf') format('truetype'), url('<?php echo siteurl ?>bootstrap/fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular') format('svg');
}
</style>
<link href="<?php echo siteurl.'site/'.$page.'/style.css?time='.time(); ?>" rel="stylesheet" type="text/css" />

<div class="content">
	<div class="container-fluid">
	<?php page($page.'/bdc',$option); ?>   
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card-box" id="filter_div">
					<?php  page($page.'/list',$option); ?> 
				</div>
			</div>
		</div>
	</div>
</div>
