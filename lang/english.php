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
  $Source: /cvsroot/cpg-contrib/CPGMark/lang/english.php,v $
  $Revision: 1.5 $
  $Author: donnoman $
  $Date: 2006/11/30 06:34:57 $
***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

$lang_cpgmark = array(
  'cpgmark' => 'CPGMark', // Display Name
  'admin_title' => 'CPGMark Admin', // Title of the button on the gallery admin menu
  'config_title' => 'CPGMark Config', // Title of the button on the gallery admin menu
  'page_success' => 'Watermark information updated', // Success messages
  'page_fail' => 'Error saving information', // Fail Messages
);

$lang_cpgmark_config_vpos =  array(
      'TOP'=>'TOP',
      'CENTER'=>'CENTER',
      'BOTTOM'=>'BOTTOM',
);

$lang_cpgmark_config_hpos =  array(
      'LEFT'=>'LEFT',
      'CENTER'=>'CENTER',
      'RIGHT'=>'RIGHT',
);

$lang_cpgmark_config_text_size = array(
      '1' => '1',
      '2' => '2',
      '3' => '3',
      '4' => '4',
      '5' => '5',
);
$lang_cpgmark_images = array(
  'Watermark Images',
	array('Intermediate watermark image (PNG24)', 'small_watermark_image', 4),
	array('Full size watermark image (PNG24)', 'large_watermark_image', 4),
);

$lang_cpgmark_admin = array(
  'Watermark Settings',
  	array('Use Watermark Image', 'use_watermark_img', 1),
	array('Watermark image vertical position', 'img_vpos', 3,'',$lang_cpgmark_config_vpos),
  	array('Watermark image horizontal position', 'img_hpos', 3,'',$lang_cpgmark_config_hpos),
  	array('Use Watermark Text', 'use_watermark_txt', 1),
  	array('Watermark text', 'watermark_text', 0),
  	array('Intermediate watermark text size', 'watermark_text_size', 3,'',$lang_cpgmark_config_text_size),
  	array('Full size watermark text size', 'large_watermark_text_size', 3,'',$lang_cpgmark_config_text_size),
	array('Watermark text colour (e.g. FFFFFF)', 'watermark_text_color', 0),
	array('Watermark text vertical position', 'txt_vpos', 3,'',$lang_cpgmark_config_vpos),
  	array('Watermark text horizontal position', 'txt_hpos', 3,'',$lang_cpgmark_config_hpos),
);

$lang_cpgmark_config = array(
  'Watermark Configuration Settings',
  	array('Apply watermark on image display', 'display_image_mark', 1),
	array('Apply watermark on image upload', 'upload_mark', 1),
  	array('Watermark image file path (fullpath/)', 'watermark_path', 0),
  	array('Enable individual user watermarks', 'user_watermark', 1),
  	array('Intermediate watermark file name', 'small_watermark_image', 0),
  	array('Full size watermark file name', 'large_watermark_image', 0),
);

?>