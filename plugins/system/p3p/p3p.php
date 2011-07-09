<?php
/**
 * @version		$Id: p3p.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

/**
 * Joomla! P3P Header Plugin
 *
 * @package		Joomla
 * @subpackage	System
 */
class plgSystemP3p extends JPlugin
{
	function onAfterInitialise()
	{
		// Get the header
		$header = $this->params->get('header','NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM');
		$header = trim($header);
		// Bail out on empty header (why would anyone do that?!)
		if( empty($header) )
		{
			return;
		}
		// Replace any existing P3P headers in the response
		JResponse::setHeader('P3P','CP="'.$header.'"',true);
	}
}