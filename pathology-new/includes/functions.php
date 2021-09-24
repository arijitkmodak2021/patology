<?php 

include("includes/config.php");

function get_pages($pagename)
{
	if($pagename)
	{
		$main_page = $pagename;
	}
	else
	{
		// $select_default_menu = "SELECT * FROM ".MENU." WHERE set_default = '1' AND status = '1' AND menu_type = 'site_menu'";
		// $default_menu_query = mysqli_query($link, $select_default_menu);
		// $menu = mysqli_fetch_array($default_menu_query);
		
		// if(strpos($menu['menu_link'],'?'))
		// {
		// 	$menu_array2 = explode('?',$menu['menu_link']);
			
		// 	if(strpos($menu_array2[1],'&'))
		// 	{
		// 		$menu_array3 = explode('&',$menu_array2[1]);
				
		// 		foreach($menu_array3 as $value)
		// 		{
		// 			$menu_array4 = explode('=',$value);
		// 			$page_array[$menu_array4[0]] = $menu_array4[1];
		// 		}
		// 		$main_page = $page_array['pages'];
		// 	}
		// 	elseif(strpos($menu_array2[1],'='))
		// 	{
		// 		$menu_array3 = explode('=',$menu_array2[1]);
		// 		$main_page = $menu_array3[1];
		// 	}
		// 	/*echo '<pre>';print_r($page_array);echo '</pre>';*/
		// }
		// else
		// {
		// 	$main_page = $menu['menu_link'];
		// }
	}
	
	$main_page = (!empty($main_page)) ? $main_page : 'login';

	require_once('pages/'.$main_page.'.php');
}

/************************* Thumbnail Function - Starts *************************/
function thumbnail($fileThumb, $file, $Twidth, $Theight, $tag)
{
	list($width, $height, $type, $attr) = getimagesize($file);

	switch($type)
	{
		case 1:
		$img = @ImageCreateFromGIF($file);
		break;

		case 2:
		$img = @ImageCreateFromJPEG($file);
		break;

		case 3:
		$img = @ImageCreateFromPNG($file);
		break;
	}

	if($tag == "width") //width contraint
	{
		$Theight = round(($height/$width)*$Twidth);
	}
	elseif($tag == "height") //height constraint
	{
		$Twidth = round(($width/$height)*$Theight);
	}
	elseif($tag=="both")
	{
		$Twidth = $Twidth;
		$Theight = $Theight;
	}
	else
	{
		  $old_x=imageSX($img);
            $old_y=imageSY($img);
           
            // next we will calculate the new dimmensions for the thumbnail image
            // the next steps will be taken:
            // 1. calculate the ratio by dividing the old dimmensions with the new ones
            // 2. if the ratio for the width is higher, the width will remain the one define in WIDTH variable
            // and the height will be calculated so the image ratio will not change
            // 3. otherwise we will use the height ratio for the image
            // as a result, only one of the dimmensions will be from the fixed ones
            if(($old_x>$Twidth)||($old_y>$Theight))
            {
                $ratio1=$old_x/$Twidth;
                $ratio2=$old_y/$Theight;
                if($ratio1>$ratio2)
                {
                    $thumb_w=$Twidth;
                    $thumb_h=$old_y/$ratio1;
                }
                else
                {
                    $thumb_h=$Theight;
                    $thumb_w=$old_x/$ratio2;
                }
            }
            else
            {
                $thumb_h=$old_y;
                $thumb_w=$old_x; 
            }
	}

	$thumb = @imagecreatetruecolor($thumb_w, $thumb_h);
	
	$white = imagecolorallocate($thumb, 238, 238, 238);

	// Draw a white rectangle
	imagefilledrectangle($thumb, 0, 0, $thumb_w, $thumb_h, $white);

	if(@imagecopyresampled($thumb, $img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y))
	{
		switch($type)
		{
			case 1:
			ImageGIF($thumb,$fileThumb);
			break;

			case 2:
			ImageJPEG($thumb,$fileThumb);
			break;

			case 3:
			ImagePNG($thumb,$fileThumb);
			break;
		}

		return true;
	}
}
/************************* Thumbnail Function - Ends *************************/



?>