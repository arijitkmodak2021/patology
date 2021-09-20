<?php 

    $connect_string = 'localhost';
    $connect_username = 'root';
    $connect_password = '';
    $connect_db = 'disability_db';
    
    //echo '<pre>'; print_r($_REQUEST); echo '</pre>';
    $gender             = (isset($_REQUEST['gender']) && !empty($_REQUEST['gender'])) ? $_REQUEST['gender'] : '';
    $disability_type    = (isset($_REQUEST['disability_type']) && !empty($_REQUEST['disability_type'])) ? $_REQUEST['disability_type'] : '';
    $daterange          = (isset($_REQUEST['daterange']) && !empty($_REQUEST['daterange'])) ? $_REQUEST['daterange'] : '';
    $gender             = (isset($_REQUEST['gender']) && !empty($_REQUEST['gender'])) ? $_REQUEST['gender'] : '';
    $camp_place         = (isset($_REQUEST['camp_place']) && !empty($_REQUEST['camp_place'])) ? $_REQUEST['camp_place'] : '';

    $where_arr          = array();
    $where_date         = '';

    if(!empty($gender)) $where_arr[] = 'gender = "'.$gender.'"';
    if(!empty($disability_type)) $where_arr[] = 'disability_type = "'.$disability_type.'"';
    if(!empty($daterange)) {
        $date_arr       = explode('-', $daterange);
        $where_arr['added_on'] = 'added_on between "'.date('Y-m-d', strtotime(trim($date_arr[0]))).'" and "'.date('Y-m-d', strtotime(trim($date_arr[1]))).'"';
    }
    
    $where_date         = implode(' AND ', $where_arr);
    $where_date         = (!empty($where_date)) ? ' WHERE '.$where_date : '';

    $link 	= mysqli_connect($connect_string,$connect_username,$connect_password,$connect_db);
    $users_list_arr   = array();
    echo $users_list       = "SELECT * FROM disability_users ".$where_date." order by id desc;";
    $users_list_q     = mysqli_query($link, $users_list);
    //echo $users_list.' Arijit: '.mysqli_num_rows($users_list_q);

    $is_sub_user      = $_SESSION['is_sub_user'];


    
?>
  
