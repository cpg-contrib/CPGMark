# *************************************************
# Coppermine Photo Gallery 1.4.1 CPGMark Plugin
# *************************************************
# 1.0  CPGMark
# Copyright (C) 2005 Jeff Paffett <jpaffett@yahoo.co.uk>
# *************************************************                                       //
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# *************************************************
# Coppermine version: 1.4.1
# $Source: /cvsroot/cpg-contrib/CPGMark/sql/basic.sql,v $
# $Revision: 1.6 $
# $Author: donnoman $
# $Date: 2006/11/30 06:34:58 $
# **************************************************

#
# Table structure for table `CPG_mark_watermark`
#

CREATE TABLE `CPG_mark_watermark` (
  `pid` INT NOT NULL,
  `watermarked` TINYINT NOT NULL,
  PRIMARY KEY (`pid`)
) TYPE=MyISAM;

#
# Table structure for table `CPG_mark_users`
#

CREATE TABLE `CPG_mark_users` (
  `user_id` int(11) NOT NULL default '0',
  `use_watermark_img` tinyint(4) NOT NULL default '0',
  `img_vpos` varchar(10) NOT NULL default '',
  `img_hpos` varchar(10) NOT NULL default '',
  `use_watermark_txt` tinyint(4) NOT NULL default '0',
  `watermark_text` varchar(255) NOT NULL default '',
  `watermark_text_size` tinyint(4) NOT NULL default '0',
  `large_watermark_text_size` tinyint(4) NOT NULL default '0',
  `watermark_text_color` varchar(6) NOT NULL default '',
  `txt_vpos` varchar(10) NOT NULL default '',
  `txt_hpos` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`user_id`)
) TYPE=MyISAM;

CREATE TABLE `CPG_mark_config` (
  `name` varchar(40) NOT NULL default '',
  `value` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`name`)
) TYPE=MyISAM;

INSERT INTO `CPG_mark_config` VALUES ('watermark_path', 'watermarks/');
INSERT INTO `CPG_mark_config` VALUES ('small_watermark_image', 'watermark.png');
INSERT INTO `CPG_mark_config` VALUES ('large_watermark_image', 'watermark_large.png');
INSERT INTO `CPG_mark_config` VALUES ('display_image_mark', '0');
INSERT INTO `CPG_mark_config` VALUES ('upload_mark', '1');
INSERT INTO `CPG_mark_config` VALUES ('user_watermark', '0');
INSERT INTO `CPG_mark_config` VALUES ('dbversion', '1');

INSERT INTO `CPG_mark_config` VALUES ('use_watermark_img','0');
INSERT INTO `CPG_mark_config` VALUES ('img_vpos','');
INSERT INTO `CPG_mark_config` VALUES ('img_hpos','');
INSERT INTO `CPG_mark_config` VALUES ('use_watermark_txt','0');
INSERT INTO `CPG_mark_config` VALUES ('watermark_text','');
INSERT INTO `CPG_mark_config` VALUES ('watermark_text_size','0');
INSERT INTO `CPG_mark_config` VALUES ('large_watermark_text_size','0');
INSERT INTO `CPG_mark_config` VALUES ('watermark_text_color','');
INSERT INTO `CPG_mark_config` VALUES ('txt_vpos','');
INSERT INTO `CPG_mark_config` VALUES ('txt_hpos','');
UPDATE `CPG_mark_config` SET value = '2' WHERE name = 'dbversion';