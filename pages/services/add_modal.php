<!-- ========================= MODAL ======================= -->
<div id="addModal" class="modal fade">
            <form method="post" enctype="multipart/form-data">
              <div class="modal-dialog modal-sm" style="width:300px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Items and Services</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date Recorded:</label>
                                    <input name="txt_doc" class="form-control input-sm" type="date" placeholder="Date Recorded"/>
                                </div>
                                <div class="form-group">
                                    <label>Services:</label>
                                    <input name="txt_act" class="form-control input-sm" type="text" placeholder="Services"/>
                                </div>
                                <div class="form-group">
                                    <label>Purpose:</label>
                                    <textarea name="txt_desc" class="form-control input-sm" placeholder="Purpose"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Image:</label>
                                    <input name="files[]" class="form-control input-sm" type="file" multiple/>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                        <input type="submit" class="btn btn-primary btn-sm" name="btn_add" value="Add"/>
                    </div>
                </div>
              </div>
              </form>
            </div>