<!DOCTYPE html>
<html>
<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else {
    ob_start();
    include('../head_css.php');
?>
<body class="skin-black">
    <?php 
    include "../connection.php";
    include('../header.php'); 
    ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php include('../sidebar-left.php'); ?>
        <aside class="right-side">
            <section class="content-header">
                <h1>File Management</h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="box">
                        <div class="box-header">
                            <div style="padding:10px;">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">
                                    <i class="fa fa-upload" aria-hidden="true"></i> Upload File
                                </button>  
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                </button> 
                            </div>                                
                        </div>
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
                                            <tr style="background-color: black; color: white;">
                                                <th style="width: 20px !important;">
                                                    <!-- <input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)"/> -->
                                                </th>
                                                <th>File Name</th>
                                                <th>Description</th>
                                                <th>Date Uploaded</th>
                                                <th style="width: 40px !important;">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $squery = mysqli_query($con, "SELECT * FROM tblfiles");
                                            while ($row = mysqli_fetch_array($squery)) {
                                                echo '
                                                <tr>
                                                    <td><input type="radio" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td>
                                                    <td>'.$row['filename'].'</td>
                                                    <td>'.$row['description'].'</td>
                                                    <td>'.$row['upload_date'].'</td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
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

                            <div id="disapproved" class="tab-pane">

                                <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="background-color: black; color: white;">
                                                <th style="width: 20px !important;">
                                                    <!-- <input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)"/> -->
                                                </th>
                                                <th>File Name</th>
                                                <th>Description</th>
                                                <th>Date Uploaded</th>
                                                <th style="width: 40px !important;">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $squery = mysqli_query($con, "SELECT * FROM tblfiles2");
                                            while ($row = mysqli_fetch_array($squery)) {
                                                echo '
                                                <tr>
                                                    <td>
                                                        <textarea style="display:none" name="rowid" value ="'.$row['id'].'"> '.$row['id'].'  </textarea>
                                                    </td>
                                                    <td>'.$row['filename'].'</td>
                                                    <td>'.$row['description'].'</td>
                                                    <td>'.$row['upload_date'].'</td>
                                                    <td>
                                                        <input  type="submit" name="btn_recover" class="btn btn-primary btn-sm" value="Recover"> 
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
                            
                        </div>
                    </div>
                    <?php include "../edit_notif.php"; ?>
                    <?php include "../added_notif.php"; ?>
                    <?php include "../delete_notif.php"; ?>
                    <?php include "../duplicate_error.php"; ?>
                    <?php include "add_modal.php"; ?>
                    <?php include "function.php"; ?>
                </div>
            </section>
        </aside>
    </div>
    <?php include "../footer.php"; ?>
    <script type="text/javascript">
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,4 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    </script>
</body>
</html>
<?php } ?>
