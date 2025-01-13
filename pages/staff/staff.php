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
                        Users
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">
                                        
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add User</button>  
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
                                        <br>
                                        <br>
                                        <label id="error" class="label label-danger pull-left"></label> 
                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">


                                <ul class="nav nav-tabs" id="myTab">
                                      <li class="active"><a data-target="#approved" data-toggle="tab">Active</a></li>
                                      <li><a data-target="#disapproved" data-toggle="tab">deleted</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="approved" class="tab-pane active in">
                                        <form method="post">
                                        <table id="table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20px !important;"></th>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Role</th>
                                                    <th style="width: 40px !important;">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $squery = mysqli_query($con, "select * from tblstaff");
                                                while($row = mysqli_fetch_array($squery))
                                                {
                                                    echo '
                                                    <tr>
                                                        <td><input type="radio" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td>
                                                        <td>'.$row['name'].'</td>
                                                        <td>'.$row['username'].'</td>
                                                        <td>'.$row['role'].'</td>
                                                        <td><button class="btn btn-primary btn-sm" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                                    </tr>
                                                    ';

                                                    include "edit_modal.php";
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <?php include "../deleteModal.php"; ?>

                                        </form>

                                    </div>

                                    <div id="disapproved" class="tab-pane">

                                        <form method="post">
                                            <table id="table" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20px !important;"></th>
                                                        <th>Name</th>
                                                        <th>Username</th>
                                                        <th>Role</th>
                                                        <th style="width: 40px !important;">Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $squery = mysqli_query($con, "select * from tblstaff2");
                                                    while($row = mysqli_fetch_array($squery))
                                                    {
                                                        echo '
                                                        <tr>
                                                            <td>
                                                                <textarea style="display:none" name="rowid" value ="'.$row['id'].'"> '.$row['id'].'  </textarea>
                                                                <input type="radio" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" />
                                                            </td>
                                                            <td>'.$row['name'].'</td>
                                                            <td>'.$row['username'].'</td>
                                                            <td>'.$row['role'].'</td>
                                                            <td>
                                                                <input type="submit" name="btn_recover"
                                                                        value="Recover"/>
                                                            </td>
                                                        </tr>
                                                        ';

                                                        include "edit_modal.php";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>

                                            <?php include "../deleteModal.php"; ?>

                                            </form>
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
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php }
        include "../footer.php"; ?>
<script type="text/javascript">
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,3 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>