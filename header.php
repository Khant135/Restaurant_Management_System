<!DOCTYPE html>
<html lang="en">
<head>
	<title>Morning Restaurant</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Miss+Fajardose&display=swap" rel="stylesheet">

	<!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="adminpanel/assets/images/favicon.png">
    <title>Morning Restaurant</title>

	<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/aos.css">

	<link rel="stylesheet" href="css/ionicons.min.css">

	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">


	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">
	
</head>
<body>
	<div class="py-1 bg-black top">
		<div class="container">
			<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
				<div class="col-lg-12 d-block">
					<div class="row d-flex">
						<div class="col-md pr-4 d-flex topper align-items-center">
							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
							<span class="text">0978987564234</span>
						</div>
						<div class="col-md pr-4 d-flex topper align-items-center">
							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
							<span class="text">morningrestaurant@gmail.com</span>
						</div>
						<div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right justify-content-end">
							<p class="mb-0 register-link"><span>Open & Delivery hours:</span> <span>Monday - Sunday</span> <span>8:00AM - 9:00PM</span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.php">Morning Restaurant</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<?php
				if (isset($_SESSION['customerid'])) {
					?>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
						<li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
						<li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
						<!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li> -->
						<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
						<li class="nav-item cta"><a href="reservation.php" class="nav-link">Book a table</a></li>
						<!-- 						<li class="nav-item"><a href="customerlogout.php" class="nav-link">LogOut</a></li> -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="oi oi-person"></span>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="menucart.php">Menu Cart</a>
								<div class="dropdown-divider"></div>
								<?php
								$userid=$_SESSION['customerid'];
								echo "<a class='dropdown-item' href='accountupdate.php?userid=$userid'>Profile Update</a>" 
								?>
								<!-- <a class="dropdown-item" href="accountupdate.php">Profile Update</a> -->
								<div class="dropdown-divider"></div>
								<a class="dropdown-item text-danger" href="customerlogout.php">LogOut</a>
							</div>
						</li>
					</ul>
					<?php
				}
				else if (!isset($_SESSION['customerid'])) {
					?>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
						<li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
						<li class="nav-item"><a href="menu.php" class="nav-link">Menu</a></li>
						<!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li> -->
						<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
						<?php
						if (isset($_SESSION['customerid'])) {
							?>
							<li class="nav-item cta"><a href="reservation.php" class="nav-link">Book a table</a></li>								
							<?php
						}else{
							?>
							<li class="nav-item cta"><a href="customerlogin.php" onclick="loginMessage()" class="nav-link">Book a table</a></li>
							<?php
						}
						?>
						<!-- 						<li class="nav-item cta"><a href="reservation.php" class="nav-link">Book a table</a></li> -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Register | LogIn
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="adminpanel/login.php">Use As Admin</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="customerlogin.php">Use As Customer</a>
							</div>
						</li>
					</ul>					
					<?php
				}
				?>
			</div>
		</div>
	</nav>

<!-- 	<div class="container">
		<div class="row">
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">

					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<a href="reservation.html" class="nav-link">Use as Admin</a>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div> -->
</body>
</html>