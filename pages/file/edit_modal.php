<?php echo '<div id="editModal'.$row['id'].'" class="modal fade">
<form method="post">
    <div class="modal-dialog modal-sm" style="width:300px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit File Details</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="file_id" value="'.$row['id'].'"/>
                <div class="form-group">
                    <label>File Name:</label>
                    <input type="text" name="file_name" class="form-control input-sm" value="'.$row['filename'].'" required/>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <input type="text" name="file_description" class="form-control input-sm" value="'.$row['description'].'" required/>
                </div>
            </div>
            <div class="modal-footer">
                <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                <input type="submit" class="btn btn-primary btn-sm" name="btn_edit" value="Save Changes"/>
            </div>
        </div>
    </div>
</form>
</div>'; ?>
