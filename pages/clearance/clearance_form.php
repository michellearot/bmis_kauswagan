<!DOCTYPE html>
<html id="clearance">
<style>
    @media print {
        .noprint {
        visibility: hidden;
         }
    }
    @page { size: auto;  margin: 4mm; }
</style>
    <?php
    session_start();
    if(!isset($_SESSION['role']))
    {
        header("Location: ../../login.php"); 
    }
    else
    {
    ob_start();
    $_SESSION['clr'] = $_GET['clearance'];
    include('../head_css.php'); ?>
    <body class="skin-black" >
        <!-- header logo: style can be found in header.less -->
        <?php 
        
        include "../connection.php";

            echo'
        
                <script>
                console.log("c-",'.  is_int( intval($_GET['clearance']) )  .')
                
                console.log("r-",'.  $_GET['resident']  .')
                </script>
                
            '; 
            
            if(intval($_GET['clearance']) >0 ) {

                $last_id = $_GET['clearance'];

                echo'
            
                    <script>
                        console.log("clearance = false")
                    </script>
                    
                ';    

            }elseif(is_int( intval($_GET['clearance']) ) ==1 ){
                echo'
            
                    <script>
                    console.log("create new clearance here")
                    </script>
                    
                ';    

                $date = date('Y-m-d H:i:s');

                $query = mysqli_query($con,
                "SELECT MAX(id) from tblclearance2"
                ) or die('Error: ' . mysqli_error($con));

                $last_id = mysqli_fetch_array($query)[0];
                echo "
                <script>
                    console.log(' New record created successfully. Last inserted ID is: '," . $last_id .")
                </script>";
                $cedulaId = $last_id;
                if($query == true)
                {
                    $_SESSION['added'] = 1;
                    // header ("location: ".$_SERVER['REQUEST_URI']);
                    echo'
                    <script>
                        console.log("cedula created")
                    </script>';
                }  
        }

        ?>
       
        <div class="col-xs-12 col-sm-6 col-md-8" style="" >
            <div style=" background: black;" >
                <div class="col-xs-4 col-sm-6 col-md-3" style="background: white; margin-right:10px; border: 2px solid black;">
                    <center><image src="../../img/logo.png" style="width:90%;height:164px;"/></center>
                    <div style="margin-top:20px; text-align: center; word-wrap: break-word;">
                        <?php
                            $qry = mysqli_query($con,"SELECT * from tblofficial");
                            while($row=mysqli_fetch_array($qry)){
                                if($row['sPosition'] == "Captain"){
                                    echo '
                                    <p>
                                    <b>'.strtoupper($row['completeName']).'</b><br>
                                    <span style="font-size:12px;">PUNONG BARANGAY</span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Ordinance)"){
                                    echo '
                                    <p>
                                    KAG. '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;">Sports / Law / Ordinance</span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Public Safety)"){
                                    echo '
                                    <p>
                                    KAG. '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;">Public Safety / Peace and Order</span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Tourism)"){
                                    echo '
                                    <p>
                                    KAG. '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;">Culture & Arts / Tourism / Womens Sector</span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Budget & Finance)"){
                                    echo '
                                    <p>
                                    KAG. '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;">Budget & Finance / Electrification</span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Agriculture)"){
                                    echo '
                                    <p>
                                    KAG. '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;">Agriculture / Livelihood / Farmers Sector / PWD Sector</span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Education)"){
                                    echo '
                                    <p>
                                    KAG. '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;">Health & Sanitation / Education</span>
                                    </p>
                                    ';
                                }elseif($row['sPosition'] == "Kagawad(Infrastracture)"){
                                    echo '
                                    <p>
                                    KAG. '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;">Infrastracture / Labor Sector/ Environment / Beautification</span>
                                    </p>
                                    ';
                                }elseif($row['status']=='Ongoing Term'){
                                    echo '
                                    <p>
                                    KAG. '.strtoupper($row['completeName']).'<br>
                                    <span style="font-size:12px;">'.$row['sPosition'].'</span>
                                    </p>
                                    ';

                                }
                            }
                        ?>
                    </div>
                </div>
                <div class="col-xs-7 col-sm-5 col-md-8" style="background: white;  ">
                    <div class="pull-left" style="font-size: 16px;"><b>
                        Republic of the Philippines<br>
                        Municipality of Cagayan de Oro<br>
                        Province of Misamis Oriental<br>
                        BARANGAY KAUSWAGAN<br>
                        Tel. 999-0000<br></b>
                    </div>
                    <div class="pull-right" style="border: 2px solid black;">
                       <?php $qry1=mysqli_query($con,"SELECT * from tblresident where id = '".$_GET['resident']."'");
                    // <?php $qry1=mysqli_query($con,"SELECT * from tblresident r left join tblclearance c on c.residentid = r.id where residentid = '".$_GET['resident']."' and clearanceNo = '".$_GET['clearance']."' ");
                            while($row1 = mysqli_fetch_array($qry1)){
                        echo '<image src="../resident/image/'.basename($row1['image']).'" style="width:160px;height:160px;"/>';
                        }
                        ?>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <p class="text-center" style="font-size: 20px; font-size:bold;">OFFICE OF THE BARANGAY CAPTAIN<br><b style="font-size: 28px;">BARANGAY CLEARANCE</b></p>
                        <p style="font-size: 18px;">TO WHOM IT MAY CONCERN:</p>
                        <p style="text-indent:40px;text-align: justify;">This is to certify that the person whose photo, signature and right thumb mark appear herein, is a resident of Barangay Kauswagan, Cagayan de Oro, Misamis Oriental and that the person had requested a criminal check from this office following is/are our findings.</p>

                        <!-- <script>
                            console.log($_GET['resident'])
                            console.log($_GET['clearance'])
                        </script> -->
                        <?php

                            $res = $_GET['resident'];
                            $cle = $_GET['clearance'];

                            echo"
                            <script>
                                console.log(".$res.")
                                console.log(".$cle.")
                            </script>
                            ";
                        
                        ?>

                        <?php

                   
                        
                            $qry=mysqli_query($con,"SELECT * from tblresident r left join tblclearance2 c on c.ResidentId = r.id where c.id = '".$last_id."'");
                            while($row = mysqli_fetch_array($qry)){
                                $bdate = date_create($row['Birthdate']);
                                $date = date_create($row['dateCreated']);
                                echo '
                                <p><b>
                                    SURNAME: <u>'.strtoupper($row['lname']).'</u><br>
                                    FIRST NAME: <u>'.strtoupper($row['fname']).'</u><br>
                                    MIDDLE NAME: <u>'.strtoupper($row['mname']).'</u><br>
                                    ADDRESS: <u>Kauswagan, Cagayan de Oro City</u><br>
                                    BIRTHDATE & PLACE: <u>'.strtoupper(date_format($bdate,"m-d-Y")).'/'.strtoupper($row['bplace']).'</u><br>
                                    GENDER/CIVIL STATUS: <u>'.strtoupper($row['gender']).'/SINGLE</u><br>
                                    NATIONALITY: <u>'.strtoupper($row['nationality']).'</u><br>
                                    RELIGION: <u>'.strtoupper($row['religion']).'</u><br>
                                    FINDINGS: <u>NO DEROGATORY RECORD</u><br>
                                </b></p>
                                <p><b>
                                    RES. CERT. NO.: <u>'.strtoupper($row['clearanceNo']).'</u><br>
                                    ISSUED ON: <u>'.strtoupper(date_format($date,"F j, o")).'</u><br>
                                    ISSUED AT: <u>KAUSWAGAN OFFICE</u><br>
                                    ISSUED ON: <u>'.strtoupper(date_format($date,"F j, o")).'</u><br>
                                </b></p>
                                ';
                                break;
                            }
                        ?>
                    </div>  
                    <div class="col-md-5 col-xs-4" style="float:right;margin-top: -160px;">
                        <div style="height:100px; width:140px; border: 1px solid black;">
                            <center><span style="text-align: center; line-height: 160px;">Right Thumb Mark</span></center>
                        </div><br><br>
                        <p>Tax Payer's Signature</p>
                    </div>
                </div>
                <div class="col-xs-offset-6 col-xs-5 col-md-offset-6 col-md-4" ><br><br><br>
                    <?php
                    $qry = mysqli_query($con,"SELECT * from tblofficial");
                    while($row=mysqli_fetch_array($qry)){
                        if($row['sPosition'] == "Captain"){
                            echo '
                            <p>
                            <b style="font-size:18px;">'.strtoupper($row['completeName']).'<br>
                            <span style=" text-align: center;">Punong Barangay</span></b>
                            </p>
                            ';
                        }
                    }
                    ?>
                </div>
                <div class="col-xs-8 col-md-4">
                    <?php
                    $qry = mysqli_query($con,"SELECT * from tblofficial");
                    while($row=mysqli_fetch_array($qry)){
                        if($row['sPosition'] == "Captain"){
                            echo '
                            <p>
                            <b style="font-size:18px;">'.strtoupper($row['completeName']).'<br>
                            <span style=" text-align: center;">OFFICER OF THE DAY</span></b>
                            </p>
                            ';
                        }
                    }
                    ?>
                </div>
                <div class="col-xs-3 pull-right" style="margin-bottom:40px;">
                    <img class=" pull-right" src="barcode.php?clr=<?php echo base64_decode($_GET['val']);?>" style="width:170px; height: 60px; " />

                    <span class="pull-right"><?php echo substr_replace($_GET['clearance'],'****',0,3);?> </span>
               
                </div>
            </div>
        </div>
    <!-- <button class="btn btn-primary noprint" id="printpagebutton" onclick="PrintElem('#clearance')">Print</button> -->
    </body>
    <?php
    }
    ?>


    <script>
         function PrintElem(elem)
    {
        window.print();
        setTimeout(() => {$("#clearance").hide() }, 3000)
    }
    // PrintElem("#clearance")
    // function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        //mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        //mywindow.document.write('</head><body class="skin-black" >');
         var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        mywindow.document.write(data);
        //mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();

        printButton.style.visibility = 'visible';
        mywindow.close();

        return true;
    }

    </script>
</html>