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
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <style>
    /* Ensure the body takes full height and removes margins */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    /* Background Image */
    body {
      background-image: url('../../img/bg.jpg');
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
        <div class="container" style="margin-top:30px">
          <div class="col-md-4 col-md-offset-4">
              <div class="panel panel-default">
            <div class="panel-heading" style="text-align:center;">
                <img src="../../img/logo.png" />
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
        include "../connection.php";
        if(isset($_POST['btn_login']))
        { 
            $username = $_POST['txt_username'];
            $password = $_POST['txt_password'];

            if(  strlen($password) <8) {
              echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Password cant be less than 8 characters";</script>';
              return;
            }

            $user = mysqli_query($con, "SELECT * from tblzone where username = '$username' and password = '$password' ");
            $numrow_user = mysqli_num_rows($user);

            if($numrow_user > 0)
            {
                while($row = mysqli_fetch_array($user)){
                  $_SESSION['role'] = "Zone Leader";
                  $_SESSION['userid'] = $row['id'];
                  $_SESSION['username'] = $row['username'];
                }    
                header ('location: ../permit/permit.php');
            }
            else
            {
              echo '<script type="text/javascript">document.getElementById("error").innerHTML = "Invalid Account";</script>';
            }
        }
      ?>

    </body>
</html>
