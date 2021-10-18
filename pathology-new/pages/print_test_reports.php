<?php
	include("includes/config.php");
	
	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == '')) {
	    header("Location:".$site_url."login");
	}
	elseif (!isset($_REQUEST['report_id']) or ($_REQUEST['report_id'] == '')) {
	    header("Location:".$site_url."test-reports");
	}
	
	$report_id				= (isset($_REQUEST['report_id']) && !empty($_REQUEST['report_id'])) ? $_REQUEST['report_id'] : 0;
	$patien_report_details_sql	= mysqli_query($link, "SELECT * FROM patient_tests where id = '".$report_id."';");
	$patien_report_details_arr 	= mysqli_fetch_all($patien_report_details_sql, MYSQLI_ASSOC);
	$test_main_categories		= explode(', ',$patien_report_details_arr[0]['test_main_categories']);
	//echo '<pre>';print_r($test_main_categories); echo '</pre>';
	
	$patient_id				= $patien_report_details_arr[0]['p_id'];
	$patien_details_sql			= mysqli_query($link, "SELECT * FROM patient_details where id = '".$patient_id."';");
	$patien_details_arr 		= mysqli_fetch_all($patien_details_sql, MYSQLI_ASSOC);
	
	$report_values_sql			= mysqli_query($link, "select * from patient_report where report_id = '".$report_id." order by cat_grp_name asc, main_cat_name asc, test_type_name asc';");
	$report_values_arr			= mysqli_fetch_all($report_values_sql, MYSQLI_ASSOC);
	
	$final_gen_report 			= [];
	$each_cat_gen_report		= [];
	$i3 						= 0;
	$i4						= 0;
	
	for ($i2 = 0; $i2 < count($report_values_arr); $i2++) {
		
		if($final_gen_report[$i3]['cat_grp_name'] == $report_values_arr[$i2]['cat_grp_name']) {
			
			if($final_gen_report[$i3]['test_values'][$i4]['main_cat_name'] 	== $report_values_arr[$i2]['main_cat_name']){
				$final_gen_report[$i3]['test_values'][$i4]['values'][]		= $report_values_arr[$i2];
			}
			else{
				$i4++;
				$final_gen_report[$i3]['test_values'][$i4]['main_cat_name']	= $report_values_arr[$i2]['main_cat_name'];
				$final_gen_report[$i3]['test_values'][$i4]['values'][]		= $report_values_arr[$i2];
			}
			
		}
		else {
			$i3++;
			$final_gen_report[$i3]['cat_grp_name']					= $report_values_arr[$i2]['cat_grp_name'];
			$final_gen_report[$i3]['test_values'][$i4]['main_cat_name']	= $report_values_arr[$i2]['main_cat_name'];
			$final_gen_report[$i3]['test_values'][$i4]['values'][]		= $report_values_arr[$i2];
			
		}
	}
	
?>	

<!-- Page Header-->
<header class="print_page_head bg-white shadow-sm px-4 py-3 z-index-20">
	<div class="container-fluid px-0">
		<h2 class="mb-0 p-1" style="display: inline-block;">
			<small>Patient: </small><?php echo ucwords(strtolower($patien_details_arr[0]['name'])) ?>
			<small>(Test Report On: <?php echo date("F j, Y, g:i a", strtotime($patien_report_details_arr[0]['create_date'])) ?>)</small>
		</h2>
			
		<div class="print_btn" style="text-align: center;">
			<button class="btn btn-primary edit_patient" onclick="printDiv('print_area')" type="button">Print</button>
		</div>
	</div>
</header>

