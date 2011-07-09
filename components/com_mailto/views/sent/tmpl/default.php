<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_mailto
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<div style="padding: 10px;">
	<div style="text-align:right">
		<a href="javascript: void window.close()">
			<?php echo JText::_('COM_MAILTO_CLOSE_WINDOW'); ?> <?php echo JHTML::_('image','mailto/close-x.png', NULL, array('border' => 0), true); ?></a>
	</div>

	<h2>
		<?php echo JText::_('COM_MAILTO_EMAIL_SENT'); ?>
	</h2>
</div>
