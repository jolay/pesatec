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


class K2StoreViewOrders extends JView
{

	function display($tpl = null) {
		
		require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'library'.DS.'prices.php');
		$mainframe = &JFactory::getApplication();
		$option = 'com_k2store';

		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();
		
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.id',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$filter_orderstate	= $mainframe->getUserStateFromRequest( $option.'filter_orderstate',	'filter_orderstate',	'', 'string' );
		
		
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		if (strpos($search, '"') !== false) {
			$search = str_replace(array('=', '<'), '', $search);
		}
		$search = JString::strtolower($search);

		// Get data from the model
		$items		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );

		$javascript 	= 'onchange="document.adminForm.submit();"';
		
		//order state filter
		$filter_orderstate_options[]= JHTML::_('select.option', 0, JText::_('- Select Order State -'));	
		$filter_orderstate_options[] = JHTML::_('select.option', 'Confirmed', JText::_('Confirmed'));
		$filter_orderstate_options[] = JHTML::_('select.option', 'Pending', JText::_('Pending'));
		$filter_orderstate_options[] = JHTML::_('select.option', 'Failed', JText::_('Failed'));
		$lists['orderstate'] = JHTML::_('select.genericlist', $filter_orderstate_options, 'filter_orderstate', $javascript, 'value', 'text', $filter_orderstate);


		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;

		// search filter
		$lists['search']= $search;

		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);

		$model = &$this->getModel();

		$params = &JComponentHelper::getParams('com_k2store');
		
		$this->addToolBar();
		K2StoreSubmenuHelper::addSubmenu($vName = 'orders');
		
		parent::display($tpl);
	}
	
	function addToolBar() {
		JToolBarHelper::title(JText::_('Orders Manager'));
		JToolBarHelper::deleteList();
		
	}

}
