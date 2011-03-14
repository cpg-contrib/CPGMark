<?php
/**************************************************
  Coppermine Photo Gallery 1.4.2 CPGMark Plugin
  *************************************************
  1.0  CPGMark
  Copyright (C) 2005 Jeff Paffett <jpaffett@gmail.com>
  *************************************************                                       //
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.
  *************************************************
  Coppermine version: 1.4.2
  $Source: /cvsroot/cpg-contrib/CPGMark/watermark.php,v $
  $Revision: 1.4 $
  $Author: donnoman $
  $Date: 2006/07/31 04:49:50 $
***************************************************/

Header("Content-type: image/jpeg");

include ('include/watermark.class.php');


$image = '../../'.$_GET['image'];

if (isset($_GET['img_watermark']))
	{
	$img_watermark = '../../'.$_GET['img_watermark'];
	}

$watermark=new watermark($image);


if (isset($_GET['img_watermark']))
	{
	$watermark->img_watermark='../../'.$_GET['img_watermark'];
	$watermark->img_watermark_Valing=$_GET['img_watermark_Valing'];
	$watermark->img_watermark_Haling=$_GET['img_watermark_Haling'];
	}
	
if (isset($_GET['txt_watermark']))
	{
	$watermark->txt_watermark=urldecode($_GET['txt_watermark']);
	$watermark->txt_watermark_color=$_GET['txt_watermark_color'];
	$watermark->txt_watermark_font=$_GET['txt_watermark_font'];
	$watermark->txt_watermark_Valing=$_GET['txt_watermark_Valing'];
	$watermark->txt_watermark_Haling=$_GET['txt_watermark_Haling'];
	}
	
$watermark->process();
$watermark->show();

?>