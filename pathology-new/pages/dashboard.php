<?php
	include("includes/config.php");
		
	if (!isset($_SESSION['is_logged_in']) or ($_SESSION['is_logged_in'] == ''))
	{
		header("Location:".$site_url."login");
	}
	
?>

<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/charts-home.js"></script>
<!-- Page Header-->
<header class="bg-white shadow-sm px-4 py-3 z-index-20">
	<div class="container-fluid px-0">
		<div class="row">
			<div class="col-sm-2"><h2 class="mb-0 p-1 inline-block">Dashboard</h2></div>
			<div class="col-sm-10">
				<div class="col-sm-6">
					<form name="dashboard_search" id="dashboard_search" action="<?php echo $site_url."includes/common_functions.php" ?>" method="post" class="row g-3 align-items-center">
						<div class="col-lg">
							<label class="visually-hidden" for="inlineFormInputGroupUsername">Year</label>
							<select class="form-select" id="inlineFormSelectPref">
								<option selected="">All Years</option>
								<?php
									$cur_yr = date('Y');
									for ($i = date('Y'); $i <= date('Y') + 5; $i++)
										echo ($i == $cur_yr) ? '<option selected value="'.$i.'">'.$i.'</option>' : '<option value="'.$i.'">'.$i.'</option>';
								?>
							</select>
						</div>
						<div class="col-lg">
							<label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
							<select class="form-select" id="inlineFormSelectPref">
								<option selected="">All Months</option>
								<option value="1">January</option>
							</select>
						</div>
						<div class="col-lg">
							<button class="btn btn-primary" type="submit">Submit</button>
						</div>
					</form>
				</div>
				<div class="col-sm-6">
				
				</div>
			</div>
		</div>
	</div>
</header>
<!-- Dashboard Counts Section-->
<section class="pb-0">
	<div class="container-fluid">
		<div class="card mb-0">
			<div class="card-body">
				<div class="row gx-5 bg-white">
					<!-- Item -->
					<div class="col-xl-3 col-sm-6 py-4 border-lg-end border-gray-200">
						<div class="d-flex align-items-center">
							<div class="icon flex-shrink-0 bg-violet">
								<svg class="svg-icon svg-icon-sm svg-icon-heavy"><use xlink:href="#user-1"> </use></svg>
							</div>
							<div class="mx-3">
								<h6 class="h4 fw-light text-gray-600 mb-3">Total<br>Patients</h6>
								<div class="progress" style="height: 4px">
									<div class="progress-bar bg-violet" role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="number"><strong class="text-lg">25</strong></div>
						</div>
					</div>
					<!-- Item -->
					<div class="col-xl-3 col-sm-6 py-4 border-lg-end border-gray-200">
						<div class="d-flex align-items-center">
							<div class="icon flex-shrink-0 bg-red">
								<svg class="svg-icon svg-icon-sm svg-icon-heavy"> <use xlink:href="#survey-1"> </use> </svg>
							</div>
							<div class="mx-3">
								<h6 class="h4 fw-light text-gray-600 mb-3">Total<br>Tests</h6>
								<div class="progress" style="height: 4px">
									<div class="progress-bar bg-red" role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="number"><strong class="text-lg">70</strong></div>
						</div>
					</div>
					<!-- Item -->
					<div class="col-xl-3 col-sm-6 py-4 border-lg-end border-gray-200">
						<div class="d-flex align-items-center">
							<div class="icon flex-shrink-0 bg-green">
								<svg class="svg-icon svg-icon-sm svg-icon-heavy"> <use xlink:href="#numbers-1"> </use> </svg>
							</div>
							<div class="mx-3">
								<h6 class="h4 fw-light text-gray-600 mb-3">New<br>Invoices</h6>
								<div class="progress" style="height: 4px">
									<div class="progress-bar bg-green" role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="number"><strong class="text-lg">40</strong></div>
						</div>
					</div>
					<!-- Item -->
					<div class="col-xl-3 col-sm-6 py-4">
						<div class="d-flex align-items-center">
							<div class="icon flex-shrink-0 bg-orange">
								<svg class="svg-icon svg-icon-sm svg-icon-heavy"> <use xlink:href="#list-details-1"> </use> </svg>
							</div>
							<div class="mx-3">
								<h6 class="h4 fw-light text-gray-600 mb-3">Open<br>Cases</h6>
								<div class="progress" style="height: 4px">
									<div class="progress-bar bg-orange" role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="number"><strong class="text-lg">50</strong></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
	<section class="pb-0">
		<div class="container-fluid">
			<div class="card mb-0">
				<div class="card-body">
					<!-- Total Overdue             -->
					<div class="row bg-white">
						<div class="card mb-0">
							<div class="card-close">
								<div class="dropdown">
									<button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
									<div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1">
										<a class="dropdown-item py-1 px-3 remove" href="#"> <i class="fas fa-times"></i>Close</a>
										<a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a>
									</div>
								</div>
							</div>
							<div class="card-body d-flex flex-column">
								<h3>Total Patients Registered, Tests</h3>
								<p class="small  text-gray-500">Lorem ipsum dolor sit amet.</p>
								<div class="chart mt-auto">
									<canvas id="lineChart1">                               </canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
          <!-- Dashboard Header Section    -->
          
          <!-- Projects Section-->
          
          <!-- Client Section-->
          
          <!-- Feeds Section-->
          
          <!-- Updates Section                                                -->
          

      