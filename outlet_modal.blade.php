<div class="modal fade " id="myModal"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-large modal_full" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
				<div class="col-md-10"><h5 id="modal_title" class="m-0">{{ translate('Create Outlet') }}</h3></div>
				<div class="col-md-2"> 
					<button type="button" class="close model_close_btn" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				</div>
				<div class="clearfix"></div>
				<form method="post" id="modalform" action=""  autocomplete="off">
                     @csrf
					<div class="card-body pt-1 pb-0" id="formDiv" ></div>
					<div class="text-right card-footer" >
                         <div id="ajax_error"></div>
						<button class="btn  btn-success btnSave" name="saveBtn" id="saveBtn" type="button" onclick="save_modal_data(this)"> 
						<i class="fa fa-plus-circle"></i> {{ translate('Save') }} </button>
						<button class="btn  btn-danger" name="ResetData" type="button" data-dismiss="modal"> <i class="fa fa-ban"></i>  {{ translate('Close') }}</button>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>