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

jimport('joomla.application.component.model');
JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'tables');
class K2StoreModelProductAttributes extends JModel
{
	
	/**
	 * TaxProfile id
	 *
	 * @var int
	 */
	var $_id = null;

	/**
	 * TaxProfile data
	 *
	 * @var array
	 */
	var $_data = null;
	
	function __construct()
	{
		parent::__construct();
		
		$mainframe = &JFactory::getApplication();
		$option = 'com_k2store';
		$ns = 'com_k2store.productattributes';
		
		$id = JRequest::getVar('id', 0, 'get', 'int');
		$this->setId((int)$id);
		
		$ns = $option.'.productattributes';
		// Get the pagination request variables
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart	= $mainframe->getUserStateFromRequest( $ns.'.limitstart', 'limitstart', 0, 'int' );

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);	
			
			
	}
	
	function setId($id)
	{
		// Set taxprofile id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}
	
	function getId() {
		return $this->_id;			
	}
	
	
	/**
	 *
	 * @access public
	 * @return array
	 */
	function getData()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_data))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
		}

		return $this->_data;
	}

	/**
	 *
	 * @access public
	 * @return integer
	 */
	function getTotal()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_total))
		{
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}

		return $this->_total;
	}

	/**
	 * Method to get a pagination object
	 *
	 * @access public
	 * @return integer
	 */
	function getPagination()
	{
		// Lets load the content if it doesn't already exist
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
		}

		return $this->_pagination;
	}

	function _buildQuery()
	{
		// Get the WHERE and ORDER BY clauses for the query
		$where		= $this->_buildContentWhere();
		$orderby	= $this->_buildContentOrderBy();

		$query = ' SELECT a.* '
			. ' FROM #__k2store_productattributes AS a '
			. $where
			. $orderby
		;

		return $query;
	}

	function _buildContentOrderBy()
	{
		$mainframe = &JFactory::getApplication();
		$option = 'com_k2store';
		$ns = $option.'.productattributes';
		
		$filter_order		= $mainframe->getUserStateFromRequest( $ns.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $ns.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		
		$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
		
		return $orderby;
	}

	function _buildContentWhere()
	{
		$mainframe = &JFactory::getApplication();
		$option = 'com_k2store';
		$ns = $option.'.productattributes';

		$db					=& JFactory::getDBO();
		$filter_order		= $mainframe->getUserStateFromRequest( $ns.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $ns.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		
		$where = array();
		
		$where[] = 'a.product_id='.$db->Quote($this->_id);
		
		$where 		= ( count( $where ) ? ' WHERE '. implode( ' AND ', $where ) : '' );

		return $where;
	}
	
}
