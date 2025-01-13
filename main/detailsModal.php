
<!-- ========================= MODAL ======================= -->
<div id="detailsModal<?php echo $row['id'];?>" class="modal fade">
<form method="post">
  <div class="modal-dialog " >
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Details of <?php echo '<b>'.$row['cname'].'</b>';?></h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                
                <?php
                echo '
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name:</label><br>
                        '.$row['cname'].'
                    </div>
                    <div class="form-group">
                        <label>Gender:</label><br>
                        '.$row['gender'].'
                    </div>
                    <div class="form-group">
                        <label>Birthdate:</label><br>
                        '.$row['bdate'].'
                    </div>
                    <div class="form-group">
                        <label>Bloodtype:</label><br>
                        '.$row['bloodtype'].'
                    </div>
                    <div class="form-group">
                        <label>Monthly Income:</label><br>
                        '.$row['monthlyincome'].'
                    </div>
                    <div class="form-group">
                        <label>Length of Stay:</label><br>
                        '.$row['lengthofstay'].'
                    </div>
                    <div class="form-group">
                        <label>Nationality:</label><br>
                        '.$row['nationality'].'
                    </div>
                    <div class="form-group">
                        <label>House Ownership Status:</label><br>
                        '.$row['houseOwnershipStatus'].'
                    </div>
                    <div class="form-group">
                        <label>Former Address:</label><br>
                        '.$row['formerAddress'].'
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Age:</label><br>
                        '.$row['age'].'
                    </div>
                    <div class="form-group">
                        <label>Civil Status:</label><br>
                        '.$row['civilstatus'].'
                    </div>
                    <div class="form-group">
                        <label>Birth Place:</label><br>
                        '.$row['bplace'].'
                    </div>
                    <div class="form-group">
                        <label>Zone:</label><br>
                        '.$row['zone'].'
                    </div>
                    <div class="form-group">
                        <label>Differently Abled Person:</label><br>
                        '.$row['differentlyabledperson'].'
                    </div>
                    <div class="form-group">
                        <label>Occupation:</label><br>
                        '.$row['occupation'].'
                    </div>
                    <div class="form-group">
                        <label>Religion:</label><br>
                        '.$row['religion'].'
                    </div>
                    <div class="form-group">
                        <label>Highest Educational Attainment:</label><br>
                        '.$row['highestEducationalAttainment'].'
                    </div>
                    <div class="form-group">
                        <label>Land Ownership Status:</label><br>
                        '.$row['landOwnershipStatus'].'
                    </div>
                    <div class="form-group">
                </div>';
                ?>
            </div>
            
        </div>
        <div class="modal-footer">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Close"/>
        </div>
    </div>
  </div>
  </form>
</div>