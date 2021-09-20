<?php 

    $user_id_arr    = explode('-', $_REQUEST['tmp_id']);
    $user_id        = (isset($user_id_arr[1]) && !empty($user_id_arr['1'])) ? $user_id_arr[1] : $_REQUEST['tmp_id']; 
    if ($_SESSION['is_logged_in'] != 1) 
        header("Location:".$site_url."index.php?pages=login");
    elseif(empty($user_id))
        header("Location:".$site_url."index.php?pages=disability_list");

    $connect_string = 'localhost';
    $connect_username = 'root';
    $connect_password = '';
    $connect_db = 'disability_db';
    
    $link 	= mysqli_connect($connect_string,$connect_username,$connect_password,$connect_db);

    if(!empty($user_id)) {
        $user_details_arr   = array();
        $user_details       = "SELECT * FROM disability_users WHERE id = ".trim($user_id);

        $user_details_q     = mysqli_query($link, $user_details);

        if(mysqli_num_rows($user_details_q)>0)
        {
            $user_det_row  = mysqli_fetch_array($user_details_q);

            $user_details_arr['id']         = $user_det_row['id'];
            $user_details_arr['camp_place'] = $user_det_row['camp_place'];
            $user_details_arr['form_no']       = $user_det_row['form_no'];
            $user_details_arr['first_name']       = $user_det_row['first_name'];
            $user_details_arr['middle_name']         = $user_det_row['middle_name'];
            $user_details_arr['date_of_birth']         = $user_det_row['date_of_birth'];
            $user_details_arr['last_name']       = $user_det_row['last_name'];
            $user_details_arr['gender']       = $user_det_row['gender'];
            $user_details_arr['age']         = $user_det_row['age'];
            $user_details_arr['disability_type']       = $user_det_row['disability_type'];
            $user_details_arr['disability_name']       = $user_det_row['disability_name'];
            $user_details_arr['disability_condition']         = $user_det_row['disability_condition'];
            $user_details_arr['disability_condition_percent']       = $user_det_row['disability_condition_percent'];
            $user_details_arr['person_iq']       = $user_det_row['person_iq'];
            $user_details_arr['person_iq_cond']         = $user_det_row['person_iq_cond'];
            $user_details_arr['need_assistance']       = $user_det_row['need_assistance'];
            $user_details_arr['aid_name']       = $user_det_row['aid_name'];
            $user_details_arr['special_remark']         = $user_det_row['special_remark'];
            $user_details_arr['relation_type']       = $user_det_row['relation_type'];
            $user_details_arr['relation_name']       = $user_det_row['relation_name'];
            $user_details_arr['address_line_1']       = $user_det_row['address_line_1'];
            $user_details_arr['city']       = $user_det_row['city'];
            $user_details_arr['state']         = $user_det_row['state'];
            $user_details_arr['zip']       = $user_det_row['zip'];
            $user_details_arr['contact_no']       = $user_det_row['contact_no'];
            $user_details_arr['email']         = $user_det_row['email'];
            $user_details_arr['validity_till']       = $user_det_row['validity_till'];
            $user_details_arr['user_image']       = $user_det_row['user_image'];
            $user_details_arr['relation_addr_diff'] = $user_det_row['relation_addr_diff'];
            $user_details_arr['depdt_address_line_1'] = $user_det_row['depdt_address_line_1'];
            $user_details_arr['depdt_city'] = $user_det_row['depdt_city'];
            $user_details_arr['depdt_state'] = $user_det_row['depdt_state'];
            $user_details_arr['depdt_zip'] = $user_det_row['depdt_zip'];

        }
    }
    else header("Location:".$site_url."index.php?pages=disability_list");

    //echo '<pre>'; print_r($user_details_arr); echo '</pre>';

?>

