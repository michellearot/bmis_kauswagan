<?php
if(isset($_POST['btn_add'])){


    // $txt_familyName = $_POST['txt_familyName'];
    // $txt_firstName = $_POST['txt_firstName'];
    // $txt_middleInitial = $_POST['txt_middleInitial'] ;
    $txt_cname = $_POST['txt_cname'] ;
    $txt_id = explode(",", $txt_cname);
    $txt_address = $_POST['txt_address'] ;
    $txt_birthplace = $_POST['txt_birthplace'];
    $txt_gender = $_POST['txt_gender'];
    $txt_birthday = $_POST['txt_birthday'];
    $txt_civilStatus = $_POST['txt_civilStatus'];
    $txt_height = $_POST['txt_height'];
    $txt_weight = $_POST['txt_weight'];
    $txt_employmentStatus = $_POST['txt_employmentStatus'];
    $txt_occupation = $_POST['txt_occupation'];
    $txt_monthlyIncome = $_POST['txt_monthlyIncome'];


    // $ddl_resident = $_POST['ddl_resident'];
    // $txt_busname = $_POST['txt_busname'];
    // $txt_busadd = $_POST['txt_busadd'];
    // $ddl_tob = $_POST['ddl_tob'];
    // $txt_ornum = $_POST['txt_ornum'];
    // $txt_amount = $_POST['txt_amount'];
    $date = date('Y-m-d H:i:s');

    if(isset($_SESSION['role'])){
        $action = 'Added cedula with name of '.$txt_cname;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    if($_SESSION['role'] == "Administrator")
    {
        $query = mysqli_query($con,"INSERT INTO tblcedula (
            ResidentId,Address,Birthplace,Gender,Birthday,CivilStatus,Height, Weight,EmploymentStatus, Occupation, MonthlyIncome,DateCreated,Status 
        ) 
        values (
            '$txt_id[0]',  
            '$txt_address', 
            '$txt_birthplace', 
            '$txt_gender', 
            '$txt_birthday', 
            '$txt_civilStatus', 
            '$txt_height', 
            '$txt_weight', 
            '$txt_employmentStatus', 
            '$txt_occupation', 
            '$txt_monthlyIncome',
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
            '$txt_id[0]', 
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

if(isset($_POST['btn_findName'])){

    $txt_lname = $_POST['txt_familyName'];
    $txt_fname = $_POST['txt_firstName'];
    $txt_mname = $_POST['txt_middleInitial'] ;

    $reqquery = mysqli_query($con,"SELECT * from tblresident WHERE fname='".$txt_fname."' and lname ='".$txt_lname."'  and mname= '" .$txt_mname ) or die('Error: ' . mysqli_error($con));

    if($reqquery == true)
    {
        echo ("
            <script>
            console.log('asdf')
            </script>
        
        ");
        // header ("location: ".$_SERVER['REQUEST_URI']);
    }   
}

if(isset($_POST['btn_req'])){
    $txt_busname = $_POST['txt_busname'];
    $txt_busadd = $_POST['txt_busadd'];
    $ddl_tob = $_POST['ddl_tob'];
    $date = date('Y-m-d H:i:s');

    $reqquery = mysqli_query($con,"INSERT INTO tblpermit (residentid,businessName,businessAddress,typeOfBusiness,orNo,samount,dateRecorded,recordedBy,status) 
        values ('".$_SESSION['userid']."', '$txt_busname', '$txt_busadd', '$ddl_tob', '', '', '$date', '".$_SESSION['username']."','New')") or die('Error: ' . mysqli_error($con));

    if($reqquery == true)
    {
        header ("location: ".$_SERVER['REQUEST_URI']);
    }   
}

if(isset($_POST['btn_approve']))
{
    $txt_id = $_POST['hidden_id'];
    $txt_ornum = $_POST['txt_ornum'];
    $txt_amount = $_POST['txt_amount'];


    // $approve_query = mysqli_query($con,"UPDATE tblpermit set orNo = '".$txt_ornum."', samount = '".$txt_amount."',status = 'Approved'  where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));
    $approve_query = mysqli_query($con,"UPDATE tblcedula set Status = 'APPROVED' where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));

    if($approve_query == true){
        header("location: ".$_SERVER['REQUEST_URI']);
    }
}

if(isset($_POST['btn_disapprove']))
{
    $txt_id = $_POST['hidden_id'];

    $disapprove_query = mysqli_query($con,"UPDATE tblcedula set Status = 'Disapproved'  where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));

    if($disapprove_query == true){
        header("location: ".$_SERVER['REQUEST_URI']);
    }
}

if(isset($_POST['btn_save']))
{
    $txt_id = $_POST['hidden_id'];
    $txt_edit_busname = $_POST['txt_edit_busname'];
    $txt_edit_busadd = $_POST['txt_edit_busadd'];
    $ddl_edit_tob = $_POST['ddl_edit_tob'];
    $txt_edit_ornum = $_POST['txt_edit_ornum'];
    $txt_edit_amount = $_POST['txt_edit_amount'];

    $update_query = mysqli_query($con,"UPDATE tblpermit set businessName = '".$txt_edit_busname."', businessAddress = '".$txt_edit_busadd."', typeOfBusiness= '".$ddl_edit_tob."', orNo = '".$txt_edit_ornum."', samount = '".$txt_edit_amount."'  where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));

    if(isset($_SESSION['role'])){
        $action = 'Update Permit with business name of '.$txt_edit_busname;
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
            $delete_query = mysqli_query($con,"DELETE from tblpermit where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }
        }
    }
}


?>