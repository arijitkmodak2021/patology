<?php
	include("includes/config.php");

	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == ''))
	{
	    header("Location:".$site_url."index.php?pages=login");
	}
	
	$test_type_list_url  	= "SELECT * FROM tests_type ORDER BY name asc;";
	$count_rs       	= mysqli_query($link, $test_type_list_url);
	$types_list_arr	= [];
		
	if(mysqli_num_rows($count_rs)>0)
	    $types_list_arr  	= mysqli_fetch_all($count_rs, MYSQLI_ASSOC);
	
	//print_r ($types_list_arr);
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
                    <div class="card-header">
                      <div class="card-close">
                        <div class="dropdown">
                          <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                          <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#"> <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                        </div>
                      </div>
                      <h3 class="h4 mb-0">Type Of Tests </h3>
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
                              <th>Cost</th>
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
									'<td>₹ '.$cost.'</td>'.
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