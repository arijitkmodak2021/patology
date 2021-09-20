<?php
    include("includes/config.php");
    include("includes/functions.php");

    // Turn off error reporting
    error_reporting(0);
    // Report runtime errors
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    // Report all errors
    error_reporting(E_ALL);
    // Same as error_reporting(E_ALL);
    ini_set("error_reporting", E_ALL);
    // Report all errors except E_NOTICE
    error_reporting(E_ALL & ~E_NOTICE);
    
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Pathology Lab Report </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="all,follow">
        <!-- <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.css" >
        <link rel="stylesheet" href="css/style.css" >
        <link rel="stylesheet" href="css/developer.css" > -->
        <!-- <link href="css/fontawesome/all.css" rel="stylesheet"> -->
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="css/custom.css">
        <!-- Favicon-->
        <link rel="shortcut icon" href="img/favicon.ico">
        <!-- Google fonts - Poppins -->
        <link href="https://fonts.googleapis.com/css?family=Acme|Crete+Round|Merriweather+Sans|Poppins:300,400,700&display=swap" rel="stylesheet">
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <!-- <script src="js/bootstrap.min.js"></script>
        <script src="js/moment.js"></script>
        <script src="js/bootstrap-datetimepicker.min.js"></script> -->

        <!-- JavaScript files-->
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- <script src="vendor/chart.js/Chart.min.js"></script> -->
        <script src="vendor/just-validate/js/just-validate.min.js"></script>
        <!-- <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script> -->
        <!-- Main File-->
        <script src="js/front.js"></script>
        <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>

    <?php 
        $bg_class = '';

        if(isset($_REQUEST['pages'])) {
            if($_REQUEST['pages'] == '' || $_REQUEST['pages'] == 'login') $bg_class = 'bg_image';
            if($_REQUEST['pages'] == 'disability_preview') $bg_class = 'full_back_color';
            if($_REQUEST['pages'] == 'disability_preview_act') $bg_class = 'full_back_color';
        }
        else $bg_class = 'bg_image';
    ?>

    <body class="<?php echo $bg_class; ?>">
        <?php
            if(isset($_SESSION['msg']) && ($_SESSION['msg'] != ''))
            {
            ?>
                <!--  start message-green -->
                <div id="message-green" class="card mb-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center" style="justify-content: center;">
                            <div class="icon flex-shrink-0 bg-orange"><i class="fas fa-check-circle"></i></div>
                            <div class="ms-3"><strong class="text-lg d-block lh-1 mb-1"><?php echo $_SESSION['msg']; ?></strong></div>
                        </div>
                    </div>
                </div>
        <?php
                    unset($_SESSION['msg']);
            }
            if(isset($_SESSION['error_msg']) && ($_SESSION['error_msg']))
            {
        ?>
                <!--  start message-red -->
                <div id="message-red" class="card mb-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center" style="justify-content: center;">
                            <div class="icon flex-shrink-0 bg-red"><i class="fas fa-times-circle"></i></div>
                            <div class="ms-3"><strong class="text-lg d-block lh-1 mb-1"><?php echo $_SESSION['error_msg']; ?></strong></div>
                        </div>
                    </div>
                </div>
        <?php
                    unset($_SESSION['error_msg']);
            }
            
            
            if (isset($_SESSION['is_logged_in']) && ($_SESSION['is_logged_in'] == 1)) {
        ?>
                <div class="page">
                    <!-- Main Navbar-->
                    <header class="header z-index-50">
                        <nav class="navbar py-3 px-0 shadow-sm text-white position-relative">
                            <!-- Search Box-->
                            <div class="search-box shadow-sm">
                                <button class="dismiss d-flex align-items-center">
                                    <svg class="svg-icon svg-icon-heavy">
                                    <use xlink:href="#close-1"> </use>
                                    </svg>
                                </button>
                                    <form id="searchForm" action="#" role="search">
                                    <input class="form-control shadow-0" type="text" placeholder="What are you looking for...">
                                </form>
                            </div>
                            <div class="container-fluid w-100">
                                <div class="navbar-holder d-flex align-items-center justify-content-between w-100">
                                    <!-- Navbar Header-->
                                    <div class="navbar-header">
                                      <!-- Navbar Brand --><a class="navbar-brand d-none d-sm-inline-block" href="index.html">
                                        <div class="brand-text d-none d-lg-inline-block"><span><strong>Pathology lab Report</strong></span></div>
                                        <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div></a>
                                      <!-- Toggle Button--><a class="menu-btn active" id="toggle-btn" href="#"><span></span><span></span><span></span></a>
                                    </div>
                                    <!-- Navbar Menu -->
                                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                                      <!-- Search-->
                                      <li class="nav-item d-flex align-items-center"><a id="search" href="#">
                                         <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                                           <use xlink:href="#find-1"> </use>
                                         </svg></a></li>
                                      
                                      <!-- Logout    -->
                                      <li class="nav-item"><a class="nav-link text-white" href="login.html"> <span class="d-none d-sm-inline">Logout</span>
                                         <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                                           <use xlink:href="#security-1"> </use>
                                         </svg></a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </header>
                    <div class="page-content d-flex align-items-stretch"> 
                        <!-- Side Navbar -->
                        <nav class="side-navbar z-index-40">
                            <!-- Sidebar Header-->
                            <div class="sidebar-header d-flex align-items-center py-4 px-3"><img class="avatar shadow-0 img-fluid rounded-circle" src="img/avatar-1.jpg" alt="...">
                              <div class="ms-3 title">
                                <h1 class="h4 mb-2">Mark Stephen</h1>
                                <p class="text-sm text-gray-500 fw-light mb-0 lh-1">Web Designer</p>
                              </div>
                            </div>
                            <!-- Sidebar Navidation Menus--><span class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Menu</span>
                            <ul class="list-unstyled py-4">
                                <li class="sidebar-item <?php echo (isset($_REQUEST['pages']) && ($_REQUEST['pages'] == 'dashboard')) ? 'active' : '' ?>"><a class="sidebar-link" href="<?php echo $site_url."index.php?pages=dashboard" ?>"> 
                                    <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                      <use xlink:href="#real-estate-1"> </use>
                                    </svg>Dashboard </a></li>
                                <li class="sidebar-item <?php echo (isset($_REQUEST['pages']) && ($_REQUEST['pages'] == 'test_types')) ? 'active' : '' ?>"><a class="sidebar-link" href="<?php echo $site_url."index.php?pages=test_types" ?>"> 
                                    <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                      <use xlink:href="#portfolio-grid-1"> </use>
                                    </svg>Test Types </a></li>
                                <li class="sidebar-item <?php echo (isset($_REQUEST['pages']) && ($_REQUEST['pages'] == 'test_reports')) ? 'active' : '' ?>"><a class="sidebar-link" href="<?php echo $site_url."index.php?pages=test_reports" ?>"> 
                                    <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                      <use xlink:href="#sales-up-1"> </use>
                                    </svg>Test Reports </a></li>
                            </ul>
                        </nav>
                        <div class="content-inner w-100">
                            <?php        
                                if(isset($_REQUEST['pages']))
                                    get_pages($_REQUEST['pages']);
                                else get_pages('');
                            ?>
                            <!-- Page Footer-->
                            <footer class="position-absolute bottom-0 bg-darkBlue text-white text-center py-3 w-100 text-xs" id="footer">
                                <div class="container-fluid">
                                    <div class="row gy-2">
                                        <div class=" text-sm-start">
                                            <p class="mb-0"><strong>Kalna Super Specility Hospital</strong> - Pathology Department  &nbsp;&nbsp;&nbsp;&nbsp; &copy;<?php echo date('Y')-1; ?> - <?php echo date('Y'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
        <?php
            }
            else{
                if(isset($_REQUEST['pages']))
                    get_pages($_REQUEST['pages']);
                else get_pages('');
            }
        ?>
        <script>
            // ------------------------------------------------------- //
            //   Inject SVG Sprite - 
            //   see more here 
            //   https://css-tricks.com/ajaxing-svg-sprite/
            // ------------------------------------------------------ //
            function injectSvgSprite(path) {
            
                var ajax = new XMLHttpRequest();
                ajax.open("GET", path, true);
                ajax.send();
                ajax.onload = function(e) {
                var div = document.createElement("div");
                div.className = 'd-none';
                div.innerHTML = ajax.responseText;
                document.body.insertBefore(div, document.body.childNodes[0]);
                }
            }
            // this is set to BootstrapTemple website as you cannot 
            // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
            // while using file:// protocol
            // pls don't forget to change to your domain :)
            injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
            
            
        </script>
    </body>
</html>