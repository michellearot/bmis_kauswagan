<?php
if(isset($_POST['btn_add'])){
    $ddl_resident = $_POST['ddl_resident'];    
    $txt_clearanceNumber = $_POST['txt_clearanceNumber'];
    $date = date('Y-m-d');

//     // $chkdup = mysqli_query($con,"SELECT * from tblclearance where clearanceNo = ".$txt_cnum." ");
//     // $num_rows = mysqli_num_rows($chkdup);

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
            header ("location: ".$_SERVER['REQUEST_URI']);
        }   
    }
    else{
        $_SESSION['duplicate'] = 1;
        header ("location: ".$_SERVER['REQUEST_URI']);
    }
}
if(isset($_POST['btn_add_cedula'])){

    $txt_id = $_POST['ddl_resident']; 
    $date = date('Y-m-d H:i:s');

    if(isset($_SESSION['role'])){
        $action = 'Added cedula with name of '.$txt_cname;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    if($_SESSION['role'] == "Administrator")
    {
        $query = mysqli_query($con,"INSERT INTO tblcedula (
            ResidentId,DateCreated,Status 
        ) 
        values (
            '$txt_id',  
            '$date',
            'APPROVED')"
        ) or die('Error: ' . mysqli_error($con));
    }
    else
    {
        $query = mysqli_query($con,"INSERT INTO tblcedula (
            ResidentId,DateCreated,Status 
        ) 
        values (
            '$txt_id', 
            '$date',
            'PENDING')"
        ) or die('Error: ' . mysqli_error($con));
    }
    if($query == true)
    {
        $_SESSION['added'] = 1;
        header ("location: ".$_SERVER['REQUEST_URI']);
    }   
}

if(isset($_POST['btn_req'])){
    $chkblot = mysqli_query($con,"select * from tblresident where '".$_SESSION['userid']."' not in (select complainant from tblblotter)");
    $num_row = mysqli_num_rows($chkblot);
    if($num_row > 0)
    {
        $chk = mysqli_query($con,"select * from tblresident where id = '".$_SESSION['userid']."' ");
        while($row = mysqli_fetch_array($chk)){

            if($row['lengthofstay'] < 6){
                $_SESSION['lengthofstay'] = 1;
                header ("location: ".$_SERVER['REQUEST_URI']);
            }
            else{
                $txt_purpose = $_POST['txt_purpose'];
                $date = date('Y-m-d');
                $reqquery = mysqli_query($con,"INSERT INTO tblclearance (clearanceNo,residentid,findings,purpose,orNo,samount,dateRecorded,recordedBy,status) 
                    values ('','".$_SESSION['userid']."','','$txt_purpose','','','$date','".$_SESSION['role']."','New') ")or die('Error: ' . mysqli_error($con));

                if($reqquery == true)
                {
                    header ("location: ".$_SERVER['REQUEST_URI']);
                } 
            }
        }
    } 
    else{
        $_SESSION['blotter'] = 1;
        header ("location: ".$_SERVER['REQUEST_URI']);
    }
}

if(isset($_POST['btn_approve']))
{
    $txt_id = $_POST['hidden_id'];

    // echo '<script>console.log("asdasd"+'.$txt_id.')</script>';
   

    $approve_query = mysqli_query($con,"UPDATE tblclearance2 set Approved = 'APPROVED' where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));

    if($approve_query == true){
        header("location: ".$_SERVER['REQUEST_URI']);
    }
}

if(isset($_POST['btn_disapprove']))
{

    $txt_id = $_POST['hidden_id'];
    // $txt_findings = $_POST['txt_findings'];
    $disapprove_query =mysqli_query($con,"UPDATE tblclearance2 set Approved = 'DISAPPROVED' where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));

    if($disapprove_query == true){
        header("location: ".$_SERVER['REQUEST_URI']);
    }
}


if(isset($_POST['btn_save']))
{
    $txt_id = $_POST['hidden_id'];
    $txt_edit_cnum = $_POST['txt_edit_cnum'];
    $txt_edit_findings = $_POST['txt_edit_findings'];
    $txt_edit_purpose = $_POST['txt_edit_purpose'];
    $txt_edit_ornum = $_POST['txt_edit_ornum'];
    $txt_edit_amount = $_POST['txt_edit_amount'];

    $update_query = mysqli_query($con,"UPDATE tblclearance set clearanceNo= '".$txt_edit_cnum."', findings = '".$txt_edit_findings."', purpose = '".$txt_edit_purpose."', orNo = '".$txt_edit_ornum."', samount = '".$txt_edit_amount."' where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));

    if(isset($_SESSION['role'])){
        $action = 'Update Clearance with clearance number of '.$txt_edit_cnum;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    if($update_query == true){
        $_SESSION['edited'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
    }
}

if(isset($_POST['btn_delete']))
{
    if(isset($_POST['chk_delete']))
    {
        foreach($_POST['chk_delete'] as $value)
        {
            $delete_query = mysqli_query($con,"DELETE from tblclearance where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }
        }
    }
}


?>