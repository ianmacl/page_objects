<?php
/**
 * @version		$Id: language.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Installation
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.language.helper');
jimport('joomla.form.formfield');
JLoader::register('JFormFieldList', JPATH_LIBRARIES.'/joomla/form/fields/list.php');

/**
 * Language Form Field class.
 *
 * @package		Joomla.Installation
 * @subpackage	Form
 * @since		1.6
 */
class JFormFieldLanguage extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'Language';

	/**
	 * Method to get the field options.
	 *
	 * @return	array	The field option objects.
	 * @since	1.6
	 */
	protected function getOptions()
	{
		// Initialise variables.
		$app = JFactory::getApplication();

		// Detect the native language.
		$native = JLanguageHelper::detectLanguage();
		if (empty($native)) {
			$native = 'en-GB';
		}

		// Get a forced language if it exists.
		$forced = $app->getLocalise();
		if (!empty($forced['lang'])) {
			$native = $forced['lang'];
		}

		// If a language is already set in the session, use this instead
		$session = JFactory::getSession()->get('setup.options', array());
		if(!empty($session['language'])){
			$native = $session['language'];
		}

		// Get the list of available languages.
		$options = JLanguageHelper::createLanguageList($native);
		if (!$options || JError::isError($options)) {
			$options = array();
		}

		// Set the default value from the native language.
		$this->value = $native;

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}
