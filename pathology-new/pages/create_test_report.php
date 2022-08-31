<?php
	include("includes/config.php");
	
	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == ''))
	{
	    header("Location:".$site_url."login");
	}
	
	$test_category_list_sql	= "select * from test_categories order by test_category asc";
	$count_rs1			= mysqli_query($link, $test_category_list_sql);
	$types_category_arr		= mysqli_fetch_all($count_rs1, MYSQLI_ASSOC);
	
	$a	= '';
	for ($i = 0; $i < 5; $i++) 
		$a .= mt_rand(0,9);
			
	$patient_id		= 'P-'.date('Y').$a;
	$cat_details_sql	= mysqli_query($link, "SELECT * FROM tests_type order by category_name asc;");
	$cat_details_arr	= mysqli_fetch_all($cat_details_sql, MYSQLI_ASSOC);
	
	$word_details_sql	= mysqli_query($link, "SELECT * FROM word_details order by word_name asc;");
	$word_details_arr 	= mysqli_fetch_all($word_details_sql, MYSQLI_ASSOC);
	
	$doctor_details_sql	= mysqli_query($link, "SELECT * FROM doctor_list order by name asc;");
	$doctor_details_arr = mysqli_fetch_all($doctor_details_sql, MYSQLI_ASSOC);
	
	$patien_list_sql	= mysqli_query($link, "SELECT * FROM patient_details order by name asc;");
	$patien_list_arr 	= mysqli_fetch_all($patien_list_sql, MYSQLI_ASSOC);
	
	$reg_patient_id	= (isset($_REQUEST['patient_id']) && !empty($_REQUEST['patient_id'])) ? $_REQUEST['patient_id'] : 0;
	$patien_details_sql	= mysqli_query($link, "SELECT * FROM patient_details where id = '".$reg_patient_id."';");
	$patien_details_arr = mysqli_fetch_all($patien_details_sql, MYSQLI_ASSOC);
	
	
	$pathologist_list_sql	= mysqli_query($link, "SELECT * FROM pathologists_list where status = '1';");
	$pathologist_list_arr = mysqli_fetch_all($pathologist_list_sql, MYSQLI_ASSOC);
	
?>
<link rel="stylesheet" href="<?php echo $site_url ?>css/selectstyle.css">
<script src="<?php echo $site_url; ?>js/selectstyle.js"></script>
<script src="<?php echo $site_url; ?>js/materialize.js"></script>

