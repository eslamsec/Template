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

<div class="modal fade " id="myModal" style="padding:0px" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-large modal_full" role="document" style="width: 70%;">
		<div class="modal-content">
			<div class="modal-body" style="padding-top:0px">
				<div class="row">
					<div class="col-md-12 fright closeBtn"> 
						<button type="button" class="close model_close_btn" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					</div>
					
					<div class="clearfix"></div>
					<form method="post" id="modalform" action="<?php echo $action ?>" autocomplete="off" >
						<div class="card-body" id="formDiv">
							<?php page($page.'/content_form',$option); ?>
						</div>

						<div class="text-right card-footer">
							<button class="btn btn-success saveBtn" type="button" data-status="1"><i class="fa fa-plus-circle"></i> Save </button>
							<button class="btn btn-danger model_close_btn" type="button" data-dismiss="modal" onclick="$('#myModal').modal('hide')"> <i class="fa fa-ban"></i> Close</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>