<?php

	foreach($final_gen_report as $final_report) {
		
		//echo '<pre>'; print_r($final_report); echo '</pre>';
		$cat_grp_name 	= $final_report['cat_grp_name'];
		
		if($cat_grp_name == 'Urine Test') 		$show_title = 'Clinical Pathology';
		else if ($cat_grp_name == 'Stool Test')	$show_title = 'Clinical Pathology';
		else $show_title = 'Blood Examination Report';
?>

<section class="print_forms pagebreak">   
	<div class="container-fluid report_gen">
		<div class="row gy-4">
			<div class="col-lg-12">
				<div class="card mb-0">
					<div class="print_content" >
						<div class="logo-image-outer no-border">
							<center><div class="col-sm-2 no-float"><img class="logo-image" src="<?php echo $site_url ?>images/Emblem_of_West_Bengal.png" alt="Emblem_of_West_Bengal" /></div></center>
						</div>
						<div class="margin-bottom-5"></div>
						<div class="no-border"><center><h2><b>Govt. of West Bengal</b></h2></center></div>
						<div class="no-border"><center><h2><b class="text-upper font-big">Kalna Sub Divisional & Super Speciality Hospital</b></h2></center></div>
						<div class="no-border"><center><h2 class="text-upper font-medium"><b>Clinical Pathology</b></h2></center></div>
						<div class="no-border"><center><h2 class="text-upper font-medium"><b>Kalna &nbsp;&nbsp;&nbsp;<i class="fas fa-arrows-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp; Purba Bardhaman</b></h2></center></div>
						<div class="no-border"><center><span class="text-upper font-medium exm_report"><b><?php echo $show_title ?></b></span></center></div>
						
						<div class="test_content">
							<div class="patient_det_sec">
								<div class="row">
									<div class="col-sm-6 no-right-padding">
										<div class="tag_div">Name</div>
										<div class="value_div border-under p_w_85"><?php echo ucwords(strtolower($patien_details_arr[0]['name'])) ?></div>
									</div>
									<div class="col-sm-2 no-padding">
										<div class="tag_div">Age</div>
										<div class="value_div border-under p_w_75"><?php echo ucwords(strtolower($patien_details_arr[0]['age'])) ?></div>
									</div>
									<div class="col-sm-2 no-padding">
										<div class="tag_div">Sex</div>
										<div class="value_div border-under p_w_75"><?php echo ucwords(strtolower($patien_details_arr[0]['gender'])) ?></div>
									</div>
									<div class="col-sm-2 no-left-padding">
										<div class="tag_div">Word</div>
										<div class="value_div border-under p_w_65"><?php echo ucwords(strtolower(str_replace('Word No ', '', $patien_report_details_arr[0]['word_no']))) ?></div>
									</div>
								</div>
								<p></p>
								<div class="row">
									<div class="col-sm-5 no-right-padding">
										<div class="tag_div">Reg No</div>
										<div class="value_div border-under p_w_80"><?php echo ucwords(strtolower($patien_details_arr[0]['registration_no'])) ?></div>
									</div>
									<div class="col-sm-7 no-left-padding">
										<div class="tag_div">Under</div>
										<div class="value_div border-under p_w_80"><?php echo ucwords(strtolower($patien_report_details_arr[0]['doctor_name'])) ?></div>
									</div>
								</div>
							</div>
							
							<div class="patient_rpt_sec">
								<?php
									$do_split 	= (count($final_report['test_values']) > 3) ? 1 : 0;
									$in_style 	= ($do_split == 1) ? '': 'padding : 0;';
									$in_class 	= ($do_split == 1) ? 'split col-sm-6': 'col-sm-12';
									$i = 0; 	
										
									echo '<div class="row" style="margin: 0">';
									
										foreach($final_report['test_values'] as $each_report_value) {
												
											$main_cat_name	= $each_report_value['main_cat_name'];
												
											$j = 0;
											echo '<div class="'.$in_class.'" style="'.$in_style.'">';
											
												foreach($each_report_value['values'] as $report_value) {
													
													$test_name	= $report_value['test_type_name'];
													$normal_range 	= ($report_value['normal_range'] != '') ? ucwords(strtolower($report_value['normal_range'])) : '';
													$unit		= ($report_value['test_type_unit'] != '') ? '('.ucwords(strtolower($report_value['test_type_unit'])).')' : '';
														
													if($j == 0)
														echo '<p style="margin: 15px 0 0; min-height: 10px;"><b>'.ucwords(strtolower($main_cat_name)).':-</b></p>';
													
													echo '<div class="each_print_div">
															<div class="child item font-small-14">'.ucwords(strtolower($test_name)).'&nbsp;</div>
															<div class="child item item_mid ">'.ucwords(strtolower($report_value['result_value'])).'</div>
															<div class="child item normal_range font-small-13">'.$normal_range.' '.$unit.'</div>
															<div style="clear: both"></div>
														</div>';
														
													$j++;
											}
											
											echo '</div>';
											
											$i++;
											
											if($i %2 == 0)
												echo '</div><div class="row">';
										}
										
									echo '</div>';
								?>
							</div>
						</div>
						<br>
						<br>
						<br>
						<div class="row signature_area">
							<div class="col-sm-1"> &nbsp; </div>
							<div class="col-sm-10" style="text-align: center;">
								<div class="row">
									<div class="col-sm-6">
										<span>Signature of <br>Medical Technologist (Lab)</span>
									</div>
									<div class="col-sm-6">
										<span>Signature of <br>Medical Officer/Pathologist</span>
									</div>
								</div>
							</div>
							<div class="col-sm-1"> &nbsp; </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>