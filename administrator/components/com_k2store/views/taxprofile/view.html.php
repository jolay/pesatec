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

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class K2StoreViewTaxProfile extends JView
{

	function display($tpl = null) {
		
		global $mainframe, $option;
		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();
		$model		= &$this->getModel('taxprofile');
		$params = &JComponentHelper::getParams('com_k2store');
		// get order data
		$taxprofile	= & $this->get('Data');
		$isNew		= ($taxprofile->id < 1);
		
		if($isNew) {			
			$taxprofile->published = 1;
			
		}
		
		$lists = array();
		$lists['published'] 		= JHTML::_('select.booleanlist',  'published', 'class="inputbox"', $taxprofile->published );
		
		$this->assignRef('taxprofile',	$taxprofile);
		$this->assignRef('lists',	$lists);
		$this->assignRef('params',	$params);
		
		$this->addToolBar();
		K2StoreSubmenuHelper::addSubmenu($vName = 'taxprofiles');
	
		parent::display($tpl);
	}
	
	function addToolBar() {
		
		JToolBarHelper::title(JText::_('Edit Tax Profile'));
		
		// Set toolbar items for the page
		$edit		= JRequest::getVar('edit',true);
		$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Tax Profile' ).': <small><small>[ ' . $text.' ]</small></small>' );
		JToolBarHelper::save();
		if (!$edit)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}	
		
	}

}
