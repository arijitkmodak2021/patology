<?php
	include("includes/config.php");

	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == ''))
	{
	    header("Location:".$site_url."login");
	}
	
	$cat_search				= (isset($_REQUEST['cat_id'])) ? $_REQUEST['cat_id'] : '';
	$name_search				= (isset($_REQUEST['test_type_name'])) ? $_REQUEST['test_type_name'] : '';
	$name_search				= ucwords(str_replace('-', ' ', $name_search));
	$page_no					= (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : 1;
	$conditions				= [];
	$conditions_det			= '';
	$limit 					= RECORDPERPAGE; //RECORDPERPAGE
	$offset					= 0;
	
	if($cat_search != '')	$conditions[] 	= 'category_id = "'.$cat_search.'"';
	if($name_search != '')	$conditions[] 	= 'name LIKE "%'.$name_search.'%"';
	if(!empty($conditions))
		$conditions_det		= ' WHERE '.implode(' AND ', $conditions);		
		
	$total_count_sql			= mysqli_query($link, "SELECT count(*) total_count FROM tests_type ".$conditions_det.";");
	$type_count_arr			= mysqli_fetch_all($total_count_sql, MYSQLI_ASSOC);
	$type_count				= $type_count_arr[0]['total_count'];
	$total_page 				= ceil($type_count/$limit);	
		
	if($page_no > 1 )
		$offset				= $limit * ($page_no - 1);
	
	$limit_test 				= ' LIMIT '.$limit;
	$limit_test 				= ($offset > 0) ? $limit_test.' OFFSET '.$offset : $limit_test;
	
	$test_type_list_sql			= "SELECT * FROM tests_type ".$conditions_det." ORDER BY category_name asc, name asc ".$limit_test.";";
	//echo $test_type_list_sql;
	$count_rs       			= mysqli_query($link, $test_type_list_sql);
	$types_list_arr			= [];
		
	if(mysqli_num_rows($count_rs)>0)
	    $types_list_arr  		= 	mysqli_fetch_all($count_rs, MYSQLI_ASSOC);
	else $types_list_arr		= [];
	
	$test_category_list_sql  	= "select * from test_categories order by main_category asc, test_category asc";
	$count_rs1	= mysqli_query($link, $test_category_list_sql);
	$types_category_arr	= mysqli_fetch_all($count_rs1, MYSQLI_ASSOC);
	
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
		
		var text_val 		= $('#test_type_name').val().trim();
		var text_val_uri	= text_val.replace(/[`~!@#$%^&*()_|+\-=?;:'", .<>\{\}\[\]\\\/]/gi, '-').toLowerCase();
		//var text_val_uri	= (text_val != '') ? encodeURI(text_val) : 'All';
		var is_paginate	= $('#is_paginate').val();
		var cat_id 		= $('#cat_id').val();
		var page_no 		= (is_paginate == 1) ? $('#page_no').val() : 1;
		var url_val		= '';
		
		url_val			= '<?php echo $site_url; ?>test-types/'+page_no;
		
		if (text_val != '')
			url_val		= url_val+'/'+text_val_uri;
			
		url_val		= url_val+'/'+cat_id;	
		
		//alert(url_val);
		window.location.href = url_val;
		return false
	}
</script>

<!-- Page Header-->
<header class="bg-white shadow-sm px-4 py-3 z-index-20">
	<div class="container-fluid px-0">
		<h2 class="mb-0 p-1">Test Types</h2>
	</div>
</header>
<!-- Breadcrumb-->
<div class="bg-white">
	<div class="container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0 py-3">
				<li class="breadcrumb-item"><a class="fw-light" href="<?php echo $site_url."dashboard" ?>">Dashboard</a></li>
				<li class="breadcrumb-item active fw-light" aria-current="page">Test Types</li>
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
							<button class="btn btn-primary" onclick="location.href = '<?php echo $site_url."test-type-create"; ?>';" type="submit">Create Test Type</button>
						</div>
						<div class="col-lg-4">
							<form name="search_arr" id="search_arr" action="<?php echo $site_url."test-types"; ?>" onsubmit="return generate_submit_form()" method="get" class="row align-items-right">
								<input type="hidden" name="pages" id="pages" value="test_types" />
								<input type="hidden" name="page_no" id="page_no" value="<?php echo $page_no ?>" />
								<input type="hidden" name="is_paginate" id="is_paginate" value="0" />
								
								<div class="col-lg-5">
									<div class="input-group">
										<input name="test_type_name" value="<?php echo $name_search; ?>" id="test_type_name" class="form-control" type="text" placeholder="Test Name">
									</div>
								</div>
								<div class="col-lg-5">
									<label class="visually-hidden" for="cat_id">Test Category</label>
									<select name="cat_id" id="cat_id" class="form-select" >
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
										<th>Test Name</th>
										<th>Test Category</th>
										<th>Normal Range (unit)</th>
										<!--<th>Cost</th>-->
										<th>Operations</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(!empty($types_list_arr)) {
											$i = 1;
											foreach ($types_list_arr as $type_data) {
												$normal_range 	= ($type_data['normal_range'] != '') ? $type_data['normal_range'] : '- ';
												$unit	= ($type_data['unit'] != '') ? '('.$type_data['unit'].')' : '';
												$cost 	= ($type_data['cost'] > 0) ? number_format($type_data['cost'], 2, '.', '') : 0.00;
												echo '<tr>'.
														'<th scope="row">'.$i.'</th>'.
														'<td>'.$type_data['name'].'</td>'.
														'<td>'.$type_data['category_name'].'</td>'.
														'<td>'.$normal_range.' '.$unit.'</td>'.
														//'<td>₹ '.$cost.'</td>'.
														'<td></td>'.
													   '</tr>';
													   
												$i++;
											}
										} else {
											echo '<tr>'.
													'<th scope="row"></th>'.
													'<td> </td>'.
													'<td>No records found.</td>'.
													'<td> </td>'.
													//'<td> </td>'.
													'<td></td>'.
												'</tr>';
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="pagi_info_div float-right">
						<span> Showing <?php echo ($type_count > $limit) ? (($offset+1).' - '.($offset+count($types_list_arr)).' of '.$type_count) : 'All' ?> records. </span>
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