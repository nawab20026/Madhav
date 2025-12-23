<?php
include "config.php";
session_start();

if (isset($_SESSION['username'])) {
    $mobile = $_SESSION['username'];
    $user = "SELECT * FROM users WHERE mobile = '$mobile'";
    $uu = mysqli_query($conn, $user);
    $userdata = mysqli_fetch_array($uu);
?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Your Website Name</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="assets/img/hdfc.png" type="image/*" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<script src="assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript">if(window.history.replaceState){window.history.replaceState(null,null,window.location.href);}</script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: "Your Otp Has Been Sent!!",
            text: "Please Click Ok Button!!",
            confirmButtonText: "Ok",
            icon: "error"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "index";
            }
        });
    </script>
     <script type="text/javascript">
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

  

<style>
body {
  line-height: 1.2;
}

a{
	text-decoration: none !important;
}	

.hand { 
	cursor: pointer; 
}

.table-sm td, .table th {
    font-size: 0.98458em;
    border-color: #ebedf2 !important;
    padding: 0.4375rem !important;
}

.bg-brown {
  background: brown !important;	
}

.d-none {
    display: none;
}

.m-primary {
 background:#285d29 !important;
 color: white !important;
}

[type="checkbox"]:not(:checked), [type="checkbox"]:checked {
    position: unset !important;
    left: unset !important;
}


.form-check {
    display: block;
    min-height: 1.3125rem;
    padding-left: 1.8em;
    margin-bottom: 0.125rem;
}

.form-check .form-check-input {
    float: left;
    margin-left: -1.8em;
}

.form-check-input {
    width: 1em;
    height: 1em;
    margin-top: 0.1em;
    vertical-align: top;
    background-color: #fff;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    border: 1px solid rgba(0, 0, 0, 0.25);
    appearance: none;
    color-adjust: exact;
}

.form-check-input[type=checkbox] {
    border-radius: 0.15em;
}

.form-check-input[type=radio] {
    border-radius: 50%;
}

.form-check-input:active {
    filter: brightness(90%);
}

.form-check-input:focus {
    border-color: #cbd1db;
    outline: 0;
    box-shadow: none;
}

.form-check-input:checked {
    background-color: #42bb37;
    border-color: #42bb37;
}

.form-check-input:checked[type=checkbox] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
}

.form-check-input:checked[type=radio] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23fff'/%3e%3c/svg%3e");
}

.form-check-input[type=checkbox]:indeterminate {
    background-color: #42bb37;
    border-color: #42bb37;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10h8'/%3e%3c/svg%3e");
}

.form-check-input:disabled {
    pointer-events: none;
    filter: none;
    opacity: 0.5;
}

.form-check-input[disabled] ~ .form-check-label, .form-check-input:disabled ~ .form-check-label {
    opacity: 0.5;
}

.form-switch {
    padding-left: 2.5em;
}

.form-switch .form-check-input {
    width: 2em;
    margin-left: -2.5em;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
    background-position: left center;
    border-radius: 2em;
    transition: background-position 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .form-switch .form-check-input {
        transition: none;
    }
}

.form-switch .form-check-input:focus {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23cbd1db'/%3e%3c/svg%3e");
}

.form-switch .form-check-input:checked {
    background-position: right center;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
}

.form-check-inline {
    display: inline-block;
    margin-right: 1rem;
}

.btn-check {
    position: absolute;
    clip: rect(0, 0, 0, 0);
    pointer-events: none;
}

.btn-check[disabled] + .btn, .wizard > .actions .btn-check[disabled] + a, div.tox .btn-check[disabled] + .tox-button, .swal2-popup .swal2-actions .btn-check[disabled] + button, .fc .btn-check[disabled] + .fc-button-primary, .btn-check:disabled + .btn, .wizard > .actions .btn-check:disabled + a, div.tox .btn-check:disabled + .tox-button, .swal2-popup .swal2-actions .btn-check:disabled + button, .fc .btn-check:disabled + .fc-button-primary {
    pointer-events: none;
    filter: none;
    opacity: 0.65;
}

