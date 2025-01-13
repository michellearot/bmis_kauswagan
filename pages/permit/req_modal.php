<!-- ========================= MODAL ======================= -->
            <div id="reqModal" class="modal fade">
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
                                                <option>'.$rowc['id'].",".$rowc['lname'].', '.$rowc['fname'].','.$rowc['mname'].'</option>
                                                ';
                                            }
                                        ?>   
                                    </select>

                                    

                                </div>

                                <script>

                                    function getId() {
                                        // Get the selected value from the dropdown
                                        var selectedValue = document.getElementById("ddlViewBy").value;

                                        const myArray = selectedValue.split(",");
                                        let id = myArray[0];
                                        console.log(id)
                                        // document.getElementById("txt_address").value = "Updated value using JS"

                                        $.ajax({
                                            type : "POST",  //type of method
                                            url  : "function.php",  //your page
                                            data : { id : id},// passing the values
                                            success: function(res){  
                                                                    //do what you want here...
                                                    }
                                        });
                                    }
                                        // console.log(
                                        
                                        // )
                                    
                                </script>
                            
                                <div>
                                    <div class="form-group col-sm-6">
                                        <label>Address</label>
                                        <input name="txt_address" id="txt_address" class="form-control input-sm" type="text" placeholder="Address" value=/>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label>Place of Birth</label>
                                        <input name="txt_birthplace" class="form-control input-sm" type="text" placeholder="Place of Birth"/>
                                    </div>
                                </div>
                                
                               

                                <div class="form-group">
                                    <div class='col-sm-4'>

                                        <label>Sex</label>
                                        <select name="txt_gender" class="form-control input-sm">
                                            <option selected="" disabled="">-- Select Sex -- </option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select> 
                                    </div>                                   

                                    <div class="form-group col-sm-4">
                                        <label>Birthdate</label>
                                        <input name="txt_birthday" class="form-control input-sm" type="text" placeholder="Birthdate"/>
                                    </div>

                                    <div class='col-sm-4'>

                                        <label>Civil Status</label>
                                        <select name="txt_civilStatus" class="form-control input-sm">
                                            <option selected="" disabled="">-- Select Status -- </option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Legally Separated">Legally Separated</option>
                                        </select> 
                                    </div>                                   
                                </div>

                                <div class="form-group">
                                    <div class="form-group col-sm-6">
                                        <label>Height</label>
                                        <input name="txt_height" class="form-control input-sm" type="text" placeholder="Height"/>
                                    </div>
                                                 

                                    <div class="form-group col-sm-6">
                                        <label>Weight</label>
                                        <input name="txt_weight" class="form-control input-sm" type="text" placeholder="Weight"/>
                                    </div>
                                
                                </div>

                                <div class="form-group">
                                                 
                                    <div class="form-group col-sm-3">
                                        <input type="radio" id="Senior" name="txt_employmentStatus" value="Senior">
                                        <label for="Senior" style=" font-size: 10px;">Senior Citizen</label><br>
                                    </div>
                                
                                    <div class="form-group col-sm-3">
                                        <input type="radio" id="Student" name="txt_employmentStatus" value="Student">
                                        <label for="Student"  style=" font-size: 10px;">Student</label><br>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <input type="radio" id="Unemployed" name="txt_employmentStatus" value="Unemployed">
                                        <label for="Unemployed"  style=" font-size: 10px;">Unemployed</label><br>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <input type="radio" id="Employee" name="txt_employmentStatus" value="Employee">
                                        <label for="Employee"  style=" font-size: 10px;">Employee</label><br>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group col-sm-6">
                                        <label>Occupation (if employed)</label>
                                        <input name="txt_occupation" class="form-control input-sm" type="text" placeholder="Occupation"/>
                                    </div>
                                                 

                                    <div class="form-group col-sm-6">
                                        <label>Monthly Income</label>
                                        <input name="txt_monthlyIncome" class="form-control input-sm" type="text" placeholder="Monthly Income"/>
                                    </div>
                                
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