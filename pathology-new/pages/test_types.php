<?php
	include("includes/config.php");

	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == ''))
	{
	    header("Location:".$site_url."index.php?pages=login");
	}
	
	$cat_search				= (isset($_REQUEST['cat_id'])) ? $_REQUEST['cat_id'] : '';
	$name_search				= (isset($_REQUEST['test_type_name'])) ? $_REQUEST['test_type_name'] : '';
	$page_no					= (isset($_REQUEST['page_no'])) ? $_REQUEST['page_no'] : '';
	$conditions				= [];
	
	if($cat_search != '')	$conditions[] 	= 'category_id = "'.$cat_search.'"';
	if($name_search != '')	$conditions[] 	= 'name LIKE "%'.$name_search.'%"';
	if($page_no != '')	$conditions[] 		= 'page_no = "'.$page_no.'"';
	
	$conditions_det	= '';
	if(!empty($conditions))
		$conditions_det		= ' WHERE '.implode(' AND ', $conditions);	
	
	$test_type_list_sql			= "SELECT * FROM tests_type ".$conditions_det." ORDER BY category_name asc, name asc;";
	$count_rs       			= mysqli_query($link, $test_type_list_sql);
	$types_list_arr			= [];
		
	if(mysqli_num_rows($count_rs)>0)
	    $types_list_arr  		= 	mysqli_fetch_all($count_rs, MYSQLI_ASSOC);
	else $types_list_arr		= [];
	
	$test_category_list_sql  	= "select * from test_categories order by main_category asc, test_category asc";
	$count_rs1	= mysqli_query($link, $test_category_list_sql);
	$types_category_arr	= mysqli_fetch_all($count_rs1, MYSQLI_ASSOC);
	
?>
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
						<li class="breadcrumb-item"><a class="fw-light" href="<?php echo $site_url."index.php?pages=dashboard" ?>">Dashboard</a></li>
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
									<button class="btn btn-primary" onclick="location.href = '<?php echo $site_url."index.php?pages=create_test_type"; ?>';" type="submit">Create Test Type</button>
								</div>
								<div class="col-lg-4">
									<form name="search_arr" id="search_arr" action="<?php echo $site_url."index.php?pages=test_types"; ?>" method="post" class="row align-items-right">
										<div class="col-lg-5">
											<div class="input-group">
												<input name="test_type_name" value="<?php echo (isset($_REQUEST['test_type_name'])) ? $_REQUEST['test_type_name'] : ''; ?>" id="test_type_name" class="form-control" type="text" placeholder="Test Type">
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
									?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                
               
              </div>
            </div>
          </section>