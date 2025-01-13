<?php echo '
<script>
console.log("asdasdasd")
</script>
<div id="editModal'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:500px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Clearance</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">

                <div class="form-group">
                    <label>Resident:</label>
                    <select name="ddl_resident" class="select2 form-control input-sm" style="width:100%">
                        <option selected="" disabled="">-- Select Resident -- </option>
                        
                    </select>
                </div>
                
                <div>
                    <div class="form-group col-sm-6">
                        <label>Address:</label>
                        <input name="txt_address" class="form-control input-sm" type="text" />
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Birthdate</label>
                        <input name="txt_birthdate" class="form-control input-sm" type="date" />
                    </div>
                </div>
            
                <div>
                    <div class="form-group col-sm-4">
                        <label>Age:</label>
                        <input name="txt_age" class="form-control input-sm" type="text" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Blood Type</label>
                        <input name="txt_bloodType" class="form-control input-sm" type="text" />
                    </div>

                    <div class="form-group col-sm-4">
                        <label>Contact #</label>
                        <input name="txt_contactNumber" class="form-control input-sm" type="text" />
                    </div>
                </div>

                <div>
                    <div class="form-group col-sm-3">
                        <label>Place of Birth</label>
                        <input name="txt_birthPlace" class="form-control input-sm" type="text" />
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Civil Status</label>
                        <input name="txt_civilStatus" class="form-control input-sm" type="text" />
                    </div>
                    <div class="form-group col-sm-6">
                        <label>No. Years in Kauswagan</label>
                        <input name="txt_years" class="form-control input-sm" type="text" />
                    </div>
                </div>

                <div>
                    <div class="form-group col-sm-4">
                        <label>Email Address</label>
                        <input name="txt_email" class="form-control input-sm" type="text" />
                    </div>
                    <div class="form-group col-sm-4">
                        <label>For</label>
                        <select name="txt_for" class="form-control input-sm">
                            <option selected="" disabled="">-- Select -- </option>
                            <option value="Single">Barangay Clearance</option>
                            <option value="Married">Barangay Certificate</option>
                        </select> 
                    </div>  
                    <div class="form-group col-sm-4">
                        <label>Purpose</label>
                        <input name="txt_purpose" class="form-control input-sm" type="text" />
                    </div>
                </div>

                <div>
                <div>
                    
                    <div class="form-group col-sm-6">
                        <label>Others</label>
                        <input name="txt_others" class="form-control input-sm" type="text" />
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Remarks</label>
                        <input name="txt_remarks" class="form-control input-sm" type="text"/>
                    </div> 
                </div>

                <div> 
                    <div class="form-group col-sm-6">
                        <label>Indigency Approved by:</label>
                        <input name="txt_indigencyApproved" class="form-control input-sm" type="text"/>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Lupon Clerk Approval</label>
                        <input name="txt_luponApproved" class="form-control input-sm" type="text"/>
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