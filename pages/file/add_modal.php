<div id="addModal" class="modal fade">
    <form method="post" enctype="multipart/form-data">
        <div class="modal-dialog modal-sm" style="width:300px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Upload File</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>File:</label>
                        <input type="file" name="file_upload" class="form-control input-sm" required/>
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <input type="text" name="file_description" class="form-control input-sm" placeholder="Enter description" required/>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                    <input type="submit" class="btn btn-primary btn-sm" name="btn_upload" value="Upload"/>
                </div>
            </div>
        </div>
    </form>
</div>
