<?php 

include("../includes/config.php");
include("../includes/generate_captcha.php");

$phptextObj         = new generate_captchaClass();
$generate_captcha   = $phptextObj->generate_captcha('','#fff',120,40,10,25);

//echo '<pre>'; print_r(json_encode($generate_captcha)); echo '</pre>';
echo json_encode($generate_captcha);


?>