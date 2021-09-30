<?php
    include("includes/config.php");
    include("includes/functions.php");
    
?>


<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Pathology Lab Report </title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="robots" content="all,follow">
		
		<!-- theme stylesheet-->
		<link rel="stylesheet" href="<?php echo $site_url ?>css/style.default.css" id="theme-stylesheet">
		<!-- Custom stylesheet - for your changes-->
		<link rel="stylesheet" href="<?php echo $site_url ?>css/custom.css">
		<link rel="stylesheet" href="<?php echo $site_url ?>css/responsive.css">
		<!-- Favicon-->
		<link rel="shortcut icon" href="<?php echo $site_url ?>img/favicon.ico">
		<!-- Google fonts - Poppins -->
		<link href="https://fonts.googleapis.com/css?family=Acme|Crete+Round|Merriweather+Sans|Poppins:300,400,700&display=swap" rel="stylesheet">
		<script src="<?php echo $site_url ?>js/jquery-1.11.1.min.js"></script>
		<!-- JavaScript files-->
		<script src="<?php echo $site_url ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- Main File-->
		<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	
	</head>

	<body>
		<div class="page">
			<!-- Main Navbar-->
			<header class="header z-index-50">
				<nav class="navbar py-3 px-0 shadow-sm text-white position-relative">
					<div class="container-fluid w-100">
						<div class="navbar-holder d-flex align-items-center justify-content-between w-100">
							<!-- Navbar Header-->
							<div class="navbar-header">
								<!-- Navbar Brand --><a class="navbar-brand d-none d-sm-inline-block" href="<?php echo $site_url; ?>">
								<div class="brand-text d-none d-lg-inline-block"><span><strong>Pathology lab Report</strong></span></div>
								<div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div></a>
							</div>
						</div>
					</div>
				</nav>
			</header>
		</div>
		<!-- Page Header-->
		<header class="bg-white shadow-sm px-4 py-3 z-index-20">
			<div class="container-fluid px-0">
				<h2 class="mb-0 p-1" style="text-align: center">404- Page Not Found</h2>
			</div>
		</header>
		<!-- Breadcrumb-->
		<div class="bg-white">
			<div class="container-fluid">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 py-3">
						<li class="breadcrumb-item">&nbsp;</li>
					</ol>
				</nav>
			</div>
		</div>
		<!-- Forms Section-->
		<section class="forms"> 
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg">
						<div class="card" style="box-shadow: none;">
							<div class="card-header" style="box-shadow: none;">
								<div class="middle_error_message">
									<p class="big_text">OOPS!</p>
									<p class="page_error_msg"><span>404 - THE PAGE CAN'T BE FOUND</span></p>
									<div class="error_go_btn"><button class="btn btn-primary error_btn" type="button"><a href="<?php echo $site_url.'dashboard' ?>" style="color: white">GO TO DASHBOARD</a></button></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>