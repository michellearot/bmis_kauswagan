
<?php
if (isset($_POST['btn_add'])) {
    $ddl_pos = $_POST['ddl_pos'];
    $txt_cname = $_POST['txt_cname'];
    $txt_contact = $_POST['txt_contact'];
    $txt_address = $_POST['txt_address'];
    $txt_sterm = $_POST['txt_sterm'];
    $txt_eterm = $_POST['txt_eterm'];

    // Log action if user is authenticated
    if (isset($_SESSION['role'])) {
        $action = 'Added Official named ' . $txt_cname;
        $iquery = mysqli_query($con, "INSERT INTO tbllogs (user, logdate, action) VALUES ('" . $_SESSION['role'] . "', NOW(), '" . $action . "')");
    }

    // Check for duplicates
    $q = mysqli_query($con, "SELECT * FROM tblofficial WHERE sPosition = '$ddl_pos' AND termStart = '$txt_sterm' AND termEnd = '$txt_eterm'");
    $ct = mysqli_num_rows($q);

    if ($ct == 0) { // Change condition to check for no duplicates
        $query = mysqli_query($con, "INSERT INTO tblofficial (sPosition, completeName, pcontact, paddress, termStart, termEnd, status) 
            VALUES ('$ddl_pos', '$txt_cname', '$txt_contact', '$txt_address', '$txt_sterm', '$txt_eterm', 'Ongoing Term')")
            or die('Error: ' . mysqli_error($con));

        if ($query) {
            $_SESSION['added'] = 1;
            header("location: " . $_SERVER['REQUEST_URI']);
        }
    } else {
        $_SESSION['duplicateuser'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
    }
}

if (isset($_POST['btn_save'])) {
    $txt_id = $_POST['hidden_id'];
    $txt_edit_cname = $_POST['txt_edit_cname'];
    $txt_edit_contact = $_POST['txt_edit_contact'];
    $txt_edit_address = $_POST['txt_edit_address'];
    $txt_edit_sterm = $_POST['txt_edit_sterm'];
    $txt_edit_eterm = $_POST['txt_edit_eterm'];

    // Log action
    if (isset($_SESSION['role'])) {
        $action = 'Update Official named ' . $txt_edit_cname;
        $iquery = mysqli_query($con, "INSERT INTO tbllogs (user, logdate, action) VALUES ('" . $_SESSION['role'] . "', NOW(), '" . $action . "')");
    }

    
    $update_query = mysqli_query($con, "UPDATE tblofficial SET completeName = '$txt_edit_cname', pcontact = '$txt_edit_contact', paddress = '$txt_edit_address', termStart = '$txt_edit_sterm', termEnd = '$txt_edit_eterm' WHERE id = '$txt_id'")
        or die('Error: ' . mysqli_error($con));

    if ($update_query) {
        $_SESSION['edited'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
    }
}

if (isset($_POST['btn_end'])) {
    $txt_id = $_POST['hidden_id'];

    $end_query = mysqli_query($con, "UPDATE tblofficial SET status = 'End Term' WHERE id = '$txt_id'")
        or die('Error: ' . mysqli_error($con));

    if ($end_query) {
        $_SESSION['end'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
    }
}

if (isset($_POST['btn_start'])) {
    $txt_id = $_POST['hidden_id'];

    $start_query = mysqli_query($con, "UPDATE tblofficial SET status = 'Ongoing Term' WHERE id = '$txt_id'")
        or die('Error: ' . mysqli_error($con));

    if ($start_query) {
        $_SESSION['start'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
    }
}

if (isset($_POST['btn_delete'])) {
    if (isset($_POST['chk_delete'])) {
        foreach ($_POST['chk_delete'] as $value) {
            $insert_query = mysqli_query($con,"INSERT into tblofficial2 SELECT * from tblofficial WHERE id ='$value' ") or die('Error: ' . mysqli_error($con));
            $delete_query = mysqli_query($con, "DELETE FROM tblofficial WHERE id = '$value'")
                or die('Error: ' . mysqli_error($con));

            if ($delete_query) {
                $_SESSION['delete'] = 1;
                header("location: " . $_SERVER['REQUEST_URI']);
            }else{
                $delete_query = mysqli_query($con,"DELETE from tblresident2 where id = '$value' ") or die('Error: ' . mysqli_error($con));
            }
        }
    }
}

if(isset($_POST['btn_recover']))
{

    $value = $_POST['rowid'] ;
    $insert_query = mysqli_query($con,"INSERT into tblofficial SELECT * from tblofficial2 WHERE id ='$value' ") or die('Error: ' . mysqli_error($con));
    
    // $select_query = mysqli_query($con,"SELECT * from tblresident where id = '$value' ") or die('Error: ' . mysqli_error($con));   
    $delete_query = mysqli_query($con,"DELETE from tblofficial2 where id = '$value' ") or die('Error: ' . mysqli_error($con));
            
    if($delete_query == true)
    {
        
        $_SESSION['delete'] = 1;
        // header("location: ".$_SERVER['REQUEST_URI']);
    }else{
        $delete_query = mysqli_query($con,"DELETE from tblofficial where id = '$value' ") or die('Error: ' . mysqli_error($con));
    }
}

?>



