<!DOCTYPE html>
<html>

    <?php
    session_start();
    if(!isset($_SESSION['role']))
    {
        header("Location: ../../login.php"); 
    }
    else
    {
    ob_start();
    include('../head_css.php'); ?>
    <style>
    .input-size {
        width:418px;
    }
    </style>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        
        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Resident
                    </h1>
                    
                </section>

                <?php 
                if(!isset($_GET['resident']))
                {
                ?>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">
                                        
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCourseModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Resident</button>  
                                        <?php 
                                            if(!isset($_SESSION['staff']))
                                            {
                                        ?>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
                                        <?php
                                            }
                                        ?>
                                
                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

                                <ul class="nav nav-tabs" id="myTab">
                                      <li class="active"><a data-target="#approved" data-toggle="tab">Active</a></li>
                                      <li><a data-target="#disapproved" data-toggle="tab">deleted</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="approved" class="tab-pane active in">

                                    
                                        <form method="post"  enctype="multipart/form-data">
                                            <table id="table" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <?php 
                                                            if(!isset($_SESSION['staff']))
                                                            {
                                                        ?>
                                                        <th style="width: 20px !important;"></th>
                                                        <?php
                                                            }
                                                        ?>
                                                        <th>Zone</th>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Birthdate</th>
                                                        <th>Gender</th>
                                                        <th>Former Address</th>
                                                        <th style="width: 40px !important;">Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(!isset($_SESSION['staff']))
                                                    {
                                                        $squery = mysqli_query($con, "SELECT zone,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, bdate, gender, formerAddress, image FROM tblresident order by zone");
                                                        while($row = mysqli_fetch_array($squery))
                                                        {
                                                            echo '
                                                            <tr>
                                                                <td><input type="radio" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td>
                                                                <td>'.$row['zone'].'</td>
                                                                <td style="width:70px;"><image src="image/'.basename($row['image']).'" style="width:60px;height:60px;"/></td>
                                                                <td>'.$row['cname'].'</td>
                                                                <td>'.$row['bdate'].'</td>
                                                                <td>'.$row['gender'].'</td>
                                                                <td>'.$row['formerAddress'].'</td>
                                                                <td>

                                                                <div id="myModal'.$row['id'].'" class="modal fade" role="dialog">

                                                                    <form  method="post">
                                                                        <div class="modal-dialog modal-sm">

                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h4 class="modal-title">'.$row['cname'].'<br></h4>
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">Enter Clearance No.</h4>
                                                                        </div>
                                                                        <div class="col-sm-12">
                                                                        
                                                                            <textarea style="display:none" name="ddl_resident" value ="'.$row['id'].'"> '.$row['id'].'  </textarea>
                                                                    
                                                                            <input name="txt_clearanceNumber" class="form-control input-sm" type="text" />
                                                                        </div>
                                                                        <div class="modal-footer">
                                                

                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            
                                                                            <Button type="submit" class="btn btn-primary btn-sm fa fa-pencil-square-o" name="btn_clearance_add" value="Add Clearance">
                                                                            
                                                                                <a target="_blank" href="../clearance/clearance_form.php?resident='.$row['id'].'&clearance=false&val='.base64_encode($row['id'].'|'.$row['cname']).'" onclick="location.reload(); ">
                                                                                    
                                                                            </a>
                                                                            <Button>
                                                                            
                                                                        </div>
                                                                        </div>
                                                                    </form>
                                                                    </div>
                                                                </div>
                                                                    

                                                                    <div class="dropdown">
                                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            Select action
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                            <button class="btn btn-primary btn-sm" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                                            <a target="_blank" href="../permit/cedula_form.php?resident='.$row['id'].'&cedula=false" onclick="location.reload();" class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Create Cedula</a> 
                                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal'.$row['id'].'">Generate Clearance</button>
                                                                        </div>    
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            ';

                                                            include "edit_modal.php";
                                                            include "clearance_no.php";

                                                        }
                                                    }
                                                    else{
                                                        $squery = mysqli_query($con, "SELECT zone,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident order by zone");
                                                        while($row = mysqli_fetch_array($squery))
                                                        {
                                                            echo '
                                                            <tr>
                                                                <td>'.$row['zone'].'</td>
                                                                <td style="width:70px;"><image src="image/'.basename($row['image']).'" style="width:60px;height:60px;"/></td>
                                                                <td>'.$row['cname'].'</td>
                                                                <td>'.$row['age'].'</td>
                                                                <td>'.$row['gender'].'</td>
                                                                <td>asdasd'.$row['formerAddress'].'</td>
                                                            <td>
                                                                <button class="btn btn-primary btn-sm" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editt</button>
                                                                
                                                            </td>
                                                            
                                                        </tr>
                                                        ';

                                                            include "edit_modal.php";
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                            <?php include "../deleteModal.php"; ?>

                                            </form>


                                    </div>

                                    <div id="disapproved" class="tab-pane"> 

                                    <table id="table" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <?php 
                                                            if(!isset($_SESSION['staff']))
                                                            {
                                                        ?>
                                                        <th style="width: 20px !important;"><input type="radio" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)"/></th>
                                                        <?php
                                                            }
                                                        ?>
                                                        <th>Zone</th>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Birthdate</th>
                                                        <th>Gender</th>
                                                        <th>Former Address</th>
                                                        <th style="width: 40px !important;">Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    

                                                    if(!isset($_SESSION['staff']))
                                                    {
                                                        $squery = mysqli_query($con, "SELECT zone,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, bdate, gender, formerAddress, image FROM tblresident2 order by zone");
                                                        while($row = mysqli_fetch_array($squery))
                                                        {
                                                            echo '
                                                            <tr>
                                                            <form method="post">
                                                                <td>
                                                                    <textarea style="display:none" name="rowid" value ="'.$row['id'].'"> '.$row['id'].'  </textarea>
                                                                    <input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" />
                                                                </td>
                                                                <td>'.$row['zone'].'</td>
                                                                <td style="width:70px;"><image src="image/'.basename($row['image']).'" style="width:60px;height:60px;"/></td>
                                                                <td>'.$row['cname'].'</td>
                                                                <td>'.$row['bdate'].'</td>
                                                                <td>'.$row['gender'].'</td>
                                                                <td>'.$row['formerAddress'].'</td>
                                                                <td>
                                                                    
                                                                    <input type="submit" name="btn_recover"
                                                                            value="Recover"/>
                                                                
                                                                </td>
                                                                </form>
                                                            </tr>
                                                            ';

                                                            include "edit_modal.php";
                                                        }
                                                    }
                                                    else{
                                                        $squery = mysqli_query($con, "SELECT zone,id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident2 order by zone");
                                                        while($row = mysqli_fetch_array($squery))
                                                        {
                                                            echo '
                                                            <tr>
                                                                <td>'.$row['zone'].'</td>
                                                                <td style="width:70px;"><image src="image/'.basename($row['image']).'" style="width:60px;height:60px;"/></td>
                                                                <td>'.$row['cname'].'</td>
                                                                <td>'.$row['age'].'</td>
                                                                <td>'.$row['gender'].'</td>
                                                                <td>asdasd'.$row['formerAddress'].'</td>
                                                            <td>
                                                                <button class="btn btn-primary btn-sm" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editt</button>
                                                            </td>
                                                            
                                                        </tr>
                                                        ';

                                                            include "edit_modal.php";
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                    </div>
                                </div>






                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <?php include "../edit_notif.php"; ?>

                            <?php include "../added_notif.php"; ?>

                            <?php include "../delete_notif.php"; ?>

                            <?php include "../duplicate_error.php"; ?>

            <?php include "add_modal.php"; ?>

            <?php include "function.php"; ?>


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
                <?php
                }
                else
                {
                ?>
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                
                                <div class="box-body table-responsive">
                                <form method="post"  enctype="multipart/form-data">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)"/></th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Former Address</th>
                                                <th style="width: 40px !important;">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $squery = mysqli_query($con, "SELECT id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident where householdnum = '".$_GET['resident']."'");
                                            while($row = mysqli_fetch_array($squery))
                                            {
                                                echo '
                                                <tr>
                                                    <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td>
                                                    <td style="width:70px;"><image src="image/'.basename($row['image']).'" style="width:60px;height:60px;"/></td>
                                                    <td>'.$row['cname'].'</td>
                                                    <td>'.$row['age'].'</td>
                                                    <td>'.$row['gender'].'</td>
                                                    <td>asdasd'.$row['formerAddress'].'</td>
                                                    <td><button class="btn btn-primary btn-sm" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ediit</button></td>
                                                </tr>
                                                ';

                                                include "edit_modal.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php include "../deleteModal.php"; ?>
                            <?php include "../duplicate_error.php"; ?>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box --> 
                        </div>   <!-- /.row -->
                </section><!-- /.content -->
                <?php
                }
                ?>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php }
        include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,6 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>