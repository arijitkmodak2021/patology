<?php
	include("includes/config.php");
	
	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == ''))
	{
	    header("Location:".$site_url."login");
	}
	elseif (!isset($_REQUEST['report_id']) or ($_REQUEST['report_id'] == ''))
	{
	    header("Location:".$site_url."test-reports");
	}
	
	$report_id				= (isset($_REQUEST['report_id']) && !empty($_REQUEST['report_id'])) ? $_REQUEST['report_id'] : 0;
	$patien_report_details_sql	= mysqli_query($link, "SELECT * FROM patient_tests where id = '".$report_id."';");
	$patien_report_details_arr 	= mysqli_fetch_all($patien_report_details_sql, MYSQLI_ASSOC);
	//echo '<pre>';print_r($patien_report_details_arr); echo '</pre>';
	$test_main_categories		= explode(',',$patien_report_details_arr[0]['test_main_categories']);
	
	$patient_id				= $patien_report_details_arr[0]['p_id'];
	$patien_details_sql			= mysqli_query($link, "SELECT * FROM patient_details where id = '".$patient_id."';");
	$patien_details_arr 		= mysqli_fetch_all($patien_details_sql, MYSQLI_ASSOC);
	
	$report_values_sql			= mysqli_query($link, "select * from patient_report where report_id = '".$report_id." order by cat_grp_name asc, main_cat_name asc, test_type_name asc';");
	$report_values_arr			= mysqli_fetch_all($report_values_sql, MYSQLI_ASSOC);
		
	$report_cat_values_sql		= mysqli_query($link, "select main_cat_name from patient_report where report_id = '".$report_id."' group by main_cat_name order by main_cat_name asc;");
	$report_cat_values_arr		= mysqli_fetch_all($report_cat_values_sql, MYSQLI_ASSOC);	
?>

<!-- Forms Section-->
<section class="tables" style="padding-top: 30px;">   
	<div class="container-fluid report_gen">
		<div class="row gy-4">
			<div class="col-lg-12">
				<div class=" mb-0">
					<div class="" >
						<div class="logo-image-outer no-border">
							<center><div class="col-sm-2 no-float"><img class="logo-image" src="<?php echo $site_url ?>images/Emblem_of_West_Bengal.png" alt="Emblem_of_West_Bengal" /></div></center>
						</div>
						<div class="margin-bottom-5"></div>
						<div class="no-border"><center><h2><b>Govt. of West Bengal</b></h2></center></div>
						<div class="no-border"><center><h2><b class="text-upper font-big">Kalna Sub Divisional & Super Speciality Hospital</b></h2></center></div>
						<div class="no-border"><center><h2 class="text-upper font-medium"><b>Clinical Pathology</b></h2></center></div>
						<div class="no-border"><center><h2 class="text-upper font-medium"><b>Kalna &nbsp;&nbsp;&nbsp;<i class="fas fa-arrows-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp; Purba Bardhaman</b></h2></center></div>
						<div class="no-border"><center><span class="text-upper font-medium exm_report"><b>Blood Examination Report</b></span></center></div>
						
						<div class="">
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
							<div class="row patient_rpt_sec" style="margin: 0;">
								<?php
									$sec_type_1	= [];
									$sec_type_2	= [];
									$sec_type_3	= [];
									
									$i = 0; $j = 1;
									//echo count($report_cat_values_arr);
									$do_split 	= (count($report_cat_values_arr) > 3) ? 1 : 0;
									$in_style 	= ($do_split == 1) ? '': 'float: none; margin: 0 auto; padding : 0';
									$in_class 	= ($do_split == 1) ? 'col-sm-6 split': 'col-sm-12';
									$border_right 	= ($do_split == 1) ? 'border-right: 2px solid #bababa;': '';
									$elb_class	= ($do_split == 1) ? 'border_new_under': '';
									
									echo '<div class="'.$in_class.'" style="'.$in_style.'">';
										if($do_split == 1)
											echo '<p style="'.$border_right.' margin: 0; height: 10px;">&nbsp;</p>
												<p style="'.$border_right.' margin: 0; height: 10px;">&nbsp;</p>';
										else
											echo '<p style="'.$border_right.' margin: 0; height: 15px;">&nbsp;</p>';
												
										foreach($report_values_arr as $report_value) {
												
											$cat_grp_name 	= $report_value['cat_grp_name'];
											$main_cat_name	= $report_value['main_cat_name'];
											$test_name	= $report_value['test_type_name'];
												
											$normal_range 	= ($report_value['normal_range'] != '') ? ucwords(strtolower($report_value['normal_range'])) : '';
											$unit		= ($report_value['test_type_unit'] != '') ? '('.ucwords(strtolower($report_value['test_type_unit'])).')' : '';
												
											if($i == 0)
												echo '<p style="'.$border_right.' margin: 0; height: 10px;"><b>'.ucwords(strtolower($main_cat_name)).':-</b></p>';
											else{
												$prev_cat_name	= $report_values_arr[$i - 1]['main_cat_name'];
												if($main_cat_name != $prev_cat_name) {
													$j++;
													if((($j % 3) == 0) && ($do_split == 1))
														echo '</div>
																<div class="'.$in_class.'">
																	<p style="'.$border_right.' margin: 0; height: 10px;">&nbsp;</p>
																	<p style="'.$border_right.' margin: 0; height: 10px;">&nbsp;</p>';
													
													if($do_split == 1)
														echo '<p style="'.$border_right.' margin: 0; height: 10px;">&nbsp;</p>
															<p style="'.$border_right.' margin: 0; height: 10px;"><b>'.ucwords(strtolower($main_cat_name)).':-</b></p>
															<p style="'.$border_right.' margin: 0; height: 10px;">&nbsp;</p>';
													else
														echo '<br>
														<p style="'.$border_right.'margin: 0; height: 10px;"><b>'.ucwords(strtolower($main_cat_name)).':-</b></p>';
												}
											}
												
											echo '<div class=" each_print_div '.$elb_class.'">
													<div class="child item font-small-14">'.ucwords(strtolower($test_name)).' :</div>
													<div class="child item item_mid ">'.ucwords(strtolower($report_value['result_value'])).'</div>
													<div class="child item font-small-13">'.$normal_range.' '.$unit.'</div>
													<div style="clear: both"></div>
												</div>';
												
												
											$i++;
										}
											
									echo '</div>'
								?>
							</div>
						</div>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<div class="row signature_area">
							<div class="col-sm-1"> &nbsp; </div>
							<div class="col-sm-10" style="text-align: center;">
								<div class="row">
									<div class="col-sm-6">
										<br>
										<p>Signature of Medical Technologist (Lab)</p>
									</div>
									<div class="col-sm-6">
										<br>
										<p>Signature of Medical Officer/Pathologist</p>
									</div>
								</div>
							</div>
							<div class="col-sm-1"> &nbsp; </div>
						</div>
						<br>
						<br>
						<div class="print_btn" style="text-align: center;">
							<button class="btn btn-primary edit_patient" onclick="printDiv('print_area')" type="button">Print</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>