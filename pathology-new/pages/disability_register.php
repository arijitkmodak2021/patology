<?php 
    if ($_SESSION['is_logged_in'] != 1) {
        header("Location:".$site_url."index.php?pages=login");
    }

    $connect_string = 'localhost';
    $connect_username = 'root';
    $connect_password = '';
    $connect_db = 'disability_db';
    
    $link 	= mysqli_connect($connect_string,$connect_username,$connect_password,$connect_db);

    function generate_numbers($start, $count, $digits) {
        $count  = 1;
        //$result = str_pad($start+$count, $digits, "0", STR_PAD_LEFT);
        $result = $start+$count;
        return $result;
    }

    $last_user_details      = mysqli_fetch_array(mysqli_query($link, "SELECT form_no FROM disability_users order by form_no desc limit 1;"));
    //echo '<pre>'; print_r($last_user_details); echo '</pre>';
    $new_form_no            = (!empty($last_user_details)) ? generate_numbers((int) $last_user_details['form_no'], 1, 5) : '1';
?>

<script>
    function change_the_hostipal(val) {
        console.log('Arijit');
        console.log(val);

        if(val == 'outdoor') {
            $('#hospital_name').show();
            //$('#hospital_name').val('');
        }
        else {
            $('#hospital_name').hide();
            $('#hospital_name').val('');
        }
    }

    function change_the_relation(val) {
        
        if(val == 'Other') {
            $('#other_relation_det').show();
        }
        else {
            $('#other_relation_det').hide();
            $('#other_relation_det').val('');
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

    // Wait for the DOM to be ready
    $(function() {
        $(function () {
            $('#date_of_birth_div').datetimepicker({ 
                pickTime: false, 
                format: 'DD-MM-YYYY',
            }).change(dateChanged)
            .on('changeDate', dateChanged);
        });

        $(function () {
            $('#date_of_reg_div').datetimepicker({ 
                pickTime: false, 
                format: 'DD-MM-YYYY',
            })
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
                date_of_birth: "required",
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
                doc_no: {
                    required: false,
                    number: false
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
        <h1 class="well">Disability Registration Form</h1>
        <a class="btn btn-lg btn-warning" style="position: absolute; right: 20px; top: 18px;" href="<?php echo SITE_URL.'includes/common_functions.php?mode=logout'; ?>">Log out</a>
    </div>
	<div class="col-lg-12 well">
	    <div class="row">
            <form name="user_register" id="user_register" action="includes/common_functions.php" method="POST" enctype="multipart/form-data"  class="">
                <input type="hidden" name="mode" id="mode" value="register" />
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>From No</label>
                            <input type="text" name="form_no" id="form_no" class="form-control" placeholder="From No" readonly="true" value="<?php echo 'KSDH/'.$new_form_no; ?>" />
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Camp Place</label>
                            <select name="camp_place" id="camp_place" class="form-control" onchange="change_the_hostipal(this.value)">
                                <option value="Kalna Sub Divisional & Super Speciality Hospital">Hospital</option>
                                <option value="outdoor">Outdoor</option>
                            </select>
                        </div>
                        <div class="col-sm-3 form-group" id="hospital_name" style="display: none;">
                            <label>Place of Camp</label>
                            <input type="text" name="hospital_name" id="hospital_name" class="form-control" placeholder="Place name" value="" />
                        </div>
                        <div class="col-sm-3 form-group"  id="date_of_reg_div">
                            <label>Registration Date</label>
                            <input type="text" name="registration_date" id="registration_date" readonly="true" class="form-control" placeholder="registration_date" value="" />
                            <span class="input-group-addon cal_icon_pos">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>First Name <span class="required">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name" maxlength="15" value="" />
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle name" maxlength="15" value="" />
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Last Name <span class="required">*</span></label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name" maxlength="15" value="" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Gender <span class="required">*</span></label>
                            <select name="gender" class="form-control" id="gender">
                                <option value="">Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="Other">Transgender</option>
                            </select>
                        </div>	
                        <div class="col-sm-3 form-group" id="date_of_birth_div">
                            <label>Date of birth <span class="required">*</span></label>
                            <input type="text" name="date_of_birth" id="date_of_birth" class="form-control" readonly="true" placeholder="" value="" />
                            <span class="input-group-addon cal_icon_pos">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Age <span class="required">*</span></label>
                            <input type="text" name="age" id="age" class="form-control" placeholder="Age" maxlength="3" value="" />
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Image</label>
                            <input type="file" name="user_image" id="user_image" value="" />
                        </div>
                    </div>				
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Disability type <span class="required">*</span></label>
                            <select name="disability_type" class="form-control" id="disability_type">
                                <option value="">Disability type</option>
                                <option value="Orthopedically">Orthopedically</option>
                                <option value="Visionary">Visionary</option>
                                <option value="Speech and Hearing Disabled">Speech and Hearing Disabled</option>
                                <option value="Mentally challenged">Mentally challenged</option>
                            </select>
                        </div>	
                        <div class="col-sm-3 form-group">
                            <label>Disability condition <span class="required">*</span></label>
                            <select name="disability_condition" class="form-control" id="disability_condition">
                                <option value="">Disability condition</option>
                                <option value="Permanent disability">Permanent disability</option>
                                <option value="Partial disability">Partial disability</option>
                                <option value="Rehabilitation">Rehabilitation changes of variation</option>
                            </select>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Disability Name <span class="required">*</span></label>
                            <input type="text" name="disability_name" id="disability_name" class="form-control" placeholder="Disability name" value="" />
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Happened by <span class="required">*</span></label>
                            <select name="disability_caused_by" class="form-control" id="disability_caused_by">
                                <option value="">Happened by</option>
                                <option value="congenital">congenital</option>
                                <option value="caused by injury">caused by injury</option>
                                <option value="diseases">diseases</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">	
                        <div class="col-sm-4 form-group">
                            <label>Disability Percent <span class="required">*</span></label>
                            <input type="text" name="disability_condition_percent" id="disability_condition_percent" maxlength="3" class="form-control" placeholder="Percent" value="" />
                        </div>	
                        <div class="col-sm-4 form-group">
                            <label>Personal IQ <span class="required">*</span></label>
                            <input type="text" name="person_iq" maxlength="4" id="person_iq" class="form-control" placeholder="IQ" value="" />
                        </div>	
                        <div class="col-sm-4 form-group">
                            <label>IQ category <span class="required">*</span></label>
                            <select name="person_iq_cond" class="form-control" id="person_iq_cond">
                                <option value="">IQ category</option>
                                <option value="Mild">Mild </option>
                                <option value="Moderate">Moderate</option>
                                <option value="Severe">Severe </option>
                                <option value="Profound">Profound </option>
                            </select>
                        </div>	
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>Need assistance of escort</label>
                            <input type="checkbox" name="need_assistance" id="need_assistance" value="1" />
                        </div>	
                        <div class="col-sm-8 form-group">
                            <label>Name of the Prosthetic aid <span class="required">*</span></label>
                            <input type="text" name="aid_name" id="aid_name" class="form-control" placeholder="Prosthetic aid name" value="" />
                        </div>		
                    </div>
                    <div class="form-group">
                        <label>Address <span class="required">*</span></label>
                        <textarea name="address_line_1" id="address_line_1" placeholder="Enter Address Here." class="form-control"></textarea>
                    </div>	
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>City <span class="required">*</span></label>
                            <input type="text" name="city" id="city" class="form-control" placeholder="City" value="" />
                        </div>	
                        <div class="col-sm-4 form-group">
                            <label>State <span class="required">*</span></label>
                            <select name="state" class="form-control" id="state">
                                <option value="">State</option>
                                <option value="Andhra Pradesh (AP)">Andhra Pradesh (AP)</option>
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
                                <option value="Uttarakhand (UTK)">Uttarakhand (UTK)</option>	
                                <option value="West Bengal (WB)">West Bengal (WB)</option>
                            </select>
                        </div>	
                        <div class="col-sm-4 form-group">
                            <label>Zip <span class="required">*</span></label>
                            <input type="text" name="zip" id="zip" placeholder="zip" class="form-control">
                        </div>		
                    </div>
                    <div class="form-group">
                        <label>Special remark</label>
                        <textarea name="special_remark" id="special_remark" class="form-control" placeholder="Special remark" ></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Phone Number <span class="required">*</span></label>
                            <input type="text" name="contact_no" id="contact_no" placeholder="Phone Number" class="form-control">
                        </div>		
                        <div class="col-sm-6 form-group">
                            <label>Email Address</label>
                            <input type="text" name="email" id="email" placeholder="Email Address" class="form-control">
                        </div>	
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Validity up to <span class="required">*</span></label>
                            <select name="validity_till" class="form-control" id="validity_till">
                                <?php 
                                    for($i=1; $i<=10; $i++) {
                                        $text = ($i > 1) ? 'Years' : 'Year';
                                        echo '<option value='.$i.'>'.$i.' '.$text.'</option>';
                                    }
                                ?>
                                <option value="0">Till Death</option>
                            </select>
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>Provided Document Type <span class="required">*</span></label>
                            <select name=doc_type" class="form-control" id="doc_type">
                                <option value="Aadhar">Aadhar Card</option>
                                <option value="Voter Card">Voter Card</option>  
                                <option value="Ration Card">Ration Card</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="col-sm-3 form-group">

                            <label>Document No. <span class="required">*</span></label>
                            <input type="text" name="doc_no" id="doc_no" placeholder="Document No." class="form-control">
                        </div>

                    </div>
                    <br><br>	
                    <div class="row">
                        <div class="col-sm-3 form-group">
                            <label>Relation type <span class="required">*</span></label>
                            <select name="relation_type" class="form-control" id="relation_type" onchange="change_the_relation(this.value)">
                                <option value="">Select</option>
                                <option value="Son">Son </option>
                                <option value="Daughter">Daughter</option>
                                <option value="Husband">Wife </option>
                                <option value="Other">Other</option>
                            </select>
                            <div id="other_relation_det" style="display:none">
                                <br>
                                <input type="text" name="relation_type_name" id="relation_type_name" maxlength="45" class="form-control" placeholder="Relation type" value="" />
                            </div>
                        </div>	
                        <div class="col-sm-9 form-group">
                            <label>Name <span class="required">*</span></label>
                            <input type="text" name="relation_name" id="relation_name" maxlength="45" class="form-control" placeholder="Name" value="" />
                        </div>	
                        <div class="clearfix"></div> 
                        <div class="col-sm-3 form-group">
                            <label>Address same as above</label>
                            <input type="checkbox" name="new_address" checked="checked" onchange="show_new_address()" id="new_address" value="1" />
                        </div>
                    </div>
                    <div id="same_as_above" style="display: none;">
                        <div class="form-group">
                            <label>Address <span class="required">*</span></label>
                            <textarea name="depdt_address_line_1" id="depdt_address_line_1" placeholder="Enter Address Here." class="form-control"></textarea>
                        </div>	
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>City <span class="required">*</span></label>
                                <input type="text" name="depdt_city" id="depdt_city" class="form-control" placeholder="City" value="" />
                            </div>	
                            <div class="col-sm-4 form-group">
                                <label>State <span class="required">*</span></label>
                                <select name="depdt_state" class="form-control" id="depdt_state">
                                    <option value="">State</option>
                                    <option value="Andhra Pradesh (AP)">Andhra Pradesh (AP)</option>
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
                                    <option value="Uttarakhand (UTK)">Uttarakhand (UTK)</option>	
                                    <option value="West Bengal (WB)">West Bengal (WB)</option>
                                </select>
                            </div>	
                            <div class="col-sm-4 form-group">
                                <label>Pin <span class="required">*</span></label>
                                <input type="text" name="depdt_zip" id="depdt_zip" placeholder="zip" class="form-control">
                            </div>		
                        </div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-lg btn-info">Preview</button>			
                    <a style="float: right;" class="btn btn-lg btn-info" href="<?php echo SITE_URL.'index.php?pages=disability_list'; ?>">Back</a>		
                </div>
            </form> 
		</div>
	</div>
</div>