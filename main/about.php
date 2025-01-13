<html>
<head>
    <meta charset="UTF-8">
    <title>Barangay Management Information System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="../js/morris/morris-0.4.3.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <html>
<head>
    <meta charset="UTF-8">
    <title>Barangay Management Information System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="../js/morris/morris-0.4.3.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../css/select2.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.12.3.js" type="text/javascript"></script>

    <style>
        /* Facebook icon smaller size and circle shape */
        .btn-facebook {
            background-color: #3b5998;
            border-radius: 50%;
            padding: 10px;
            font-size: 30px;  /* Smaller font size */
            color: white;
            text-decoration: none;
            width: 60px; /* Set fixed width */
            height: 60px; /* Set fixed height */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-facebook:hover {
            background-color: #2d4373;
        }

        .facebook-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
            text-align: center;
        }

        .facebook-text {
            display: block;
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse" style="border-radius:0px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img alt="Brand" src="../img/logo.png" style="width:50px; margin-top:-15px; "></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="../login.php">Admin</a></li>
        <li><a href="../pages/resident/login.php">Front Desk</a></li>
        <li><a href="../pages/zone/login.php">Permit Admin</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="wrapper row-offcanvas row-offcanvas-left">

  <div class="breadcrumb">
      <h3>About Us</h3>
  </div>

  <!-- Mission and Vision Container -->
  <div class="container">
      <div class="row">
          <div class="col-md-6">
              <h4><strong>Our Mission</strong></h4>
              <p>To serve the community with integrity, dedication, and transparency, ensuring the well-being of all residents through efficient governance and sustainable development programs.</p>
          </div>
          <div class="col-md-6">
              <h4><strong>Our Vision</strong></h4>
              <p>A progressive, inclusive, and resilient barangay that promotes a safe, healthy, and vibrant community where everyone has equal opportunities to thrive.</p>
          </div>
      </div>
  </div>
  <!-- End of Mission and Vision Container -->

  <!-- Facebook Icon Container -->
  <!-- <div class="facebook-container">
      <a href="https://www.facebook.com/groups/393397299829535" target="_blank" class="btn-facebook">
          <i class="fa fa-facebook"></i>
      </a>
      <span class="facebook-text">Join Us Here</span>
  </div> -->
  <!-- End of Facebook Icon Container -->

</div>

</body>

<script src="../js/alert.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>

<script src="../js/morris/raphael-2.1.0.min.js" type="text/javascript"></script>
<script src="../js/morris/morris.js" type="text/javascript"></script>
<script src="../js/select2.full.js" type="text/javascript"></script>

<script src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="../js/buttons.print.min.js" type="text/javascript"></script>

<script src="../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="../js/AdminLTE/app.js" type="text/javascript"></script>

<script type="text/javascript">
  $(function() {
      $("#table").dataTable({
         "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
      });
  });
</script>
</html>
    <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../css/select2.css" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.12.3.js" type="text/javascript"></script>

    <style>
        /* Facebook icon smaller size and circle shape */
        .btn-facebook {
            background-color: #3b5998;
            border-radius: 50%;
            padding: 10px;
            font-size: 30px;  /* Smaller font size */
            color: white;
            text-decoration: none;
            width: 60px; /* Set fixed width */
            height: 60px; /* Set fixed height */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-facebook:hover {
            background-color: #2d4373;
        }

        .facebook-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
            text-align: center;
        }

        .facebook-text {
            display: block;
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse" style="border-radius:0px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img alt="Brand" src="../img/logo.png" style="width:50px; margin-top:-15px; "></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="../login.php">Admin</a></li>
        <li><a href="../pages/resident/login.php">Front Desk</a></li>
        <li><a href="../pages/zone/login.php">Staff</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="wrapper row-offcanvas row-offcanvas-left">

  <div class="breadcrumb">
      <h3>About Us</h3>
  </div>

  <!-- Mission and Vision Container -->
  <div class="container">
      <div class="row">
          <div class="col-md-6">
              <h4><strong>Our Mission</strong></h4>
              <p>To serve the community with integrity, dedication, and transparency, ensuring the well-being of all residents through efficient governance and sustainable development programs.</p>
          </div>
          <div class="col-md-6">
              <h4><strong>Our Vision</strong></h4>
              <p>A progressive, inclusive, and resilient barangay that promotes a safe, healthy, and vibrant community where everyone has equal opportunities to thrive.</p>
          </div>
      </div>
  </div>
  <!-- End of Mission and Vision Container -->

  <!-- Facebook Icon Container -->
  <div class="facebook-container">
      <a href="https://www.facebook.com/groups/393397299829535" target="_blank" class="btn-facebook">
          <i class="fa fa-facebook"></i>
      </a>
      <span class="facebook-text">Join Us Here</span>
  </div>
  <!-- End of Facebook Icon Container -->

</div>

</body>

<script src="../js/alert.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>

<script src="../js/morris/raphael-2.1.0.min.js" type="text/javascript"></script>
<script src="../js/morris/morris.js" type="text/javascript"></script>
<script src="../js/select2.full.js" type="text/javascript"></script>

<script src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="../js/buttons.print.min.js" type="text/javascript"></script>

<script src="../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="../js/AdminLTE/app.js" type="text/javascript"></script>

<script type="text/javascript">
  $(function() {
      $("#table").dataTable({
         "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,5 ] } ],"aaSorting": []
      });
  });
</script>
</html>
