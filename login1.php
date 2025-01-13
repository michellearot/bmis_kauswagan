<!DOCTYPE html>
<html>
<?php
session_start();
?>
    <head>
        <meta charset="UTF-8">
        <title>Barangay Information System</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <style>
            /* Ensure the body takes full height and removes margins */
            html, body {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            /* Background Image */
            body {
                background-image: url('img/bg.jpg'); /* Path to the image */
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh; /* Full height */
            }

            /* Panel Styles */
            .panel {
                box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.5); /* Dark shadow for the login form */
                z-index: 1; /* Ensure the panel is above the background */
                position: relative;
            }

            .panel-heading img {
                width: 150px;
                height: auto;
            }

            /* Add margin-top to h3 */
            .panel-heading h3 {
                margin-top: 20px; /* Adjust the value as needed */
            }

            /* Container for the login box */
            .container {
                margin-top: 30px;
                position: relative;
                z-index: 2; /* Keep the form above the background */
            }
        </style>

    </head>
    <body class="skin-black">
        <!-- Login Form -->
        <div class="container">
          <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;">
                    <img src="img/logo.png" style="height:150px;" />
                  <h3 class="panel-title">
                    <strong>
                        Barangay Management Information System
                    </strong>
                  </h3>
                </div>
                <div class="panel-body">
                  <form role="form" method="post">
                    <div class="form-group">
                      <label for="txt_username">Username</label>
                      <input type="text" class="form-control" style="border-radius:0px" name="txt_username" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                      <label for="txt_password">Password</label>
                      <input type="password" class="form-control" style="border-radius:0px" name="txt_password" placeholder="Enter Password">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary" name="btn_login">Log in</button>
                    <label id="error" class="label label-danger pull-right"></label> 
                  </form>
                </div>
              </div>
          </div>
        </div>

      <?php
        consolePrint('asdf');
        function consolePrint($data) {
          $output = $data;
          if (is_array($output))
              $output = implode(',', $output);

          echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
        }

        include "pages/connection.php";
        if(isset($_POST['btn_login']))
        { 
            $username = $_POST['txt_username'];
            $password = $_POST['txt_password'];

            
            consolePrint( strlen($password) );
            if(  strlen($password) <8) {
              echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Password cant be less than 8 characters";</script>';
              return;
            }


            $admin = mysqli_query($con, "SELECT * from tbluser where username = '$username' and password = '$password' and type = 'administrator' ");
            $numrow_admin = mysqli_num_rows($admin);

            // echo $username;
            // echo $password;
            consolePrint($username);
            consolePrint($password);

            $zone = mysqli_query($con, "SELECT * from tblzone where username = '$username' and password = '$password'");
            $numrow_zone = mysqli_num_rows($zone);

            $staff = mysqli_query($con, "SELECT * from tblstaff where username = '$username' and password = '$password' ");
            $numrow_staff = mysqli_num_rows($staff);

            if($numrow_admin > 0)
            {
                while($row = mysqli_fetch_array($admin)){
                  $_SESSION['role'] = "Administrator";
                  $_SESSION['userid'] = $row['id'];
                  $_SESSION['username'] = $row['username'];
                }    
                header ('location: pages/officials/officials.php');
            }
            elseif($numrow_zone > 0)
            {
                while($row = mysqli_fetch_array($zone)){
                  $_SESSION['role'] = $row['name'];
                  $_SESSION['zone'] = "Permit Admin";
                  $_SESSION['userid'] = $row['id'];
                  $_SESSION['username'] = $row['username'];
                }    
                header ('location: pages/permit/permit.php');
            }
            elseif($numrow_staff > 0)
            {
                while($row = mysqli_fetch_array($staff)){
                  $_SESSION['role'] = $row['name'];
                  $_SESSION['staff'] = "Staff";
                  $_SESSION['userid'] = $row['id'];
                  $_SESSION['username'] = $row['username'];
                }    
                header ('location: pages/resident/resident.php');
            }
            else
            {
              echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Invalid Account";</script>';
               
            }
             
        }
        
      ?>

    </body>
</html>