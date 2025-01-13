<!-- ========================= MODAL ======================= -->
            <div id="addModal" class="modal fade">
            <form method="post">
              <div class="modal-dialog modal-sm" style="width:500px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Manage Clearance</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">
                        <div class="col-md-12">
                                <div class="form-group">
                                    <label>Resident:</label>
                                    <select name="ddl_resident" class="select2 form-control input-sm" style="width:100%">
                                        <option selected="" disabled="">-- Select Resident -- </option>
                                        <?php
                                            // $squery = mysqli_query($con,"SELECT r.id,r.lname,r.fname,r.mname from tblresident r where ((r.id not in (select personToComplain from tblblotter)) or (r.id in (select personToComplain from tblblotter where sStatus = 'Solved')) ) and lengthofstay >= 6");
                                            $squery = mysqli_query($con,"SELECT * from tblresident ");
                                            while ($row = mysqli_fetch_array($squery)){
                                                echo '
                                                    <option value="'.$row['id'].'">'.$row['lname'].', '.$row['fname'].' '.$row['mname'].'</option>    
                                                ';
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                



                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                        <input type="submit" class="btn btn-primary btn-sm" name="btn_add" value="Add Clearance"/>
                    </div>
                </div>
              </div>
              </form>
            </div>