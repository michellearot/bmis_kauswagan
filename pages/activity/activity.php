

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

<head>
<style>
* {box-sizing: border-box;}
ul {list-style-type: none;}
body {font-family: Verdana, sans-serif;}

.month {
  padding: 70px 25px;
  width: 100%;
  background: #1abc9c;
  text-align: center;
}

.month ul {
  margin: 0;
  padding: 0;
}

.month ul li {
  color: white;
  font-size: 20px;
  text-transform: uppercase;
  letter-spacing: 3px;
}

.month .prev {
  float: left;
  padding-top: 10px;
}

.month .next {
  float: right;
  padding-top: 10px;
}

.weekdays {
  margin: 0;
  padding: 10px 0;
  background-color: #ddd;
}

.weekdays li {
  display: inline-block;
  width: 13.6%;
  color: #666;
  text-align: center;
}

.days {
  padding: 10px 0;
  background: #eee;
  margin: 0;
}

.days li {
  list-style-type: none;
  display: inline-block;
  width: 13.6%;
  text-align: center;
  margin-bottom: 5px;
  font-size:12px;
  color: #777;
}

.days li .active {
  padding: 5px;
  background: #1abc9c;
  color: white !important
}

/* Add media queries for smaller screens */
@media screen and (max-width:720px) {
  .weekdays li, .days li {width: 13.1%;}
}

@media screen and (max-width: 420px) {
  .weekdays li, .days li {width: 12.5%;}
  .days li .active {padding: 2px;}
}

@media screen and (max-width: 290px) {
  .weekdays li, .days li {width: 12.2%;}
}
</style>


