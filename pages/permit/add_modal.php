<!-- ========================= MODAL ======================= -->
<div id="addModal" class="modal fade">
            <form method="post">
              <div class="modal-dialog modal-sm" style="width:500px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Cedula</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div class="row">

                        
                            <div class="col-md-12">
                    
                                <div class="form-group" >
                                    <label>Name</label>
                                    <select name="txt_cname" class="select2 form-control input-sm" style="width:100%" id=ddlViewBy onchange="getId()">
                                        <option disabled selected>-- Select Resident --</option>
                                        <?php
                                            $qc = mysqli_query($con,"SELECT * from tblresident");
                                            while($rowc = mysqli_fetch_array($qc)){
                                                echo '
                                                <option value="'.$rowc['id'].'">  '.$rowc['lname'].', '.$rowc['fname'].','.$rowc['mname'].'  '.$rowc['bdate'] .'  '.$rowc['bplace'].'</option>
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
                        <input type="submit" class="btn btn-primary btn-sm" name="btn_add" value="Add Cedula"/>
                    </div>
                </div>
              </div>
              </form>
            </div>