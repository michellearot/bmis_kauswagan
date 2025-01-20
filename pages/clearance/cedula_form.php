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
    $_SESSION['clr'] = $_GET['cedula'];
    include('../head_css.php'); ?>
    <body class="skin-black" >
        <!-- header logo: style can be found in header.less -->
        <?php 
        
        include "../connection.php";


        $cedulaId = $_GET['cedula'];

        if ( $_GET['cedula']== 'false'){
                echo'
            
                    <script>
                    console.log("create new cedula here")
                    </script>
                    
                ';    

                $date = date('Y-m-d H:i:s');

                $query = mysqli_query($con,
                "INSERT INTO tblcedula (
                    ResidentId,DateCreated,status) 
                    values (
                    
                    ".$_GET['resident'].",
                    '".$date."',
                    'APPROVED')"
                ) or die('Error: ' . mysqli_error($con));

                $last_id = mysqli_insert_id($con);
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

        echo'
        
                <script>
                console.log('.$_GET['cedula'].')
                </script>
                
            '; 

        

        ?>
       
        <div class="col-xs-12 col-sm-6 col-md-8" style="" >
            <div style=" background: black;" >

                <div class="col-xs-7 col-sm-5 col-md-8" style="background: white;  ">
                    <!-- <div class="pull-left col-sm-6" style="font-size: 16px;border: 1px solid black;"><b>
                        COMMUNITY TAX CERTIFICATE 
                    </div>

                    <div class="pull-left col-sm-6" style="font-size: 16px;border: 1px solid black;"><b>
                        INDIVIDUAL
                    </div>

                    <div class="pull-left col-sm-2" style="font-size: 12px;border: 1px solid black;"><b>
                        Year
                    </div>

                    <div class="pull-left col-sm-4" style="font-size: 12px;border: 1px solid black;"><b>
                        Place of Issue
                    </div>
                    <div class="pull-left col-sm-6" style="font-size: 12px;border: 1px solid black;"><b>
                        Date of Issue
                    </div>



                    <div class="pull-left col-sm-2" style="font-size: 16px;border: 1px solid black;"><b>
                        <?php echo date("Y"); ?>
                    </div>

                    <div class="pull-left col-sm-4" style="font-size: 16px;border: 1px solid black;"><b>
                    Kauswagan, Cagayan de Oro
                    </div> -->


                    
                       
                        <?php

                   
                        
                        $qry=mysqli_query($con,"

                        SELECT *
                        FROM tblresident
                        LEFT JOIN tblcedula ON tblresident.id = tblcedula.ResidentId
                        WHERE tblcedula.ResidentId ='".$_GET['resident']."' and tblcedula.id ='".$cedulaId."'");
                        
    
                        while($row = mysqli_fetch_array($qry)){
                           
                            


                            $bdate = date_create($row['bdate']);
                            $date = date_create($row['dateCreated']);


                            echo '


                            <div class="pull-left col-sm-6" style="font-size: 16px;"><b>
                                COMMUNITY TAX CERTIFICATE 
                            </div>

                            <div class="pull-left col-sm-6" style="font-size: 16px;"><b>
                                INDIVIDUAL
                            </div>

                            <div class="pull-left col-sm-2" style="font-size: 12px;"><b>
                                Year
                            </div>

                            <div class="pull-left col-sm-4" style="font-size: 12px;"><b>
                                Place of Issue
                            </div>

                            <div class="pull-left col-sm-6" style="font-size: 12px"><b>
                                Date of Issue
                            </div>

                            <div class="pull-left col-sm-2" style="font-size: 16px;"><b>
                                '.date("Y").'
                            </div>

                            <div class="pull-left col-sm-4" style="font-size: 16px;">
                                <b>Kauswagan, Cagayan de Oro</b>
                            </div>
                            <div class="pull-left col-sm-6 style="font-size: 16px;"><b>
                                <b>'.strtoupper(date_format($date,"F j, o")).'</b>
                            </div>
                            <br>
                            <br>
                            <br>

                            

                           

                            <div class="pull-left col-sm-2" style="font-size: 12px;"><b>
                                Name( surnamee)
                            </div>

                            <div class="pull-left col-sm-4" style="font-size: 12px;"><b>
                                First
                            </div>
                            <div class="pull-left col-sm-6" style="font-size: 12px"><b>
                                Middle
                            </div>

                            <div class="pull-left col-sm-2 style="font-size: 16px"><b>
                                <u>'.strtoupper($row['lname']).'</u>
                            </div>

                            <div class="pull-left col-sm-4 style="font-size: 16px"><b>
                                <u>'.strtoupper($row['fname']).'</u>
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 16px"><b>
                                <u>'.strtoupper($row['mname']).'</u>
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 12px"><b>
                                Address
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 12px"><b>
                                sex
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 16px"><b>
                                <u>'.strtoupper($row['formerAddress']).'</u>
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 16px"><b>
                                <u>'.strtoupper($row['gender']).'</u><br>
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 12px"><b>
                                Place of Birth
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 12px"><b>
                                Date of Birth
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 16px"><b>
                                <u>'.strtoupper($row['bplace']).'</u>
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 16px"><b>
                                <u>'.strtoupper($row['bdate']).'</u><br>
                            </div>


                            <div class="pull-left col-sm-6 style="font-size: 12px"><b>
                                Nationality
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 12px"><b>
                                Religion
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 16px"><b>
                            <u>'.strtoupper($row['nationality']).'</u>
                            </div>

                            <div class="pull-left col-sm-6 style="font-size: 16px"><b>
                            <u>'.strtoupper($row['religion']).'</u>
                            </div>
                            ';
                        }
                        ?>
                     
                    <!-- <div class="col-md-5 col-xs-4" style="float:right;margin-top: -160px;">
                        <div style="height:100px; width:140px; border: 1px solid black;">
                            <center><span style="text-align: center; line-height: 160px;">Right Thumb Mark</span></center>
                        </div>
                        <p>Tax Payer's Signature</p>
                    </div> -->
                    <div class="pull-left col-sm-6" style="float:left;">
                        <div style="height:100px; width:140px; border: 1px solid black;">
                            <center><span style="text-align: center; line-height: 160px;">Right Thumb Mark</span></center>
                        </div>
                        <p>Tax Payer's Signature</p>
                    </div>
                </div>
                
                <!-- <div class="col-md-5" style="float:left;margin-top: -160px;">
                    <div style="height:100px; width:140px; border: 1px solid black;">
                        <center><span style="text-align: center; line-height: 160px;">Right Thumb Mark</span></center>
                    </div>
                    <p>Tax Payer's Signature</p>
                </div> -->
            </div>
        </div>
    <button class="btn btn-primary noprint" id="printpagebutton" onclick="PrintElem('#clearance')">Print</button>
    </body>
    <?php
    }
    ?>


    <script>
         function PrintElem(elem)
    {
        window.print();
    }
    
    function Popup(data) 
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