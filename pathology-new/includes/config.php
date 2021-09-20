<?php

error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 'On');
ob_start();
@session_start();

$connect_string = 'localhost';
$connect_username = 'root';
$connect_password = '';
$connect_db = 'pathology';

// $link = mysql_connect($connect_string,$connect_username,$connect_password) or die(mysql_error());
// mysql_select_db($connect_db, $link) or die(mysql_error());

$link 	= mysqli_connect($connect_string,$connect_username,$connect_password,$connect_db);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


// $sql_query = "SELECT * FROM ".$prefix." site_settings";
// $mysql_query = mysql_query($sql_query) or die(mysql_error());
// $settings_rs =array();
// while($settings_rs2 = mysql_fetch_array($mysql_query))
// {
// 	$settings_rs[$settings_rs2['field_name']] = $settings_rs2['field_value'];
// }

// $prefix = "";
// $copyright = "Copyright &#169; ".date('Y')." ".$settings_rs['site_name'].". All Rights Reserved.";

// $url=$_SERVER['REQUEST_URI'];
// $site_name = $settings_rs['site_name'];
$site_url = 'http://localhost/git_projects/patology/pathology-new/';
// $admin_email = $settings_rs['admin_email'];
// $footer_text = $settings_rs['footer_text'];
// $copyright = $settings_rs['copyright'];
// $phone = $settings_rs['admin_number'];
// $fax = $settings_rs['fax'];
// $address = $settings_rs['address'];
// $smtp_mail = $settings_rs['smtp_mail'];
// $smtp_password = $settings_rs['smtp_password'];
// $today = date('Y-m-d');
// $ip = $_SERVER['REMOTE_ADDR'];

$user_path = $site_url;
// $admin_path = $site_url."/admin/";

// $mandatory = "<font color=\"#C52A1A\"><strong>* </strong></font>";
// $curyear = date('Y');
// $curmonth = date('F');
define("DS", "/");
$physical_path = $_SERVER['DOCUMENT_ROOT'].DS.'disability_print'.DS;

// if(!isset($_REQUEST['pages']) || $_REQUEST['pages']=='home'){
// 	$isHome = 1;
// }
// else{
// 	$isHome = 0;
// }
// define("MANDATORY", $mandatory);
// define("CURYEAR", $curyear);
// define("CURMONTH", $curmonth);
// define("RECORDPERPAGE", $limit);
// define("USER_RECORDPERPAGE", $user_limit);
define("PHYSICAL_PATH", $physical_path);
define("SITE_URL", $site_url);

// define("FCKEDITORFILE", "../FCKeditor/fckeditor.php");
// define("FCKEDITORBASEPATH", "../FCKeditor/");
// define("ADMIN_SESSION_ID", "ESOLZINTERNALADMINID");
// define("ADMIN_tSESSION_ID", "ESOLZTLADMINID");
// //======================================================================//

// ##################### Defining Tables STARTS ###########################
// define("ADMIN", $prefix."admin");
// define("SETTINGS", $prefix."site_settings");
// define("MENU", $prefix."menu");
// define("USER", $prefix."users");
// define("CATEGORY", $prefix."category");
// define("ARTICLE", $prefix."article");
##################### Defining Tables ENDS ############################
?>