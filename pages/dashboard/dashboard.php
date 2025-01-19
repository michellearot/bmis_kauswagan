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
                        Dashboard
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                            <div class="box">

                                <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                  <div class="info-box">
                                    <a href="../files/files.php"><span class="info-box-icon bg-aqua"><i class="fa fa-home"></i></span></a>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Total Files</span>
                                      <span class="info-box-number">
                                        <?php
                                            $q = mysqli_query($con,"SELECT * from tblfiles");
                                            $num_rows = mysqli_num_rows($q);
                                            echo $num_rows;
                                        ?>
                                      </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                                  <!-- /.info-box -->
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                  <div class="info-box">
                                    <a href="../resident/resident.php"><span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span></a>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Total Resident</span>
                                      <span class="info-box-number">
                                        <?php
                                            $q = mysqli_query($con,"SELECT * from tblresident");
                                            $num_rows = mysqli_num_rows($q);
                                            echo $num_rows;
                                        ?>
                                      </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                                  <!-- /.info-box -->
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                  <div class="info-box">
                                    <a href="../clearance/clearance.php"><span class="info-box-icon bg-aqua"><i class="fa fa-file"></i></span></a>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Total Clearance</span>
                                      <span class="info-box-number">
                                        <?php
                                            $q = mysqli_query($con,"SELECT * from tblclearance2 where Approved = 'Approved' ");
                                            $num_rows = mysqli_num_rows($q);
                                            echo $num_rows;
                                        ?>
                                      </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                                  <!-- /.info-box -->
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                  <div class="info-box">
                                    <a href="../permit/permit.php"><span class="info-box-icon bg-aqua"><i class="fa fa-file"></i></span></a>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Total Cedula</span>
                                      <span class="info-box-number">
                                        <?php
                                            $q = mysqli_query($con,"SELECT * from tblcedula where status = 'Approved' ");
                                            $num_rows = mysqli_num_rows($q);
                                            echo $num_rows;
                                        ?>
                                      </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                                  <!-- /.info-box -->
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                  <div class="info-box">
                                    <a href="../blotter/blotter.php"><span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span></a>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Total Blotter</span>
                                      <span class="info-box-number">
                                        <?php
                                            $q = mysqli_query($con,"SELECT * from tblblotter");
                                            $num_rows = mysqli_num_rows($q);
                                            echo $num_rows;
                                        ?>
                                      </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                                  <!-- /.info-box -->
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                  <div class="info-box">
                                    <a href="../blotter/blotter.php"><span class="info-box-icon bg-aqua"><i class="fa fa-file"></i></span></a>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Cedula Range</span>

                                      <?php

                                        
                                      $fff = date('Y') .'-'. date('m') .'-'. intval(date('d'))-7;
                                      
                                      $firstday = date( "Y-m-d",strtotime($fff) );
                                      echo'

                                      
                                      <form method="post">
                                      
                                        <input name="date1" class="form-control input-sm" type="date" placeholder="Date of Activity" value="'.$firstday.'"/>
                                        -
                                        <input name="date2" class="form-control input-sm" type="date" placeholder="Date of Activity" value="'.date("Y-m-d").'"/>
                                      ';
                                      
                                      ?>
    
                                    <!-- <input name="txt_doc" class="form-control input-sm" type="date" placeholder="Date of Activity"/> -->
                                      <span class="info-box-number">

                                      
                                      <input style='width: 100px;' type="submit" name="button1"
                                                  class="btn btn-primary btn-sm" value="Go" /> <br>
                                        <?php

                                          if(isset($_POST['date1'])){
                                            $txt_date1 = $_POST['date1'];
                                            $txt_date2 = $_POST['date2'];
                                          }else{
                                            
                                            $txt_date1 = $firstday;
                                            $txt_date2 = date("Y-m-d");
                                          }
                                            

                                            $q = mysqli_query($con,"SELECT * from tblcedula where dateCreated BETWEEN '".$txt_date1. "' AND '" .$txt_date2."'");
                                            $num_rows = mysqli_num_rows($q);
                                        
                                            function button1() {
                                              echo "";
                                            }

                                            if(array_key_exists('button1', $_POST)) {
                                                button1();
                                            }

                                            
                                            echo $num_rows;
                                            
                                        ?>                                      
                                      </span>

                              `        </form>
                                      
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                                  <!-- /.info-box -->
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12"><br>
                                  <div class="info-box">
                                    <a href="../blotter/blotter.php"><span class="info-box-icon bg-aqua"><i class="fa fa-file"></i></span></a>

                                    <div class="info-box-content">
                                      <span class="info-box-text">Clearance Range</span>

                                      <?php

                                        
                                      $fff = date('Y') .'-'. date('m') .'-'. intval(date('d'))-7;
                                      
                                      $firstday = date( "Y-m-d",strtotime($fff) );
                                      echo'

                                      
                                      <form method="post">
                                      
                                        <input name="clearance_date1" class="form-control input-sm" type="date" placeholder="Date of Activity" value="'.$firstday.'"/>
                                        -
                                        <input name="clearance_date2" class="form-control input-sm" type="date" placeholder="Date of Activity" value="'.date("Y-m-d").'"/>
                                      ';
                                      
                                      ?>
    
                                    <!-- <input name="txt_doc" class="form-control input-sm" type="date" placeholder="Date of Activity"/> -->
                                      <span class="info-box-number">
                                        
                                      <input style='width: 100px;' type="submit" name="buttonc1"
                                                  class="btn btn-primary btn-sm" value="Go" /><br>
                                        <?php

                                          if(isset($_POST['clearance_date1'])){
                                            $txt_clearance_date1 = $_POST['clearance_date1'];
                                            $txt_clearance_date2 = $_POST['clearance_date2'];
                                          }else{
                                            
                                            $txt_clearance_date1 = $firstday;
                                            $txt_clearance_date2 = date("Y-m-d");
                                          }
                                            

                                            $qc = mysqli_query($con,"SELECT * from tblclearance2 where dateCreated BETWEEN '".$txt_clearance_date1. "' AND '" .$txt_clearance_date2."'");
                                            $num_rowsc = mysqli_num_rows($qc);
                                        
                                            function buttonc1() {
                                              echo "";
                                            }

                                            if(array_key_exists('buttonc1', $_POST)) {
                                                buttonc1();
                                            }

                                            
                                            echo $num_rowsc;
                                            
                                        ?>                                      
                                      </span>

                                      </form>
                                      
                                    </div>
                                    <!-- /.info-box-content -->
                                  </div>
                                  <!-- /.info-box -->
                                </div>
                            </div><!-- /.box -->
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
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>