<script>
	//document.addEventListener('DOMContentLoaded', function() {
	//	var elem = document.querySelector('.collapsible.expandable');
	//	var elem2 = document.querySelector('.collapsible.expandable2');
	//	var instance = M.Collapsible.init(elem, {
	//		accordion: false
	//	});
	//	var instance2 = M.Collapsible.init(elem2, {
	//		accordion: false
	//	});
	//});
	var rspond_val;
	$(document).ready(function(){
		$('.collapsible').collapsible();
		$('.patient_search').selectstyle({
			width  : 400,
			height : 300,
			theme  : 'light',
			onchange : function(val){ }
		});
	});

	var cat_pos_ids 	= {};
	var selected_ids	= [];
	
	function testhandleClick(e, val_id, cat_pos) {
			
		//console.log($(e).attr('id')+' '+$(e).attr('name'))
		if ($(e).is(':checked')) {
			selected_ids.push($(e).attr('id'));
			$('#'+val_id).removeAttr('readonly');
			
			if (cat_pos in cat_pos_ids)
				cat_pos_ids[cat_pos]	= cat_pos_ids[cat_pos] + 1;
			else cat_pos_ids[cat_pos]	= 1;
		}
		else{
			selected_ids.splice( $.inArray($(e).attr('id'), selected_ids), 1 );
			$('#'+val_id).attr('readonly', 'readonly');
			$('#'+val_id).removeAttr('style');
			
			if (cat_pos in cat_pos_ids)
				cat_pos_ids[cat_pos]	= (cat_pos_ids[cat_pos] > 0) ? cat_pos_ids[cat_pos] - 1: 0;
			else cat_pos_ids[cat_pos]	= 0;
		}
			
		for (var key in cat_pos_ids) {
			console.log(cat_pos_ids[key])
			
			if (cat_pos_ids[key] > 0)
				(cat_pos_ids[key] > 1) ? $("#"+key+"_cat_sec_det").text(' - ('+cat_pos_ids[key]+' tests selected)') : $("#"+key+"_cat_sec_det").text(' - ('+cat_pos_ids[key]+' test selected)')
			else $("#"+key+"_cat_sec_det").text('')
		}
	}
		
	function check_validate() {
		var error_num		= 0;			
		var element_id 	= $('#final_patient_id').attr('id');
		var element_name 	= $('#final_patient_id').attr('name');
		var element_value 	= $('#final_patient_id').val();
		var selected_ids_len= selected_ids.length;	
			
		//Check the patient id selected	
		if(element_id == 'final_patient_id') {
				
			if (element_value == 0) {
				$('#p_error_message').remove();
				$('#sr_error_div').append('<div id="p_error_message" class="js-validate-error-label" style="color: #B81111">Please select a patient.</div>');
				$('#select_style').attr('style', 'border: 1px solid rgb(184, 17, 17); color: rgb(184, 17, 17);');
				error_num  = error_num + 1;
			}
			else {
				$('#p_error_message').remove();
				$('#select_style').removeAttr('style');
				error_num  = (error_num > 0) ? error_num - 1 : 0;
			}
		}
		//Check if any test is selected
		if (selected_ids_len == 0) {
			$('#t_error_message').html('Please check atleast one test.');
			$('#t_error_message').removeClass('hide');
			error_num  		= error_num + 1;
		} else {
			$('.form-check-input').each(function(key, value) {
					
				var ck_id 	= $(this).attr('id');
				var inp_val_pos= $(this).attr('pos_id');
				var inp_val	= $('#test_value_'+inp_val_pos).val();
				var ed_pos 	= $(this).attr('ed_pos');
				var is_checked	= $('#'+ck_id).is(':checked');
				
				if (is_checked == 1 && inp_val.trim() == '') {
					$('#test_value_'+inp_val_pos).attr('style', 'border: 1px solid rgb(184, 17, 17); color: rgb(184, 17, 17);');
					error_num  	= error_num + 1;
				}
				//else error_num  = (error_num > 0) ? error_num - 1 : 0;
			});
				
			if(error_num > 0) {
				$('#t_error_message').removeClass('hide');
				$('#t_error_message').html('Please enter values for checked tests. '+error_num+' remaining.');
			} else {
				$('#t_error_message').addClass('hide');
				$('#t_error_message').html('Please check atleast one test.');
			}	
		}
			
		if(error_num == 0)	return true;
		else return false;
	}
	
	function patient_ajax_call(args) {
		
		var site_url		= '<?php echo $site_url.'includes/common_functions.php' ?>';
		var p_search_url 	= site_url+'?mode=search_patient&p_id='+args;
		var http 			= new XMLHttpRequest();
		http.open("GET", p_search_url, true);
		http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		http.onreadystatechange 	= function() {
			
			if(http.readyState == 4 && http.status == 200) {
				rspond_val			= JSON.parse(http.responseText);
				var rspond_val_status 	= rspond_val.status;
				
				if (rspond_val_status == 1) {
					//console.log(rspond_val_status);
					$("#register_modal_btn").attr('disabled', 'disabled');
					$("#p_name").text(rspond_val.patient_details.name);
					$("#p_age").text(rspond_val.patient_details.age);
					$("#p_sex").text(rspond_val.patient_details.gender);
					$("#p_word").text(rspond_val.patient_details.word_name);
					$("#p_reg").text(rspond_val.patient_details.registration_no);
					$("#p_under").text(rspond_val.patient_details.doctor_name);
					$("#final_patient_id").val(rspond_val.patient_details.id);
					$("#patient_det_show_div").show();
				} else {
					$("#eror_msg").show();
					$("#p_name").text('');
					$("#p_age").text('');
					$("#p_sex").text('');
					$("#p_word").text('');
					$("#p_reg").text('');
					$("#p_under").text('');
					$("#final_patient_id").val('');
					$("#patient_det_show_div").hide();
					$("#register_modal_btn").removeAttr('disabled');
				}
			} else if(http.readyState == 4 && http.status != 200){
				$("#eror_msg").show();
				$("#p_name").text('');
				$("#p_age").text('');
				$("#p_sex").text('');
				$("#p_word").text('');
				$("#p_reg").text('');
				$("#p_under").text('');
				$("#final_patient_id").val('');
				$("#patient_det_show_div").hide();
				$("#register_modal_btn").removeAttr('disabled');
			}
		}
		http.send();
	}
	
	function show_edit_modal() {
		//console.log(rspond_val);
		
		$("#ed_p_name").text(rspond_val.patient_details.name);
		$("#ed_p_age").text(rspond_val.patient_details.age);
		$("#ed_p_sex").text(rspond_val.patient_details.gender);
		$("#ed_p_word").text(rspond_val.patient_details.word_name);
		$("#ed_p_reg").text(rspond_val.patient_details.registration_no);
	}
	
	function clear_search_selected() {
		
		$("#p_name").text('');
		$("#p_age").text('');
		$("#p_sex").text('');
		$("#p_word").text('');
		$("#p_reg").text('');
		$("#p_under").text('');
		$("#final_patient_id").val('');
		
		$("#patient_details_edited").val('0');
		$("#edited_word_no").val('');
		$("#edited_word_name").val('');
		$("#edited_doctor_id").val('');
		$("#edited_doctor_name").val('');
		
		$("#patient_det_show_div").hide();
		$("#register_modal_btn").removeAttr('disabled');
	}
	
	function update_patient_details() {
		var word_no 		= $("#update_word_no").val();
		var word_no_name 	= $('#update_word_no :selected').text();
		var doc_no 		= $("#update_docotor_name").val();
		var doc_name 		= $("#update_docotor_name :selected").text();
		
		if (word_no == 0) {
			$("#update_word_no").attr('style', 'border: 1px solid rgb(184, 17, 17); color: rgb(184, 17, 17);');
			$("#update_word_no").append('<div id="word_no_error_msg_div" style="color: #B81111">Please select a word.</div>');
		}
		else{
			$("#update_word_no").removeAttr('style');
			$("#word_no_error_msg_div").remove();
		}
		
		if (doc_no == 0) {
			$("#update_docotor_name").attr('style', 'border: 1px solid rgb(184, 17, 17); color: rgb(184, 17, 17);');
			$("#update_docotor_name").append('<div id="word_no_error_msg_div" style="color: #B81111">Please select a doctor.</div>');
		}
		else{
			$("#update_word_no").removeAttr('style');
			$("#word_no_error_msg_div").remove();
		}
		
		if (word_no > 0 && doc_no> 0) {
			
			$("#patient_details_edited").val('1');
			$("#edited_word_no").val(word_no);
			$("#edited_word_name").val(word_no_name);
			$("#edited_doctor_id").val(doc_no);
			$("#edited_doctor_name").val(doc_name);
			
			$("#p_word").text(word_no_name);
			$("#p_under").text(doc_name);
			
			$("#edit_md_close").click();
		}
	}

	
