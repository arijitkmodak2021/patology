<?php
	include("includes/config.php");
	
	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == ''))
	{
	    header("Location:".$site_url."index.php?pages=login");
	}
	
	$test_category_list_sql	= "select * from test_categories order by test_category asc";
	$count_rs1	= mysqli_query($link, $test_category_list_sql);
	$types_category_arr	= mysqli_fetch_all($count_rs1, MYSQLI_ASSOC);
	
	$a	= '';
	for ($i = 0; $i < 5; $i++) 
		$a .= mt_rand(0,9);
			
	$patient_id	= 'P-'.date('Y').$a;
	$cat_details_sql	= mysqli_query($link, "SELECT * FROM tests_type order by category_name asc;");
	$cat_details_arr	= mysqli_fetch_all($cat_details_sql, MYSQLI_ASSOC);
	
	$word_details_sql	= mysqli_query($link, "SELECT * FROM word_details order by word_name asc;");
	$word_details_arr = mysqli_fetch_all($word_details_sql, MYSQLI_ASSOC);
	
	$doctor_details_sql	= mysqli_query($link, "SELECT * FROM doctor_list order by name asc;");
	$doctor_details_arr = mysqli_fetch_all($doctor_details_sql, MYSQLI_ASSOC);
	
	$reg_patient_id	= (isset($_SESSION['patient_id']) && !empty(isset($_SESSION['patient_id']))) ? isset($_SESSION['patient_id']) : 0;
	$patien_details_sql	= mysqli_query($link, "SELECT * FROM doctor_list order by name asc;");
	$patien_details_arr = mysqli_fetch_all($patien_details_sql, MYSQLI_ASSOC);
	
?>

<script src="js/materialize.js"></script>

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
	
	$(document).ready(function(){
		$('.collapsible').collapsible();
	});

	var selected_ids	= []
	function testhandleClick(e, val_id) {
		
		console.log($(e).attr('id')+' '+$(e).attr('name'))
		if ($(e).is(':checked')) {
			selected_ids.push($(e).attr('id'));
			$('#'+val_id).removeAttr('readonly');
		}
		else{
			selected_ids.splice( $.inArray($(e).attr('id'), selected_ids), 1 );
			$('#'+val_id).attr('readonly', 'readonly');
		}
		console.log(selected_ids)
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
				<li class="breadcrumb-item"><a class="fw-light" href="<?php echo $site_url."index.php?pages=dashboard" ?>">Dashboard</a></li>
				<li class="breadcrumb-item"><a class="fw-light" href="<?php echo $site_url."index.php?pages=test_reports" ?>">Test Reports</a></li>
				<li class="breadcrumb-item active fw-light" aria-current="page">Generate</li>
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
									<!-- Modal-->
									<div class="modal fade text-start" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="myModalLabel">Patient Registration Modal</h5>
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
								</div>
							</div>
						</div>
						<form name="generate_report" id="generate_report" action="<?php echo $site_url."includes/common_functions.php" ?>" method="post" class="generate_report form-horizontal">
							<input type="hidden" id="mode" name="mode" value="generate_report" />
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">&nbsp;</label>
								<div class="col-sm-6">
									<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#myModal">Register new Patient</button>
								</div>
							</div>
							<br>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElOne">Patient Id</label>
								<div class="col-sm-6">
									<input class="form-control" name="new_patient_id" id="new_patient_id" id="inputHorizontalElTwo" value="" type="text" data-validate-field="patient_id" >
								</div>
								<div class="col-sm-3">
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#myModal">Search</button>
								</div>
							</div>
							<br>
							<div class="drop_select_list">
								<div class="row gy-2 mb-4">
									<div class="col-sm-4">
										<div class="card-header" style="box-shadow: none; padding-left: 0;">
											<h3 class="h4 mb-0"><span style="border-bottom: 1px solid #bababa; padding: 0 15px; line-height: 2;">Enter Test Report Values :</span></h3>
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
										
										if(!empty($test_main_cat_list_arr)){
											echo '<div class="col-sm-6">
													<ul class="collapsible">';
											foreach($test_main_cat_list_arr as $test_main_cat){
												
												$test_cat_list_sql	= mysqli_query($link, "SELECT id, test_category FROM `test_categories` where main_category = '".$test_main_cat['main_category']."' order by test_category asc;");
												$test_cat_list_arr	= mysqli_fetch_all($test_cat_list_sql, MYSQLI_ASSOC);
												$t_value			= count($test_cat_list_arr);
												
												echo '<li>
														<div class="collapsible-header"><i class="fas fa-vial"></i><b>'.ucfirst($test_main_cat['main_category']).'</b></div>
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
																										<span style="display: initial"><input class="form-check-input " name="test_checkbox['.$test_cat['id'].']['.$cat['id'].'][]" onclick="testhandleClick(this, \'test_value_'.$test_cat['id'].'_'.$cat['id'].'_'.$j.'\');" id="test_checkbox_'.$test_cat['id'].'_'.$cat['id'].'_'.$j.'" value="1" type="checkbox"></span>
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