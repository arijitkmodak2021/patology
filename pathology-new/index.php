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
            
            if(isset($_REQUEST['pages']))
                get_pages($_REQUEST['pages']);
            else get_pages('');
        ?>
    </body>
</html>