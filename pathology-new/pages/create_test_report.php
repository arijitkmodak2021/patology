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
?>

<script>
	// Treeview Initialization
$(document).ready(function() {
  $('.treeview').mdbTreeview();
});
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
												<div class="modal-body">
													<p>&nbsp;</p>
													<form>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="inputHorizontalElOne">Patient Id</label>
															<div class="col-sm-8">
																<input class="form-control" readonly="true" name="new_patient_id" id="new_patient_id" id="inputHorizontalElTwo" value="<?php echo $patient_id; ?>" type="text" data-validate-field="patient_id" placeholder="">
															</div>
														</div>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Registration No</label>
															<div class="col-sm-8">
																<input class="form-control" name="serial_no" id="serial_no" required data-validate-field="serial_no" type="text" placeholder="">
															</div>
														</div> 
														<div id="new_category" class="row gy-2 mb-4 hide">
															<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Patient's Name</label>
															<div class="col-sm-8">
																<input class="form-control" name="name" id="name" id="inputHorizontalElTwo" type="text" data-validate-field="patient_name" placeholder="">
															</div>
														</div>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Patient's Age</label>
															<div class="col-sm-8">
																<input class="form-control" name="age" id="age" id="inputHorizontalElTwo" type="text" required data-validate-field="patient_name" placeholder="">
															</div>
														</div>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Mobile No</label>
															<div class="col-sm-8">
																<input class="form-control" name="mobile_no" id="mobile_no" required data-validate-field="mobile_no" type="text" placeholder="">
															</div>
														</div>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Patient's Gender</label>
															<div class="col-sm-8">
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
															<div class="col-sm-8">
																<select name="word_no" id="word_no" class="form-select" id="inlineFormSelectPref">
																	<option value="">Select Word</option>
																	<?php
																		foreach ($word_details_arr as $word)  
																			echo '<option value="'.$word['id'].'">'.$word['word_name'].'</option>';
																	?>
																</select>
															</div>
														</div>
														<div class="row gy-2 mb-4">
															<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Doctor's Name</label>
															<div class="col-sm-8">
																<select name="docotor_name" id="docotor_name" class="form-select" id="inlineFormSelectPref">
																	<?php
																		foreach ($doctor_details_arr as $doctor)  
																			echo '<option value="'.$doctor['id'].'">'.$doctor['name'].'</option>';
																	?>
																</select>
															</div>
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
													<button class="btn btn-primary" type="button">Save changes</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<form name="generate_report" id="generate_report" action="<?php echo $site_url."includes/common_functions.php" ?>" method="post" class="generate_report form-horizontal">
							<input type="hidden" id="mode" name="mode" value="generate_report" />
							<input type="hidden" id="create_new_patient" name="create_new_patient" value="0" />
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
									<input class="form-control" name="new_patient_id" id="new_patient_id" id="inputHorizontalElTwo" value="" type="text" data-validate-field="patient_id" placeholder="">
								</div>
								<div class="col-sm-3">
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#myModal">Search</button>
								</div>
							</div>
							<div>
								<div class="treeview w-20 border">
  <h6 class="pt-3 pl-3">Folders</h6>
  <hr>
  <ul class="mb-1 pl-3 pb-2">
    <li><i class="fas fa-angle-right rotate"></i>
      <span><i class="far fa-envelope-open ic-w mx-1"></i>Mail</span>
      <ul class="nested">
        <li><i class="far fa-bell ic-w mr-1"></i>Offers</li>
        <li><i class="far fa-address-book ic-w mr-1"></i>Contacts</li>
        <li><i class="fas fa-angle-right rotate"></i>
          <span><i class="far fa-calendar-alt ic-w mx-1"></i>Calendar</span>
          <ul class="nested">
            <li><i class="far fa-clock ic-w mr-1"></i>Deadlines</li>
            <li><i class="fas fa-users ic-w mr-1"></i>Meetings</li>
            <li><i class="fas fa-basketball-ball ic-w mr-1"></i>Workouts</li>
            <li><i class="fas fa-mug-hot ic-w mr-1"></i>Events</li>
          </ul>
        </li>
      </ul>
    </li>
    <li><i class="fas fa-angle-right rotate"></i>
      <span><i class="far fa-folder-open ic-w mx-1"></i>Inbox</span>
      <ul class="nested">
        <li><i class="far fa-folder-open ic-w mr-1"></i>Admin</li>
        <li><i class="far fa-folder-open ic-w mr-1"></i>Corporate</li>
        <li><i class="far fa-folder-open ic-w mr-1"></i>Finance</li>
        <li><i class="far fa-folder-open ic-w mr-1"></i>Other</li>
      </ul>
    </li>
    <li><i class="fas fa-angle-right rotate"></i>
      <span><i class="far fa-gem ic-w mx-1"></i>Favourites</span>
      <ul class="nested">
          <li><i class="fas fa-pepper-hot ic-w mr-1"></i>Restaurants</li>
          <li><i class="far fa-eye ic-w mr-1"></i>Places</li>
          <li><i class="fas fa-gamepad ic-w mr-1"></i>Games</li>
          <li><i class="fas fa-cocktail ic-w mr-1"></i>Coctails</li>
          <li><i class="fas fa-pizza-slice ic-w mr-1"></i>Food</li>
        </ul>
    </li>
    <li><i class="far fa-comment ic-w mr-1"></i>Notes</li>
    <li><i class="fas fa-cogs ic-w mr-1"></i>Settings</li>
    <li><i class="fas fa-desktop ic-w mr-1"></i>Devices</li>
    <li><i class="fas fa-trash-alt ic-w mr-1"></i>Deleted Items</li>
  </ul>
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