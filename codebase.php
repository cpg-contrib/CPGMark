<?php
/**************************************************
  Coppermine Photo Gallery 1.4.1 CPGMark Plugin
  *************************************************
  1.2  CPGMark
  Copyright (C) 2005 Jeff Paffett <jpaffett@yahoo.co.uk>
  *************************************************                                       //
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.1
  $Source: /cvsroot/cpg-contrib/CPGMark/codebase.php,v $
  $Revision: 1.10 $
  $Author: donnoman $
  $Date: 2007/01/14 18:50:34 $
***************************************************/

if (!defined('IN_COPPERMINE')) die('Not in Coppermine...');

define('CPGMARK_DBVERSION',2);

// Add an install action
$thisplugin->add_action('plugin_install','cpgmark_install');
$thisplugin->add_action('plugin_configure','cpgmark_configure');
$thisplugin->add_filter('gallery_header','cpgmark_gallery_header');
// Add a action
$thisplugin->add_action('page_start','cpgmark_page_start');

// Add a filter
$thisplugin->add_filter('add_file_data','cpgmark_add_file_data');

function cpgmark_gallery_header($html)
{
    global $CPGMARK, $CONFIG, $lang_cpgmark;
    if (!isset($CPGMARK['dbversion']) OR $CPGMARK['dbversion']!= CPGMARK_DBVERSION ) {
        ob_start();
        echo "<h2>{$lang_cpgmark['cpgmark']} {$CPGMARK['dbversion']}</h2><br />{$lang_cpgmark['cpgmark']}: ".CPGMARK_DBVERSION."<br />";
        cpgmark_configure(false); //auto-updater and dont print the "go" button
        $html .= ob_get_clean();
        $CPGMARK=array();
        $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}mark_config");
        while ($row = mysql_fetch_array($result)) {
            $CPGMARK[$row[0]] = $row[1];
        }
    }
    return $html;

}
// Install function
function cpgmark_install() {
    // Install
    if ($_REQUEST['submit']=='Go!') {

        return true;

    // Loop again
    } else {

        return 1;
    }
}

function cpgmark_add_admin_button($href,$title,$target,$link) {
  global $template_sys_menu, $template_sys_menu_spacer;

  $new_template=$template_sys_menu;
  $button=template_extract_block($new_template,'upload_pic');

  $params = array(
      '{UPL_PIC_LNK}' => $target,
      '{UPL_PIC_TITLE}' => $title,
      '{UPL_PIC_TGT}' => $href,
      'upload_pic' => $link,
  );
  $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
  template_extract_block($template_sys_menu,'upload_pic',"<!-- BEGIN upload_pic -->" . $button . "<!-- END upload_pic -->\n" .$new_button);
}

function cpgmark_add_config_button($href,$title,$target,$link) {
  global $template_gallery_admin_menu;

  $new_template=$template_gallery_admin_menu;
  $button=template_extract_block($new_template,'documentation');
  $params = array(
      '{DOCUMENTATION_HREF}' => $href,
      '{DOCUMENTATION_TITLE}' => $title,
      'target="cpg_documentation"' => $target,
      '{DOCUMENTATION_LNK}' => $link,
   );
   $new_button="<!-- BEGIN $link -->".template_eval($button,$params)."<!-- END $link -->\n";
   template_extract_block($template_gallery_admin_menu,'documentation',"<!-- BEGIN documentation -->" . $button . "<!-- END documentation -->\n" . $new_button);
}

function cpgmark_merge_user_settings($owner)
{
	global $CPGMARK,$CONFIG;
	$cpgmark=$CPGMARK;
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}mark_users WHERE user_id = $owner");
 	$row = mysql_fetch_row($result);
 	if ($row[1] == 1 || $row[4] == 1) {
 		$cpgmark['use_watermark_img'] = $row[1];
		$cpgmark['img_vpos'] = $row[2];
		$cpgmark['img_hpos'] = $row[3];
		$cpgmark['use_watermark_txt'] = $row[4];
		$cpgmark['watermark_text'] = $row[5];
		$cpgmark['watermark_text_size'] = $row[6];
		$cpgmark['large_watermark_text_size'] = $row[7];
		$cpgmark['watermark_text_color'] = $row[8];
		$cpgmark['txt_vpos'] = $row[9];
		$cpgmark['txt_hpos'] = $row[10];
		$cpgmark['small_watermark_image']=$owner.'/'.$cpgmark['small_watermark_image'];
		$cpgmark['large_watermark_image']=$owner.'/'.$cpgmark['large_watermark_image'];
	}
	return $cpgmark;
}

