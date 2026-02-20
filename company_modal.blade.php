  
  
  <div class="modal fade " id="myModal" style="padding:0px" data-keyboard="false" data-backdrop="static" tabindex="-1"
      role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg modal_full "  style="max-width: 80%;" role="document">
          <div class="modal-content">
              <div class="modal-body" style="padding-top:0px">
                  <div class="row"> 
                      <div class="col-md-12 fright closeBtn">
                          <button type="button" class="close model_close_btn" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                      </div>

                      <div class="clearfix"></div>
                      <form method="post" id="modalform" action="" autocomplete="off">
                          @csrf
                          <div class="card-body" id="formDiv"> 
                          </div>
                          <div class="text-right card-footer">
                              <div id="ajax_error"></div>

                              <button class="btn  btn-success" name="saveBtn" id="saveBtn" type="button"
                                  data-status='1' onclick="save_modal_data(this)"> 
                                  <i class="fa fa-plus-circle"></i> Save </button>
                              <button class="btn  btn-danger model_close_btn" name="ResetData" type="button"
                                  data-dismiss="modal"> <i class="fa fa-ban"></i> Close</button>

                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