.card .card-category {
    font-size: 14px;
    font-weight: 600;
}
.card {
    border-radius: 5px !important;
}

.card .card-title {
    font-size: 15px;
    font-weight: 400;
    line-height: 1.6;
}

.Success {
    color: #ffffff;
    background-color: #59d05d;
}

.Failed {
    color: #ffffff;
    background-color: #ff646d;
}

.Pending {
    color: #ffffff;
    background: #fbad4c;
}
</style>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="dashboard" class="logo">
					<!--?=$site_data['brand']?-->
					<img src="assets/img/hdfc.png" height="31" alt="logo" />
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					
					<form class="navbar-left navbar-form nav-search mr-md-3" action="">
						<div class="input-group">
							<input type="text" id="utr_number" placeholder="Search By UTR Number" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text hand" onclick="utr_search($('#utr_number').val())">
									<i class="la la-search search-icon"></i>
								</span>
							</div>
						</div>
					</form>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> 
								<img src="assets/img/k2.png" alt="user-img" width="36" class="img-circle">
								<span><?php echo $userdata['name']; ?></span></span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="assets/img/k2.png" alt="user"></div>
										<div class="u-text">
											<h4><?php echo $userdata['name']; ?></h4>
											<p class="text-muted"><?php echo $userdata['email']; ?></p><a href="profile" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
										</div>
									</li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="profile"><i class="ti-user"></i> My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="changepassword"><i class="ti-settings"></i> Change Password</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="logout"><i class="fa fa-power-off"></i> Logout</a>
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="photo">
							<img src="assets/img/k2.png">
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
                                <?php echo $userdata['name']; ?>			<span class="user-level"><?php echo $userdata['role']; ?></span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<ul class="nav">
									<li>
										<a href="profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="changepassword">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item active">
														<a href="dashboard">
								<i class="la la-dashboard"></i>
								<p>Dashboard</p>
							</a>
						    						</li>
						    						
			<?php
			if($userdata['role'] == 'Admin'){
			    ?>
			    		<li class="nav-item">
							<a href="adduser.php">
								<i class="la la-user-plus"></i>
								<p>Add User</p>
								<span class="badge badge-success">User</span>
							</a>
						</li>
								<li class="nav-item">
							<a href="userlist.php">
								<i class="la la-user"></i>
								<p>Manage User</p>
								<span class="badge badge-success">User</span>
							</a>
						</li>
			    <?php
			}
			?>			    						
						    						
						    						
						<li class="nav-item">
							<a href="upisettings.php">
								<i class="la la-bank"></i>
								<p>UPI Settings</p>
								<span class="badge badge-success">Merchant</span>
							</a>
						</li>
						
				
						
						<li class="nav-item">
							<a href="transactions">
								<i class="la la-shekel"></i>
								<p>Transactions</p>
								<span class="badge badge-danger">Merchant</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="subscription">
								<i class="la la-shopping-cart"></i>
								<p>Subscription</p>
								<span class="badge badge-info">Buy Plan</span>
							</a>
						</li>
												<li class="nav-item">
							<a href="developers">
								<i class="la la-code"></i>
								<p>Developers</p>
								<span class="badge badge-default bg-warning">Api Docs</span>
							</a>
						</li>
						
						<li class="nav-item">
							<a href="plugin">
								<i class="la la-code"></i>
								<p>Plugin</p>
								<span class="badge badge-default bg-brown">Plugin</span>
							</a>
						</li>

						<li class="nav-item update-pro">
							<button class="bg-dark"  onclick="location='logout'">
								<i class="la la-sign-out"></i>
								<p >Log Out</p>
							</button>
						</li>
					</ul>
				</div>
			</div>
          <?php
} else {

   header("location:index");
}
?>