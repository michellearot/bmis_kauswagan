<?php
if(isset($_POST['btn_add'])){
    $txt_doc = $_POST['txt_doc'];
    $txt_act = $_POST['txt_act'];
    $txt_desc = $_POST['txt_desc'];

   // $chkdup = mysqli_query($con, "SELECT * from tblactivity where householdno = ".$txt_householdno." ");
    //$num_rows = mysqli_num_rows($chkdup);

    if(isset($_SESSION['role'])){
        $action = 'Added Items and Services '.$txt_act;
        $iquery = mysqli_query($con,"INSERT INTO tbllogs (user,logdate,action) values ('".$_SESSION['role']."', NOW(), '".$action."')");
    }


    //if($num_rows == 0){
        $query = mysqli_query($con,"INSERT INTO tblservices (daterecorded,services,purpose) 
            values ('$txt_doc', '$txt_act', '$txt_desc')") or die('Error: ' . mysqli_error($con));
        $id = mysqli_insert_id($con);
        if(isset($_FILES['files']))
        {
            foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name){

                $target="photo/";
                $milliseconds = round(microtime(true) * 1000);
                $name = $milliseconds.$_FILES['files']['name'][$key];
                $target=$target.$name;

                    if(move_uploaded_file($tmp_name, $target)){
                        mysqli_query($con,"INSERT INTO tblservicephoto (serviceid,filename) 
                    values ('$id', '".$name."')") or die('Error: ' . mysqli_error($con));
                    }
 
                }
        }

        if($query == true)
        {
            $_SESSION['added'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
        }     
    //}
    //else{
    //    $_SESSION['duplicate'] = 1;
    //    header ("location: ".$_SERVER['REQUEST_URI']);
    //}
}


if(isset($_POST['btn_save']))
{
    $txt_id = $_POST['hidden_id'];
    $txt_edit_doc = $_POST['txt_edit_doc'];
    $txt_edit_act = $_POST['txt_edit_act'];
    $txt_edit_desc = $_POST['txt_edit_desc'];

    $update_query = mysqli_query($con,"UPDATE tblservices set daterecorded = '".$txt_edit_doc."', services = '".$txt_edit_act."', purpose = '".$txt_edit_desc."' where id = '".$txt_id."' ") or die('Error: ' . mysqli_error($con));

    if(isset($_SESSION['role'])){
        $action = 'Update Items and Services '.$txt_edit_act;
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
            $insert_query = mysqli_query($con,"INSERT into tblservices2 SELECT * from tblservices WHERE id ='$value' ") or die('Error: ' . mysqli_error($con));
   
            $delete_query = mysqli_query($con,"DELETE from tblservices where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }
            else{
                $delete_query = mysqli_query($con,"DELETE from tblservices2 where id = '$value' ") or die('Error: ' . mysqli_error($con));  
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
    $insert_query = mysqli_query($con,"INSERT into tblservices SELECT * from tblservices2 WHERE id ='$value' ") or die('Error: ' . mysqli_error($con));
    
    // $select_query = mysqli_query($con,"SELECT * from tblresident where id = '$value' ") or die('Error: ' . mysqli_error($con));   
    $delete_query = mysqli_query($con,"DELETE from tblservices2 where id = '$value' ") or die('Error: ' . mysqli_error($con));
            
    if($delete_query == true)
    {
        
        $_SESSION['delete'] = 1;
        // header("location: ".$_SERVER['REQUEST_URI']);
    }else{
        $delete_query = mysqli_query($con,"DELETE from tblservices where id = '$value' ") or die('Error: ' . mysqli_error($con));
    }
}


if(isset($_POST['btn_addimage'])){
    $id = $_POST['hidden_id'];

        if(isset($_FILES['photos']))
        {
            foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name){

                $target="photo/";
                $milliseconds = round(microtime(true) * 1000);
                $name = $milliseconds.$_FILES['photos']['name'][$key];
                $target=$target.$name;

                    if(move_uploaded_file($tmp_name, $target)){
                        $query = mysqli_query($con,"INSERT INTO tblservicephoto (serviceid,filename) 
                    values ('$id', '".$name."')") or die('Error: ' . mysqli_error($con));
                        if($query == true)
                            {
                                $_SESSION['added'] = 1;
                                header ("location: ".$_SERVER['REQUEST_URI']);
                            }  
                    }
 
                }
        }

}



if(isset($_POST['btn_remove']))
{
    if(isset($_POST['chk_deletephoto']))
    {
        foreach($_POST['chk_deletephoto'] as $value)
        {
            $delete_query = mysqli_query($con,"DELETE from tblservicephoto where id = '$value' ") or die('Error: ' . mysqli_error($con));
                    
            if($delete_query == true)
            {
                $_SESSION['delete'] = 1;
                header("location: ".$_SERVER['REQUEST_URI']);
            }
        }
    }
}



?>