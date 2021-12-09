<?php
	include("includes/config.php");

	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == ''))
	{
	    header("Location:".$site_url."login");
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
		<h2 class="mb-0 p-1">User Profile</h2>
	</div>
</header>
<!-- Breadcrumb-->
<div class="bg-white">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb mb-0 py-3">
			<li class="breadcrumb-item"><a class="fw-light" href="<?php echo $site_url."dashboard" ?>">Dashboard</a></li>
			<li class="breadcrumb-item"><a class="fw-light" href="<?php echo $site_url."test-types" ?>">User Profile</a></li>
			<li class="breadcrumb-item active fw-light" aria-current="page">Update</li>
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
							<input type="hidden" id="mode" name="mode" value="update_user" />
							<input type="hidden" id="create_new" name="create_new" value="0" />
							
							<div id="new_category" class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">User Name</label>
								<div class="col-sm-6">
									<input class="form-control" name="user_name" readonly="true" id="user_name" id="inputHorizontalElTwo" type="text" data-validate-field="user_name" placeholder="">
								</div>
							</div>
							<br>
							<div class="row gy-2 mb-4">
								<label class="col-sm-3 form-label text-right" for="inputHorizontalElTwo">User Email</label>
								<div class="col-sm-6">
									<input class="form-control" name="email " id="email " id="email " type="text" required data-validate-field="email " placeholder="">
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-9 ms-auto">
									<input class="btn btn-primary" type="submit" value="Update">
									<a href="<?php echo $site_url."test-types" ?>" id="create_button" style="line-height: 1.5; margin-left: 20px;" class="selected">Back</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>