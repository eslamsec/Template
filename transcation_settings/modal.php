<?php
if(!isset($option)){
	return;
}
$data = $option['data'];
$page = $option['page'];
$action_url = siteurl.'site/'.$page.'/save.php';
$action = base64_encode($action_url);
$currency = $option['currency_symbol'];
//$action = $action_url;
?>

<div class="modal fade " id="myModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-large modal_full"  role="document">
		<div class="modal-content">
			<div class="modal-body" style="padding-top:0px">
				<div class="row">
				
				<form method="post"  id="modalform" action="<?php echo $action ?>" autocomplete="off" >
					<div class="card-body" id="formDiv">
						<?php //page($page.'/form',$option); ?>
					</div>
					<div class="text-right card-footer">
					
					<div id="product_error_message" ></div>		
					<!--
					<button class="btn  btn-success"  type="submit" > 
					<i class="fa fa-plus-circle"></i> Save </button>
						-->
					
					<button class="btn  btn-success" name="saveBtn" id="saveBtn" type="button" data-status='1' onclick="return erp_save_form(this)"> 
					<i class="fa fa-plus-circle"></i> Save </button>
					<button class="btn  btn-danger model_close_btn" name="ResetData" type="button" data-dismiss="modal"> <i class="fa fa-ban"></i> Close</button>
					
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>