<script>
    function change_the_hostipal(val) {
        
        if(val == 'outdoor') {
            $('#hospital_name').show();
            //$('#hospital_name').val('');
        }
        else {
            $('#hospital_name').hide();
            $('#hospital_name').val('');
        }
    }

    function show_new_address () {
        var checkBox = document.getElementById("new_address");
        if (checkBox.checked == true){
            //alert('1')
            $('#same_as_above').hide()
        }
        else {
            //alert('2')
            $('#same_as_above').show()
        }
    }

    var sec_date = new Date('<?php echo date('Y', strtotime($user_details_arr['date_of_birth'])) ?>', '<?php echo date('m', strtotime($user_details_arr['date_of_birth'])) - 1 ?>', '<?php echo date('d', strtotime($user_details_arr['date_of_birth'])) ?>');
    // Wait for the DOM to be ready
    $(function() {
        $(function () {
            $('#date_of_birth_div').datetimepicker({ 
                pickTime: false,
                defaultDate: sec_date,
                format: 'DD-MM-YYYY'
            }).change(dateChanged)
            .on('changeDate', dateChanged);;
        });

        function dateChanged(){
            // do what you want here
            var d0      = $('#date_of_birth').val().split("-");
            console.log(d0)
            d1          = new Date(d0[2], (d0[1] - 1), d0[0]);
            d2          = new Date();
            console.log(d1+' '+d2);

            var diff    = d2.getTime() - d1.getTime();
            var age     = Math.floor(diff / (1000 * 60 * 60 * 24 * 365.25)); 
            console.log(age);
            if(age > 0) $('#age').val(age);
        }
        //$('#date_of_birth_div').datetimepicker();

        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        $("#user_register").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                hospital_name: {
                    required: function(element){
                            return $("#can_place").val() == "outdoor";
                        }
                },
                first_name: "required",
                //middle_name: "required",
                last_name: "required",
                gender: "required",
                age: {
                    required: true,
                    number: true
                },
                //date_of_birth: "required",
                disability_type: "required",
                disability_condition: "required",
                disability_name: "required",
                disability_condition_percent:  {
                    required: true,
                    number: true
                },
                person_iq:  {
                    required: true,
                    number: true
                },
                aid_name: "required",
                address_line_1: "required",
                city: "required",
                state: "required",
                zip: {
                    required: true,
                    number: true
                },
                contact_no: {
                    required: true,
                    number: true
                },
                email: {
                    //required: true,
                    email: true
                },
                aadhar_card: {
                    required: true,
                    number: true
                },
                relation_type: "required",
                relation_name: "required",
                // depdt_address_line_1: "required",
                // depdt_city: "required",
                // depdt_state: "required",
                // depdt_zip: {
                //     required: true,
                //     number: true
                // }
            },
            // Specify validation error messages
            messages: {
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>

<div class="container">
    <div style="position: relative;">
        <h1 class="well">Disability Registration Edit Form</h1>
        <a class="btn btn-lg btn-warning" style="position: absolute; right: 20px; top: 18px;" href="<?php echo SITE_URL.'includes/common_functions.php?mode=logout'; ?>">Log out</a>
    </div>
	<div class="col-lg-12 well">
	    <div class="row">
            <form name="user_register" id="user_register" action="includes/common_functions.php" method="POST" enctype="multipart/form-data"  class="">
                <input type="hidden" name="mode" id="mode" value="update" />
                <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>From No</label>
                            <input type="text" name="form_no" id="form_no" class="form-control" placeholder="From No" readonly="true" value="<?php echo 'KSDH-'.$user_det_row['form_no'] ?>" />
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Camp Place</label>
                            <select name="camp_place" id="camp_place" class="form-control" onchange="change_the_hostipal(this.value)">
                                <option value="Kalna Sub Divisional & Super Speciality Hospital" <?php echo ($user_det_row['camp_place'] == 'Kalna Sub Divisional & Super Speciality Hospital') ? 'selected' : '' ?>>Hospital</option>
                                <option value="outdoor" <?php echo ($user_det_row['camp_place'] == 'outdoor') ? 'selected' : ''; ?>>Outdoor</option>
                            </select>
                        </div>
                        <div class="col-sm-4 form-group" id="hospital_name" style="<?php echo ($user_details_arr['camp_place'] == 'outdoor') ? '' : 'display: none;' ?>">
                            <label>Place of Camp</label>
                            <input type="text" name="hospital_name" id="hospital_name" class="form-control" placeholder="Place name" value="<?php echo $user_det_row['hospital_name'] ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>First Name <span class="required">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name" maxlength="15" value="<?php echo $user_det_row['first_name'] ?>" />
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle name" maxlength="15" value="<?php echo $user_det_row['middle_name'] ?>" />
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Last Name <span class="required">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name" maxlength="15" value="<?php echo $user_det_row['last_name'] ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Gender <span class="required">*</span></label>
                            <select name="gender" class="form-control" id="gender">
                                <option value="">Gender</option>
                                <option value="male" <?php echo ($user_det_row['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                                <option value="female" <?php echo ($user_det_row['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                                <option value="other" <?php echo ($user_det_row['gender'] == 'other') ? 'selected' : '' ?>>Transgender</option>
                            </select>
                        </div>	
                        <div class="col-sm-3 form-group" id="date_of_birth_div">
                            <label>Date of birth</label>
                            <input type="text" name="date_of_birth" id="date_of_birth" readonly="true" class="form-control" placeholder="" value="" />
                            <span class="input-group-addon cal_icon_pos">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Age <span class="required">*</span></label>
                            <input type="text" name="age" id="age" class="form-control" placeholder="Age" maxlength="3" value="<?php echo $user_det_row['age'] ?>" />
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Image</label>
                            <div style="padding-bottom: 10px">
                                <?php 
                                    $user_image = (!empty($user_details_arr['user_image'])) ? $user_details_arr['user_image'] : '';
                                    
                                    if(!empty($user_image)) {
                                        $user_image_path = PHYSICAL_PATH."user_images/thumb/".$user_image;
    
                                        if(file_exists($user_image_path)) 
                                            echo '<img style="width: 100px; border: 1px solid #bababa;" src="'.SITE_URL.'user_images/thumb/'.$user_image.'" style="width: 100%" alt="User Image" />';
                                        else echo '<img style="width: 100px; border: 1px solid #bababa;" src="images/default_photo.png" alt="User Image" />';
                                    }
                                    else echo '<img style="width: 100px; border: 1px solid #bababa" src="images/default_photo.png" alt="User Image" />';
                                ?>
                            </div>
                            <div style="overflow: hidden">
                                <input type="file" name="user_image" id="user_image" value="" />
                            </div>
                        </div>
                    </div>				
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Disability type <span class="required">*</span></label>
                            <select name="disability_type" class="form-control" id="disability_type">
                                <option value="">Disability type</option>
                                <option value="Orthopedically" <?php echo ($user_det_row['disability_type'] == 'Orthopedically') ? 'selected' : '' ?>>Orthopedically</option>
                                <option value="Visionary" <?php echo ($user_det_row['disability_type'] == 'Visionary') ? 'selected' : '' ?>>Visionary</option>
                                <option value="Speech and Hearing Disabled" <?php echo ($user_det_row['disability_type'] == 'Speech and Hearing Disabled') ? 'selected' : '' ?>>Speech and Hearing Disabled</option>
                                <option value="Mentally challenged" <?php echo ($user_det_row['disability_type'] == 'Mentally challenged') ? 'selected' : '' ?>>Mentally challenged</option>
                            </select>
                        </div>	
                        <div class="col-sm-3 form-group">
                            <label>Disability condition <span class="required">*</span></label>
                            <select name="disability_condition" class="form-control" id="disability_condition">
                                <option value="">Disability condition</option>
                                <option value="Permanent disability" <?php echo (($user_det_row['disability_condition'] == 'Permanent') || ($user_det_row['disability_condition'] == 'Permanent disability')) ? 'selected' : '' ?>>Permanent disability</option>
                                <option value="Partial disability" <?php echo ($user_det_row['disability_condition'] == 'Partial disability') ? 'selected' : '' ?>>Partial disability</option>
                                <option value="Rehabilitation" <?php echo ($user_det_row['disability_condition'] == 'Rehabilitation') ? 'selected' : '' ?>>Rehabilitation</option>
                            </select>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Disability Name <span class="required">*</span></label>
                            <input type="text" name="disability_name" id="disability_name" class="form-control" placeholder="Disability name" value="<?php echo $user_det_row['disability_name'] ?>" />
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Happened by <span class="required">*</span></label>
                            <select name="disability_caused_by" class="form-control" id="disability_caused_by">
                                <option value="">Happened by</option>
                                <option value="congenital" <?php echo ($user_det_row['disability_caused_by'] == 'congenital') ? 'selected' : '' ?>>congenital</option>
                                <option value="caused by injury" <?php echo ($user_det_row['disability_caused_by'] == 'caused by injury') ? 'selected' : '' ?>>caused by injury</option>
                                <option value="diseases" <?php echo ($user_det_row['disability_caused_by'] == 'diseases') ? 'selected' : '' ?>>diseases</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">	
                        <div class="col-sm-4 form-group">
                            <label>Disability Percent <span class="required">*</span></label>
                            <input type="text" name="disability_condition_percent" id="disability_condition_percent" maxlength="3" class="form-control" placeholder="Percent" value="<?php echo $user_det_row['disability_condition_percent'] ?>" />
                        </div>	
                        <div class="col-sm-4 form-group">
                            <label>Personal IQ <span class="required">*</span></label>
                            <input type="text" name="person_iq" maxlength="4" id="person_iq" class="form-control" placeholder="IQ" value="<?php echo $user_det_row['person_iq'] ?>" />
                        </div>	
                        <div class="col-sm-4 form-group">
                            <label>IQ category <span class="required">*</span></label>
                            <select name="person_iq_cond" class="form-control" id="person_iq_cond">
                                <option value="">N/A</option>
                                <option value="Mild" <?php echo ($user_det_row['person_iq_cond'] == 'Mild') ? 'selected' : '' ?>>Mild </option>
                                <option value="Moderate" <?php echo ($user_det_row['person_iq_cond'] == 'Moderate') ? 'selected' : '' ?>>Moderate</option>
                                <option value="Severe" <?php echo ($user_det_row['person_iq_cond'] == 'Severe') ? 'selected' : '' ?>>Severe </option>
                                <option value="Profound" <?php echo ($user_det_row['person_iq_cond'] == 'Profound') ? 'selected' : '' ?>>Profound </option>
                            </select>
                        </div>	
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Need assistance of escort</label>
                            <input type="checkbox" name="need_assistance" id="need_assistance" <?php echo ($user_det_row['need_assistance'] == 1) ? 'checked' : '' ?> value="1" />
                        </div>	
                        <div class="col-sm-8 form-group">
                            <label>Name of the Prosthetic aid <span class="required">*</span></label>
                            <input type="text" name="aid_name" id="aid_name" class="form-control" placeholder="Prosthetic aid name" value="<?php echo $user_det_row['aid_name'] ?>" />
                        </div>		
                    </div>
                    <div class="form-group">
                        <label>Address <span class="required">*</span></label>
                        <textarea name="address_line_1" id="address_line_1" placeholder="Enter Address Here." class="form-control"><?php echo $user_det_row['address_line_1'] ?></textarea>
                    </div>	
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>City <span class="required">*</span></label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="City" value="<?php echo $user_det_row['city'] ?>" />
                        </div>	
                        <div class="col-sm-4 form-group">
                            <label>State <span class="required">*</span></label>
                            <select name="state" class="form-control" id="state">
                                <!-- <option value="">State</option> -->
                                <!-- <option value="Andhra Pradesh (AP)">Andhra Pradesh (AP)</option>
                                <option value="Arunachal Pradesh (AR)">Arunachal Pradesh (AR)</option>	
                                <option value="Assam (AS)">Assam (AS)</option>
                                <option value="Bihar (BR)">Bihar (BR)</option>
                                <option value="Chhattisgarh (CHT)">Chhattisgarh (CHT)</option>
                                <option value="Goa (GOA)">Goa (GOA)</option>
                                <option value="Gujarat (GJ)">Gujarat (GJ)</option>	
                                <option value="Haryana (HR)">Haryana (HR)</option>
                                <option value="Himachal Pradesh (HP)">Himachal Pradesh (HP)</option>
                                <option value="Jammu & Kashmir (J & K)">Jammu & Kashmir (J & K)</option>	
                                <option value="Jharkhand (JHK)">Jharkhand (JHK)</option>
                                <option value="Karnataka (KAR)">Karnataka (KAR)</option>
                                <option value="Kerala (KR)">Kerala (KR)</option>	
                                <option value="Ladakh (LD)">Ladakh (LD)</option>
                                <option value="Madhya Pradesh (MP)">Madhya Pradesh (MP)</option>
                                <option value="Maharashtra (MH)">Maharashtra (MH)</option>
                                <option value="Manipur (MN)">Manipur (MN)</option>
                                <option value="Meghalaya (MGH)">Meghalaya (MGH)</option>
                                <option value="Mizoram (MZ)">Mizoram (MZ)</option>
                                <option value="Nagaland (NG)">Nagaland (NG)</option>
                                <option value="New Delhi (DL)">New Delhi (DL)</option>
                                <option value="Odisha (OR)">Odisha (OR)</option>
                                <option value="Puducherry (PUD)">Puducherry (PUD)</option>
                                <option value="Punjab (PB)">Punjab (PB)</option>
                                <option value="Rajasthan (RJ)">Rajasthan (RJ)</option>
                                <option value="Sikkim (SK)">Sikkim (SK)</option>
                                <option value="Tamil Nadu (TN)">Tamil Nadu (TN)</option>
                                <option value="Telangana (TG)">Telangana (TG)</option>
                                <option value="Tripura (TR)">Tripura (TR)</option>
                                <option value="Uttar Pradesh (UP)">Uttar Pradesh (UP)</option>
                                <option value="Uttarakhand (UTK)">Uttarakhand (UTK)</option>	 -->
                                <option value="West Bengal (WB)">West Bengal (WB)</option>
                            </select>
                        </div>	
                        <div class="col-sm-4 form-group">
                            <label>Zip <span class="required">*</span></label>
                            <input type="text" name="zip" id="zip" placeholder="zip" value="<?php echo $user_det_row['zip'] ?>" class="form-control">
                        </div>		
                    </div>
                    <div class="form-group">
                        <label>Special remark</label>
                        <textarea name="special_remark" id="special_remark" class="form-control" placeholder="Special remark" ><?php echo $user_det_row['special_remark'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Phone Number <span class="required">*</span></label>
                            <input type="text" name="contact_no" id="contact_no" placeholder="Phone Number" value="<?php echo $user_det_row['contact_no'] ?>" class="form-control">
                        </div>		
                        <div class="col-sm-6 form-group">
                            <label>Email Address</label>
                            <input type="text" name="email" id="email" placeholder="Email Address" value="<?php echo $user_det_row['email'] ?>" class="form-control">
                        </div>	
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Validity up to <span class="required">*</span></label>
                            <select name="validity_till" class="form-control" id="validity_till">
                                <?php 
                                    for($i=1; $i<=10; $i++) {
                                        $text = ($i > 1) ? 'Years' : 'Year';
                                        $sec = ($user_det_row['validity_till'] == $i) ? 'selected' : '';
                                        echo '<option value='.$i.' '.$sec.' >'.$i.' '.$text.'</option>';
                                    }
                                        
                                ?>
                                <option value="0" <?php echo ($user_det_row['validity_till'] == '0') ? 'selected' : '' ?>>Till Death</option>
                            </select>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Provided Document Type <span class="required">*</span></label>
                            <select name=doc_type" class="form-control" id="doc_type">
                                <option value="Aadhar" <?php echo ($user_det_row['doc_type'] == 'Aadhar') ? 'selected' : '' ?>>Aadhar Card</option>
                                <option value="Voter Card" <?php echo ($user_det_row['doc_type'] == 'Voter Card') ? 'selected' : '' ?>>Voter Card</option>  
                                <option value="Ration Card" <?php echo ($user_det_row['doc_type'] == 'Ration Card') ? 'selected' : '' ?>>Ration Card</option>
                                <option value="other" <?php echo ($user_det_row['doc_type'] == 'other') ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>

                        <div class="col-sm-3 form-group">
                            <label>Document No. <span class="required">*</span></label>
                            <input type="text" name="doc_no" id="doc_no" placeholder="Document No" value="<?php echo $user_det_row['doc_no'] ?>" class="form-control">
                        </div>	
                    </div>
                    <br><br>	
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Relation type <span class="required">*</span></label>
                            <select name="relation_type" class="form-control" id="relation_type">
                                <option value="">Select</option>
                                <option value="Son" <?php echo ($user_det_row['relation_type'] == 'Son') ? 'selected' : '' ?>>Son </option>
                                <option value="Daughter" <?php echo ($user_det_row['relation_type'] == 'Daughter') ? 'selected' : '' ?>>Daughter</option>
                                <option value="Husband" <?php echo ($user_det_row['relation_type'] == 'Husband') ? 'selected' : '' ?>>Husband </option>
                                <option value="Other" <?php echo ($user_det_row['relation_type'] == 'Other') ? 'selected' : '' ?>>Other</option>
                            </select>
                            <div id="other_relation_det" style="<?php echo ($user_det_row['relation_type'] == 'Other') ? '' : 'display:none' ?>">
                                <br>
                                <input type="text" name="relation_type_name" id="relation_type_name" maxlength="45" class="form-control" placeholder="Relation type" value="<?php echo $user_det_row['relation_type_name'] ?>" />
                            </div>
                        </div>	
                        <div class="col-sm-9 form-group">
                            <label>Name <span class="required">*</span></label>
                            <input type="text" name="relation_name" id="relation_name" maxlength="45" class="form-control" placeholder="Name" value="<?php echo $user_det_row['relation_name'] ?>" />
                        </div>	
                        <div class="clearfix"></div> 
                        <div class="col-sm-3 form-group">
                            <label>Address same as above</label>
                            <input type="checkbox" name="new_address" onchange="show_new_address()" <?php echo ($user_det_row['relation_addr_diff'] == 1) ? 'checked' : '' ?> id="new_address" value="1" />
                        </div>
                    </div>
                    <div id="same_as_above" style="<?php echo ($user_det_row['relation_addr_diff'] == 1) ? 'display: none;' : '' ?>">
                        <div class="form-group">
                            <label>Address <span class="required">*</span></label>
                            <textarea name="depdt_address_line_1" id="depdt_address_line_1" placeholder="Enter Address Here." class="form-control"><?php echo $user_det_row['depdt_address_line_1'] ?></textarea>
                        </div>	
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>City <span class="required">*</span></label>
                                <input type="text" name="depdt_city" id="depdt_city" class="form-control" placeholder="City" value="<?php echo $user_det_row['depdt_city'] ?>" />
                            </div>	
                            <div class="col-sm-4 form-group">
                                <label>State <span class="required">*</span></label>
                                <select name="depdt_state" class="form-control" id="depdt_state">
                                    
                                    <option value="West Bengal (WB)">West Bengal (WB)</option>
                                </select>
                            </div>	
                            <div class="col-sm-4 form-group">
                                <label>Zip <span class="required">*</span></label>
                                <input type="text" name="depdt_zip" id="depdt_zip" value="<?php echo $user_det_row['depdt_zip'] ?>" placeholder="zip" class="form-control">
                            </div>		
                        </div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-lg btn-info">Submit</button>			
                    <a style="float: right;" class="btn btn-lg btn-info" href="<?php echo SITE_URL.'index.php?pages=disability_list'; ?>">Back</a>		
                </div>
            </form> 
		</div>
	</div>
</div>