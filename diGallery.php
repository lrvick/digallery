<?php //{{{ diGallery v0.5 -- begin configuration
$engine              = "im";                     // "gd" for GD or "im" for iMagicK
$page_header         = "";			                 // override built-in header with your own file
$page_footer         = "";		                   // override built-in footer with your own
$loading_image       = "/images/loading.gif";    // image to be displayed in place of images while they load
$page_title          = "diGallery 0.5";          // title of gallery
$div_id_thumbs       = "gallery";                // css id of div container for thumbnails and nav
$div_id_full         = "gallery_full";           // css id of div container for full image and nav
$path                = "./";                     // path where images (or folders with images) are stored
$thumb_x             = "220";                    // true width for thumbnail
$thumb_y             = "220";                    // true height for thumbnail
$full_x              = "500";                    // width of images viewed in full mode
$full_y              = "2000";                   // height of images viewed in full mode.
$thumb_margin        = "10";                     // css margin to space thumbnails from each other
$thumb_border_width  = "0";                      // css border width for thumbnails
$thumb_border_color  = "#FFF";                   // css broder color for thumbnails
$per_page            = "8";                      // max number of thumbnails per page
$cropping            = "on";                     // crop thumbnails if needed to maintain uniformity
$crop_percent        = ".5";                     // .5 to crop out middle of longest side (GD only)
$shuffle             = "on";                     // randomize order of files
$comments            = "off";                    // allow commenting on full_images to comments.txt
$originals           = "on";                     // allow "full" images to link to the real original images
$slideshow           = "off";                    // allow use of JonDesign's SmoothGallery slideshow
$slimbox             = "off";                    // output thumbnail html as expected by slimbox
$slimbox_script      = "/scripts/slimbox.js";    // http path to slimbox (required if using built-in header)
$framework_script    = "/scripts/mootools.js";   // http path to mootools or jquery (requirement of slimbox)
$preload             = "on";                     // preload thumbnails for all pages. (needed for slimbox)
$captions            = "off";                    // Allow images to be captioned via captions.txt
$polo_thumb          = "on";                     // make thumbnails look like poloroids (requires imagick)
$polo_full           = "off";                    // make full images look like poloroids (requires imagick)
$polo_min_angle      = "-8";                     // minimum rotation for poloroids
$polo_max_angle      = "8";                      // maximum rotation for poloroids
$polo_bg             = "transparent";            // transparent (only works if output is png) or color name
$polo_added_width    = "60";                     // Extra room to give around poloroid. May take tweaking.
$polo_added_height   = "105";                    // old/(sin(theta)+cos(theta)) = new
$thumb_type          = "jpg";                    // output filetype for thumbnails (jpg, png, svg)
$full_type           = "jpg";                    // output filetype for full images (jpg, png, svg)
$jpeg_qual           = "90";                     // jpeg recompression quality (1-100) -- end configuration}}}
function showCSS(){ // {{{ outputs default css theme. 
  Global $thumb_margin, $thumb_x, $thumb_y, $thumb_border_color, $thumb_border_width, $div_id_full, $div_id_thumbs, $loading_image;
  if(extension_loaded('zlib')){
    ob_start('ob_gz_handler');
  }
  header("Content-type: text/css");
  echo "#".$div_id_full." a, #".$div_id_full." a:visited, #".$div_id_thumbs." a, #".$div_id_thumbs." a:visited{\n";
  echo "text-decoration:none;  \n";
  echo "border:none;  \n";
  echo "margin: 0;  \n";
  echo "padding: 0;  \n";
  echo "background:none;  \n";
  echo "}\n";
  if (isset($loading_image)){
    echo "#".$div_id_full." a img {\n";
    echo "  background:url('".$loading_image."') no-repeat center;\n";
    echo "}\n";
  }
  echo "#".$div_id_full."{\n";
	echo "  text-align:center;\n";
  echo "}\n";
  echo "#".$div_id_thumbs." ul {\n";
  echo "  margin: 0;\n";
  echo "  padding: 0;\n";
  echo "}\n";
  echo "#".$div_id_thumbs." ul li {\n";
  echo "  margin: ".$thumb_margin."px;\n";
  echo "  padding: 0;\n";
  echo "  width: ".$thumb_x."px;\n";
  echo "  height: ".$thumb_y."px;\n";
  echo "  display: table;\n";
  echo "  float: left;\n";
  echo "  margin: 0 auto;\n";
  echo "  overflow: hidden;\n";
  echo "}\n";
  echo "#".$div_id_thumbs." ul li div {\n";
  if (isset($loading_image)){
    echo "  background:url('".$loading_image."') no-repeat center;\n";
  }  
  echo "  display: table-cell;\n";
  echo "  text-align: center;\n";
  echo "  vertical-align: middle;\n";
  ieHack("  position: absolute;\n");
  ieHack("  top: 50%;\n");
  echo "}\n";
  echo "#".$div_id_thumbs." ul li div img{\n";
  echo "  margin: 0;\n";
  echo "  padding: 0;\n";
  echo "  border:".$thumb_border_width."px ".$thumb_border_color." solid;\n";
  ieHack("  position: relative;\n");
  ieHack("  top: -50%;\n");
  echo "}\n";
  echo "#".$div_id_thumbs.":after{\n";
  echo "  content:\".\";\n";
  echo "  display:block;\n";
  echo "  height: 0;\n";
  echo "  clear:both;\n";
	echo "  visibility:hidden;\n";
	echo "}\n";
	echo "*, body {\n";
	echo "  margin: 0;\n";
	echo "  padding: 0;\n";
	echo "  position: static;\n";
	echo "  background: transparent;\n";
	echo "  color:#000;\n";
	echo "  font:100% \"Lucida Grande\", Arial, Helvetica, Verdana, sans-serif;\n";
	echo "  line-height:1.2em;\n";
	echo "}\n";
	echo "html, body {\n";
	echo "  height:100%;\n";
	echo "}\n";
	echo "html {\n";
	echo "  margin-bottom:1px;\n";
	echo "}\n";
	echo "#wrapper {\n";
	echo "	margin: 0px auto;\n";
	echo "	text-align: left;\n";
	echo "	width: 95%;\n";
	echo "}\n";
	echo "#header {\n";
	echo "	margin-bottom: 20px;\n";
	echo "	text-align: center;\n";
	echo "	padding: 20px 0px 20px 0px;\n";
	echo "	border-bottom: 1px black solid;\n";
	echo "	font-size: 140%;\n";
	echo "}\n";
	echo "#footer {\n";
	echo "	border-top: 1px black solid;\n";
	echo "	font-size: 80%;\n";
	echo "	width: 95%;\n";
	echo "	margin: 0px auto;\n";
	echo "	margin-top: 20px;\n";
	echo "	padding: 20px 0px 20px 0px;\n";
	echo "	text-align: center;\n";
	echo "}\n";

	if(extension_loaded('zlib')){
		ob_end_flush();
  }
  exit;
} // }}}
function ieHack($cssline) { // {{{ outputs $cssline only to Internet Explorer 6 
	if(preg_match('/msie\s(5\.[5-9]|[6]\.[0-9]*).*(win)/i',$_SERVER['HTTP_USER_AGENT'])){
		echo $cssline;
	}
} // }}}
function formatImage($file_in, $file_out, $new_width, $new_height, $quality, $cropping, $crop_percent, $engine, $new_filetype){ // {{{
	global $polo_thumb, $polo_full, $polo_min_angle, $polo_max_angle, $polo_bg, $polo_added_height, $polo_added_width, $thumb_type, $full_type;
	preg_match("/\.([^\.]+)$/", $file_in, $extension);
	if ($engine == "gd"){/*{{{*/
		if ( preg_match("/jpeg|jpg|png|gif|bmp|xpm|xbm/i", $extension[1] )) {
			$image = imagecreatefromjpeg($file_in);
			$old_width  = imagesx( $image );
			$old_height = imagesy( $image );
			// If either dimension is larger than the desired size, we need to scale/crop down
			if( ($old_width != $new_width && $old_height > $new_height)
					|| ($old_height != $new_height && $old_width > $new_width) ){
				$larger_side = max($old_width, $old_height);
				if( $cropping == "on" ) {
					$image_tc = imagecreatetruecolor($new_width,$new_height);
					// This is needed to preserve aspect ratio
					$new_height = ($old_width != $old_height) ? ($new_width * $old_height / $old_width) : $new_width;
					/**if( $old_width != $old_height ){
						$new_height = $new_width * $old_height / $old_width;
						} else {
						$new_height = $new_width;
						}**/
					$crop_x   = $larger_side*$crop_percent;
					$crop_y   = $larger_side*$crop_percent;
					$offset_x = ( $old_width  - $crop_x ) / 2;
					$offset_y = ( $old_height - $crop_y ) / 2;
					imagecopyresampled($image_tc, $image, 0, 0, $offset_x, $offset_y, $new_width, $new_height, $crop_x, $crop_y);
				} else {
					if ( $larger_side == $old_width ) {
						$new_height = ( $old_height * $new_width ) / $old_width;
					} else {
						$new_width = ( $old_width * $new_height ) / $old_height;
					}
					$image_tc = imagecreatetruecolor($new_width,$new_height);
					imagecopyresized( $image_tc, $image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height );
				}
				if ( $new_filetype == "jpg" ) {
					imagejpeg($image_tc,$file_out,$quality);
				}
				if ( $new_filetype == "png" ) {
					imagepng($image_tc,$file_out,$quality);
				}
			}
		} else {
			echo $file_in." is not of a filetype supported by GD, please consider using ImageMagick<br>";
		}
	}/*}}}*/
	if ($engine == "im") {
		$image = new Imagick($file_in);
		$image->flattenImages();
		$old_width = $image->getImageWidth();
		$old_height = $image->getImageHeight();
		if ( $old_width != $new_width ){
			if ( $cropping == "on" && !preg_match("/full_/", $file_out ) ) {
				$image->cropThumbnailImage($new_width, $new_height);
			} else {
				$image->thumbnailImage($new_width, $new_height, TRUE);
			}
		}
		if (( $polo_thumb == "on" && preg_match("/thumb_/", $file_out)) ||
				( $polo_full  == "on" && preg_match("/full_/", $file_out))){
			$canvas = new Imagick();
			$color = new ImagickPixel();
			if ($polo_bg == "transparent" &&
					((preg_match("/thumb_/", $file_out) && $thumb_type == "jpg") ||
					 (preg_match("/full_/", $file_out) && $full_type == "jpg"))) {
					$color->setColor( "white" );
			} else {
					$color->setColor( "$polo_bg" );
			}
			$canvas->newImage( $new_width + $polo_added_width, $new_height + $polo_added_height, $color );
			$draw = new ImagickDraw();
			$angle = mt_rand( $polo_min_angle , $polo_max_angle );
			$image->setImageBackgroundColor( new ImagickPixel("black") );
			$image->polaroidImage( $draw, $angle );
			$canvas->compositeImage( $image, Imagick::COMPOSITE_OVER, 0, 0);
			$canvas->trimImage(0);
			$canvas->writeImage($file_out);
		} else {
			$image->writeImage($file_out);
		}
	}
}//}}}
function viewAlbum($album_name=NULL){ // {{{ output gallery of thumbnails
  global $file, $div_id_thumbs, $per_page, $arg, $full_type, $thumb_type, $slimbox, $slideshow, $shuffle, $thumb_x, $thumb_y;
  if ($shuffle == "on") {
    $shuff_order = preg_replace("/\.jpg|\.jpeg|\.png|\.svg|\.tif|\.tiff|\.xcf|\.psd|\.psp|\.pdf/i", "", file("shuffle.txt", FILE_IGNORE_NEW_LINES));
  }
  $web_path = preg_replace('/\/*(index|page)?\.php.*/','/',"http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
  if ( $arg == 1 || $arg == ""){
    $start_num = 0;
    $end_num   = ($per_page );
  } else {
    $start_num = (($arg - 1) * $per_page );
    $end_num   = (($arg - 1) * $per_page + $per_page);
  }
  if ($shuffle == "on") $file = preg_replace("/\..*/i", "", $shuff_order);
  if (!is_numeric($arg)){ $arg = 1; }
  $last_page = (ceil(count($file) / $per_page));
  if ( $arg > 1 ) {
    $prev_page = ($arg - 1);
    $href_1p = "<a href=\"".$web_path."page/".$prev_page."\">";
    $href_2p = "</a>";
  }
  if ( $arg < $last_page ){
    $next_page = ($arg + 1);
    $href_1n = "<a href=\"".$web_path."page/".$next_page."\">";
    $href_2n = "</a>";
  }
  if ( $last_page != 1 ) {
    $nav_buttons = "<div style=\"clear:both;text-align:center;\">\n<p>".$href_1p."&lt;Prev&nbsp;&nbsp;".$href_2p."\n";
    for ($n == 1; $n <= $last_page; $n++){
      if ( $arg == $n ){ $lb = "["; $rb = "]"; }
      if ( $n != $last_page ){ $dv = "&nbsp;&nbsp;-&nbsp;&nbsp;"; }
      if (isset($n)){
        $nav_buttons .= "<a href=\"".$web_path."page/".$n."\"> ".$lb.$n.$rb.$dv." </a>\n";
      }
      unset($lb, $rb, $dv);
    }
    $nav_buttons .= "".$href_1n."&nbsp;&nbsp;Next&gt;&nbsp;&nbsp;".$href_2n."</p>\n</div>\n";
  }
  echo "<div id=\"".$div_id_thumbs."\">\n";
  echo $nav_buttons;
  if ($slideshow == "on") {
    ?><div style="text-align:center"><p><a href="/<? echo $web_path ?>/slideshow"> [ View Slideshow ] </a></p></div><?
  }
  echo "<ul>\n";
	if ($comments == "on" && file_exists("database.xml")) {
		$db = simplexml_load_file("database.xml");
	}
  for ($n = $start_num; $n < $end_num; $n++){
    $image_name = $file[$n];
    $thumb_image = str_replace("full_", "thumb_", $file[$n]);
    if (isset($image_name)){
      if ($slimbox == "on"){
        echo "<script type=\"text/javascript\"> document.write('<li><div><a href=\"".$web_path."full_".$image_name.".".$full_type."\" ><img src=\"".$web_path."thumb_".$thumb_image.".".$thumb_type."\" alt=\"\" title=\"\" width=\"$thumb_x\" height=\"$thumb_y\" >";
				if ($comments == "on") {
					$comments = $db->xpath("/$image_name/comment");

				}
				echo "</a></div>')</script>";
        echo "<noscript><li><div><a href=\"".$web_path."Full/$image_name\" ><img src=\"".$web_path."thumb_".$thumb_image.".".$thumb_type."\" alt=\"\" title=\"\" width=\"$thumb_x\" height=\"$thumb_y\" ></a></div></noscript>";
      } else {
        echo "<li><div><a href=\"".$web_path."Full/$image_name\" ><img src=\"".$web_path."thumb_".$thumb_image.".".$thumb_type."\" alt=\"\" title=\"\" width=\"$thumb_x\" height=\"$thumb_y\" ></a></div>";
      } 
    }
    if ( $comments == "on" ){
      //todo echo $num_comments." comments"
    }
    echo "</li>\n";
  }
  echo "</ul>\n";
  echo $nav_buttons;
  echo "</div>\n";
}//}}}
function viewFull($image, $album_name=NULL) { //{{{ outputs a large version of a given image, and navigation links.
  global $full_type, $filelist, $per_page, $div_id_full, $full_x;
  if (isset($album_name)){
    $web_path = "../".$album_name."/";
  } else {
    $web_path = "../";
  }
	$match_name = basename($_SERVER['PHP_SELF']);
  foreach ($filelist as $open_file) {
      $image_name = preg_replace("/\..*/", "", $open_file);
      if (!isset($first_image)) {
        $first_image = $image_name;
      }
      if ($next_image == "yes") {
        $next_image = $image_name;
      }
      if ($image_name == $match_name) {
        $next_image = "yes";
      }
      if (!isset($next_image)) {
        $prev_image = $image_name;
      }
      $last_image = $image_name;
  }
  //unset($open_file,$match_name); // Don't see why we need this.
  echo "<div class=\"heading\">$title</div>\n";
  $nav_buttons = "<div style=\"text-align:center;\"><p>";
  if (isset($prev_image)){
    $href_1f  = "<a href=\"".$web_path."Full/$first_image\">";
    $href_1p  = "<a href=\"".$web_path."Full/$prev_image\">";
    $href_2fp = "</a>";
  }
  $nav_buttons .= $href_1f."&lt;&lt;First&nbsp;&nbsp;".$href_2fp;
  $nav_buttons .= $href_1p."&nbsp;&lt;Prev&nbsp;&nbsp;".$href_2fp;
  $nav_buttons .= "<a href=\"".$web_path."page/".ceil((array_search($match_name,$filelist)+1)/$per_page)."\"> [ Return to Gallery ] </a>";
  if (isset($next_image) && $next_image != "yes"){
    $href_1n  = "<a href=\"".$web_path."Full/$next_image\">";
    $href_1l  = "<a href=\"".$web_path."Full/$last_image\">";
    $href_2nl   = "</a>";
  }
  $nav_buttons .= $href_1n."&nbsp;&nbsp;Next&gt;&nbsp;&nbsp;".$href_2nl;
  $nav_buttons .= $href_1l."&nbsp;&nbsp;Last&gt;&gt;".$href_2nl;
  $nav_buttons .= "</p></div>\n";
  echo "<div id=\"".$div_id_full."\">\n";
  echo $nav_buttons;
  $full_image = str_replace("Full.php/" , "full_" , $_SERVER['PHP_SELF']);
  $real_image=str_replace("full_", "",$full_image);
  echo "<a href=\"".$real_image."\" title=\"Click here for full-sized original image\"> <img src=\"".$full_image.".".$full_type."\" width=\"$full_x\" alt=\"Large version of ".$real_image."\" title=\"\"></a>\n";
  echo $nav_buttons;
  if ( $commenting == "on" ){
    //todo
    //echo $comments;
    //echo $comments_form;
  }
  echo "</div>\n";
}//}}}
function viewSlideshow(){ //{{{ outputs an html page of all images as would be expected by JonDesign's SmoothGallery
  global $shuffle;
  $web_path = str_replace(array($_SERVER['DOCUMENT_ROOT'], "page", "Full", ".php", "/"), "", dirname($_SERVER['PHP_SELF']));
  echo "<script type=\"text/javascript\">\n";
  echo "  function startGallery() {\n";
  echo "    var myGallery = new gallery($('myGallery'), {\n";
  echo "      timed: true,\n";
  echo "      delay: 4000,\n";
  echo "      showArrows: true,\n";
  echo "      showCarousel: true,\n";
  echo "      embedLinks: false\n";
  echo "    });\n";
  echo "  }\n";
  echo "  window.addEvent('domready', startGallery);\n";
  echo "</script>\n";
  echo "<div id=\"myGallery\">\n";
  function outputDivs($open_file) {
    if (preg_match("/full_/i", $open_file)) {
      $full_image = str_replace("slideshow.php/" , "full_" , $_SERVER['PHP_SELF']);
      $image_name = preg_replace(array("/\..*/i","/full_/i") , "" , $open_file);
      echo "<div class=\"imageElement\">";
      echo "  <h3></h3>";
      echo "  <p></p>";
      echo "  <a href=\"".$full_image."\" title=\"open image\" class=\"open\"></a>";
      echo "  <img src=\"full_".$image_name."\" class=\"full\" />";
      echo "  <img src=\"thumb_".$image_name."\" class=\"thumbnail\" />";
      echo "</div>";
    }
  }
  if ($shuffle == "on") {
    foreach ($shuff_order as $open_file) outputDivs($open_file);
  } else {
    foreach (scandir($path) as $open_file) outputDivs($open_file);
  }
  echo "</div><div style=\"text-align:center\"><p><a href=\"".$web_path."page/1\"> [ Return to Gallery ] </a></p></div>";
}//}}}
function generateStuff(){//{{{ checks/creates all needed symlinks and then generates "full" and "thumbnail" versions of all images
	global $path, $full_type, $thumb_type, $filelist, $thumb_x, $thumb_y, $jpeg_qual, $cropping, $crop_percent, $engine, $thumb_type, $full_x, $full_y, $shuffle, $file;
	if ($slideshow == "on" && !file_exists("slideshow.php")) symlink("index.php", "slideshow.php");
	if (!file_exists("page.php")) symlink("index.php", "page.php");
	if (!file_exists("Full.php")) symlink("index.php", "Full.php");
	if (!file_exists("albums.php")) symlink("index.php", "albums.php");
	if (!file_exists("built-in.css.php")) symlink("index.php", "built-in.css.php");
	//$shuff_list = array();
	$newest_file = "";
	foreach (scandir($path) as $open_file) {
		$filename_parts = explode(".", $open_file);
		if (preg_match("/jpg|jpeg|png|svg|tif|tiff|xcf|psd|psp|pdf/i", $filename_parts[1]) && !preg_match("/full_|thumb_/i", $open_file)) {
			//Part of the deletion code
			//if (!preg_match("/full_|thumb_/i", $open_file)) {
				$filelist[] = $open_file;
				if (!file_exists("full_".$filename_parts[0].".".$full_type)) {
					$full_file  = "full_".$filename_parts[0].".".$full_type;
					echo "<div class=\"creation\">$open_file -> $full_file</div>";
					formatImage($open_file, $full_file, $full_x, $full_y, $jpeg_qual, $cropping, $crop_percent, $engine, $full_type);
				}
				if (!file_exists("thumb_".$filename_parts[0].".".$thumb_type)) {
					$full_file  = "full_".$filename_parts[0].".".$full_type;
					$thumb_file = "thumb_".$filename_parts[0].".".$thumb_type;
					echo "<div class=\"creation\">$open_file -> $thumb_file</div>";
					formatImage($open_file, $thumb_file, $thumb_x, $thumb_y, $jpeg_qual, $cropping, $crop_percent, $engine, $thumb_type);
				}
				//if ($shuffle == "on" && !in_array($open_file, $shuff_list)) {
				//	$shuff_list[] = $open_file;
					if ($shuffle == "on" && !$newest_file || filemtime($newest_file) < filemtime($open_file)) {
						$newest_file = $open_file;
					}
				//}
				//Deletion code. If someone has the ability to remove the orig image, they can remove the thumb and full files.
				//There's also the possible use that someone wants to remove all the originals to save space.
			/*} else if (preg_match("/full_|thumb_/i", $open_file)) {
				$orig_file = str_ireplace("png", "jpg", preg_replace("/full_|thumb_/i", "", $open_file)); // This is horrible. HORRIBLE. Will not work....but it does for now, here.
				if (!file_exists($orig_file)) {
					echo "unlink($open_file);<br>";
					if (in_array($orig_file, $shuff_list)) {
						echo "Remove $orig_file from shuffle.txt<br>";
					}
			echo "---------<br>";
				}
			}*/
		}
	}
	if ($shuffle == "on") {
		if (!file_exists("shuffle.txt") || filemtime($newest_file) > filemtime("shuffle.txt")) {
			shuffle($filelist);
			file_put_contents("shuffle.txt", implode("\n", array_unique($filelist)));
		} else {
			file_put_contents("shuffle.txt", implode("\n", array_intersect(file("shuffle.txt", FILE_IGNORE_NEW_LINES), array_unique($filelist))));
		}
	} else {
		$file = preg_replace("/\.jpg|\.jpeg|\.png|\.svg|\.tif|\.tiff|\.xcf|\.psd|\.psp|\.pdf/i", "", $filelist);
		if (file_exists("shuffle.txt")) {
			unlink("shuffle.txt");
		}
	}
}//}}}
function pageHeader(){ //{{{ output default html page header
	global $page_header, $page_title, $http_path, $slimbox, $slimbox_script, $framework_script;
	if ($page_header){
		require($page_header);
	} else {
		echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">\n";
		echo "<html lang=\"en\">\n";
		echo "  <head>\n";
		echo "    <title>$page_title</title>\n";
		echo "    <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" >\n";
		echo "    <meta name=\"resource-type\" content=\"document\">\n";
		echo "    <meta http-equiv=\"pragma\" content=\"no-cache\">\n";
		echo "    <meta name=\"revisit-after\" content=\"14 days\">\n";
		echo "    <meta name=\"robots\" content=\"ALL\">\n";
		echo "    <meta name=\"distribution\" content=\"Global\">\n";
		echo "    <meta name=\"language\" content=\"English\">\n";
		echo "    <meta name=\"doc-type\" content=\"Public\">\n";
		echo "    <meta name=\"doc-class\" content=\"Completed\">\n";
		echo "    <meta name=\"doc-rights\" content=\"Public\">\n";
		if ($slimbox && $slimbox_script && $framework_script) {
			echo "<script type=\"text/javascript\" src=\"$framework_script\"></script>\n";
			echo "<script type=\"text/javascript\" src=\"$slimbox_script\"></script>\n";
		}
		echo "    <link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\" href=\"".$http_path."rss.xml\" >\n";
		echo "    <link rel=\"alternate\" type=\"application/atom+xml\" title=\"Atom\" href=\"".$http_path."atom.xml\" >\n";        
		echo "    <link href=\"".$http_path."built-in.css\" media=\"screen\" rel=\"stylesheet\" type=\"text/css\" >\n";             
		echo "  </head>\n";
		echo "  <body>\n";
		echo "    <div id=\"wrapper\">\n";
		echo "      <div id=\"header\"><h1>$page_title</h1></div>\n";
		echo "      <div id=\"content\">\n";
	}
}//}}}
function pageFooter(){ //{{{ optput default html page footer
	global $page_footer, $start_time;
	if ($page_footer) {
		require($page_footer);
	} else {
		echo "      </div>\n";
		echo "    </div>\n";
		echo "    <div id=\"footer\">\n";
		echo "			Page generation took " . round(((microtime(true) - $start_time)*1000), 2) . " milliseconds.<br>";
		echo "      <a href=\"http://jigsaw.w3.org/css-validator/check/referer\">VALID:CSS</a> |\n";
		echo "      <a accesskey=\"3\" href=\"/sources.crosstechnical.net/p/digallery\">Powered By diGallery</a> |\n";
		echo "      <a href=\"http://validator.w3.org/check/referer\">VALID:HTML</a>\n";
		echo "    </div>\n";
		echo "  </body>\n";
		echo "</html>\n";
	}
}//}}}
$start_time = microtime(true); // {{{ begin output
$arg = str_replace( "/" , "" , $_SERVER['PATH_INFO']);
$args = explode('/',stripslashes($_SERVER['PATH_INFO']));
generateStuff();
if (preg_match("/built-in.css/i", $_SERVER['PHP_SELF'])) {
	showCSS();
}
pageHeader();
if ((preg_match("/albums/i", $_SERVER['PHP_SELF']) && $args[0] == "default") || preg_match("/full/i", $_SERVER['PHP_SELF'])) {
	viewFull($args[1]);
} else if (preg_match("/slideshow/i", $_SERVER['PHP_SELF'])) {
	viewSlideshow();
} else {
	viewAlbum();
}
pageFooter();
//}}}?>
