<?php
/**
 * @version		$Id: icon.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * Content Component HTML Helper
 *
 * @static
 * @package		Joomla.Site
 * @subpackage	com_content
 * @since 1.5
 */
class JHTMLIcon
{
	static function create($article, $params)
	{
		$uri = JFactory::getURI();

		$url = 'index.php?option=com_content&task=article.add&return='.base64_encode($uri).'&a_id=0';

		if ($params->get('show_icons')) {
			$text = JHTML::_('image','system/new.png', JText::_('JNEW'), NULL, true);
		} else {
			$text = JText::_('JNEW').'&#160;';
		}

		$button =  JHTML::_('link',JRoute::_($url), $text);

		$output = '<span class="hasTip" title="'.JText::_('COM_CONTENT_CREATE_ARTICLE').'">'.$button.'</span>';
		return $output;
	}

	static function email($article, $params, $attribs = array())
	{
		$uri	= JURI::getInstance();
		$base	= $uri->toString(array('scheme', 'host', 'port'));
		$template = JFactory::getApplication()->getTemplate();
		$link	= $base.JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid) , false);
		$url	= 'index.php?option=com_mailto&tmpl=component&template='.$template.'&link='.base64_encode($link);

		$status = 'width=400,height=350,menubar=yes,resizable=yes';

		if ($params->get('show_icons')) {
			$text = JHTML::_('image','system/emailButton.png', JText::_('JGLOBAL_EMAIL'), NULL, true);
		} else {
			$text = '&#160;'.JText::_('JGLOBAL_EMAIL');
		}

		$attribs['title']	= JText::_('JGLOBAL_EMAIL');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";

		$output = JHTML::_('link',JRoute::_($url), $text, $attribs);
		return $output;
	}

	/**
	 * Display an edit icon for the article.
	 *
	 * This icon will not display in a popup window, nor if the article is trashed.
	 * Edit access checks must be performed in the calling code.
	 *
	 * @param	object	$article	The article in question.
	 * @param	object	$params		The article parameters
	 * @param	array	$attribs	Not used??
	 *
	 * @return	string	The HTML for the article edit icon.
	 * @since	1.6
	 */
	static function edit($article, $params, $attribs = array())
	{
		// Initialise variables.
		$user	= JFactory::getUser();
		$userId	= $user->get('id');
		$uri	= JFactory::getURI();

		// Ignore if in a popup window.
		if ($params && $params->get('popup')) {
			return;
		}

		// Ignore if the state is negative (trashed).
		if ($article->state < 0) {
			return;
		}

		JHtml::_('behavior.tooltip');

		$url	= 'index.php?task=article.edit&a_id='.$article->id.'&return='.base64_encode($uri);
		$icon	= $article->state ? 'edit.png' : 'edit_unpublished.png';
		$text	= JHTML::_('image','system/'.$icon, JText::_('JGLOBAL_EDIT'), NULL, true);

		if ($article->state == 0) {
			$overlib = JText::_('JUNPUBLISHED');
		}
		else {
			$overlib = JText::_('JPUBLISHED');
		}

		$date = JHTML::_('date',$article->created);
		$author = $article->created_by_alias ? $article->created_by_alias : $article->author;

		$overlib .= '&lt;br /&gt;';
		$overlib .= $date;
		$overlib .= '&lt;br /&gt;';
		$overlib .= JText::sprintf('COM_CONTENT_WRITTEN_BY', htmlspecialchars($author, ENT_COMPAT, 'UTF-8'));

		$button = JHTML::_('link',JRoute::_($url), $text);

		$output = '<span class="hasTip" title="'.JText::_('COM_CONTENT_EDIT_ITEM').' :: '.$overlib.'">'.$button.'</span>';

		return $output;
	}


	static function print_popup($article, $params, $attribs = array())
	{
		$url  = ContentHelperRoute::getArticleRoute($article->slug, $article->catid);
		$url .= '&tmpl=component&print=1&layout=default&page='.@ $request->limitstart;

		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';

		// checks template image directory for image, if non found default are loaded
		if ($params->get('show_icons')) {
			$text = JHTML::_('image','system/printButton.png', JText::_('JGLOBAL_PRINT'), NULL, true);
		} else {
			$text = JText::_('JGLOBAL_ICON_SEP') .'&#160;'. JText::_('JGLOBAL_PRINT') .'&#160;'. JText::_('JGLOBAL_ICON_SEP');
		}

		$attribs['title']	= JText::_('JGLOBAL_PRINT');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$attribs['rel']		= 'nofollow';

		return JHTML::_('link',JRoute::_($url), $text, $attribs);
	}

	static function print_screen($article, $params, $attribs = array())
	{
		// checks template image directory for image, if non found default are loaded
		if ($params->get('show_icons')) {
			$text = JHTML::_('image','system/printButton.png', JText::_('JGLOBAL_PRINT'), NULL, true);
		} else {
			$text = JText::_('JGLOBAL_ICON_SEP') .'&#160;'. JText::_('JGLOBAL_PRINT') .'&#160;'. JText::_('JGLOBAL_ICON_SEP');
		}
		return '<a href="#" onclick="window.print();return false;">'.$text.'</a>';
	}

}