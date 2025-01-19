<?php
if(isset($_POST['btn_add'])){
    $txt_lname = mysqli_real_escape_string($con,  $_POST['txt_lname']);
    $txt_fname = mysqli_real_escape_string($con, $_POST['txt_fname']);
    $txt_mname = mysqli_real_escape_string($con,$_POST['txt_mname']);
    $txt_suffix = mysqli_real_escape_string($con, $_POST['txt_suffix']);
    $ddl_gender = mysqli_real_escape_string($con,$_POST['ddl_gender']);
    $txt_bdate = mysqli_real_escape_string($con,$_POST['txt_bdate']);
    $txt_bplace = mysqli_real_escape_string($con,$_POST['txt_bplace']);

    //$txt_age = $_POST['txt_age'];
    $dateOfBirth = $txt_bdate;
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $txt_age = $diff->format('%y');

    $txt_brgy = mysqli_real_escape_string($con,$_POST['txt_brgy']);
    $txt_dperson = mysqli_real_escape_string($con,$_POST['txt_dperson']);
    $txt_mstatus = mysqli_real_escape_string($con,$_POST['txt_mstatus']);
    $txt_zone = mysqli_real_escape_string($con,$_POST['txt_zone']);
    $txt_householdmem =mysqli_real_escape_string($con, $_POST['txt_householdmem']);
    $txt_rthead =mysqli_real_escape_string($con, $_POST['txt_rthead']);

    $txt_btype = mysqli_real_escape_string($con,$_POST['txt_btype']);
    $txt_cstatus = mysqli_real_escape_string($con,$_POST['txt_cstatus']);
    $txt_occp = mysqli_real_escape_string($con,$_POST['txt_occp']);
    $txt_income = mysqli_real_escape_string($con,$_POST['txt_income']);
    $txt_householdnum = mysqli_real_escape_string($con,$_POST['txt_householdnum']);
    $txt_length = mysqli_real_escape_string($con,$_POST['txt_length']);
    $txt_religion = mysqli_real_escape_string($con,$_POST['txt_religion']);
    $txt_national = mysqli_real_escape_string($con,$_POST['txt_national']);
    $txt_skills = mysqli_real_escape_string($con,$_POST['txt_skills']);
    $txt_igpit = mysqli_real_escape_string($con,$_POST['txt_igpit']);
    $txt_phno = mysqli_real_escape_string($con,$_POST['txt_phno']);
    $ddl_eattain = mysqli_real_escape_string($con,$_POST['ddl_eattain']);
    $ddl_hos = mysqli_real_escape_string($con,$_POST['ddl_hos']);

    $ddl_los = mysqli_real_escape_string($con,$_POST['ddl_los']);
    $ddl_dtype = mysqli_real_escape_string($con,$_POST['ddl_dtype']);
    $txt_water = mysqli_real_escape_string($con,$_POST['txt_water']);
    $txt_lightning = mysqli_real_escape_string($con,$_POST['txt_lightning']);
    $txt_toilet = mysqli_real_escape_string($con,$_POST['txt_toilet']);
    $txt_faddress = mysqli_real_escape_string($con,$_POST['txt_faddress']);

    $txt_remarks = mysqli_real_escape_string($con,$_POST['txt_remarks']);

    $name = basename($_FILES['txt_image']['name']);
    $temp = $_FILES['txt_image']['tmp_name'];
    $imagetype = $_FILES['txt_image']['type'];
    $size = $_FILES['txt_image']['size'];

    $milliseconds = round(microtime(true) * 1000);
    $image = $milliseconds.'_'.$name;

    if(isset($_SESSION['role'])){
        $action = 'Added Resident named '.$txt_lname.', '.$txt_fname.' '.$txt_mname;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    
    $ct = 0;
    
    if($ct == 0){

        if($name != ""){
            if(($imagetype=="image/jpeg" || $imagetype=="image/png" || $imagetype=="image/bmp") && $size<=2048000){
                    if(move_uploaded_file($temp, 'image/'.$image))
                    {
                    $txt_image = $image;
                    $query = mysqli_query($con,"INSERT INTO tblresident (
                                        lname,
                                        fname,
                                        mname,
                                        suffix,
                                        bdate,
                                        bplace,
                                        age,
                                        zone,
                                        totalhousehold,
                                        differentlyabledperson,
                                        relationtohead,
                                        maritalstatus,
                                        bloodtype,
                                        civilstatus,
                                        occupation,
                                        monthlyincome,
                                        householdnum,
                                        lengthofstay,
                                        religion,
                                        nationality,
                                        gender,
                                        skills,
                                        highestEducationalAttainment,
                                        houseOwnershipStatus,
                                        landOwnershipStatus,
                                        dwellingtype,
                                        formerAddress,
                                        remarks,
                                        image
                                    ) 
                                    values (
                                        '$txt_lname', 
                                        '$txt_fname', 
                                        '$txt_mname', 
                                        '$txt_suffix',  
                                        '$txt_bdate', 
                                        '$txt_bplace',
                                        '$txt_age',
                                        '$txt_zone',
                                        '$txt_householdmem',
                                        '$txt_dperson',
                                        '$txt_rthead',
                                        '$txt_mstatus',
                                        '$txt_btype',
                                        '$txt_cstatus',
                                        '$txt_occp',
                                        '$txt_income',
                                        '$txt_householdnum',
                                        '$txt_length',
                                        '$txt_religion',
                                        '$txt_national',
                                        '$ddl_gender', 
                                        '$txt_skills', 
                                        '$ddl_eattain', 
                                        '$ddl_hos',
                                        '$ddl_los', 
                                        '$ddl_dtype', 
                                        '$txt_faddress', 
                                        '$txt_remarks', 
                                        '$txt_image'
                                    )"
                            ) 
                            or die('Error: ' . mysqli_error($con));
                    }
            }
            else
            {
                $_SESSION['filesize'] = 1; 
                header ("location: ".$_SERVER['REQUEST_URI']);
            }
        }
        else
        {
             $txt_image = 'default.png';
             
        $query = mysqli_query($con,"INSERT INTO tblresident (
                                        lname,
                                        fname,
                                        mname,
                                        bdate,
                                        bplace,
                                        age,
                                        barangay,
                                        zone,
                                        totalhousehold,
                                        differentlyabledperson,
                                        relationtohead,
                                        maritalstatus,
                                        bloodtype,
                                        civilstatus,
                                        occupation,
                                        monthlyincome,
                                        householdnum,
                                        lengthofstay,
                                        religion,
                                        nationality,
                                        gender,
                                        skills,
                                        igpitID,
                                        philhealthNo,
                                        highestEducationalAttainment,
                                        houseOwnershipStatus,
                                        landOwnershipStatus,
                                        dwellingtype,
                                        waterUsage,
                                        lightningFacilities,
                                        sanitaryToilet,
                                        formerAddress,
                                        remarks,
                                        image
                                    ) 
                                    values (
                                        '$txt_lname', 
                                        '$txt_fname', 
                                        '$txt_mname',  
                                        '$txt_bdate', 
                                        '$txt_bplace',
                                        '$txt_age',
                                        '$txt_brgy',
                                        '$txt_zone',
                                        '$txt_householdmem',
                                        '$txt_dperson',
                                        '$txt_rthead',
                                        '$txt_mstatus',
                                        '$txt_btype',
                                        '$txt_cstatus',
                                        '$txt_occp',
                                        '$txt_income',
                                        '$txt_householdnum',
                                        '$txt_length',
                                        '$txt_religion',
                                        '$txt_national',
                                        '$ddl_gender', 
                                        '$txt_skills', 
                                        '$txt_igpit', 
                                        '$txt_phno', 
                                        '$ddl_eattain', 
                                        '$ddl_hos',
                                        '$ddl_los', 
                                        '$ddl_dtype', 
                                        '$txt_water', 
                                        '$txt_lightning', 
                                        '$txt_toilet', 
                                        '$txt_faddress', 
                                        '$txt_remarks', 
                                        '$txt_image'
                                    )"
                            ) 
                            or die('Error: ' . mysqli_error($con));
             
        }

        
            if($query == true)
            {
                $_SESSION['added'] = 1;
                header ("location: ".$_SERVER['REQUEST_URI']);
            }
    }
    else{
        $_SESSION['duplicateuser'] = 1;
        header ("location: ".$_SERVER['REQUEST_URI']);
    }    

}


