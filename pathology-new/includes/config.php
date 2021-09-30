<?php

error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 'On');
ob_start();
@session_start();

$connect_string = 'localhost';
$connect_username = 'root';
$connect_password = '';
$connect_db = 'pathology';

$link 	= mysqli_connect($connect_string,$connect_username,$connect_password,$connect_db);

// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$site_url 	= 'http://localhost/git_projects/patology/pathology-new/';
$user_path 	= $site_url;
define("DS", "/");
$physical_path = $_SERVER['DOCUMENT_ROOT'].DS.'git_projects/patology/pathology-new'.DS;

define("RECORDPERPAGE", 20);
define("PHYSICAL_PATH", $physical_path);
define("SITE_URL", $site_url);

?>