<?php 

    function convert_to_text($number = 0) {
        if($number > 0 && !empty($number)) {
            $no         = floor($number);
            $point      = round($number - $no, 2) * 100;
            $hundred    = null;
            $digits_1   = strlen($no);
            $i          = 0;
            $str        = array();
            $words      = array('0' => '', '1' => 'one', '2' => 'two',
                            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                            '7' => 'seven', '8' => 'eight', '9' => 'nine',
                            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                            '13' => 'thirteen', '14' => 'fourteen',
                            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
                            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                            '60' => 'sixty', '70' => 'seventy',
                            '80' => 'eighty', '90' => 'ninety');
            $digits     = array('', 'hundred', 'thousand', 'lakh', 'crore');
            
            while ($i < $digits_1) {

                $divider    = ($i == 2) ? 10 : 100;
                $number     = floor($no % $divider);
                $no         = floor($no / $divider);
                $i += ($divider == 10) ? 1 : 2;

                if ($number) {
                    $plural     = (($counter = count($str)) && $number > 9) ? 's' : null;
                    $hundred    = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str []     = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred
                        :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
                } else $str[] = null;
            }
            $str            = array_reverse($str);
            $result         = implode('', $str);
            $points         = ($point) ?
                                "." . $words[$point / 10] . "" . 
                                    $words[$point = $point % 10] : '';
            $final_result   = $result;

            return trim($final_result);
        }
        else return 'N/A';
    }

    if ($_SESSION['is_logged_in'] != 1) {
        header("Location:".$site_url."index.php?pages=login");
    }

    $connect_string = 'localhost';
    $connect_username = 'root';
    $connect_password = '';
    $connect_db = 'disability_db';
    
    $link 	= mysqli_connect($connect_string,$connect_username,$connect_password,$connect_db);
 
    $user_id_arr    = explode('-', $_REQUEST['tmp_id']);
    $user_id        = (isset($user_id_arr[1]) && !empty($user_id_arr['1'])) ? $user_id_arr[1] : $_REQUEST['tmp_id']; 

    if(!empty($user_id)) {
        $user_details_arr   = array();
        $user_details       = "SELECT * FROM disability_users WHERE id = ".trim($user_id);

        $user_details_q     = mysqli_query($link, $user_details);

        if(mysqli_num_rows($user_details_q)>0)
        {
            $user_det_row  = mysqli_fetch_array($user_details_q);

            $user_details_arr['id']         = $user_det_row['id'];
            $user_details_arr['form_no']       = $user_det_row['form_no'];
            $user_details_arr['first_name']       = $user_det_row['first_name'];
            $user_details_arr['middle_name']         = $user_det_row['middle_name'];
            $user_details_arr['last_name']       = $user_det_row['last_name'];
            $user_details_arr['gender']       = $user_det_row['gender'];
            $user_details_arr['age']         = $user_det_row['age'];
            $user_details_arr['disability_type']       = $user_det_row['disability_type'];
            $user_details_arr['disability_name']       = $user_det_row['disability_name'];
            $user_details_arr['phy_other_det']          = $user_det_row['phy_other_det'];
            $user_details_arr['disability_condition']         = $user_det_row['disability_condition'];
            $user_details_arr['disability_caused_by']       = $user_det_row['disability_caused_by'];
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

            //echo '<pre>'; print_r($user_details_arr); echo '</pre>';
?>
    <link href="css/print.css" rel="stylesheet">
    <script>
        
    </script>
    <div class="container container_1 well_2">
        <fieldset>
            <div class="col-sm-12 position_center">
                <!-- Form Name -->
                <legend class="logo-image-outer no-border">
                    <center><div class="col-sm-2 no-float"><img class="logo-image" src="images/Emblem_of_West_Bengal.png" alt="Emblem_of_West_Bengal" /></div></center>
                </legend>
                <div class="margin-bottom-30"></div>
                <!-- <div class="header_text"> -->
                    <legend class="no-border"><center><h2><b class="text-upper" style="font-family: 'Acme';">Government of West Bengal</b></h2></center></legend>
                    <legend class="no-border"><center><h2><b class="text-upper" style="font-family: 'Acme';">Office of The Superintendent, Kalna S.D. & S.S. Hospital</b></h2></center></legend>
                    <legend class="no-border"><center><h2 class="text-upper" style="font-family: 'Merriweather Sans';"><b>Kalna    *    Purba Bardhaman</b></h2></center></legend>
                    <legend class="no-border"><center><h2><p class="outer-border text-upper" style="font-family: 'Merriweather Sans';"><b>Disability Certificate</b></p></h2></center></legend>
                <!-- </div> -->
                <legend class="no-border"><center><p class="text-size-17">Certificate issued as per order No. HF / O/PHP /292/HAD/9M-57-2002 (P/1); Dated : 08.05.2003</p></center></legend>
                <!-- Text input-->
                <div class="description_content">
                    <div class="description_top">
                        <div class="col-sm-3 outer_border_pic">
                            <?php 
                                $user_image = (!empty($user_details_arr['user_image'])) ? $user_details_arr['user_image'] : '';
                                
                                if(!empty($user_image)) {
                                    $user_image_path = PHYSICAL_PATH."user_images/thumb/".$user_image;

                                    if(file_exists($user_image_path)) 
                                        echo '<img src="'.SITE_URL.'user_images/thumb/'.$user_image.'" style="width: 100%" alt="User Image" />';
                                    else echo '<img src="images/default_photo.png" alt="User Image" />';
                                }
                                else echo '<img src="images/default_photo.png" alt="User Image" />';
                            ?>
                        </div>
                        <div class="col-sm-9">
                            <div class="first_sec">
                                <div class="col-sm-6 text-left padding_left_0">
                                    <span class="text-size-18">No.- </span>
                                    <span class="text-size-18"><?php echo (!empty($user_details_arr['form_no'])) ? 'KSDH/'.$user_details_arr['form_no'] : 'KSDH/1'; ?></span>
                                </div>
                                <div class="col-sm-6 text-right date_sec">
                                    <span class="text-size-18">Date : </span>
                                    <span><?php echo date('d', strtotime($user_det_row['added_on'])); ?></span>
                                    <span>/</span>
                                    <span><?php echo date('m', strtotime($user_det_row['added_on'])); ?></span>
                                    <span>/<?php echo date('Y', strtotime($user_det_row['added_on'])); ?></span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="second_sec">
                                <div class="padding-top-10 padding_left_0 padding_right_0">
                                    <span class="col-sm-6 padding_left_0 padding_right_0 text-size-18">
                                        On our examination of 
                                        <?php 
                                            if(!empty($user_details_arr['gender']) && ($user_details_arr['gender'] != 'Other'))
                                                echo ($user_details_arr['gender'] == 'male') ? 'Shri' : 'Smt'; 
                                            else echo 'Shri/Smt';
                                        ?>
                                    </span>
                                    <span class="bottom_border col-sm-6 padding_left_0 padding_right_0 text-center text-size-18"><?php echo ucfirst($user_details_arr['first_name']).' '.ucfirst($user_details_arr['middle_name']).' '.ucfirst($user_details_arr['last_name']) ?></span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="third_sec">
                                <div class="col-sm-4 padding-top-10 padding_left_0 padding_right_0">
                                    <span class="text-size-18">aged about</span> 
                                    <span class="bottom_border text-center text-size-18"><?php echo $user_details_arr['age'] ?></span>
                                </div>
                                <div class="col-sm-8 padding-top-10 padding_left_0 padding_right_0">
                                    <span class="text-size-18">Years <?php echo (!empty($user_details_arr['relation_type']) && ($user_details_arr['relation_type'] != 'Other')) ? $user_details_arr['relation_type'].' of' : $user_det_row['relation_type_name'].' of'; ?></span>
                                    <span class="bottom_border text-size-18"><?php echo (!empty($user_details_arr['relation_name'])) ? $user_details_arr['relation_name'] : ''; ?></span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="forth_sec">
                                <div class="col-sm-2 padding-top-10 padding_left_0 padding_right_0 text-size-18";>Address</div>
                                <div class="col-sm-10 padding-top-10 padding_left_0 padding_right_0 text-size-18";">
                                    <p class="bottom_border"><?php echo $user_details_arr['address_line_1']; ?> </p>
                                    <p class="bottom_border">
                                        <?php
                                            echo $user_details_arr['city'].', '.$user_details_arr['state'].', '.$user_details_arr['zip'];
                                        ?>
                                    </p>
                                </div>
                                <span class="text-size-18">it is certified that -</span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <ul class="description_list text-size-18">
                        <li class"list_items>
                            <span>
                                <?php 
                                    if(!empty($user_details_arr['gender']) && ($user_details_arr['gender'] != 'Other'))
                                        echo ($user_details_arr['gender'] == 'male') ? 'He' : 'She'; 
                                    else echo 'He/She';
                                ?>
                                is a <?php echo ($user_details_arr['disability_type'] == 'Mentally challenged') ? 'Mentally challenged' : 'Physically challenged' ?>
                            </span>
                            <span> 
                                <?php 
                                    if($user_details_arr['disability_type'] == 'Physically challenged')
                                        echo '';
                                    else if($user_details_arr['disability_type'] == 'Physically challenged others')
                                        echo '('.$user_details_arr['phy_other_det'].')';
                                    else if ($user_details_arr['disability_type'] == 'Mentally challenged')
                                        echo '';
                                    else echo '('.$user_details_arr['disability_type'].')';
                                    
                                ?> person with (Nature of disability)</span>
                            <span class="bottom_border"><?php echo $user_details_arr['disability_name'];  ?></span>
                        </li>
                        <li>
                            <span>
                                The disability reportedly in 
                                <?php   
                                    echo ($user_details_arr['disability_caused_by'] == 'diseases') ?
                                        $user_details_arr['disability_caused_by'].' not likely to respond to any <span>sorts of treatment.</span>' : 
                                        $user_details_arr['disability_caused_by'].'.';
                                ?>
                            </span>
                        </li>
                        <li>
                            <span>
                                <?php 
                                    if(!empty($user_details_arr['gender']) && ($user_details_arr['gender'] != 'Other'))
                                        echo ($user_details_arr['gender'] == 'male') ? 'His' : 'Her';
                                    else echo 'His/Her'; 
                                ?>
                                percentage of <?php echo $user_details_arr['disability_condition']; ?> is calculated as</span>
                                <span class="bottom_border"><?php echo $user_details_arr['disability_condition_percent'].' <span class="text-size-12">('.ucfirst(convert_to_text($user_details_arr['disability_condition_percent'])).')</span>';  ?></span>%
                        </li>
                        <li>
                            <span>
                                <?php 
                                    if(!empty($user_details_arr['gender']) && ($user_details_arr['gender'] != 'Other'))
                                        echo ($user_details_arr['gender'] == 'male') ? 'He' : 'She'; 
                                    else echo 'He/She'; 
                                ?> 
                                being a Mentally Retarded person with an IQ of <span class="bottom_border"><?php echo ($user_details_arr['person_iq'] > 0) ? $user_details_arr['person_iq'].' <span class="text-size-12">('.ucfirst(convert_to_text($user_details_arr['person_iq'])).')</span>' : '<span class="text-size-12">N/A</span>' ?></span> falls</span>
                            <span>under the category of <?php echo !empty($user_details_arr['person_iq_cond']) ? $user_details_arr['person_iq_cond']: 'N/A';  ?>.</span>
                        </li>
                        <li>
                            <span>The assessment has been made as per instruction issued by the Government of India vide No.</span>
                            <span>4-2/83 IIII dated. 06081986 /No. 16-18/97-NI dated 18.02.2002</span>
                        </li>
                        <li>
                            <span>
                                <?php 
                                    if(!empty($user_details_arr['gender']) && ($user_details_arr['gender'] != 'Other'))
                                        echo ($user_details_arr['gender'] == 'male') ? 'He' : 'She'; 
                                    else echo 'He/She'; 
                                ?>
                                may be provided with assistance of escort. 
                                <?php 
                                    echo ($user_details_arr['need_assistance'] == '1') ? '<span class="bottom_border"> - Yes</span>' : '<span class="bottom_border"> - No</span>'; 
                                ?>
                                .</span>
                        </li>
                        <li>
                            <span><?php 
                                    if(!empty($user_details_arr['gender']) && ($user_details_arr['gender'] != 'Other'))
                                        echo ($user_details_arr['gender'] == 'male') ? 'He' : 'She';
                                    else echo 'He/She';  
                                ?> may be provided with
                            </span>
                            <span class="bottom_border"><?php echo $user_details_arr['aid_name'];  ?></span>
                            <span>    (name of the prosthetic aid)</span>
                            <p style="margin: 0;">Which will increase <?php 
                                if(!empty($user_details_arr['gender']) && ($user_details_arr['gender'] != 'Other'))
                                    echo ($user_details_arr['gender'] == 'male') ? 'His' : 'Her'; 
                                else echo 'His/Her'; 
                                ?> mobility and functional independence.</p>
                        </li>
                        <li>
                            <span>Special remark, if any </span> <span class="bottom_border"> &nbsp;&nbsp;<?php echo $user_details_arr['special_remark'];  ?></span>
                        </li>
                        <li>
                            <span>This disability certificate is valid for <span class="bottom_border" style="border-bottom: 1px dotted black"><?php echo ($user_details_arr['validity_till'] != '0')  ? $user_details_arr['validity_till'].' <span class="text-size-12">('.ucfirst(convert_to_text($user_details_arr['validity_till'])).') </span> years' : 'Till death';  ?></span> from the date if Issue.</span>
                        </li>
                    </ul>
                    <br><br>
                    <div class="col-sm-6">
                        <p class="bottom_border"></p>
                        <span class="text-size-18">Signature/L.T.I of the Candidate</span>
                    </div>
                    <div class="clearfix"></div>
                    <br><br>
                    <div class="member_sign">
                        <div class="col-sm-3">
                            <p class="bottom_border"></p>
                            <p class="text-center">Member</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="bottom_border"></p>
                            <p class="text-center">Member</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="bottom_border"></p>
                            <p class="text-center">Member</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="bottom_border"></p>
                            <p class="text-center">Member</p>
                        </div>
                    </div>
                    <br><br><br>
                    <div class="stamp_area text-center" style="font-family: 'Merriweather Sans'; font-weight: 700;">
                        <p style="margin: 0;">Chairman of the Board</p>
                        <p style="margin: 0;">Kalna S.D. & S.S Hospital</p>
                        <p style="margin: 0;">Kalna, Purba Bardhman</p>
                        
                    </div>
                    <button style="margin: 10px auto auto; display: block;" type="submit" onclick="document.title='<?php echo 'KSDH-'.$user_details_arr['form_no'] ?> - Disability Certificate-<?php echo date('d-m-Y') ?>'; window.print();" class="btn btn-lg btn-info print_hide">Print</button>			
                </div>
            </div>
        </fieldset>
    </div>
<?php 
        }
        else {
            $_SESSION['error_msg']  = 'Failed to preview data. Please try again';
            header("Location:".$site_url."index.php?pages=disability_list");
        }
    }
    else {
        $_SESSION['error_msg']  = 'Failed to preview data. Please try again';
        header("Location:".$site_url."index.php?pages=disability_list");
    }


?>