function watermark_image($CURRENT_PIC_DATA, $pid = '') 	{

    global $CONFIG, $CPGMARK, $lang_cpgmark, $lang_cpgmark_config, $lang_cpgmark_images, $path_to_pic;

	require ('plugins/CPGMark/include/watermark.class.php');
    $cpgmark=$CPGMARK; //throw away variable so we can override the main config without destroying it.

    //A bit of a hack, but pid hasn't been set by here in image upload
	if ($pid == '') {
		$result = cpg_db_query("SELECT MAX(pid) FROM {$CONFIG['TABLE_PREFIX']}pictures");

		$row = mysql_fetch_row($result);

		$pid = $row[0] + 1;
	}

	if ($cpgmark['user_watermark'] == 1) {
        $cpgmark=cpgmark_merge_user_settings($CURRENT_PIC_DATA['owner_id']);
	}

	$result = cpg_db_query("SELECT pid FROM {$CONFIG['TABLE_PREFIX']}mark_watermark WHERE pid = $pid");

	if (mysql_num_rows($result) == 0) {

		if (file_exists($CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CONFIG['normal_pfx'].$CURRENT_PIC_DATA['filename'])) 				{
			$watermark_target = $CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CONFIG['normal_pfx'].$CURRENT_PIC_DATA['filename'];
			//$watermark=new watermark($CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CONFIG['normal_pfx'].$CURRENT_PIC_DATA['filename']);
			$normal_exists = true;
		} else {
		    $watermark_target = $CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CURRENT_PIC_DATA['filename'];
			$normal_exists = false;
		}

		$watermark=new watermark($watermark_target);
		if ($cpgmark['use_watermark_img'] == 1) {
			$watermark->img_watermark=$CONFIG['fullpath'].$cpgmark['watermark_path'].$cpgmark['small_watermark_image'];
			$watermark->img_watermark_Valing=$cpgmark['img_vpos'];
			$watermark->img_watermark_Haling=$cpgmark['img_hpos'];
		}
		if ($cpgmark['use_watermark_txt'] == 1) {
			$watermark->txt_watermark=$cpgmark['watermark_text'];
			$watermark->txt_watermark_color=$cpgmark['watermark_text_color'];
			$watermark->txt_watermark_font=$cpgmark['watermark_text_size'];
			$watermark->txt_watermark_Valing=$cpgmark['txt_vpos'];
			$watermark->txt_watermark_Haling=$cpgmark['txt_hpos'];
		}
		$watermark->quality=$CONFIG['jpeg_qual'];
		$watermark->process();
		$watermark->save($watermark_target);


		if ($normal_exists == true) { //normal is already done, now do the fullsize
		    $watermark_target = $CONFIG['fullpath'].$CURRENT_PIC_DATA['filepath'].$CURRENT_PIC_DATA['filename'];
			$watermark=new watermark($watermark_target);
			if ($cpgmark['use_watermark_img'] == 1) {
				$watermark->img_watermark=$CONFIG['fullpath'].$cpgmark['watermark_path'].$cpgmark['large_watermark_image'];
				$watermark->img_watermark_Valing=$cpgmark['img_vpos'];
				$watermark->img_watermark_Haling=$cpgmark['img_hpos'];
			}
			if ($cpgmark['use_watermark_txt'] ==1) {
				$watermark->txt_watermark=$cpgmark['watermark_text'];
				$watermark->txt_watermark_color=$cpgmark['watermark_text_color'];
				$watermark->txt_watermark_font=$cpgmark['large_watermark_text_size'];
				$watermark->txt_watermark_Valing=$cpgmark['txt_vpos'];
				$watermark->txt_watermark_Haling=$cpgmark['txt_hpos'];
			}
			$watermark->quality=$CONFIG['jpeg_qual'];
			$watermark->process();
			$watermark->save($watermark_target);
		}
		cpg_db_query("INSERT INTO {$CONFIG['TABLE_PREFIX']}mark_watermark SET pid = $pid, watermarked = 1");
	}
}


function cpgmark_add_file_data($picdata)
{

global $CPGMARK;

	if ($CPGMARK['upload_mark'] == 1)
		{
		watermark_image($picdata);
		}

	return $picdata;
}

