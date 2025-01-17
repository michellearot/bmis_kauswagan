<!-- ========================= MODAL ======================= -->
<?php echo '
<div id="viewDate'.$i.$checkMonth.$year.'" class="modal fade">
            <form method="post" enctype="multipart/form-data">
              <div class="modal-dialog modal-sm" style="width:300px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Events</h4>
                    </div>
                    <div class="modal-body">';

                    
                    $curDate = date( "Y-m-d", strtotime($year.'-'.$checkMonth.'-'.$i));

                    $edit_query = mysqli_query($con,"SELECT * from tblactivity where dateofactivity = '".$curDate."' ");
                    $erow = mysqli_fetch_array($edit_query);

                    if($edit_query->num_rows > 0 ){

                       echo '

                        '.$erow['activity'].'<br>'.
                          $erow['description'].'<br>'.
                          $erow['Status'].'<br>';


                    }else{ 

                        echo'

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Date of the Event:</label><br>
                                    <textarea style="display:none" name="txt_doc" value ="'.$curDate.'"> '.$curDate.'  </textarea>                    
                                    '.$curDate.'
                                    </div>
                                <div class="form-group">
                                    <label>Event Name:</label>
                                    <input name="txt_act" class="form-control input-sm" type="text" placeholder="Activity Name"/>
                                </div>
                                <div class="form-group">
                                    <label>Description:</label>
                                    <textarea name="txt_desc" class="form-control input-sm" placeholder="Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Image:</label>
                                    <input name="files[]" class="form-control input-sm" type="file" multiple/>
                                </div>
                            </div>
                        </div>
                        ';
                    }

                    
                    $addButton = "";
                    if(!$edit_query->num_rows > 0 ){
                        $addButton ='<input type="submit" class="btn btn-primary btn-sm" name="btn_add" value="Add Activity"/>';
                    }    
                    echo'   
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                        '.$addButton.'
                    </div>
                </div>
              </div>
              </form>
            </div>

        ';
        ?>