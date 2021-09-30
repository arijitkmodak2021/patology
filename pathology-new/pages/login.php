<?php
    include("includes/config.php");
    
    if (isset($_SESSION['is_logged_in']) && ($_SESSION['is_logged_in'] == 1)) {
        header("Location:".$site_url."dashboard");
    }
    
    //include(PHYSICAL_PATH."includes/generate_captcha.php");

    // $phptextObj         = new generate_captchaClass();
    // $generate_captcha   = $phptextObj->generate_captcha('','#fff',120,40,10,25);
    // $captcha_status     = (isset($generate_captcha['status'])) ? $generate_captcha['status'] : 0;
    // $c_image_path       = (isset($generate_captcha['image'])) ? $generate_captcha['image'] : '';
    // $c_val              = (isset($generate_captcha['captcha_val'])) ? $generate_captcha['captcha_val'] : '';
    
?>

<script>

    function change_login_form(type_val, div_id){
        if(type_val == 'opt'){
            $('#username_level').text('Operator username');
            $('#password_level').text('Operator password');
            $('#login_type').val('operator');
            $("#opt_log").attr('class', 'selected');
            $("#adm_log").attr('class', '');
            $('#login-username').val('');
            $('#login-password').val('');
        }
        else if(type_val == 'adm'){
            $('#username_level').text('Admin username');
            $('#password_level').text('Admin password');
            $('#login_type').val('admin');
            $("#opt_log").attr('class', '');
            $("#adm_log").attr('class', 'selected');
            $('#login-username').val('');
            $('#login-password').val('');
        }
    }
    
</script>
<div class="login-page">
	<div class="container d-flex align-items-center position-relative py-5">
		<div class="card shadow-sm w-100 rounded overflow-hidden bg-none">
			<div class="card-body p-0">
				<div class="row gx-0 align-items-stretch">
					<!-- Logo & Information Panel-->
					<div class="col-lg-6">
						<div class="info d-flex justify-content-center flex-column p-4 h-100">
							<div class="py-5">
								<h1 class="display-6 fw-bold text-center" style="font-size: 150px;"><i class="fas fa-microscope"></i></h1>
								</br>
								<p class="fw-light mb-0 text-center" style="font-size: 30px; ">Pathology Reporting Tool</p>
							</div>
						</div>
					</div>
					<!-- Form Panel    -->
					<div class="col-lg-6 bg-white">
						<div class="d-flex align-items-center px-4 px-lg-5 h-100">
							<form id="login_form" name="login_form" class="login-form py-5 w-100" action="includes/common_functions.php" method="POST">
								<input type="hidden" name="mode" id="mode" value="user_login" />
								<input type="hidden" name="login_type" id="login_type" value="opt" />
								<div class="heading text-center">
								    <a class="selected" id="opt_log" href="javascript:change_login_form('opt', 'opt_log')"><p>Operator Login</p></a> 
								    <span class="divider"></span>
								    <a id="adm_log" href="javascript:change_login_form('adm', 'adm_log')"><p>Admin Login</p></a>
								</div>
								<br>
								<div class="input-material-group mb-3">
									<input class="input-material" id="login-username" auto-complete="off" type="text" name="loginUsername" value="<?php echo (isset($_COOKIE['loginUsername'])) ? $_COOKIE['loginUsername'] : ''; ?>" autocomplete="off" required data-validate-field="loginUsername">
									<label class="label-material" id="username_level" for="login-username">Operator username</label>
								</div>
								<div class="input-material-group mb-4">
									<input class="input-material" id="login-password" type="password" auto-complete="off" name="loginPassword" value="<?php echo (isset($_COOKIE['loginPassword'])) ? $_COOKIE['loginPassword'] : ''; ?>" required data-validate-field="loginPassword">
									<label class="label-material" id="password_level" for="login-password">Operator password</label>
								</div>
								<button class="btn btn-primary mb-3" id="login" type="submit">Login</button>
								<div class="form-check">
									<input class="form-check-input" <?php echo (isset($_COOKIE['remember_chck'])) ? 'checked' : ''; ?> name="remember_chck" value="1" id="defaultCheck0" type="checkbox">
									<label class="form-check-label" for="defaultCheck0" style="color: #6c757d;">Remember Me</label>
							    </div>
							    <br><a class="text-sm text-paleBlue" href="javascript:void(0)">Forgot Password?</a><br>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
