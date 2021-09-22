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

<!-- Page Header-->
<header class="bg-white shadow-sm px-4 py-3 z-index-20">
	<div class="container-fluid px-0">
		<h2 class="mb-0 p-1">Create Test Type</h2>
	</div>
</header>
<!-- Breadcrumb-->
<div class="bg-white">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb mb-0 py-3">
			<li class="breadcrumb-item"><a class="fw-light" href="<?php echo $site_url."index.php?pages=dashboard" ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a class="fw-light" href="<?php echo $site_url."index.php?pages=test_types" ?>">Test Types</a></li>
			<li class="breadcrumb-item active fw-light" aria-current="page">Create</li>
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
						<form class="form-horizontal">
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElOne">Test Category</label>
								<div class="col-sm-6">
									<select name="cat_id" id="cat_id" class="form-select" id="inlineFormSelectPref">
										<option value="">Select Category</option>
										<?php
											foreach ($types_category_arr as $category_det) {
												$selected 	= (isset($_REQUEST['cat_id']) && ($_REQUEST['cat_id'] == $category_det['id'])) ? 'selected' : '';
												echo '<option value="'.$category_det['id'].'" '.$selected.'>'.$category_det['test_category'].'</option>';
											}
										?>
									</select>
								</div>
								<div class="col-sm-3">
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<a href="javascript:create_category('open')" id="create_button" style="line-height: 1.5;" class="selected">Create new</a>
								</div>
							</div>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Test Type Name</label>
								<div class="col-sm-6">
									<input class="form-control" name="name" id="type_name" id="inputHorizontalElTwo" type="text" placeholder="">
								</div>
							</div>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Unit</label>
								<div class="col-sm-6">
									<input class="form-control" name="unit" id="unit" type="text" placeholder="">
								</div>
							</div>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Normal Range</label>
								<div class="col-sm-6">
									<input class="form-control" name="normal_range" id="normal_range" type="text" placeholder="">
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