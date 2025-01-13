<?php echo '

<div id="editModal'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:500px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Edit Cedula</h4>
        </div>
        <div class="modal-body">
        
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>

                

                <div class="form-group" >
                    <label>Name</label>
                    <select name="txt_cname" class="form-control input-sm-12 select2" style="width:100%" id=ddlViewBy onchange="getId()">
                        <option disabled selected>-- Resident id --</option>
                        
                                <option selected>'.$row['ResidentId'].'</option>
                               
                    </select>
                </div> 

                <div>
                    <div class="form-group col-sm-6">
                        <label>Address</label>
                        <input name="txt_address" class="form-control input-sm" type="text" value="'.$row['Address'].'"/>
                    </div>

                    <div class="form-group col-sm-6">
                        <label>Place of Birth</label>
                        <input name="txt_birthplace" class="form-control input-sm" type="text" value="'.$row['Birthplace'].'"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4">

                        <label>Sex</label>
                        <select name="txt_gender" class="form-control input-sm"/>
                            <option selected="" disabled="">-- Select Sex -- </option>
                            <option value="Male" ' . ($row['Gender'] == 'Male' ? 'selected' : '') . '>Male</option>
                            <option value="Female" ' . ($row['Gender'] == 'Female' ? 'selected' : '') . '>Female</option>
                        </select> 
                    </div>                                   

                    <div class="form-group col-sm-4">
                        <label>Birthdate</label>
                        <input name="txt_birthday" class="form-control input-sm" type="text" value="'.$row['Birthday'].'"/>
                    </div>

                    <div class="col-sm-4">

                        <label>Civil Status</label>
                        <select name="txt_civilStatus" class="form-control input-sm">
                            <option selected="" disabled="">-- Select Status -- </option>
                            <option value="Single" ' . ($row['CivilStatus'] == 'Single' ? 'selected' : '') . '>Single</option>
                            <option value="Married"' . ($row['CivilStatus'] == 'Married' ? 'selected' : '') . '>Married</option>
                            <option value="Widowed"' . ($row['CivilStatus'] == 'Widowed' ? 'selected' : '') . '>Widowed</option>
                            <option value="Legally Separated"' . ($row['CivilStatus'] == 'Legally Separated' ? 'selected' : '') . '>Legally Separated</option>
                        </select> 
                    </div>                                   
                </div>

                <div class="form-group">
                    <div class="form-group col-sm-6">
                        <label>Height</label>
                        <input name="txt_height" class="form-control input-sm" type="text" value="'.$row['Height'].'"/>
                    </div>
                                    

                    <div class="form-group col-sm-6">
                        <label>Weight</label>
                        <input name="txt_weight" class="form-control input-sm" type="text" value="'.$row['Weight'].'"/>
                    </div>
                
                </div>

                <div class="form-group">
                                    
                    <div class="form-group col-sm-3">
                        <input type="radio" id="Senior" name="txt_employmentStatus" value="Senior"' . ($row['EmploymentStatus'] == 'Senior' ? 'checked' : '') . '>
                        <label for="Senior" style=" font-size: 10px;"  >Senior Citizen</label><br>
                    </div>
                
                    <div class="form-group col-sm-3">
                        <input type="radio" id="Student" name="txt_employmentStatus" value="Student"' . ($row['EmploymentStatus'] == 'Student' ? 'checked' : '') . '>
                        <label for="Student"  style=" font-size: 10px;">Student</label><br>
                    </div>
                    <div class="form-group col-sm-3">
                        <input type="radio" id="Unemployed" name="txt_employmentStatus" value="Unemployed"' . ($row['EmploymentStatus'] == 'Unemployed' ? 'checked' : '') . '>
                        <label for="Unemployed"  style=" font-size: 10px;">Unemployed</label><br>
                    </div>
                    <div class="form-group col-sm-3">
                        <input type="radio" id="Employee" name="txt_employmentStatus" value="Employee" ' . ($row['EmploymentStatus'] == 'Employee' ? 'checked' : '') . '>
                        <label for="Employee"  style=" font-size: 10px;">Employee</label><br>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group col-sm-6">
                        <label>Occupation (if employed)</label>
                        <input name="txt_occupation" class="form-control input-sm" type="text" value="'.$row['Occupation'].'"/>
                    </div>
                                    

                    <div class="form-group col-sm-6">
                        <label>Monthly Income</label>
                        <input name="txt_monthlyIncome" class="form-control input-sm" type="text" value="'.$row['MonthlyIncome'].'"/>
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
</div>';

?>