<?php
/**
 * @version		$Id: router.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Installation
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('JPATH_BASE') or die;

jimport('joomla.application.router');

/**
 * Class to create and parse routes
 *
 * @package		Joomla
 * @since		1.5
 */
class JRouterInstallation extends JObject
{
	/**
	 * Function to convert a route to an internal URI
	 *
	 * @since	1.5
	 */
	public function parse($url)
	{
		return true;
	}

	/**
	 * Function to convert an internal URI to a route
	 *
	 * @param	string	$string	The internal URL
	 *
	 * @return	string	The absolute search engine friendly URL
	 * @since	1.5
	 */
	public function build($url)
	{
		$url = str_replace('&amp;', '&', $url);

		return new JURI($url);
	}
}