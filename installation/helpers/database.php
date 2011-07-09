<?php
/**
 * @version		$Id: database.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Installation
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Joomla Installation Database Helper Class.
 *
 * @static
 * @package		Joomla.Installation
 * @since		1.6
 */
class JInstallationHelperDatabase
{
	/**
	 * Method to get a JDatabase object.
	 *
	 * @access	public
	 * @param	string	The database driver to use.
	 * @param	string	The hostname to connect on.
	 * @param	string	The user name to connect with.
	 * @param	string	The password to use for connection authentication.
	 * @param	string	The database to use.
	 * @param	string	The table prefix to use.
	 * @param	boolean True if the database should be selected.
	 * @return	mixed	JDatabase object on success, JException on error.
	 * @since	1.0
	 */
	static function & getDBO($driver, $host, $user, $password, $database, $prefix, $select = true)
	{
		static $db;

		if (!$db) {
			// Build the connection options array.
			$options = array (
				'driver' => $driver,
				'host' => $host,
				'user' => $user,
				'password' => $password,
				'database' => $database,
				'prefix' => $prefix,
				'select' => $select
			);

			// Get a database object.
			jimport('joomla.database.database');
			$db = JDatabase::getInstance($options);
		}

		return $db;
	}
}