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
  $Source: /cvsroot/cpg-contrib/CPGMark/lang/dutch.php,v $
  $Revision: 1.1 $
  $Author: donnoman $
  $Date: 2006/11/30 06:34:57 $
***************************************************/

/**
 * Dutch Language File
 * @author Hein Traag <heintraag@gmail.com>
 * @package language
 * @subpackage dutch
 * @version 1.2
 */

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

$lang_cpgmark = array(
  'cpgmark' => 'CPGMark', // Display Name
  'admin_title' => 'CPGMark Admin', // Title of the button on the gallery admin menu
  'config_title' => 'CPGMark Config', // Title of the button on the gallery admin menu
  'page_success' => 'Watermarkering informatie bijgewerkt', // Success messages
  'page_fail' => 'Fout bij bewaren van informatie', // Fail Messages
);

$lang_cpgmark_config_vpos =  array(
      'TOP'=>'BOVEN',
      'CENTER'=>'MIDDEN',
      'BOTTOM'=>'ONDER',
);

$lang_cpgmark_config_hpos =  array(
      'LEFT'=>'LINKS',
      'CENTER'=>'MIDDEN',
      'RIGHT'=>'RECHTS',
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
	array('Tussen foto watermerk grootte (PNG24)', 'small_watermark_image', 4),
	array('Grootte foto watermerk grootte (PNG24)', 'large_watermark_image', 4),
);

$lang_cpgmark_admin = array(
  'Watermark Settings',
  	array('Gebruik watermark plaatje', 'use_watermark_img', 1),
	array('Watermerk vertikale positie', 'img_vpos', 3,'',$lang_cpgmark_config_vpos),
  	array('Watermerk horizontale positie', 'img_hpos', 3,'',$lang_cpgmark_config_hpos),
  	array('Gebruik watermerk tekst', 'use_watermark_txt', 1),
  	array('Watermerk tekst', 'watermark_text', 0),
  	array('Intermediate foto watermerk tekst grootte', 'watermark_text_size', 3,'',$lang_cpgmark_config_text_size),
  	array('Full size foto watermerk tekst grootte', 'large_watermark_text_size', 3,'',$lang_cpgmark_config_text_size),
	array('Watermerk tekst kleur (e.g. FFFFFF)', 'watermark_text_color', 0),
	array('Watermerk tekst vertikale positie', 'txt_vpos', 3,'',$lang_cpgmark_config_vpos),
  	array('Watermerk tekst horizontala positie', 'txt_hpos', 3,'',$lang_cpgmark_config_hpos),
);

$lang_cpgmark_config = array(
  'Watermark Configuration Settings',
  	array('Hanteer watermerk op foto afbeelden', 'display_image_mark', 1),
	array('Hanteer watermerk op foto toevoegen', 'upload_mark', 1),
  	array('Watermerk plaatje pad (volledig_pad/)', 'watermark_path', 0),
  	array('Laat gebruik individuele watermerken toe', 'user_watermark', 1),
  	array('Intermediate watermerk bestands naam', 'small_watermark_image', 0),
  	array('Full size watermerk bestands naam', 'large_watermark_image', 0),
);

?>