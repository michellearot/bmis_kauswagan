<!-- ========================= MODAL ======================= -->
            <div id="disapproveModal<?php echo $row['id']?>" class="modal fade">
            <form method="post">
              <div class="modal-dialog modal-sm" style="width:300px !important;">
                <div class="modal-content">
                
                
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Approve Clearance</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        echo '
                    <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>';
                        ?>

                    <div class="modal-body">
                            <?php
                            echo '
                    <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>';
                            ?>
                            <p>Are you sure you want to approve this clearance?</p>
                            
                        </div>
                        
                    </div>
            
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                        <input type="submit" class="btn btn-primary btn-sm" name="btn_disapprove" value="Disapprove"/>
                    </div>
                </div>
              </div>
              </form>
            </div>