function cpgmark_page_start()
{

  	global $template_sys_menu, $template_sys_menu_spacer, $template_sys_menu_button, $sys_menu_buttons;
    global $CONFIG, $CPGMARK, $lang_cpgmark, $lang_cpgmark_config, $lang_cpgmark_admin, $lang_cpgmark_images, $path_to_pic;
    global $META_ALUBM_SET;

  	require ('plugins/CPGMark/include/init.inc.php');

	if ((USER_ID && $CPGMARK['user_watermark']) OR GALLERY_ADMIN_MODE)
    {
        cpgmark_add_admin_button('index.php?file=CPGMark/cpgmark_admin','CPGMark','CPGMark','CPGMark');
    }
  	if (GALLERY_ADMIN_MODE)	{
        cpgmark_add_config_button('index.php?file=CPGMark/cpgmark_config',$lang_cpgmark['config_title'],'',$lang_cpgmark['config_title']);
  	}

  	if (defined('DISPLAYIMAGE_PHP') && ($CPGMARK['display_image_mark'] == 1))
		{

		$pos = isset($_GET['pos']) ? (int)$_GET['pos'] : 0;

		$pid = isset($_GET['pid']) ? (int)$_GET['pid'] : 0;

		$cat = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;

		$album = isset($_GET['album']) ? $_GET['album'] : '';

		// Retrieve data for the current picture
		if ($pos < 0 || $pid > 0) {
			$pid = ($pos < 0) ? -$pos : $pid;
			$result = cpg_db_query("SELECT aid from {$CONFIG['TABLE_PICTURES']} WHERE pid='$pid' $ALBUM_SET LIMIT 1");
			if (mysql_num_rows($result) == 0) cpg_die(ERROR, $lang_errors['non_exist_ap'], __FILE__, __LINE__);
			$row = mysql_fetch_array($result);
			$album = $row['aid'];
			$pic_data = get_pic_data($album, $pic_count, $album_name, -1, -1, false);
			for($pos = 0; $pic_data[$pos]['pid'] != $pid && $pos < $pic_count; $pos++);
			$pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
			$CURRENT_PIC_DATA = $pic_data[0];
            watermark_image($CURRENT_PIC_DATA, $CURRENT_PIC_DATA['pid']);

		} elseif (isset($_GET['pos'])) {
			$pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
			if ($pic_count == 0) {
				cpg_die(INFORMATION, $lang_errors['no_img_to_display'], __FILE__, __LINE__);
			} elseif (count($pic_data) == 0 && $pos >= $pic_count) {
				$pos = $pic_count - 1;
				$human_pos = $pos + 1;
				$pic_data = get_pic_data($album, $pic_count, $album_name, $pos, 1, false);
			}

		    $CURRENT_PIC_DATA = $pic_data[0];
    		watermark_image($CURRENT_PIC_DATA,$CURRENT_PIC_DATA['pid']);
		}
	}
}

/**
 * custom query for cpgmark_configure to avoid Coppermine from aborting out on a failed query.
 *
 * @param string $q
 * @return object mysql result
 */
function cpgmark_configure_query($query)
{
        global $CONFIG, $query_stats, $queries;

        $query_start = cpgGetMicroTime();
        $result = mysql_query($query, $CONFIG['LINK_ID']);
        $query_end = cpgGetMicroTime();
        if (isset($CONFIG['debug_mode']) && (($CONFIG['debug_mode']==1) || ($CONFIG['debug_mode']==2) )) {
                $duration = round($query_end - $query_start, 3);
                $query_stats[] = $duration;
                $queries[] = "$query ({$duration}s)";
        }
        return $result;
}

 // Configure function
// Displays the form
function cpgmark_configure($stop=true)
{
    global $errors, $CONFIG;
    require ('include/sql_parse.php');

    $db_update = 'plugins/CPGMark/sql/basic.sql';
    $sql_query = fread(fopen($db_update, 'r'), filesize($db_update));
    // Update table prefix
    $sql_query = preg_replace('/CPG_/', $CONFIG['TABLE_PREFIX'], $sql_query);

    $sql_query = remove_remarks($sql_query);
    $sql_query = split_sql_file($sql_query, ';');


    ?>
        <h2>Performing Database Updates<h2>
        <table class="maintable">

    <?php

    foreach($sql_query as $q) {
        echo "<tr><td class='tableb'>$q</td>";
        if (cpgmark_configure_query($q)) {
            echo "<td class='updatesOK'>OK</td></tr>";
        } else {
            echo "<td class='updatesFail'>Already Done</td></tr>";
            echo "<tr><td class='tablef'>";
            echo mysql_errno($CONFIG['LINK_ID']) . ": " . mysql_error($CONFIG['LINK_ID']);
            echo "</td><td class='tableh2_compact'>MySQL Said</td></tr>";
        }
    }

    echo "</table>";

    if ($stop) {
        echo <<< EOT

        <form action="{$_SERVER['REQUEST_URI']}" method="post">
            <input type="submit" value="Go!" name="submit" />
        </form>
EOT;
    }

}

?>