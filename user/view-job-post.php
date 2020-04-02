<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Job Portal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="../css/custom.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo logo-bg">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>J</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Job</b> Portal</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="../search.php">Jobs</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">          
           <?php 
          //Get Job Post details From id passed through url.
          $sql = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id]'";
          $result = $conn->query($sql);
          
          //If job post with Url Id exists then show details about the post.
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
             ?>

		  <div class="col-md-9 bg-white padding-2">
            <div class="pull-left">
              <h2><b><i><?php echo $row['jobtitle']; ?></i></b></h2>
            </div>
            <div class="pull-right">
              <button class="btn btn-default btn-lg btn-flat margin-top-20" onclick="window.history.go(-1)"><i class="fa fa-arrow-circle-left"></i> Back</button>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div>
              <p><i class="fa fa-calendar text-green"></i> <?php echo date("d-M-Y", strtotime($row['createdat'])); ?></p>              
            </div>
            <div>
              <p> <?php echo stripcslashes($row['description']); ?></p>
			  <br>
        <hr>
			  <h4>Qualification Required : </h4> <strong><?php echo $row['qualification']; ?> </strong> 
			  <h4>Experience Required : </h4> <strong><?php echo $row['experience']; ?> &nbsp;Years</strong>
			  <h4>Salary Range : </h4> <strong><?php echo $row['minimumsalary']; ?>&nbsp;-&nbsp;<?php echo $row['maximumsalary']; ?></strong>
			  
            
            </div>
			<?php if(isset($_SESSION['id_user'])) { 
              if(isset($_GET['applied']))
              {
              ?>
                <a href="#" class="btn btn-success btn-flat margin-top-50">Already Applied</a>   
              <?php } else { ?> 
              <a href="apply.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-success btn-flat margin-top-50">Apply</a>
			<?php }} else { ?>
			<a href="user-login.php" class="btn btn-primary btn-flat margin-top-50">Login To Apply</a>
			<?php } ?>
			
			
			<?php
			$_SESSION["id_company"] = $row['id_company'];
            }
          }
          ?>   
            
          </div>
		  <?php 
		   $sql1 = "SELECT * FROM company WHERE id_company='$_SESSION[id_company]'";
           $result1 = $conn->query($sql1);
          if($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) 
            {
             ?>
          <div class="col-md-3">
            <div class="thumbnail">
              <img src="../img/browse.jpg" alt="companylogo">
              <div class="caption text-center">
                <h3><?php echo $row['companyname']; ?></h3>
                <p><?php echo $row['companytype']; ?></p>
                <p><a href="#" class="btn btn-primary btn-flat" role="button">More Info</a>
                <hr>
                <div class="row">
               <!--   <div class="col-md-4"><a href=""><i class="fa fa-address-card-o"></i> Apply</a></div>
                  <div class="col-md-4"><a href=""><i class="fa fa-warning"></i> Report</a></div>
                  <div class="col-md-4"><a href=""><i class="fa fa-envelope"></i> Email</a></div> -->
                </div>
              </div>
            </div>
          </div>
		 <?php
            }
          }
          ?> 
        </div>
      </div>
    </section>

    

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
      <strong>Copyright &copy; 2019-2020 Developed By : <a href="#">Ashish Dawani</a>.</strong> All rights
    reserved.
    </div>
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>

</body>
</html>