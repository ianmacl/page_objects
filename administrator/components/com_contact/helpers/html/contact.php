<?php
/**
 * @version		$Id: contact.php 20228 2011-01-10 00:52:54Z eddieajau $
 * @package		Joomla.Administrator
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Administrator
 * @subpackage	com_contact
 */
abstract class JHtmlContact
{
	/**
	 * @param	int $value	The featured value
	 * @param	int $i
	 *
	 * @return	string	The anchor tag to toggle featured/unfeatured contacts.
	 * @since	1.6
	 */
	static function featured($value = 0, $i)
	{
		// Array of image, task, title, action
		$states	= array(
			0	=> array('disabled.png', 'contacts.featured', 'COM_CONTACT_UNFEATURED', 'COM_CONTACT_TOGGLE_TO_FEATURE'),
			1	=> array('featured.png', 'contacts.unfeatured', 'JFEATURED', 'COM_CONTACT_TOGGLE_TO_UNFEATURE'),
		);
		$state	= JArrayHelper::getValue($states, (int) $value, $states[1]);
		$html	= '<a href="javascript:void(0);" onclick="return listItemTask(\'cb'.$i.'\',\''.$state[1].'\')" title="'.JText::_($state[3]).'">'
				. JHTML::_('image','admin/'.$state[0], JText::_($state[2]), NULL, true).'</a>';

		return $html;
	}
}