<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>

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
                        Events
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">
                                        <?php 
                                            if(!isset($_SESSION['resident']))
                                            {
                                        ?>

                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Event</button>  
                                                
                                                <?php 
                                                    if(!isset($_SESSION['staff']))
                                                    {
                                                ?>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
                                                <?php
                                                    }
                                            }
                                                ?>
                                
                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">

                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active"><a data-target="#calendar" data-toggle="tab">Calendar</a></li>
                                    <li><a data-target="#notcalendar" data-toggle="tab">Events List</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="calendar" class="tab-pane active in">

                                    <?php

                                    $year = date('Y');
                                    $month = date('F');
                                    $currentDate = date('d');

                                    $timestamp = time();

                                
                                        
                                    $cars = array("Volvo", "BMW", "Toyota"); 
                                    $months =  array("","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

                                    $days =  array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

                                    $checkMonth = 0;
                                    for ($i = 0; $i < count($months); $i++) {
                                        if($months[$i] === $month){
                                            $checkMonth = $i;
                                        }
                                    }

                                    echo $currentDate."-<br>";
                                    $noDays=cal_days_in_month(CAL_GREGORIAN, $checkMonth ,date("Y"));
                                  

                                    $fff = date('F') .' '. date('Y');
                                    
                                    $firstday = trim( date('l ', strtotime($fff)) );
                                    
                                    

                                
                                    
                
                                    $skip = 0;

                                    echo '<br>';
                                    for ($i = 0; $i < count($days); $i++) {
                                        if($days[$i] == $firstday){
                                            $skip = $i;
                                        }
                                    }
                                    
                                    ?>

                                    


                                    <div class="month">      
                                    <ul>
                                        <li class="prev">&#10094;</li>
                                        <li class="next">&#10095;</li>
                                        <li>
                                            <?php
                                                echo  $month;
                                            ?>
                                        <br>
                                        <span style="font-size:18px">
                                            <?php
                                                echo $year;
                                            ?>
                                        </span>
                                        </li>
                                    </ul>
                                    </div>

                                    <ul class="weekdays">

                                    <?php
                                    for ($i = 0; $i <count($days); $i++) {
                                        echo "<li> $days[$i] </li>";
                                    }
                                    ?>
                                    
                                    
                                    </ul>

                                    <ul class="days">  

                                    <?php

                                    $skip = 0;

                                    for ($i = 0; $i < count($days); $i++) {

                                        if($days[$i] == $firstday){
                                            $skip = $i;
                                        }
                                    }
                                    // $aaa;
                                    $my_array = array_fill(0, $skip, "");

                                    for ($i = 1; $i <= $skip; $i++) {
                                        echo "<li>  </li>";
                                    }
                                                        
                                    for ($i = 1; $i <= $noDays; $i++) {

                                        $squery = mysqli_query($con, "SELECT * FROM tblactivity where month(dateofactivity) =".$checkMonth);


                                        $skipAfter = FALSE;

                                        
                                
                                        while ($row = mysqli_fetch_array($squery)) {
                                            $date=date_create($row['dateofactivity']);
                                            $date =  intval(date_format($date,"d"));

                                            $emptyArray=array();           

                                            if($date === $i){
                                                array_push($emptyArray,$row['activity']);
                                                // echo "<li><span class='active'> $i </span></li>";
                                            }

                                            if(  count( $emptyArray) > 0   ){

                                                $tagtext = '';
                                                for ($j=0; $i<=$emptyArray; $j++)
                                                {
                                                    $tagtext .= '<p>'.$emptyArray[$j].'</p>'  ;
                                                    // echo $emptyArray[$j];
                                                    break;
                                                }
                                                // <script></script>

                                                echo'
                                                    <li> 
                                                        <div>
                                                            <button onclick="document.getElementById("id01").style.display="block"'.'" class="w3-button w3-black">'.$i.'</button> 
                                                            <div id="id01" class="w3-modal">
                                                                <div class="w3-modal-content">
                                                                <div class="w3-container">
                                                                    <span onclick="document.getElementById("id01").style.display="none"'.'" class="w3-button w3-display-topright">&times;</span>

                                                                    <p>asdasdasd</p>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>  

                                                ';

                                                // <div id="id01" class="w3-modal">
                                                //     <div class="w3-modal-content">
                                                //     <div class="w3-container">
                                                //         <span onclick="document.getElementById("id01").style.display="none"'.'" class="w3-button w3-display-topright">&times;</span>

                                                //         <p>asdasdasd</p>
                                                //     </div>
                                                //     </div>
                                                // </div>

                                                $skipAfter = TRUE;

                                            }
                                    

                                            // echo count( $emptyArray).'-';
                                        }
                                        
                                        if( $skipAfter ){
                                            continue;
                                        }
                                        if ($squery->num_rows > 0){
                                            if($i == $currentDate){

                                                echo 
                                                "<li>
                                                    <span class='active'>".$i."</span>
                                                </li>";
                                            }else{
                                                echo 
                                            "<li>".$i."</li>";

                                            }
                                        }
                                    }
                                    
                                    ?>
                                    
                                    </ul>                                    
                                    </div>

                                    
                                    <div id="notcalendar" class="tab-pane ">

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
                                                            <?php 
                                                            if((!isset($_SESSION['staff'])) && (!isset($_SESSION['resident'])))
                                                            {
                                                            ?>
                                                            <th style="width: 20px !important;">
                                                                <!-- <input type="radio" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)"/> -->
                                                            </th>
                                                            <?php
                                                                }
                                                            ?>
                                                            <th>Date of the Event</th>
                                                            <th>Event</th>
                                                            <th>Description</th>
                                                            <th style="width: 140px !important;">Option</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if($_SESSION['role'] == "Administrator")
                                                        {   

                                                            $squery = mysqli_query($con, "select * from tblactivity");
                                                            while($row = mysqli_fetch_array($squery))
                                                            {
                                                                echo '
                                                                <tr>
                                                                    <td><input type="radio" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td>
                                                                    <td>'.$row['dateofactivity'].'</td>
                                                                    <td>'.$row['activity'].'</td>
                                                                    <td>'.$row['description'].'</td>
                                                                    <td>
                                                                        <button class="btn btn-primary btn-sm" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                                        <button class="btn btn-primary btn-sm" data-target="#viewModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-search" aria-hidden="true"></i> Photo</button>
                                                                    </td>
                                                                </tr>
                                                                ';

                                                                include "edit_modal.php";
                                                                include "view_modal.php";
                                                            }

                                                        }
                                                        elseif(isset($_SESSION['resident'])){
                                                            $squery = mysqli_query($con, "select * from tblactivity");
                                                            while($row = mysqli_fetch_array($squery))
                                                            {
                                                                echo '
                                                                <tr>
                                                                    <td>'.$row['dateofactivity'].'</td>
                                                                    <td>'.$row['activity'].'</td>
                                                                    <td>'.$row['description'].'</td>
                                                                    <td><button class="btn btn-primary btn-sm" data-target="#viewModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-search" aria-hidden="true"></i> Photo</button></td>
                                                                </tr>
                                                                ';

                                                                include "view_modal.php";
                                                            }
                                                        }
                                                        else{
                                                            $squery = mysqli_query($con, "select * from tblactivity");
                                                            while($row = mysqli_fetch_array($squery))
                                                            {
                                                                echo '
                                                                <tr>
                                                                    <td>'.$row['dateofactivity'].'</td>
                                                                    <td>'.$row['activity'].'</td>
                                                                    <td>'.$row['description'].'</td>
                                                                    <td>
                                                                        <button class="btn btn-primary btn-sm" data-target="#editModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                                        <button class="btn btn-primary btn-sm" data-target="#viewModal'.$row['id'].'" data-toggle="modal"><i class="fa fa-search" aria-hidden="true"></i> Photo</button>
                                                                    </td>
                                                                </tr>
                                                                ';

                                                                include "edit_modal.php";
                                                                include "view_modal.php";
                                                            }
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
                                                    <?php 
                                                    if((!isset($_SESSION['staff'])) && (!isset($_SESSION['resident'])))
                                                    {
                                                    ?>
                                                    <th style="width: 20px !important;">
                                                    <!-- <input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)"/> -->
                                                    </th>
                                                    <?php
                                                        }
                                                    ?>
                                                    <th>Date of the Event</th>
                                                    <th>Event</th>
                                                    <th>Description</th>
                                                    <th style="width: 140px !important;">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                  

                                                    $squery = mysqli_query($con, "select * from tblactivity2");
                                                    while($row = mysqli_fetch_array($squery))
                                                    {
                                                        echo '
                                                        <tr>
                                                            <td>
                                                                <textarea style="display:none" name="rowid" value ="'.$row['id'].'"> '.$row['id'].'  </textarea>
                                                            </td>
                                                            <td>'.$row['dateofactivity'].'</td>
                                                            <td>'.$row['activity'].'</td>
                                                            <td>'.$row['description'].'</td>
                                                            <td>
                                                                <input  type="submit" name="btn_recover" class="btn btn-primary btn-sm" value="Recover"> 
                                                            </td>
                                                        </tr>
                                                        ';

                                                        include "edit_modal.php";
                                                        include "view_modal.php";
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

var select_all = document.getElementById("cbxMainphoto"); //select all checkbox
var checkboxes = document.getElementsByClassName("chk_deletephoto"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
    for (i = 0; i < checkboxes.length; i++) { 
        checkboxes[i].checked = select_all.checked;
    }
});


for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){
            select_all.checked = false;
        }
        //check "select all" if all checkbox items are checked
        if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
            select_all.checked = true;
        }
    });
}

    <?php
    if($_SESSION['role'] == "Administrator")
    {
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,4 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    elseif(isset($_SESSION['resident']))
    {
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    else{
    ?>
        $(function() {
            $("#table").dataTable({
               "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 4 ] } ],"aaSorting": []
            });
            $(".select2").select2();
        });
    <?php
    }
    ?>
</script>
    </body>
</html>