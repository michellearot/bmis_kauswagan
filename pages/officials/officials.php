<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else
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
                        Barangay Officials
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="box">
                            <div class="box-header">
                                <div style="padding:10px;">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCourseModal">
                                        <i class="fa fa-user-plus" aria-hidden="true"></i> Add Officials
                                    </button>

                                    <?php if (!isset($_SESSION['staff'])) { ?>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                        </button>
                                    <?php } ?>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <?php if (!isset($_SESSION['staff'])) { ?>
                                                    <th style="width: 20px !important;">
                                                        <input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" />
                                                    </th>
                                                <?php } ?>
                                                <th>Position</th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>Start of Term</th>
                                                <th>End of Term</th>
                                                <th>Status</th>
                                                <th style="width: 130px !important;">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!isset($_SESSION['staff'])) {
                                                $squery = mysqli_query($con, "SELECT * FROM tblofficial");
                                                while ($row = mysqli_fetch_array($squery)) {
                                                    echo '
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['id'] . '" />
                                                        </td>
                                                        <td>' . $row['sPosition'] . '</td>
                                                        <td>' . $row['completeName'] . '</td>
                                                        <td>' . $row['pcontact'] . '</td>
                                                        <td>' . $row['paddress'] . '</td>
                                                        <td>' . $row['termStart'] . '</td>
                                                        <td>' . $row['termEnd'] . '</td>
                                                        <td>
                                                            <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin-right: 5px; background-color: ' . ($row['status'] == 'Ongoing Term' ? 'green' : 'red') . ';"></span>
                                                            ' . ($row['status'] == 'Ongoing Term' ? 'Current Official' : 'Former Official') . '
                                                        </td>
                                                        <td style="text-align: center;">
                                                            ' . ($row['status'] == 'Ongoing Term' ? 
                                                                '<button class="btn btn-danger btn-sm" data-target="#endModal' . $row['id'] . '" data-toggle="modal">
                                                                    <i class="fa fa-minus-circle" aria-hidden="true"></i> End
                                                                </button>' : 
                                                                '<span class="label label-default" style="font-size: 12px;">Ended</span>') . '
                                                        </td>
                                                    </tr>';
                                                    include "edit_modal.php";
                                                    include "endterm_modal.php";
                                                }
                                            } else {
                                                $squery = mysqli_query($con, "SELECT * FROM tblofficial WHERE status = 'Ongoing Term' GROUP BY termend");
                                                while ($row = mysqli_fetch_array($squery)) {
                                                    echo '
                                                    <tr>
                                                        <td>' . $row['sPosition'] . '</td>
                                                        <td>' . $row['completeName'] . '</td>
                                                        <td>' . $row['pcontact'] . '</td>
                                                        <td>' . $row['paddress'] . '</td>
                                                        <td>' . $row['termStart'] . '</td>
                                                        <td>' . $row['termEnd'] . '</td>
                                                        <td>
                                                            <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin-right: 5px; background-color: green;"></span>
                                                            Current Official
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <button class="btn btn-primary btn-sm" data-target="#editModal' . $row['id'] . '" data-toggle="modal">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                            </button>
                                                        </td>
                                                    </tr>';
                                                    include "edit_modal.php";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php include "../deleteModal.php"; ?>

                                </form>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                        <?php include "../duplicate_error.php"; ?>
                        <?php include "../edit_notif.php"; ?>
                        <?php include "../added_notif.php"; ?>
                        <?php include "../delete_notif.php"; ?>
                        <?php include "add_modal.php"; ?>
                        <?php include "function.php"; ?>
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <?php include "../footer.php"; ?>

        <script type="text/javascript">
            <?php if (!isset($_SESSION['staff'])) { ?>
                $(function() {
                    $("#table").dataTable({
                        "aoColumnDefs": [{
                            "bSortable": false,
                            "aTargets": [0, 7]
                        }],
                        "aaSorting": []
                    });
                });
            <?php } else { ?>
                $(function() {
                    $("#table").dataTable({
                        "aoColumnDefs": [{
                            "bSortable": false,
                            "aTargets": [6]
                        }],
                        "aaSorting": []
                    });
                });
            <?php } ?>
        </script>
    </body>
</html>