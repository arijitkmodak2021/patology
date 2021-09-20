<?php
    include("config.php");
    include("functions.php");

    
    $mode_name  = (isset($_REQUEST['mode'])) ? $_REQUEST['mode'] : '';

    if ($mode_name == 'admin_login') {
        print_r($_REQUEST);
        die;

        $login_sql  = "SELECT * FROM admin WHERE user_name='".mysqli_real_escape_string($link, $_REQUEST['user_name'])."' AND password='".$_REQUEST['password']."' ";
        
        $login_rs       = mysqli_query($link, $login_sql);

        if(mysqli_num_rows($login_rs)>0)
        {
            $login_row  = mysqli_fetch_array($login_rs);

            $subadmin=$login_row['id'];
            $_SESSION['userId'] = $login_row['id'];
            $_SESSION['username'] = $login_row['user_name'];
            $_SESSION['password'] = $login_row['password'];
            $_SESSION['is_logged_in'] = 1;
            $_SESSION['is_sub_user'] = 0;
            $_SESSION['success_msg']  = '';

            //echo 'Arijit'; die;
            header("Location:".$site_url."index.php?pages=disability_list");
        }
        else{
            $_SESSION['error_msg']  = 'Invalid username or password. Please try again.';
            header("Location:".$site_url."index.php?pages=login");
        }
    }
    elseif($mode_name == 'user_login') {

        print_r($_REQUEST);
        //$login_type = (isset($_REQUEST['login_type'])) ? $_REQUEST['login_type'] : 'opt';
        $login_sql  = "SELECT * FROM users WHERE user_name='".mysqli_real_escape_string($link, $_REQUEST['loginUsername'])."' AND password='".$_REQUEST['loginPassword']."' ";
        //echo 'A: '.$login_sql; die;
        $login_rs       = mysqli_query($link, $login_sql);

        if(mysqli_num_rows($login_rs)>0)
        {
            $login_row  = mysqli_fetch_array($login_rs);

            $subadmin=$login_row['id'];
            $_SESSION['userId'] = $login_row['id'];
            $_SESSION['username'] = $login_row['user_name'];
            $_SESSION['password'] = $login_row['password'];
            $_SESSION['is_logged_in'] = 1;
            $_SESSION['is_sub_user'] = $login_row['is_subadmin'];
            $_SESSION['success_msg']  = '';

            if($_REQUEST['remember_chck'] == 1) {
                $_COOKIE['loginUsername'] = $login_row['user_name'];
                $_COOKIE['loginPassword'] = $login_row['password'];
                $_COOKIE['remember_chck'] = 1;
                
                setcookie('loginUsername', $login_row['user_name'], time()+60*60*24*365, '/');
                setcookie('loginPassword', $login_row['password'], time()+60*60*24*365, '/');
                setcookie('remember_chck', 1, time()+60*60*24*365, '/'); 
            }
            else{
                unset($_COOKIE['loginUsername']);
                unset($_COOKIE['loginPassword']);
                unset($_COOKIE['remember_chck']);
                
                setcookie('loginUsername', null, -1, '/');
                setcookie('loginPassword', null, -1, '/');
                setcookie('remember_chck', null, -1, '/');
            }
            
            //print_r($_COOKIE);die;
            header("Location:".$site_url."index.php?pages=disability_list");
        }
        else {
            $_SESSION['error_msg']  = 'Invalid username or password. Please try again.';
            header("Location:".$site_url."index.php?pages=login");
        }
    }
    elseif($mode_name == 'logout') {
        
        unset($_SESSION['userId']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['is_logged_in']);

        header("Location:".$site_url."index.php?pages=login");

    }
    elseif($mode_name == 'confirm_submit') {

        $user_id    = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : 0;
        
        if(!empty($user_id)) {

            //get last form no
            $last_user_details  = mysqli_fetch_array(mysqli_query($link, "SELECT form_no FROM disability_users order by form_no desc limit 1;"));
            $new_form_no        = (!empty($last_user_details)) ? generate_numbers((int) $last_user_details['form_no'], 1, 5) : '1'; 
            $user_details       = "SELECT * FROM disability_users_tmp WHERE id = '".$user_id."'";
            $user_details_q     = mysqli_query($link, $user_details);

            if(mysqli_num_rows($user_details_q)>0)  {
                $user_det_row   = mysqli_fetch_array($user_details_q);


                $insert_query   =   'insert into disability_users set 
                                    form_no = "'.$new_form_no.'", 
                                    camp_place = "'.$user_det_row['camp_place'].'", 
                                    hospital_name = "'.$user_det_row['hospital_name'].'", 
                                    first_name = "'.$user_det_row['first_name'].'", 
                                    middle_name = "'.$user_det_row['middle_name'].'", 
                                    last_name = "'.$user_det_row['last_name'].'", 
                                    gender = "'.$user_det_row['gender'].'", 
                                    age = "'.$user_det_row['age'].'", 
                                    date_of_birth = "'.$user_det_row['date_of_birth'].'", 
                                    disability_type = "'.$user_det_row['disability_type'].'", 
                                    phy_other_det = "'.$user_det_row['phy_other_det'].'", 
                                    disability_name = "'.$user_det_row['disability_name'].'", 
                                    disability_condition = "'.$user_det_row['disability_condition'].'", 
                                    disability_condition_percent = "'.$user_det_row['disability_condition_percent'].'",
                                    disability_caused_by = "'.$user_det_row['disability_caused_by'].'",
                                    person_iq = "'.$user_det_row['person_iq'].'",  
                                    person_iq_cond = "'.$user_det_row['person_iq_cond'].'", 
                                    need_assistance = "'.$user_det_row['need_assistance'].'", 
                                    aid_name = "'.$user_det_row['aid_name'].'", 
                                    special_remark = "'.$user_det_row['special_remark'].'", 
                                    address_line_1 = "'.$user_det_row['address_line_1'].'", 
                                    city = "'.$user_det_row['city'].'", 
                                    state = "'.$user_det_row['state'].'", 
                                    zip = "'.$user_det_row['zip'].'", 
                                    contact_no = "'.$user_det_row['contact_no'].'", 
                                    email = "'.$user_det_row['email'].'", 
                                    validity_till = "'.$user_det_row['validity_till'].'",
                                    doc_type = "'.$user_det_row['doc_type'].'",
                                    doc_no = "'.$user_det_row['doc_no'].'",
                                    relation_type = "'.$user_det_row['relation_type'].'", 
                                    relation_type_name = "'.$user_det_row['relation_type_name'].'", 
                                    relation_name = "'.$user_det_row['relation_name'].'", 
                                    relation_addr_diff = "'.$user_det_row['relation_addr_diff'].'",
                                    depdt_address_line_1 = "'.$user_det_row['depdt_address_line_1'].'",
                                    depdt_city = "'.$user_det_row['depdt_city'].'",
                                    depdt_state = "'.$user_det_row['depdt_state'].'",
                                    depdt_zip = "'.$user_det_row['depdt_zip'].'",
                                    user_image = "'.$user_det_row['user_image'].'",
                                    status = "1",
                                    added_on = "'.$user_det_row['added_on'].'"';
                                    
                //echo $insert_query; die;
                if(mysqli_query($link, $insert_query)) {

                    //$delete_statement = 'DELETE from disability_users_tmp where id = "'.$user_id.'"';
                    //mysqli_query($link, $delete_statement);

                    echo 1;
                }
                else echo 0;
            }
            else echo 0;
        }
        else echo 0;
    }
    elseif($mode_name == 'register') {
        //echo '<pre>'; print_r($_REQUEST); echo '</pre>';
        //echo '<pre>'; print_r($_FILES); echo '</pre>';
        $adddr_same_av          = isset($_REQUEST['new_address']) ? $_REQUEST['new_address'] : 1;
        $depdt_address_line_1   = ($adddr_same_av == 1) ? addslashes(stripslashes($_REQUEST['address_line_1'])) : addslashes(stripslashes($_REQUEST['depdt_address_line_1']));
        $depdt_city             = ($adddr_same_av == 1) ? addslashes(stripslashes($_REQUEST['city'])) : addslashes(stripslashes($_REQUEST['depdt_city']));
        $depdt_state            = ($adddr_same_av == 1) ? addslashes(stripslashes($_REQUEST['state'])) : addslashes(stripslashes($_REQUEST['depdt_state']));
        $depdt_zip              = ($adddr_same_av == 1) ? addslashes(stripslashes($_REQUEST['zip'])) : addslashes(stripslashes($_REQUEST['depdt_zip']));
        
        echo $registration_date      = (isset($_REQUEST['registration_date']) && !empty($_REQUEST['registration_date'])) ? $_REQUEST['registration_date'] : '';

        if(!empty($registration_date) && (strtotime($registration_date) != strtotime(date('d-m-yy')))) $added_on    = date('Y-m-d H:i:s', strtotime($registration_date));
        else  $added_on         = date('Y-m-d H:i:s');


        $insert_query   =  'insert into disability_users_tmp set 
                            form_no = "'.addslashes(stripslashes($_REQUEST['form_no'])).'", 
                            camp_place = "'.addslashes(stripslashes($_REQUEST['camp_place'])).'", 
                            hospital_name = "'.addslashes(stripslashes($_REQUEST['hospital_name'])).'", 
                            first_name = "'.addslashes(stripslashes($_REQUEST['first_name'])).'", 
                            middle_name = "'.addslashes(stripslashes($_REQUEST['middle_name'])).'", 
                            last_name = "'.addslashes(stripslashes($_REQUEST['last_name'])).'", 
                            gender = "'.addslashes(stripslashes($_REQUEST['gender'])).'", 
                            age = "'.addslashes(stripslashes($_REQUEST['age'])).'", 
                            date_of_birth = "'.addslashes(stripslashes(date('Y-m-d', strtotime($_REQUEST['date_of_birth'])))).'", 
                            disability_type = "'.addslashes(stripslashes($_REQUEST['disability_type'])).'", 
                            phy_other_det = "'.addslashes(stripslashes($_REQUEST['phy_other_det'])).'", 
                            disability_name = "'.addslashes(stripslashes($_REQUEST['disability_name'])).'", 
                            disability_condition = "'.addslashes(stripslashes($_REQUEST['disability_condition'])).'", 
                            disability_condition_percent = "'.addslashes(stripslashes($_REQUEST['disability_condition_percent'])).'",
                            disability_caused_by = "'.addslashes(stripslashes($_REQUEST['disability_caused_by'])).'",
                            person_iq = "'.addslashes(stripslashes($_REQUEST['person_iq'])).'",  
                            person_iq_cond = "'.addslashes(stripslashes($_REQUEST['person_iq_cond'])).'", 
                            need_assistance = "'.addslashes(stripslashes($_REQUEST['need_assistance'])).'", 
                            aid_name = "'.addslashes(stripslashes($_REQUEST['aid_name'])).'", 
                            special_remark = "'.addslashes(stripslashes($_REQUEST['special_remark'])).'", 
                            address_line_1 = "'.addslashes(stripslashes($_REQUEST['address_line_1'])).'", 
                            city = "'.addslashes(stripslashes($_REQUEST['city'])).'", 
                            state = "'.addslashes(stripslashes($_REQUEST['state'])).'", 
                            zip = "'.addslashes(stripslashes($_REQUEST['zip'])).'", 
                            contact_no = "'.addslashes(stripslashes($_REQUEST['contact_no'])).'", 
                            email = "'.addslashes(stripslashes($_REQUEST['email'])).'", 
                            validity_till = "'.addslashes(stripslashes($_REQUEST['validity_till'])).'",
                            doc_type = "'.addslashes(stripslashes($_REQUEST['doc_type'])).'",
                            doc_no = "'.addslashes(stripslashes($_REQUEST['doc_no'])).'",
                            relation_type = "'.addslashes(stripslashes($_REQUEST['relation_type'])).'", 
                            relation_type_name = "'.addslashes(stripslashes($_REQUEST['relation_type_name'])).'", 
                            relation_name = "'.addslashes(stripslashes($_REQUEST['relation_name'])).'", 
                            relation_addr_diff = "'.$_REQUEST['new_address'].'",
                            depdt_address_line_1 = "'.$depdt_address_line_1.'",
                            depdt_city = "'.$depdt_city.'",
                            depdt_state = "'.$depdt_state.'",
                            depdt_zip = "'.$depdt_zip.'",
                            user_image = "",
                            status = "1",
                            added_on = "'.$added_on.'";';

        //echo $insert_query; die;
        if (mysqli_query($link, $insert_query)) {
            
            $id                 = mysqli_insert_id($link);

            if($_FILES['user_image']['name'] != '')
            {
                $DIR_IMG_NORMAL = PHYSICAL_PATH."user_images/normal/";
                $DIR_IMG_THUMB  = PHYSICAL_PATH."user_images/thumb/";
                $file_org       = $_FILES['user_image']['name'];

                $srch           = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','/','*','+','~','','=');
                $rep                    = array('_','','','','','','','','','','','','','','','','','','','','','','','','');
                $file_org               = str_replace($srch,$rep,$file_org);
                $file_tmp               = $_FILES['user_image']['tmp_name'];
                $fileNormal             = $DIR_IMG_NORMAL.$id."~".$file_org;
                $fileThumb_size100x100  = $DIR_IMG_THUMB.$id."~".$file_org;
                list($width, $height)   = getimagesize($file_tmp);
        
                if($width > 400)
                {
                    $size100_width = 400;
                }
                else
                {
                    $size100_width = $width;
                }
                if($height > 400)
                {
                    $size100_height = 400;
                }
                else
                {
                    $size100_height = $height;
                }
                
                $tag = "";
        
                if( move_uploaded_file($file_tmp, $fileNormal) )
                {
                    thumbnail($fileThumb_size100x100, $fileNormal, $size100_width, $size100_height, $tag);
                    $newfilename    = $id."~".$file_org;
                    $update_query   = mysqli_query($link, "UPDATE disability_users_tmp SET user_image = '".$newfilename."' WHERE id = '".$id."'");
                }
            }

            $_SESSION['success_msg']  = '';
            header("Location:".$site_url."index.php?pages=disability_preview&tmp_id=ksh-".$id);
            exit();

        } else {
            $_SESSION['error_msg']  = 'Failed to store data. Please try again';
            header("Location:".$site_url."index.php?pages=disability_preview");
        }
    }
    elseif($mode_name == 'update') {

        //echo '<pre>'; print_r($_REQUEST); echo '</pre>';

        $user_id                = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : '';

        if(!empty($user_id)) {

            //echo '1';
            $adddr_same_av          = isset($_REQUEST['new_address']) ? $_REQUEST['new_address'] : 1;
            $depdt_address_line_1   = ($adddr_same_av == 1) ? addslashes(stripslashes($_REQUEST['address_line_1'])) : addslashes(stripslashes($_REQUEST['depdt_address_line_1']));
            $depdt_city             = ($adddr_same_av == 1) ? addslashes(stripslashes($_REQUEST['city'])) : addslashes(stripslashes($_REQUEST['depdt_city']));
            $depdt_state            = ($adddr_same_av == 1) ? addslashes(stripslashes($_REQUEST['state'])) : addslashes(stripslashes($_REQUEST['depdt_state']));
            $depdt_zip              = ($adddr_same_av == 1) ? addslashes(stripslashes($_REQUEST['zip'])) : addslashes(stripslashes($_REQUEST['depdt_zip']));

            $update_query   =  'UPDATE disability_users SET 
                                    camp_place = "'.addslashes(stripslashes($_REQUEST['camp_place'])).'", 
                                    hospital_name = "'.addslashes(stripslashes($_REQUEST['hospital_name'])).'", 
                                    first_name = "'.addslashes(stripslashes($_REQUEST['first_name'])).'", 
                                    middle_name = "'.addslashes(stripslashes($_REQUEST['middle_name'])).'", 
                                    last_name = "'.addslashes(stripslashes($_REQUEST['last_name'])).'", 
                                    gender = "'.addslashes(stripslashes($_REQUEST['gender'])).'", 
                                    age = "'.addslashes(stripslashes($_REQUEST['age'])).'", 
                                    date_of_birth = "'.addslashes(stripslashes(date('Y-m-d', strtotime($_REQUEST['date_of_birth'])))).'", 
                                    disability_type = "'.addslashes(stripslashes($_REQUEST['disability_type'])).'", 
                                    phy_other_det = "'.addslashes(stripslashes($_REQUEST['phy_other_det'])).'", 
                                    disability_name = "'.addslashes(stripslashes($_REQUEST['disability_name'])).'", 
                                    disability_condition = "'.addslashes(stripslashes($_REQUEST['disability_condition'])).'", 
                                    disability_condition_percent = "'.addslashes(stripslashes($_REQUEST['disability_condition_percent'])).'",
                                    disability_caused_by = "'.addslashes(stripslashes($_REQUEST['disability_caused_by'])).'",
                                    person_iq = "'.addslashes(stripslashes($_REQUEST['person_iq'])).'",  
                                    person_iq_cond = "'.addslashes(stripslashes($_REQUEST['person_iq_cond'])).'", 
                                    need_assistance = "'.addslashes(stripslashes($_REQUEST['need_assistance'])).'", 
                                    aid_name = "'.addslashes(stripslashes($_REQUEST['aid_name'])).'", 
                                    special_remark = "'.addslashes(stripslashes($_REQUEST['special_remark'])).'", 
                                    address_line_1 = "'.addslashes(stripslashes($_REQUEST['address_line_1'])).'", 
                                    city = "'.addslashes(stripslashes($_REQUEST['city'])).'", 
                                    state = "'.addslashes(stripslashes($_REQUEST['state'])).'", 
                                    zip = "'.addslashes(stripslashes($_REQUEST['zip'])).'", 
                                    contact_no = "'.addslashes(stripslashes($_REQUEST['contact_no'])).'", 
                                    email = "'.addslashes(stripslashes($_REQUEST['email'])).'", 
                                    validity_till = "'.addslashes(stripslashes($_REQUEST['validity_till'])).'",
                                    doc_type = "'.addslashes(stripslashes($_REQUEST['doc_type'])).'",
                                    doc_no = "'.addslashes(stripslashes($_REQUEST['doc_no'])).'",
                                    relation_type = "'.addslashes(stripslashes($_REQUEST['relation_type'])).'", 
                                    relation_type_name = "'.addslashes(stripslashes($_REQUEST['relation_type_name'])).'", 
                                    relation_name = "'.addslashes(stripslashes($_REQUEST['relation_name'])).'", 
                                    relation_addr_diff = "'.$_REQUEST['new_address'].'",
                                    depdt_address_line_1 = "'.$depdt_address_line_1.'",
                                    depdt_city = "'.$depdt_city.'",
                                    depdt_state = "'.$depdt_state.'",
                                    depdt_zip = "'.$depdt_zip.'"
                                    WHERE id = "'.$user_id.'";';
            //echo $update_query; die;

            if (mysqli_query($link, $update_query)) {
                
                if($_FILES['user_image']['name'] != '')
                {
                    $DIR_IMG_NORMAL = PHYSICAL_PATH."user_images/normal/";
                    $DIR_IMG_THUMB  = PHYSICAL_PATH."user_images/thumb/";
                    $file_org       = $_FILES['user_image']['name'];

                    $srch           = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','/','*','+','~','','=');
                    $rep                    = array('_','','','','','','','','','','','','','','','','','','','','','','','','');
                    $file_org               = str_replace($srch,$rep,$file_org);
                    $file_tmp               = $_FILES['user_image']['tmp_name'];
                    $fileNormal             = $DIR_IMG_NORMAL.$user_id."~".$file_org;
                    $fileThumb_size100x100  = $DIR_IMG_THUMB.$user_id."~".$file_org;
                    list($width, $height)   = getimagesize($file_tmp);
            
                    if($width > 400)
                    {
                        $size100_width = 400;
                    }
                    else
                    {
                        $size100_width = $width;
                    }
                    if($height > 400)
                    {
                        $size100_height = 400;
                    }
                    else
                    {
                        $size100_height = $height;
                    }
                    
                    $tag = "";
            
                    if( move_uploaded_file($file_tmp, $fileNormal) )
                    {
                        thumbnail($fileThumb_size100x100, $fileNormal, $size100_width, $size100_height, $tag);
                        $newfilename    = $user_id."~".$file_org;
                        $update_query   = mysqli_query($link, "UPDATE disability_users SET user_image = '".$newfilename."' WHERE id = '".$user_id."'");
                    }
                }
            } 

            $_SESSION['success_msg']  = '';
            header("Location:".$site_url."index.php?pages=disability_list");
        }
        else {
            
            $_SESSION['error_msg']  = 'Failed to update data. Please try again';
            header("Location:".$site_url."index.php?pages=disability_list");
        }
    }


    function generate_numbers($start, $count, $digits) {
        $count  = 1;
        //$result = str_pad($start+$count, $digits, "0", STR_PAD_LEFT);
        $result = $start+$count;
        return $result;
    }

?>