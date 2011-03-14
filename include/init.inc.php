<?php
/**************************************************
  Coppermine Photo Gallery 1.4.1 CPGMark Plugin
  *************************************************
  1.0  CPGMark
  Copyright (C) 2005 Jeff Paffett <jpaffett@yahoo.co.uk>
  *************************************************                                       //
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.1
  $Source: /cvsroot/cpg-contrib/CPGMark/include/init.inc.php,v $
  $Revision: 1.2 $
  $Author: donnoman $
  $Date: 2006/11/30 06:34:57 $
***************************************************/

if (!defined('IN_COPPERMINE')) { die('Not in Coppermine...');}

//define('MINICMS_DBVER','1.4.7');

// submit your lang file for this plugin on the coppermine forums
// plugin will try to use the configured language if it is available.

if (file_exists("plugins/CPGMark/lang/{$CONFIG['lang']}.php")) {
  require "plugins/CPGMark/lang/{$CONFIG['lang']}.php";
} else require 'plugins/CPGMark/lang/english.php';


$result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}mark_config");
while ($row = mysql_fetch_array($result)) {
    $CPGMARK[$row[0]] = $row[1];
}

/**
 * This really doesn't seem to need to be here.
 * The domain wide information should be kept in mark_config
 * if user marking is enabled it can come from the mark_users table.


if ($CPGMARK['user_watermark'] == 1) {
    $result = cpg_db_query("SELECT * FROM {$CONFIG['TABLE_PREFIX']}mark_users WHERE user_id = ".USER_ID);
    $row = mysql_fetch_row($result);
    $CPGMARK['use_watermark_img'] = $row[1];
    $CPGMARK['img_vpos'] = $row[2];
    $CPGMARK['img_hpos'] = $row[3];
    $CPGMARK['use_watermark_txt'] = $row[4];
    $CPGMARK['watermark_text'] = $row[5];
    $CPGMARK['watermark_text_size'] = $row[6];
    $CPGMARK['large_watermark_text_size'] = $row[7];
    $CPGMARK['watermark_text_color'] = $row[8];
    $CPGMARK['txt_vpos'] = $row[9];
    $CPGMARK['txt_hpos'] = $row[10];
}

 */
?>