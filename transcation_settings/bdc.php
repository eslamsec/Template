<?php
if(!isset($option)){
	return;
}
$page = $option['page'];
$url = siteurl.'site/'.$page.'/ajax.php';
$edit_url = base64_encode(siteurl.'site/'.$page.'/edit.php');
$filter_url = base64_encode(siteurl.'site/'.$page.'/filter.php');

$param = array();
$param['guid'] = 0;
$parameter = base64_encode(json_encode($param));

$param['type'] = 'search_form';
$parameter_filter = base64_encode(json_encode($param));

$action_url = siteurl.'site/'.$page.'/save.php';
$action = base64_encode($action_url);
$privilage = (int)$_SESSION['privilages']['transcation_settings']['privilage'];

?>
<div class="page-title-box">
	<div class="row">
		<div class="col-md-3"> 
			<h4 class="page-title"><i class="icon-settings"></i>&nbsp;Transaction Master </h4>
		</div>
		
		<div class="col-md-9">
			<div class="page-title-right">

				<div class="titlemenu">
					<?php if($privilage>2){?>
					<a href="#" class="btn btn-primary"
						data-id="0" 
						data-url="<?php echo $edit_url ?>"
						data-param="<?php echo $parameter ?>"
						data-title="Create Transcation Settings"
						data-action="<?php echo $action ?>"
						data-btnlabel = "Save"
						data-modalwidth = "75"
						onclick="return edit_form(this)"  >
						<i class="icon-plus"></i>New Settings
					</a>
					<?php } ?>
					
					<a class="btn btn-primary" onclick="voucher_sorting_form()"><i class="fas fa-sort-numeric-down"></i> Set Voucher Order</a>				
					
					<a href="#" style="display:none" class="btn btn-primary"
						data-id="0" 
						data-url="<?php echo $filter_url ?>"
						data-param="<?php echo $parameter_filter ?>"
						data-title="Search Products"
						data-btnlabel = "search"
						data-modalwidth = "80"
						data-hidefooter = "1"
						onclick="return search_form(this)"  >
						<i class="ti-search"></i>Search
					</a> 
					
					<a href="#"  class="btn btn-primary clearsearch1"  
						style="display:none;background-color: #ff5d48;	border-color: #ff5d48;"
						data-id="0" 
						data-url="<?php echo $filter_url ?>"
						data-param="<?php echo $parameter_filter ?>"
						onclick="return clear_search(this)"  >
						 <i class="icon-plus"></i>Clear Search
					</a>  
				</div>
			</div>
		</div>
	</div>
</div>  
