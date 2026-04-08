<?php
if(!isset($option)){
	return;
}
$page = $option['page'];
$search_url = siteurl.'site/'.$page.'/ajax.php';
$search_url = base64_encode($search_url);
$privilage = (int)$option['privilages']['transcation_settings']['privilage'];
?>
<div class="modal fade " id="Search_myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog innerpopup" role="document" style="max-width:500px">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
				<div class="col-md-10"><h3 id="search_modal_title">Select Ledger</h3></div>
				<div class="col-md-2"> 
					<button type="button" class="close model_close_btn" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				</div>
				<div class="clearfix"></div>
				<div id="search_box_div" style="display: flex;width: 100%;margin: 0pc 1pc;">
					<input type="text" id="keywords"   
					onkeyup="myFunction()"
					class="form-control" 
         			placeholder="Search for Group/Ledger..." 
         			>
         			<button type="button" class="btn btn-sm btn-primary" onclick="myFunction()">Search</button>
         			<button type="button" class="btn btn-sm btn-danger" onclick="erp_clear_ledger_search()">Clear</button>
         			</div>
				<form method="post" id="filter_form" action="<?php echo $search_url ?>" >
					<input type="hidden" name="privilage" id="privilage" value="<?php echo $privilage ?>">
					<input type="hidden" name="voucher_guid" id="voucher_guid_filter" value="0">
					<input type="hidden" name="counter" id="counter" value="0">
					<div id="grouptextbox"></div>
					
					<div class="card-body" id="treeview_json" style="max-height: 430px;overflow: auto;">	</div>
					
					<div class="text-right card-footer" >
					<div id="ledger_search_info" style="float: left;color: green; font-weight: bold;"></div>
					<button class="btn  btn-success btnSearch" name="searchBtn"  type="button" onclick="return erp_select_node(this)"> 
					<i class="fa fa-plus-circle"></i> Select Ledger </button>
					<button class="btn  btn-danger" name="ResetData" type="button" data-dismiss="modal"> <i class="fa fa-ban"></i> Close</button>
					</div>
				
				</form>
				</div>
			</div>
		</div>
	</div>
</div>