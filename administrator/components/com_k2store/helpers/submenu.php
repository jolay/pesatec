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
// No direct access
defined('_JEXEC') or die;

/**
 * Submenu helper.
 *
 * @package		Joomla.Administrator
 * @subpackage	com_k2store
 * @since		1.6
 */
 
class K2StoreSubmenuHelper 
{

public static function addSubmenu($vName = 'cpanel')
	{
		
		JSubMenuHelper::addEntry(
			JText::_('Dashboard'),
			'index.php?option=com_k2store&view=cpanel',
			$vName == 'cpanel'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('Orders'),
			'index.php?option=com_k2store&view=orders',
			$vName == 'orders'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('Tax Profiles'),
			'index.php?option=com_k2store&view=taxprofiles',
			$vName == 'taxprofiles'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('Shopper Addresses'),
			'index.php?option=com_k2store&view=addresses',
			$vName == 'addresses'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('Shipping Methods'),
			'index.php?option=com_k2store&view=shippingmethods',
			$vName == 'shippingmethods'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('Information'),
			'index.php?option=com_k2store&view=info',
			$vName == 'info'
		);
		
	}
	
	
	
}	
