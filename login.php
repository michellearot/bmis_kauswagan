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
        width: 400px; /* Increase width of the login form */
        border-radius: 20px; /* Add roundness to the edges */
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.5); /* Dark shadow for the login form */
        z-index: 1; /* Ensure the panel is above the background */
        position: relative;
        overflow: hidden; /* Ensure rounded corners apply to all inner content */
    }

    .panel-heading {
        border-top-left-radius: 20px; /* Match the top-left roundness */
        border-top-right-radius: 20px; /* Match the top-right roundness */
        background: #c35451; /* Change canvas background color to #c35451 */
        text-align: center; /* Center-align content */
        padding: 20px; /* Add padding for spacing */
    }

    .panel-heading h3 {
        color: black; /* Change header text color to white */
        margin-top: 10px; /* Adjust spacing below the logo */
        font-weight: bold;
    }

    .panel-body {
        border-bottom-left-radius: 20px; /* Match the bottom-left roundness */
        border-bottom-right-radius: 20px; /* Match the bottom-right roundness */
    }

    .panel-heading img {
        width: 150px;
        height: auto;
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
              <div class="panel-heading">
    <img src="img/logo.png" style="height:150px;" />
    <h3 class="panel-title">
        Barangay Management Information System
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

            $username = $_POST['txt_username'];
            $password = $_POST['txt_password'];

            if(  strlen($password) <8) {
              echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Password cant be less than 8 characters";</script>';
              return;
            }

            $user = mysqli_query($con, "SELECT * from tblstaff where username = '$username' and password = '$password' ");
            $numrow_user = mysqli_num_rows($user);

            


            $admin = mysqli_query($con, "SELECT * from tbluser where username = '$username' and password = '$password' and type = 'administrator' ");
            $numrow_admin = mysqli_num_rows($admin);

            // echo $username;
            // echo $password;
            consolePrint($username);
            consolePrint($password);



            if($numrow_user > 0)
            {
                while($row = mysqli_fetch_array($user)){

                  if( $row['role'] == "Staff"){
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['role'] = $row['name'];
                    $_SESSION['staff'] = "Staff";
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    
                    // header ('location: pages/resident/resident.php');
                    
                    header ('location: pages/officials/officials.php');
                  }else{
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['role'] = "Permit Admin";
                    $_SESSION['zone'] = "Zone Leader";
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    
                    header ('location: pages/permit/permit.php');
                    
                    // header ('location: pages/permi/officials.php');

                  }
                  
                }    
            }elseif($numrow_admin > 0)
            {
                while($row = mysqli_fetch_array($admin)){
                  $_SESSION['role'] = "Administrator";
                  $_SESSION['userid'] = $row['id'];
                  $_SESSION['username'] = $row['username'];
                }    
                header ('location: pages/officials/officials.php');
            }
            else
            {
              echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Invalid Account";</script>';
               
            }
             
        }
        
      ?>

    </body>
</html>