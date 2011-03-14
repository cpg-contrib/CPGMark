<?php

/**************************************************

  Coppermine Photo Gallery 1.4.1 CPGMark Plugin

  *************************************************

  1.2  CPGMark

  Copyright (C) 2005 Jeff Paffett <jpaffett@yahoo.co.uk>

  German language file thanks to andre@partynation.tv

  *************************************************                                       //

  This program is free software; you can redistribute it and/or modify

  it under the terms of the GNU General Public License as published by

  the Free Software Foundation; either version 2 of the License, or

  (at your option) any later version.

  *************************************************

  Coppermine version: 1.4.1

  $Source: /cvsroot/cpg-contrib/CPGMark/lang/german.php,v $

  $Revision: 1.4 $

  $Author: donnoman $

  $Date: 2006/11/30 06:34:57 $

***************************************************/



if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}



$lang_cpgmark = array(

  'cpgmark' => 'Wasserzeichen', // Display Name

  'admin_title' => 'Wasserzeichen Admin', // Title of the button on the gallery admin menu

  'config_title' => 'Wasserzeichen Config', // Title of the button on the gallery admin menu

  'page_success' => 'Wasserzeichen Informationen aktualisiert', // Success messages

  'page_fail' => 'Fehler beim aktualisieren', // Fail Messages

);



$lang_cpgmark_config_vpos =  array(

      'TOP'=>'Oben',

      'CENTER'=>'Mitte',

      'BOTTOM'=>'Unten',

);



$lang_cpgmark_config_hpos =  array(

      'LEFT'=>'Links',

      'CENTER'=>'Mitte',

      'RIGHT'=>'Rechts',

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

	array('Mittleres Wasserzeichen (PNG24)', 'small_watermark_image', 4),

	array('Gro&szlig;es Wasserzeichen (PNG24)', 'large_watermark_image', 4),

);



$lang_cpgmark_admin = array(

  'Watermark Settings',

  	array('Wasserzeichen aktiviert', 'use_watermark_img', 1),

	array('Vertikale Position des Wasserzeichens', 'img_vpos', 3,'',$lang_cpgmark_config_vpos),

  	array('Horizontale Position des Wasserzeichens', 'img_hpos', 3,'',$lang_cpgmark_config_hpos),

  	array('Text Wasserzeichen nutzen', 'use_watermark_txt', 1),

  	array('Text', 'watermark_text', 0),

  	array('Textgr&ouml;&szlig;e f&uuml;r mittleres Bild', 'watermark_text_size', 3,'',$lang_cpgmark_config_text_size),

  	array('Textgr&ouml;&szlig;e f&uuml;r gro&szlig;es Bild', 'large_watermark_text_size', 3,'',$lang_cpgmark_config_text_size),

	array('Textfarbe (z.B. FFFFFF)', 'watermark_text_color', 0),

	array('Vertikale Position des Textes', 'txt_vpos', 3,'',$lang_cpgmark_config_vpos),

  	array('Horizontale Position des Textes', 'txt_hpos', 3,'',$lang_cpgmark_config_hpos),

);



$lang_cpgmark_config = array(

  'Watermark Configuration Settings',

  	array('Wasserzeichen beim anzeigen hinzuf&uuml;gen', 'display_image_mark', 1),

	array('Wasserzeichen beim Upload hinzuf&uuml;gen', 'upload_mark', 1),

  	array('Pfad zur Wasserzeichen Datei', 'watermark_path', 0),

	array('Individuelle Wasserzeichen aktivieren', 'user_watermark', 1),

  	array('Dateiname des Mittleren Wasserzeichens', 'small_watermark_image', 0),

  	array('Dateiname des gro&szlig;en Wasserzeichens', 'large_watermark_image', 0),

);



?>