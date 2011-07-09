# $Id: joomla.sql 17225 2010-05-24 03:01:15Z dextercowley $

#
# Database updates for 1.6 Beta 12 to Beta 13
#

ALTER TABLE `#__template_styles`
 CHANGE `params` `params` varchar(10240) NOT NULL DEFAULT '';

ALTER TABLE `#__menu`
 ADD COLUMN `client_id` TINYINT(4) NOT NULL DEFAULT 0 AFTER `language`;

ALTER TABLE `#__menu`
 ADD UNIQUE `idx_alias_parent_id` (`client_id`,`parent_id`,`alias`);

UPDATE `jos_menu`
 SET `menutype` = 'menu', `client_id` = 1
 WHERE `menutype` = '_adminmenu';