<div class="wrapper">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href="css/fresh-bootstrap-table.css" rel="stylesheet" />
    <link href="css/demo.css" rel="stylesheet" />
    <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.js"></script>
    
    <!--  Just for demo purpose, do not include in your project   -->
    <script src="js/demo/gsdk-switch.js"></script>
    <script src="js/demo/jquery.sharrre.js"></script>
    <script src="js/demo/demo.js"></script>

    

    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });

            $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
                console.log('Arijit')
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
                console.log('Arijit 11')
                $(this).val('');
            });
        });

        function change_the_hostipal(val) {
        
            if(val == 'outdoor') {
                $('#h_name').show();
            }
            else {
                $('#h_name').hide();
            }
        }
    </script>

    <!-- Creative Tim Branding   -->
    <div class="logo-container full-screen-table-demo">
        <div class="top_nav_sec">
            <nav class="navbar">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">List of Registered Users</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="<?php echo SITE_URL.'index.php?pages=disability_register' ?>">Register New User</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="<?php echo SITE_URL.'includes/common_functions.php?mode=logout'; ?>">Log out</a></li>
                    </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        </div>
        <form name="search_submit" id="search_submit" action="" method="POST" >
            <div class="search_section col-sm-6" style="padding-right: 0">
                <div class="col-sm-3 form-group" style="margin-bottom: 0">
                    <select name="gender" class="form-control" id="gender">
                        <option value="">Gender</option>
                        <option value="male" <?php echo ($gender == 'male') ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?php echo ($gender == 'female') ? 'selected' : '' ?>>Female</option>
                        <option value="other" <?php echo ($gender == 'other') ? 'selected' : '' ?>>Transgender</option>
                    </select>
                </div>
                <div class="col-sm-3 form-group" style="margin-bottom: 0">
                    <select name="disability_type" class="form-control" id="disability_type">
                        <option value="">Disability type</option>
                        <option value="Orthopedically" <?php echo ($disability_type == 'Orthopedically') ? 'selected' : '' ?>>Orthopedically</option>
                        <option value="Visionary" <?php echo ($disability_type == 'Visionary') ? 'selected' : '' ?>>Visionary</option>
                        <option value="Speech and Hearing Disabled" <?php echo ($disability_type == 'Speech and Hearing Disabled') ? 'selected' : '' ?>>Speech and Hearing Disabled</option>
                        <option value="Mentally challenged" <?php echo ($disability_type == 'Mentally challenged') ? 'selected' : '' ?>>Mentally challenged</option>
                    </select>
                </div>
                <div class="col-sm-3 form-group" style="margin-bottom: 0">
                    <input type="text" class="form-control" name="daterange" value="<?php echo $daterange ?>" />
                    <span class="input-group-addon cal_icon_pos" style="top: 10px; background: transparent; right: 21px; border: none; padding: 0;">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <div class="col-sm-3 form-group" style="margin-bottom: 0; display: none">
                    <select name="camp_place" id="camp_place" class="form-control" onchange="change_the_hostipal(this.value)">
                        <option value="" <?php echo ($camp_place == '1') ? 'selected' : '' ?>>Hospital</option>
                        <option diseable value="" <?php echo ($camp_place == 'outdoor') ? 'selected' : ''; ?>>Outdoor</option>
                    </select>
                </div>
            </div>	
            <div class="search_section col-sm-6" style="padding-left: 0">
                <div class="col-sm-3 form-group" id="h_name" style="margin-bottom: 0; display: none">
                    <input type="text" name="hospital_name" id="hospital_name" class="form-control" placeholder="Place name" value="" />
                </div>
                <div class="col-sm-3 form-group" style="margin-bottom: 0">
                    <input type="submit" class="btn btn-dark" value="Submit" />
                </div>
            </div>
        </form>
    </div>
    
    <div class="fresh-table full-screen-table toolbar-color-azure">
    <!--
        Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
        Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
    -->

    
        <table id="fresh-table" class="table">
            <thead>
                <th>Sl No:</th>
                <th>Added On:</th>
                <th>Name & Address</th>
                <th>Age/Gender</th>
                <th>Disability percent</th>
                <th>Disability Name (Type)</th>
                <th>IQ (Type)</th>
                <th>Photo</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php 
                    $i  = 0;
                    //echo $is_sub_user;
                    if(mysqli_num_rows($users_list_q)>0)
                    {
                        while($list_data = mysqli_fetch_array($users_list_q)) {

                            $address['address'] = $list_data['address_line_1'];
                            $address['city'] = $list_data['city'];
                            $address['state'] = $list_data['state'];
                            $address['zip'] = $list_data['zip'];

                            $depd_address['address'] = $list_data['depdt_address_line_1'];
                            $depd_address['city'] = $list_data['depdt_city'];
                            $depd_address['state'] = $list_data['depdt_state'];
                            $depd_address['zip'] = $list_data['depdt_zip'];

                            $user_id = $list_data['id'];

                            //echo '<pre>'; print_r($list_data); echo '</pre>';
                            //echo implode(', ', $address);

                            $user_image = (!empty($list_data['user_image'])) ? $list_data['user_image'] : '';
                                    
                            echo '<tr>';
                                echo '<td>KSDH/'.($list_data['form_no']).'</td>';
                                echo '<td>'.date('dS M, Y', strtotime($list_data['added_on'])).'</td>';
                                echo '<td>';
                                    echo '<p>'.$list_data['first_name'].' '.$list_data['middle_name'].' '.$list_data['last_name'].'</p>';
                                    echo '<p>'.implode(', ', $address).'<p>';
                                echo '</td>';
                                echo '<td>'.$list_data['age'].' / '.ucfirst($list_data['gender']).'</td>';
                                echo '<td>'.$list_data['disability_condition_percent'].'%</td>';
                                echo '<td>'.$list_data['disability_name'].' ('.$list_data['disability_type'].')</td>';
                                echo '<td>'.$list_data['person_iq'].' ('.$list_data['person_iq_cond'].')</td>';
                                // echo '<td>';
                                //     echo '<p>'.$list_data['relation_name'].'</p>';
                                //     echo '<p>'.implode(', ', $depd_address).'<p>';
                                // echo '</td>';
                                echo '<td>';
                                    if(!empty($user_image)) {
                                        $user_image_path = PHYSICAL_PATH."user_images/thumb/".$user_image;
        
                                        if(file_exists($user_image_path)) 
                                            echo '<img style="width: 100px; border: 1px solid #bababa;" src="'.SITE_URL.'user_images/thumb/'.$user_image.'" style="width: 100%" alt="User Image" />';
                                        else echo '<img style="width: 100px; border: 1px solid #bababa;" src="images/default_photo.png" alt="User Image" />';
                                    }
                                    else echo '<img style="width: 100px; border: 1px solid #bababa" src="images/default_photo.png" alt="User Image" />';
                                echo '</td>';
                                echo '<td>';
                                    echo '<a rel="tooltip" title="Edit" class="table-action edit" target="_blank" href="'.$site_url.'index.php?pages=disability_preview_act&tmp_id=ksh-'.$user_id.'" title="Edit"><i class="fa fa-print"></i></a>';
                                    echo ($is_sub_user == 1) ? '' : '<a rel="tooltip" title="Edit" class="table-action like" target="_blank" href="'.$site_url.'index.php?pages=disability_edit&tmp_id=KSDH-'.$user_id.'" title="Print"><i class="fa fa-edit"></i></a>';
                                    //echo '<a rel="tooltip" title="Remove" class="table-action remove" target="_blank" href="'.$site_url.'index.php?pages=disability_delete&tmp_id=ksh-'.$user_id.'" title="Remove"><i class="fas fa-trash-alt"></i></a>';
                                echo '</td>';
                            echo '</tr>';
                            
                            $i++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>




<script>
    var $table  = $('#fresh-table')

    window.operateEvents = {
        'click .like': function (e, value, row, index) {
            alert('You click like icon, row: ' + JSON.stringify(row))
            console.log(value, row, index)
        },
        'click .edit': function (e, value, row, index) {
            alert('You click edit icon, row: ' + JSON.stringify(row))
            console.log(value, row, index)
        },
        'click .remove': function (e, value, row, index) {
            $table.bootstrapTable('remove', {
                field: 'id',
                values: [row.id]
            })
        }
    }

    // function operateFormatter(value, row, index) {
    //     return [
    //         '<a rel="tooltip" title="Edit" class="table-action edit" href="javascript:void(0)" title="Edit">',
    //             '<i class="fa fa-edit"></i>',
    //         '</a>',
    //         '<a rel="tooltip" title="Like" class="table-action like" href="javascript:void(0)" title="Print">',
    //             '<i class="fa fa-print"></i>',
    //         '</a>',
    //         '<a rel="tooltip" title="Remove" class="table-action remove" href="javascript:void(0)" title="Remove">',
    //             '<i class="fas fa-trash-alt"></i>',
    //         '</a>'
    //     ].join('')
    // }

    $(function () {
        

        $table.bootstrapTable({
            classes: 'table table-hover table-striped',
            toolbar: '.toolbar',
            search: true,
            showRefresh: false,
            showToggle: false,
            showColumns: false,
            pagination: true,
            striped: true,
            sortable: false,
            height: $(window).height() - 15,
            pageSize: 25,
            pageList: [25, 50, 100],

            formatShowingRows: function (pageFrom, pageTo, totalRows) {
                return ''
            },
            formatRecordsPerPage: function (pageNumber) {
                return pageNumber + ' rows visible'
            }
        })

        $(window).resize(function () {
            $table.bootstrapTable('resetView', {
                height: $(window).height()
            })
        })
    })
  </script>