if(isset($_POST['btn_save']))
{
    
    echo ' <script>console.log("yeah")</script>';
    $txt_id = $_POST['hidden_id'];
    $txt_edit_lname = $_POST['txt_edit_lname'];
    $txt_edit_fname = $_POST['txt_edit_fname'];
    $txt_edit_mname = $_POST['txt_edit_mname'];
    $txt_edit_bdate = $_POST['txt_edit_bdate'];
    $txt_edit_bplace = $_POST['txt_edit_bplace'];

    $dateOfBirth = $txt_edit_bdate;
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    $txt_edit_age = $diff->format('%y');

    $txt_edit_brgy = $_POST['txt_edit_brgy'];
    $txt_edit_dperson = $_POST['txt_edit_dperson'];
    $txt_edit_mstatus = $_POST['txt_edit_mstatus'];
    $txt_edit_zone = $_POST['txt_edit_zone'];
    $txt_edit_householdmem = $_POST['txt_edit_householdmem'];
    $txt_edit_rthead = $_POST['txt_edit_rthead'];

    $txt_edit_btype = $_POST['txt_edit_btype'];
    $txt_edit_cstatus = $_POST['txt_edit_cstatus'];
    $txt_edit_occp = $_POST['txt_edit_occp'];
    $txt_edit_income = $_POST['txt_edit_income'];


    $txt_edit_householdnum = $_POST['txt_edit_householdnum'];
    $txt_edit_length = $_POST['txt_edit_length'];
    $txt_edit_religion = $_POST['txt_edit_religion'];
    $txt_edit_national = $_POST['txt_edit_national'];
    $ddl_edit_gender = $_POST['ddl_edit_gender'];
    $txt_edit_skills = $_POST['txt_edit_skills'];
    $txt_edit_igpit = $_POST['txt_edit_igpit'];
    $txt_edit_phno = $_POST['txt_edit_phno'];
    $ddl_edit_eattain = $_POST['ddl_edit_eattain'];
    $ddl_edit_hos = $_POST['ddl_edit_hos'];

    $ddl_edit_los = $_POST['ddl_edit_los'];
    $ddl_edit_dtype = $_POST['ddl_edit_dtype'];
    $txt_edit_water = $_POST['txt_edit_water'];
    $txt_edit_lightning = $_POST['txt_edit_lightning'];
    $txt_edit_toilet = $_POST['txt_edit_toilet'];
    $txt_edit_faddress = $_POST['txt_edit_faddress'];

    $txt_edit_uname = $_POST['txt_edit_uname'];
    $txt_edit_upass = $_POST['txt_edit_upass'];
    $txt_edit_remarks = $_POST['txt_edit_remarks'];

    $name = basename($_FILES['txt_edit_image']['name']);
    $temp = $_FILES['txt_edit_image']['tmp_name'];
    $imagetype = $_FILES['txt_edit_image']['type'];
    $size = $_FILES['txt_edit_image']['size'];

    $milliseconds = round(microtime(true) * 1000);
    $image = $milliseconds.'_'.$name;

    if(isset($_SESSION['role'])){
        $action = 'Update Resident named '.$txt_edit_lname.', '.$txt_edit_fname.' '.$txt_edit_mname;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

// $su = mysqli_query($con,"SELECT * from tblresident where username = '".$txt_edit_uname."' and id not in (".$txt_id.") ");

$su = mysqli_query($con,"SELECT * from tblresident where id = ".$txt_id );
$ct = mysqli_num_rows($su);

if($ct == 0){

    echo ' <script>console.log("yeah")</script>';

    if($name != ""){
            if(($imagetype=="image/jpeg" || $imagetype=="image/png" || $imagetype=="image/bmp") && $size<=2048000){
                if(move_uploaded_file($temp, 'image/'.$image))
                {

                $txt_edit_image = $image;
                $update_query = mysqli_query($con,"UPDATE tblresident set 
                                        lname = '".$txt_edit_lname."',
                                        fname = '".$txt_edit_fname."',
                                        mname = '".$txt_edit_mname."',
                                        bdate = '".$txt_edit_bdate."',
                                        bplace = '".$txt_edit_bplace."',
                                        age = '".$txt_edit_age."',
                                        barangay = '".$txt_edit_brgy."',
                                        zone = '".$txt_edit_zone."',
                                        totalhousehold = '".$txt_edit_householdmem."',
                                        differentlyabledperson = '".$txt_edit_dperson."',
                                        relationtohead = '".$txt_edit_rthead."',
                                        maritalstatus = '".$txt_edit_mstatus."',
                                        bloodtype = '".$txt_edit_btype."',
                                        civilstatus = '".$txt_edit_cstatus."',
                                        occupation = '".$txt_edit_occp."',
                                        monthlyincome = '".$txt_edit_income."',
                                        householdnum = '".$txt_edit_householdnum."',
                                        lengthofstay = '".$txt_edit_length."',
                                        religion = '".$txt_edit_religion."',
                                        nationality = '".$txt_edit_national."',
                                        gender = '".$ddl_edit_gender."',
                                        skills = '".$txt_edit_skills."',
                                        igpitID = '".$txt_edit_igpit."',
                                        philhealthNo = '".$txt_edit_phno."',
                                        highestEducationalAttainment = '".$ddl_edit_eattain."',
                                        houseOwnershipStatus = '".$ddl_edit_hos."',
                                        landOwnershipStatus = '".$ddl_edit_los."',
                                        dwellingtype = '".$ddl_edit_dtype."',
                                        waterUsage = '".$txt_edit_water."',
                                        lightningFacilities = '".$txt_edit_lightning."',
                                        sanitaryToilet = '".$txt_edit_toilet."',
                                        formerAddress = '".$txt_edit_faddress."',
                                        remarks = '".$txt_edit_remarks."',
                                        image = '".$txt_edit_image."',
                                        username = '".$txt_edit_uname."',
                                        password = '".$txt_edit_upass."'
                                        where id = '".$txt_id."'
                                ") or die('Error: ' . mysqli_error($con));
                }
            }
            else{
                $_SESSION['filesize'] = 1; 
                header ("location: ".$_SERVER['REQUEST_URI']);
            }
    }
    else{

        $chk_image = mysqli_query($con,"SELECT * from tblresident where id = '".$_POST['hidden_id']."' ");
        $rowimg = mysqli_fetch_array($chk_image);

        $txt_edit_image = $rowimg['image'];
        $update_query = mysqli_query($con,"UPDATE tblresident set 
                                        lname = '".$txt_edit_lname."',
                                        fname = '".$txt_edit_fname."',
                                        mname = '".$txt_edit_mname."',
                                        bdate = '".$txt_edit_bdate."',
                                        bplace = '".$txt_edit_bplace."',
                                        age = '".$txt_edit_age."',
                                        barangay = '".$txt_edit_brgy."',
                                        zone = '".$txt_edit_zone."',
                                        totalhousehold = '".$txt_edit_householdmem."',
                                        differentlyabledperson = '".$txt_edit_dperson."',
                                        relationtohead = '".$txt_edit_rthead."',
                                        maritalstatus = '".$txt_edit_mstatus."',
                                        bloodtype = '".$txt_edit_btype."',
                                        civilstatus = '".$txt_edit_cstatus."',
                                        occupation = '".$txt_edit_occp."',
                                        monthlyincome = '".$txt_edit_income."',
                                        householdnum = '".$txt_edit_householdnum."',
                                        lengthofstay = '".$txt_edit_length."',
                                        religion = '".$txt_edit_religion."',
                                        nationality = '".$txt_edit_national."',
                                        gender = '".$ddl_edit_gender."',
                                        skills = '".$txt_edit_skills."',
                                        igpitID = '".$txt_edit_igpit."',
                                        philhealthNo = '".$txt_edit_phno."',
                                        highestEducationalAttainment = '".$ddl_edit_eattain."',
                                        houseOwnershipStatus = '".$ddl_edit_hos."',
                                        landOwnershipStatus = '".$ddl_edit_los."',
                                        dwellingtype = '".$ddl_edit_dtype."',
                                        waterUsage = '".$txt_edit_water."',
                                        lightningFacilities = '".$txt_edit_lightning."',
                                        sanitaryToilet = '".$txt_edit_toilet."',
                                        formerAddress = '".$txt_edit_faddress."',
                                        remarks = '".$txt_edit_remarks."',
                                        image = '".$txt_edit_image."',
                                        username = '".$txt_edit_uname."',
                                        password = '".$txt_edit_upass."'
                                        where id = '".$txt_id."'
                                ") or die('Error: ' . mysqli_error($con));
    }
        
    if($update_query == true){
        $_SESSION['edited'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
    }

    }
    else{
        $_SESSION['duplicateuser'] = 1;
        header ("location: ".$_SERVER['REQUEST_URI']);
    }  

    
}

if(isset($_POST['btn_delete']))
{
    if(isset($_POST['chk_delete']))
    {
        foreach($_POST['chk_delete'] as $value)
        {
            $insert_query = mysqli_query($con,"INSERT into tblresident2 SELECT * from tblresident WHERE id ='$value' ") or die('Error: ' . mysqli_error($con));
            
            // $select_query = mysqli_query($con,"SELECT * from tblresident where id = '$value' ") or die('Error: ' . mysqli_error($con));   
            $delete_query = mysqli_query($con,"DELETE from tblresident where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }else{
                $delete_query = mysqli_query($con,"DELETE from tblresident2 where id = '$value' ") or die('Error: ' . mysqli_error($con));
                
            }
        }
    }
}

// data-target="#deleteModal"

if(isset($_POST['btn_recover']))
{

    $value = $_POST['rowid'] ;

    echo'
        <script>
            console.log("recover here --")
        </script>
    ';
    $insert_query = mysqli_query($con,"INSERT into tblresident SELECT * from tblresident2 WHERE id ='$value' ") or die('Error: ' . mysqli_error($con));
    
    // $select_query = mysqli_query($con,"SELECT * from tblresident where id = '$value' ") or die('Error: ' . mysqli_error($con));   
    $delete_query = mysqli_query($con,"DELETE from tblresident2 where id = '$value' ") or die('Error: ' . mysqli_error($con));
            
    if($delete_query == true)
    {
        
        $_SESSION['delete'] = 1;
        // header("location: ".$_SERVER['REQUEST_URI']);
    }else{
        $delete_query = mysqli_query($con,"DELETE from tblresident where id = '$value' ") or die('Error: ' . mysqli_error($con));
    }
}

if(isset($_POST['btn_clearance_add'])){
    $ddl_resident = $_POST['ddl_resident'];    
    $txt_clearanceNumber = $_POST['txt_clearanceNumber'];
    $date = date('Y-m-d');

    $num_rows = 0;

    if(isset($_SESSION['role'])){
        $action = 'Added Clearance with clearance for '.$ddl_resident;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    if($num_rows == 0){
        
    
        if($_SESSION['role'] == "Administrator"){
            // $query = mysqli_query($con,"INSERT INTO tblclearance2 (clearanceNo,residentid,findings,purpose,orNo,samount,dateRecorded,recordedBy,status) 
            // values ('$txt_cnum','$ddl_resident', '$txt_findings','$txt_purpose', '$txt_ornum', '$txt_amount', '$date', '".$_SESSION['username']."','Approved')") or die('Error: ' . mysqli_error($con));
            
            $query = mysqli_query($con,"INSERT INTO tblclearance2 (
                ResidentId,
                Approved,
                dateCreated,
                clearanceNo
            ) 
            values (
                '$ddl_resident', 
                'APPROVED',
                '$date' ,
                '$txt_clearanceNumber'
                
            )"
                
            ) or die('Error: ' . mysqli_error($con));
    
    
        }
        else{

            $query = mysqli_query($con,"INSERT INTO tblclearance2 (
                ResidentId,
                Approved,
                dateCreated,
                clearanceNo
            ) 
            values (
                '$ddl_resident', 
                'PENDING',
                '$date' ,
                '$txt_clearanceNumber'
            )"
                
            ) or die('Error: ' . mysqli_error($con));
        }




        if($query == true)
        {
            $_SESSION['added'] = 1;

            // <a target="_blank" href="../clearance/clearance_form.php?resident='.$row['id'].'&clearance=false &val='.base64_encode($row['id'].'|'.$row['cname']).'" onclick="location.reload();" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Create Clearance</a></td>                                              
                                                                        
            header ('location: ../clearance/clearance_form.php?resident='.$ddl_resident.'&clearance=false &val='.base64_encode($ddl_resident.'|').'"');
            // header ("location: ".$_SERVER['REQUEST_URI']);
        }   
    }
    else{
        $_SESSION['duplicate'] = 1;
        header ("location: ".$_SERVER['REQUEST_URI']);
    }
}


?>