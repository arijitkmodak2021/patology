<?php
	include("includes/config.php");

	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == ''))
	{
	    header("Location:".$site_url."index.php?pages=login");
	}
	
	$test_category_list_sql  	= "select * from test_categories order by main_category asc, test_category asc";
	$count_rs1	= mysqli_query($link, $test_category_list_sql);
	$types_category_arr	= mysqli_fetch_all($count_rs1, MYSQLI_ASSOC);
?>

<script>
	function create_category(val) {
		if(val == 'open'){
			$('#create_new').val(1);
			$('#new_category').removeClass('hide');
			$('#create_button').text('Close');
			$('#create_button').attr('href', 'javascript:create_category(\'close\');');
			$("#cat_id").attr('disabled', 'disabled');
			$('#cat_id').removeAttr('required');
			$('#cat_id option:selected').removeAttr('selected');
		}
		else{
			$('#create_new').val(0);
			$('#new_category').addClass('hide');
			$('#create_button').text('Create new');
			$('#create_button').attr('href', 'javascript:create_category(\'open\');');
			$("#cat_id").removeAttr('disabled');
			$('#cat_id').addAttr('required');
		}
	}
</script>

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
						<form name="test_type_create" id="test_type_create" action="<?php echo $site_url."includes/common_functions.php" ?>" method="post" class="test_type_create form-horizontal">
							<input type="hidden" id="mode" name="mode" value="test_type_insert" />
							<input type="hidden" id="create_new" name="create_new" value="0" />
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElOne">Test Category</label>
								<div class="col-sm-6">
									<select name="cat_id" id="cat_id" class="form-select" id="inlineFormSelectPref" required data-validate-field="cat_id">
										<option value="">Select Category</option>
										<?php
											$i 	= 0;
											if($i == 0) echo '<optgroup label="'.$types_category_arr[$i]['main_category'].'">';
											foreach ($types_category_arr as $category_det) {
												
												if(($i > 0) && ($types_category_arr[$i - 1]['main_category'] != $types_category_arr[$i]['main_category']))
													echo '</optgroup>
														<optgroup label="'.$types_category_arr[$i]['main_category'].'">';
													
												$selected 	= (isset($_REQUEST['cat_id']) && ($_REQUEST['cat_id'] == $category_det['id'])) ? 'selected' : '';
												echo '<option value="'.$category_det['id'].'" '.$selected.'>'.$category_det['test_category'].'</option>';
												
												$i++;
											}
											echo '</optgroup>';
										?>
									</select>
								</div>
								<div class="col-sm-3 hide">
									<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
									<a href="javascript:create_category('open')" id="create_button" style="line-height: 1.5;" class="selected">Create new</a>
								</div>
							</div>
							<div id="new_category" class="row gy-2 mb-4 hide">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Category Name</label>
								<div class="col-sm-6">
									<input class="form-control" name="category_name" id="category_name" id="inputHorizontalElTwo" type="text" data-validate-field="category_name" placeholder="">
								</div>
							</div>
							<br>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Test Type Name</label>
								<div class="col-sm-6">
									<input class="form-control" name="name" id="type_name" id="inputHorizontalElTwo" type="text" required data-validate-field="type_name" placeholder="">
								</div>
							</div>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Unit</label>
								<div class="col-sm-6">
									<input class="form-control" name="unit" id="unit" type="text" required data-validate-field="unit" placeholder="">
								</div>
							</div>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">Normal Range</label>
								<div class="col-sm-6">
									<input class="form-control" name="normal_range" id="normal_range" required data-validate-field="normal_range" type="text" placeholder="">
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
									<a href="<?php echo $site_url."index.php?pages=test_types" ?>" id="create_button" style="line-height: 1.5; margin-left: 20px;" class="selected">Back</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>