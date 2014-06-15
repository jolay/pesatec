<?php
/*
 * --------------------------------------------------------------------------------
   Weblogicx India  - K2 Store v 2.4
 * --------------------------------------------------------------------------------
 * @package		Joomla! 1.5x
 * @subpackage	K2 Store
 * @author    	Weblogicx India http://www.weblogicxindia.com
 * @copyright	Copyright (c) 2010 - 2015 Weblogicx India Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link		http://weblogicxindia.com
 * --------------------------------------------------------------------------------
*/
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 *
 * @static
 * @package		Joomla
 * @subpackage	K2Store
 * @since 1.0
 */
class K2StoreViewAddress extends JView
{
	function display($tpl = null)
	{
		$mainframe = &JFactory::getApplication();

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		parent::display($tpl);
	}

	function _displayForm($tpl)
	{
		$mainframe = &JFactory::getApplication();
		$option = 'com_k2store';

		$db		=& JFactory::getDBO();
		$uri 	=& JFactory::getURI();
		$model	=& $this->getModel();
		//get the address
		$address	=& $this->get('Data');
		$this->assignRef('address',		$address);
		parent::display($tpl);
	}
}
