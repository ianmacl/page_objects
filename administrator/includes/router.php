<?php
/**
 * @version		$Id: router.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Framework
 * @subpackage	Application
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('JPATH_BASE') or die;

/**
 * Class to create and parse routes
 *
 * @package		Joomla
 * @since		1.5
 */
class JRouterAdministrator extends JRouter
{
	/**
	 * Function to convert a route to an internal URI
	 */
	public function parse(&$uri)
	{
		return array();
	}

	/**
	 * Function to convert an internal URI to a route
	 *
	 * @param	string	$uri	The internal URL
	 *
	 * @return	string	The absolute search engine friendly URL
	 * @since	1.5
	 */
	function build($url)
	{
		// Create the URI object
		$uri = parent::build($url);

		// Get the path data
		$route = $uri->getPath();

		//Add basepath to the uri
		$uri->setPath(JURI::base(true).'/'.$route);

		return $uri;
	}
}