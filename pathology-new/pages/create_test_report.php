<?php
	include("includes/config.php");

	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == ''))
	{
	    header("Location:".$site_url."index.php?pages=login");
	}
	
	$test_category_list_sql  	= "select * from test_categories order by test_category asc";
	$count_rs1	= mysqli_query($link, $test_category_list_sql);
	$types_category_arr	= mysqli_fetch_all($count_rs1, MYSQLI_ASSOC);
	
?>

<script>
	
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
					<div class="card-body">
						<form name="generate_report" id="generate_report" action="<?php echo $site_url."includes/common_functions.php" ?>" method="post" class="generate_report form-horizontal">
							<input type="hidden" id="mode" name="mode" value="generate_report" />
							<input type="hidden" id="create_new_patient" name="create_new_patient" value="0" />
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElOne">Patient Id</label>
								<div class="col-sm-6">
									<input class="form-control" name="patient_id" id="patient_id" id="inputHorizontalElTwo" type="text" data-validate-field="patient_id" placeholder="">
								</div>
								<div class="col-sm-3 hide">
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<a href="javascript:create_patient_model('open')" id="create_button" style="line-height: 1.5;" class="selected">Add new patient</a>
								</div>
							</div>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Serial No</label>
								<div class="col-sm-6">
									<input class="form-control" name="serial_no" id="serial_no" required data-validate-field="serial_no" type="text" placeholder="">
								</div>
							</div>
							<div id="new_category" class="row gy-2 mb-4 hide">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Patient's Name</label>
								<div class="col-sm-6">
									<input class="form-control" name="name" id="name" id="inputHorizontalElTwo" type="text" data-validate-field="patient_name" placeholder="">
								</div>
							</div>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Patient's Age</label>
								<div class="col-sm-6">
									<input class="form-control" name="age" id="age" id="inputHorizontalElTwo" type="text" required data-validate-field="patient_name" placeholder="">
								</div>
							</div>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Patient's Gender</label>
								<div class="col-sm-6">
									<select name="gender" id="gender" class="form-select" id="inlineFormSelectPref">
										<option value="">Select Gender</option>
										<option value="">Male</option>
										<option value="">Female</option>
										<option value="">Transgender</option>
										<option value="">Other</option>
									</select>
								</div>
							</div>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Patient's Word</label>
								<div class="col-sm-6">
									<input class="form-control" name="word_id" id="word_id" required data-validate-field="word_id" type="text" placeholder="">
								</div>
							</div>
							<div class="row gy-2 mb-4 hidden">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Cost</label>
								<div class="col-sm-6">
									<input class="form-control" name="cost" id="cost" type="text" value="0" placeholder="">
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