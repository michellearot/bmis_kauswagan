<?php echo '<div id="editModal'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit User Role</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div style="display:none" class="form-group">
                    <label>Name: <span style="color:gray; font-size: 10px;">(Lastname, Firstname Middlename)</span></label>
                    <input name="txt_edit_name" class="form-control input-sm" type="text" value="'.$row['name'].'"/>
                </div>
                <div style="display:none" class="form-group">
                    <label>Username: </label>
                    <input name="txt_edit_uname" class="form-control input-sm" type="text" value="'.$row['username'].'" />
                </div>
                <div style="display:none" class="form-group">
                    <label>Password: </label>
                    <input name="txt_edit_pass" class="form-control input-sm" type="password" value="'.$row['password'].'" />
                </div>


                <div class="form-group">
                    <select name="txt_edit_role" class="form-control input-sm">
                        <option value="Staff">Staff</option>
                        <option value="Permit Admin">Permit Admin</option>
                    </select>
                
                </div>
                
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_save" value="Save"/>
        </div>
    </div>
  </div>
</form>
</div>';?>