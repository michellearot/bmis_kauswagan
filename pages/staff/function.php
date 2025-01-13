<?php
if(isset($_POST['btn_add'])){
    $txt_name = $_POST['txt_name'];
    $txt_uname = $_POST['txt_uname'];
    $txt_pass = $_POST['txt_pass'];
    $txt_role = $_POST['txt_role'];


    // consolePrint( strlen($password) );
    if(  strlen($txt_pass) <8) {
        echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Password cant be less than 8 characters";</script>';
        return;
    }

    if(!preg_match('/[A-Z]/', $txt_pass)) {
        echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Must contain atleast 1 capital";</script>';
        return;
    }
    



    if(isset($_SESSION['role'])){
        $action = 'Added Staff with name of '.$txt_name;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    $su = mysqli_query($con,"SELECT * from tblstaff where username = '".$txt_uname."' ");
    $ct = mysqli_num_rows($su);
    
    if($ct == 0){
        $query = mysqli_query($con,"INSERT INTO tblstaff (name,username,password,role) 
            values ('$txt_name', '$txt_uname', '$txt_pass', '$txt_role')") or die('Error: ' . mysqli_error($con));
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
    $txt_id = $_POST['hidden_id'];
    $txt_edit_name = $_POST['txt_edit_name'];
    $txt_edit_uname = $_POST['txt_edit_uname'];
    $txt_edit_pass = $_POST['txt_edit_pass'];
    $txt_edit_role = $_POST['txt_edit_role'];


    if(isset($_SESSION['role'])){
        $action = 'Update Staff with name of '.$txt_edit_name;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }

    $su = mysqli_query($con,"SELECT * from tblstaff where username = '".$txt_edit_uname."' ");
    $ct = mysqli_num_rows($su);
    
    // if($ct == 0){
    
    $update_query = mysqli_query($con,"UPDATE tblstaff set role = '".$txt_edit_role."' where id = ".$txt_id." ") or die('Error: ' . mysqli_error($con));

    if($update_query == true){
        $_SESSION['edited'] = 1;
        header("location: ".$_SERVER['REQUEST_URI']);
    }
    // }
    // else{
    //     $_SESSION['duplicateuser'] = 1;
    //     header ("location: ".$_SERVER['REQUEST_URI']);
    // } 
}

if(isset($_POST['btn_delete']))
{
    if(isset($_POST['chk_delete']))
    {
        foreach($_POST['chk_delete'] as $value)
        {
            $insert_query = mysqli_query($con,"INSERT into tblstaff2 SELECT * from tblstaff WHERE id ='$value' ") or die('Error: ' . mysqli_error($con));
            $delete_query = mysqli_query($con,"DELETE from tblstaff where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }else{
                $delete_query = mysqli_query($con,"DELETE from tblstaff2 where id = '$value' ") or die('Error: ' . mysqli_error($con));
            }
        }
    }
}

if(isset($_POST['btn_recover']))
{

    $value = $_POST['rowid'] ;

    echo'
        <script>
            console.log("recover here --",'.$value.')
        </script>
    ';
    $insert_query = mysqli_query($con,"INSERT into tblstaff SELECT * from tblstaff2 WHERE id ='$value' ") or die('Error: ' . mysqli_error($con));
    
    // $select_query = mysqli_query($con,"SELECT * from tblresident where id = '$value' ") or die('Error: ' . mysqli_error($con));   
    $delete_query = mysqli_query($con,"DELETE from tblstaff2 where id = '$value' ") or die('Error: ' . mysqli_error($con));
            
    if($delete_query == true)
    {
        
        $_SESSION['delete'] = 1;
        // header("location: ".$_SERVER['REQUEST_URI']);
    }else{
        $delete_query = mysqli_query($con,"DELETE from tblstaff where id = '$value' ") or die('Error: ' . mysqli_error($con));
    }
}


?>