</script>

<!-- Page Header-->
<header class="bg-white shadow-sm px-4 py-3 z-index-20">
	<div class="container-fluid px-0">
		<h2 class="mb-0 p-1">Generate Test Report</h2>
	</div>
</header>
<!-- Breadcrumb-->
<div class="bg-white">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 py-3">
				<li class="breadcrumb-item"><a class="fw-light" href="<?php echo $site_url."dashboard" ?>">Dashboard</a></li>
				<li class="breadcrumb-item"><a class="fw-light" href="<?php echo $site_url."test-reports" ?>">Test Reports</a></li>
				<li class="breadcrumb-item active fw-light" aria-current="page">Enter Report Details</li>
			</ol>
		</nav>
	</div>
</div>
<!-- Forms Section-->
<section class="forms"> 
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg">
				<div class="card">
					<div class="card-header">
						<div class="card-close"></div>
						<h3 class="h4 mb-0">&nbsp;</h3>
					</div>
					<div class="card-body" style="padding-top: 0;">
						<div class="col-lg-4">
							<div class="card">
								<div class="card-body text-center" style="padding: 0;">
									<!-- Register patient Modal-->
									<div class="modal fade text-start" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="myModalLabel">Patient Registration Form</h5>
													<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<form name="patient_register_form" id="patient_register_form" action="<?php echo $site_url."includes/common_functions.php" ?>" method="post" class="patient_register_form form-horizontal">
													<input type="hidden" id="mode" name="mode" value="patient_register" />
													<div class="modal-body">
														<p>&nbsp;</p>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="new_patient_id">Patient Id</label>
															<div class="col-sm-8">
																<input class="form-control" readonly="true" name="new_patient_id" id="new_patient_id" value="<?php echo $patient_id; ?>" type="text" required data-validate-field="patient_id" >
															</div>
														</div>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="serial_no">Registration No</label>
															<div class="col-sm-8">
																<input class="form-control" name="serial_no" id="serial_no" required data-validate-field="serial_no" type="text" >
															</div>
														</div> 
														<div id="new_category" class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="patient_name">Patient's Name</label>
															<div class="col-sm-8">
																<input class="form-control" name="patient_name" id="patient_name" type="text" required data-validate-field="patient_name" >
															</div>
														</div>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="age">Patient's Age</label>
															<div class="col-sm-8">
																<input class="form-control" name="patient_age" id="patient_age" type="text" required required data-validate-field="patient_age" >
															</div>
														</div>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="mobile_no">Mobile No</label>
															<div class="col-sm-8">
																<input class="form-control" name="mobile_no" id="mobile_no" required data-validate-field="mobile_no" type="text" >
															</div>
														</div>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="gender">Patient's Gender</label>
															<div class="col-sm-8">
																<select name="gender" id="gender" required data-validate-field="gender_val" class="form-select" >
																	<option value="">Select Gender</option>
																	<option value="Male">Male</option>
																	<option value="Female">Female</option>
																	<option value="Transgender">Transgender</option>
																	<option value="Other">Other</option>
																</select>
															</div>
														</div>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="word_no">Patient's Word</label>
															<div class="col-sm-8">
																<select name="word_no" id="word_no" class="form-select" required data-validate-field="word_no_val">
																	<option value="">Select Word</option>
																	<?php
																		foreach ($word_details_arr as $word)  
																			echo '<option value="'.$word['id'].'">'.$word['word_name'].'</option>';
																	?>
																</select>
															</div>
														</div>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="docotor_name">Doctor's Name</label>
															<div class="col-sm-8">
																<select name="docotor_name" id="docotor_name" required data-validate-field="docotor_name_val" class="form-select" >
																	<?php
																		foreach ($doctor_details_arr as $doctor)  
																			echo '<option value="'.$doctor['id'].'">'.$doctor['name'].'</option>';
																	?>
																</select>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<input class="btn btn-primary" type="submit" value="Create">
														<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								
									<!-- Edit patient Modal-->
									<div class="modal fade text-start" id="myModal2" tabindex="-1" aria-labelledby="myModalLabel2" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="myModalLabel2">Edit Patient's Information</h5>
													<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<div class="row gy-2 mb-4">
														<label class="col-sm-3 form-label text-right" for="new_patient_id">Patient's Details:</label>
														<div class="col-sm-8">
															<h3 id="ed_p_name" class="fw-normal text-dark mb-0" style="padding-bottom: 10px;"></h3>
															<div class="patient_det"> <span>Age: </span>&nbsp; <span id="ed_p_age" class="text-gray-500"></span> </div>
															<div class="patient_det"><span>Sex: </span>&nbsp; <span id="ed_p_sex" class="text-gray-500"></span></div>
															<br>
															<div class="patient_det"><span>Reg No: </span>&nbsp;<span id="ed_p_reg" class="text-gray-500"></span></div>
														</div>
													</div>
													<div class="row gy-2 mb-4">
														<label class="col-sm-3 form-label text-right" for="word_no">Patient's Word</label>
														<div class="col-sm-8">
															<select name="update_word_no" id="update_word_no" class="form-select" required data-validate-message="Please select word no.">
																<option value="0">Select Word</option>
																<?php
																	foreach ($word_details_arr as $word)  
																		echo '<option value="'.$word['id'].'">'.$word['word_name'].'</option>';
																?>
															</select>
														</div>
													</div>
													<div class="row gy-2 mb-4">
														<label class="col-sm-3 form-label text-right" for="docotor_name">Doctor's Name</label>
														<div class="col-sm-8">
															<select name="update_docotor_name" id="update_docotor_name" required data-validate-message="Please select a doctor." class="form-select" >
																<option value="0">Select Doctor</option>
																<?php
																	foreach ($doctor_details_arr as $doctor)  
																		echo '<option value="'.$doctor['id'].'">'.$doctor['name'].'</option>';
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<input class="btn btn-primary" type="submit" onclick="update_patient_details()" value="Update">
													<button class="btn btn-secondary" type="button" id="edit_md_close"  data-bs-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!---- Search patient area -->
						<div class="row gy-2 mb-4">
							<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">&nbsp;</label>
							<div class="col-sm-6">
								<button <?php echo ($reg_patient_id > 0) ? 'disabled' : '' ?> class="btn btn-primary" id="register_modal_btn" type="button" data-bs-toggle="modal" data-bs-target="#myModal">Register new Patient</button>
								<div style="margin-top: 15px;">OR Select an Existing Patient</div>
							</div>
						</div>
						<div class="row gy-2 mb-4">
							<label class="col-sm-3 form-label" for="search_patient_id"></label>
							<div class="col-sm-6" id="sr_error_div">
								<select name="search_patient_id" id="search_patient_id" class="form-select patient_search" onchange="patient_ajax_call(this.value)" placeholder="Select a Patient" data-search="true">
									<?php
										if(count($patien_list_arr) > 0){
											foreach($patien_list_arr as $patient_list){
												echo '<option value="'.$patient_list['id'].'">'.ucwords(strtolower($patient_list['name'])).'</option>';
											}
										}
									?>
								</select>
							</div>
						</div>
						
						<!---- Search patient area -->
						<!---- Main form start area -->
						<form name="generate_report" id="generate_report" action="<?php echo $site_url."includes/common_functions.php" ?>" onsubmit="return check_validate()" method="post" class="generate_report form-horizontal">
							<input type="hidden" id="mode" name="mode" value="generate_report" />
							<input type="hidden" id="final_patient_id" name="final_patient_id" value="<?php echo $reg_patient_id ?>" />
							<input type="hidden" id="patient_details_edited" name="patient_details_edited" value="0" />
							<input type="hidden" id="edited_word_no" name="edited_word_no" value="" />
							<input type="hidden" id="edited_word_name" name="edited_word_name" value="" />
							<input type="hidden" id="edited_doctor_id" name="edited_doctor_id" value="" />
							<input type="hidden" id="edited_doctor_name" name="edited_doctor_name" value="" />
								
							<div class="row gy-2 mb-4" style="margin-bottom: 0px !important;">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElOne"></label>
								<div class="col-sm-6">
									<h3 id="eror_msg" class="fw-normal text-dark mb-0 hide" style="padding-bottom: 10px; font-size: 15px;">Patient details not found. Please try again.</h3>
								</div>
							</div>
								
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label" for="search_patient_id"></label>
								<div class="col-sm-6" id="sr_error_div">
									<select name="search_pathologist_id" id="search_pathologist" class="form-select patient_search" placeholder="Select an Pathologist" data-search="true">
										<?php
											if(count($pathologist_list_arr) > 0){
												foreach($pathologist_list_arr as $pathologist_list){
													echo '<option value="'.$pathologist_list['id'].'">'.ucwords(strtolower($pathologist_list['name'])).'</option>';
												}
											}
										?>
									</select>
								</div>
							</div>						

							<div class="row gy-2 mb-4" id="patient_det_show_div" style="<?php echo ($reg_patient_id == 0) ? 'display: none;' : '' ?>">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElOne"></label>
								<div class="col-sm-6">
									<div class="card mb-0" style="border: 1px solid #bababa; border-radius: 5px;">
										<div class="card-body p-0">
											<!-- Item-->
											<div class="p-3 d-flex align-items-center">
												<img class="img-fluid rounded-circle p-1 border border-faintGreen flex-shrink-0 hide" src="<?php echo $site_url; ?>img/avatar-1.jpg" alt="..." width="50">
												<div class="ms-3">
													<h3 id="p_name" class="fw-normal text-dark mb-0" style="padding-bottom: 10px;"><?php echo ucwords(strtolower($patien_details_arr[0]['name'])) ?></h3>
													<div class="patient_det"> <span>Age: </span>&nbsp; <span id="p_age" class="text-gray-500"><?php echo ucwords(strtolower($patien_details_arr[0]['age'])) ?></span> </div>
													<div class="patient_det"><span>Sex: </span>&nbsp; <span id="p_sex" class="text-gray-500"><?php echo ucwords(strtolower($patien_details_arr[0]['gender'])) ?></span></div>
													<div class="patient_det"><span>Word No: </span>&nbsp; <span id="p_word" class="text-gray-500"><?php echo ucwords(strtolower($patien_details_arr[0]['word_name'])) ?></span></div>
													<br>
													<div class="patient_det"><span>Reg No: </span>&nbsp;<span id="p_reg" class="text-gray-500"><?php echo ucwords(strtolower($patien_details_arr[0]['registration_no'])) ?></span></div>
													<div class="patient_det"><span>Under: </span>&nbsp;<span id="p_under" class="text-gray-500"><?php echo ucwords(strtolower($patien_details_arr[0]['doctor_name'])) ?></span></div>
												</div>
												<a href="javascript:clear_search_selected()" class="p_clear_btn"><i class="far fa-times-circle"></i></a>
												<button class="btn btn-primary edit_patient" onclick="show_edit_modal()"  type="button" data-bs-toggle="modal" data-bs-target="#myModal2">Edit</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="drop_select_list">
								<div class="row gy-2 mb-4">
									<div class="col-sm-4">
										<div class="card-header" style="box-shadow: none; padding-left: 0;">
											<h3 class="h4 mb-0">
												<span style="border-bottom: 1px solid #bababa; padding: 0 15px; line-height: 2;">Enter Test Report Values :</span>
												<div id="t_error_message" class="js-validate-error-label hide" style="font-weight: 500; padding-left: 15px;">Please check atleast one test.</div>
											</h3>
										</div>
									</div>
								</div>
								<div class="row gy-2 mb-4 drop_select_list">
									<?php
										$test_main_cat_list_sql	= mysqli_query($link, "SELECT main_category FROM `test_categories` group by 1 order by 1 asc;");
										$test_main_cat_list_arr	= mysqli_fetch_all($test_main_cat_list_sql, MYSQLI_ASSOC);
										$total_value			= count($test_main_cat_list_arr);
										$i	= 0;
										$j 	= 0;
										$k 	= 0;
										
										if(!empty($test_main_cat_list_arr)){
											echo '<div class="col-sm-6">
													<ul class="collapsible">';
											foreach($test_main_cat_list_arr as $test_main_cat){
												
												$test_cat_list_sql	= mysqli_query($link, "SELECT id, test_category FROM `test_categories` where main_category = '".$test_main_cat['main_category']."' order by test_category asc;");
												$test_cat_list_arr	= mysqli_fetch_all($test_cat_list_sql, MYSQLI_ASSOC);
												$t_value			= count($test_cat_list_arr);
												$k++;
												
												echo '<li>
														<div class="collapsible-header">
															<i class="fas fa-vial"></i>
															<b>'.ucfirst($test_main_cat['main_category']).' <span id="'.$i.'_cat_sec_det" class="cat_sec_det"></span></b>
														</div>
														<div class="collapsible-body">';
															if(!empty($test_cat_list_arr)) {
																echo '<ul class="show_tree_list" style="max-height: 700px; overflow-y: auto;">';
																foreach($test_cat_list_arr as $test_cat) {
																	$test_list_sql	= mysqli_query($link, "SELECT * FROM `tests_type` where category_id = '".$test_cat['id']."' order by name asc;");
																	$test_list_arr	= mysqli_fetch_all($test_list_sql, MYSQLI_ASSOC);
																	$ty_value		= count($test_list_arr);
																	
										?>				
																		<li>
																			<span class="tree_head"><strong><?php echo ucfirst($test_cat['test_category']) ?></strong></span>
																			<?php
																				if(!empty($test_list_arr)){
																					echo '<ul class="tree_view">';
																					foreach($test_list_arr as $cat) {
																						
																						$normal_range 	= ($cat['normal_range'] != '') ? ucwords(strtolower($cat['normal_range'])) : '';
																						$unit	= ($cat['unit'] != '') ? '('.ucwords(strtolower($cat['unit'])).')' : '';
																						
																						echo '<li>
																								<div class="row" style="margin: 0">
																									<div class="col-sm-4" style="padding-right: 0; padding-top: 5px;">
																										<span style="display: initial"><input class="form-check-input " name="test_checkbox['.$test_cat['id'].']['.$cat['id'].'][]" ed_pos="'.$i.'_error_div" pos_id="'.$test_cat['id'].'_'.$cat['id'].'_'.$j.'" onclick="testhandleClick(this, \'test_value_'.$test_cat['id'].'_'.$cat['id'].'_'.$j.'\', '.$i.');" id="test_checkbox_'.$test_cat['id'].'_'.$cat['id'].'_'.$j.'" value="1" type="checkbox"></span>
																										<span class="test_name_span">'.ucwords(strtolower($cat['name'])).'</span>
																									</div>
																									<div class="col-sm-4" style="padding-right: 0;">
																										<input class="form-control" name="test_value['.$test_cat['id'].']['.$cat['id'].'][]" id="test_value_'.$test_cat['id'].'_'.$cat['id'].'_'.$j.'" id="inputHorizontalElTwo" readonly="true" value="" type="text" data-validate-field="patient_id" >
																									</div>
																									<div class="col-sm-4" style="padding-right: 0; padding-top: 5px;">
																										<span>'.$normal_range.'  '.$unit.'</span>
																									</div>
																								</div>
																							</li>';
																							
																							$j++;
																					}
																					echo '</ul>';
																				}
																				else{
																					echo '<ul class="tree_view">
																							<li><span style="padding-left: 20px">No tests</span></li>
																						</ul>';
																				}
																			?>
																		</li>
										<?php
																}
																echo '</ul>';
															}
															else{
																echo '<ul class="show_tree_list">
																		<li><span class="tree_head"><strong>No Category Found</strong></span></li>
																	</ul>';
															}
													
												echo 	'</div>
													</li>';
												$i++;
												
												if(($total_value > $i) && ($i % 3) == 0)
													echo '</div>
														<div class="col-sm-6">
															<ul class="collapsible expandable_'.$i.'">';
											}
											echo '</ul>
											</div>';
										}
									?>
								</div>
							</div>
							<div class="row gy-2 mb-4 hidden">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Cost</label>
								<div class="col-sm-6">
									<input class="form-control" name="cost" id="cost" type="text" value="0" >
								</div>
							</div>
							<div class="row">
								<div class="col-sm-9 ms-auto">
									<input class="btn btn-primary" type="submit" value="Submit">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>