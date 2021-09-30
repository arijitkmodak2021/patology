<?php
	include("includes/config.php");

	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == ''))
	{
	    header("Location:".$site_url."login");
	}
	
	$patient_name				= (isset($_REQUEST['patient_name'])) ? $_REQUEST['patient_name'] : '';
	$cat_search				= (isset($_REQUEST['test_cat_name'])) ? $_REQUEST['test_cat_name'] : '';
	$cat_search				= ucwords(strtolower(str_replace('-', ' ', $cat_search)));
	$page_no					= (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
	$conditions				= [];
	$conditions_det			= '';
	$limit 					= RECORDPERPAGE; //RECORDPERPAGE
	$offset					= 0;
	
	$conditions[]				= 'p.id = pt.p_id';
	if($patient_name != '')	$conditions[] 	= '(p.name like "%'.$patient_name.'%" OR pt.patient_id like "%'.$patient_name.'%")';
	if($cat_search != '')	$conditions[] 	= 'test_main_categories like "%'.$cat_search.'%"'; 
	if(!empty($conditions))
		$conditions_det		= ' WHERE '.implode(' AND ', $conditions);		
	
	//echo "SELECT count(*) total_count FROM patient_tests as pt, patient_details as p ".$conditions_det.";";
	$total_count_sql			= mysqli_query($link, "SELECT count(*) total_count FROM patient_tests as pt, patient_details as p ".$conditions_det.";");
	$type_count_arr			= mysqli_fetch_all($total_count_sql, MYSQLI_ASSOC);
	$type_count				= $type_count_arr[0]['total_count'];
	$total_page 				= ceil($type_count/$limit);	
		
	if($page_no > 1 )
		$offset				= $limit * ($page_no - 1);
	
	$limit_test 				= ' LIMIT '.$limit;
	$limit_test 				= ($offset > 0) ? $limit_test.' OFFSET '.$offset : $limit_test;
	
	$test_type_list_sql			= "SELECT p.id p_id, p.patient_id, p.name patient_name, p.registration_no, p.gender, p.age, p.mobile_no, p.address, pt.id as report_id, pt.test_main_categories, pt.created_by, pt.doctor_name, pt.word_no, pt.notes, pt.create_date FROM patient_tests as pt, patient_details as p ".$conditions_det." ORDER BY create_date desc, patient_name asc ".$limit_test.";";
	
	$count_rs       			= mysqli_query($link, $test_type_list_sql);
	$test_list_arr				= [];
		
	if(mysqli_num_rows($count_rs) > 0)
	    $test_list_arr  		= mysqli_fetch_all($count_rs, MYSQLI_ASSOC);
	
	$test_category_list_sql  	= "select main_category from test_categories group by main_category order by main_category asc";
	$count_rs1				= mysqli_query($link, $test_category_list_sql);
	$types_category_arr			= mysqli_fetch_all($count_rs1, MYSQLI_ASSOC);
	
?>

<script>
	function change_page(args) {
		if (args > 0) {
			$('#page_no').val(args);
			$('#is_paginate').val(1);
			$('#search_arr').submit();
		}
	}
	
	function generate_submit_form() {
		
		var text_val 		= $('#patient_name').val();
		var text_val_uri	= (text_val != '') ? text_val : '';
		var is_paginate	= $('#is_paginate').val();
		var cat_name 		= $('#test_cat_name').val();
		var cat_name_uri	= (cat_name != '') ? cat_name : '';
		var page_no 		= (is_paginate == 1) ? $('#page_no').val() : 1;
		var url_val		= '';
		url_val			= '<?php echo $site_url; ?>test-reports/'+page_no;
		
		if (text_val != '')
			url_val		= url_val+'/'+text_val_uri;
			
		url_val		= url_val+'/'+cat_name_uri;	
		
		alert(url_val);
		window.location.href = url_val;
		return false
	}
</script>

<!-- Page Header-->
<header class="bg-white shadow-sm px-4 py-3 z-index-20">
	<div class="container-fluid px-0">
		<h2 class="mb-0 p-1">Test Reports</h2>
	</div>
</header>
<!-- Breadcrumb-->
<div class="bg-white">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 py-3">
				<li class="breadcrumb-item"><a class="fw-light" href="<?php echo $site_url."dashboard" ?>">Dashboard</a></li>
				<li class="breadcrumb-item active fw-light" aria-current="page">Test Reports</li>
			</ol>
		</nav>
	</div>
</div>
<section class="tables">   
	<div class="container-fluid">
		<div class="row gy-4">
			<div class="col-lg-12">
				<div class="card mb-0">
					<div class="card-header row" style="margin-left: 0; margin-right: 0;">
						<div class="col-lg-8">
							<button class="btn btn-primary" onclick="location.href = '<?php echo $site_url."generate-test-report"; ?>';" type="submit">Generate Test Report</button>
						</div>
						<div class="col-lg-4">
							<form name="search_arr" id="search_arr" action="<?php echo $site_url."test-reports"; ?>" onsubmit="return generate_submit_form()" method="get" class="row align-items-right">
								<input type="hidden" name="pages" id="pages" value="test_reports" />
								<input type="hidden" name="page_no" id="page_no" value="<?php echo $page_no ?>" />
								<input type="hidden" name="is_paginate" id="is_paginate" value="0" />
								
								<div class="col-lg-5">
									<div class="input-group">
										<input name="patient_name" value="<?php echo (isset($_REQUEST['patient_name'])) ? $_REQUEST['patient_name'] : ''; ?>" id="patient_name" class="form-control" type="text" placeholder="Patient ID / Name">
									</div>
								</div>
								<div class="col-lg-5">
									<label class="visually-hidden" for="cat_id">Test Category</label>
									<select name="test_cat_name" id="test_cat_name" class="form-select" >
										<option value="">Select Category</option>
										<?php
											foreach ($types_category_arr as $category_det) {
												$opt_val		= str_replace(' ', '-', $category_det['main_category']);
												$selected 	= (isset($_REQUEST['test_cat_name']) && ($_REQUEST['test_cat_name'] == $opt_val)) ? 'selected' : '';
												
												echo '<option value="'.$opt_val.'" '.$selected.'>'.$category_det['main_category'].'</option>';
											}
										?>
									</select>
								</div>
								<div class="col-lg-2">
									<button class="btn btn-primary" type="submit">Search</button>
								</div>
							</form>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table mb-0 table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Patient Details</th>
										<th style="text-align: center;">Operator Name</th>
										<th style="text-align: center;">Test Categories</th>
										<th style="text-align: center;">Test Date</th>
										<th style="text-align: center;">Operations</th>
									</tr>
								</thead>
								<tbody>
								<?php
									//<a target="_blank" href="'.$site_url.'generate-test-report/'.$type_data['id'].'">'.$type_data['patient_name'].'
									$i 	= 1;
									foreach ($test_list_arr as $type_data) {
										
										$normal_range 	= ($type_data['normal_range'] != '') 	? $type_data['normal_range'] : '- ';
										$unit		= ($type_data['unit'] != '') 			? '('.$type_data['unit'].')' : '';
										$cost 		= ($type_data['cost'] > 0) 			? number_format($type_data['cost'], 2, '.', '') : 0.00;
										$test_cat_arr 	= explode(",", $test_list_arr[0]['test_main_categories']);
										$test_cat_val  = implode("<br>", $test_cat_arr);
										
										echo '<tr>'.
												'<th scope="row">'.$i.'</th>'.
												'<td>
													
													<div class="d-flex align-items-center">
														<img class="img-fluid rounded-circle p-1 border border-faintGreen flex-shrink-0" src="'.$site_url.'img/avatar-1.jpg" alt="profile image" width="50">
														<div class="ms-3">
															<h3 class="fw-normal text-dark mb-0">'.ucwords(strtolower($test_list_arr[0]['patient_name'])).' <br> <span style="font-size: 13px;">'.$test_list_arr[0]['patient_id'].'</span></h3>
															<div class="patient_det"> <span>Age: </span>&nbsp; <span class="text-gray-500">'.ucwords(strtolower($test_list_arr[0]['age'])).'</span> </div>
															<div class="patient_det"><span>Sex: </span>&nbsp; <span class="text-gray-500">'.ucwords(strtolower($test_list_arr[0]['gender'])).'</span></div>
															<div class="patient_det"><span>Word No: </span>&nbsp; <span class="text-gray-500">'.ucwords(strtolower($test_list_arr[0]['word_no'])).'</span></div>
															<br>
															<div class="patient_det"><span>Reg No: </span>&nbsp;<span class="text-gray-500">'.ucwords(strtolower($test_list_arr[0]['registration_no'])).'</span></div>
															<div class="patient_det"><span>Under: </span>&nbsp;<span class="text-gray-500">'.ucwords(strtolower($test_list_arr[0]['doctor_name'])).'</span></div>
														</div>
													</div>
												</td>';
											echo	'<td style="text-align: center;">'.ucwords(strtolower($test_list_arr[0]['created_by'])).'</td>';
											echo	'<td style="text-align: center;">'.ucwords(strtolower($test_cat_val)).'</td>';
											echo	'<td style="text-align: center;">'.date("F j, Y, g:i a", strtotime($test_list_arr[0]['create_date'])).'</td>';
											echo	'<td style="text-align: center;">
													<a class="opt_button" href="'.$site_url.'view-test-details/'.$test_list_arr[0]['report_id'].'"><span><i class="far fa-eye"></i></span></a>
													<a class="opt_button" href="'.$site_url.'edit-test-details/'.$test_list_arr[0]['report_id'].'"><span><i class="far fa-edit"></i></span></a>
													<a class="opt_button" href="'.$site_url.'print-report/'.$test_list_arr[0]['report_id'].'"><span><i class="far fa-file-pdf"></i></span></a>
												</td>';
										echo '</tr>';
											
										$i++;
									}
								?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="pagi_info_div float-right">
						<span> Showing <?php echo ($type_count > $limit) ?  (($offset+1).' - '.($offset+count($test_list_arr)).' of '.$type_count) : 'All' ?> records. </span>
					</div>
					<div class="pagination_div">
						<?php
							if($total_page > 1) {
								echo '<ul class="pagination">';
								for ($i = 1; $i <= $total_page; $i++){
									$act 	= ($i == $page_no) ? 'active' : '';
									echo '<li class="'.$act.'"><a href="javascript:change_page('.$i.')">'.$i.'</a></li>';
								}
								echo '</ul>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>