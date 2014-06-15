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

class TableOrderdetails extends JTable
{
	
	/** @var int Primary key */
	var $id = null;
	
	/** @var int */
	var $user_id = null;
	
	/** @var datetime */
	var $order_date = null;
		
	/** @var datetime */
	var $order_id = null;
	
	/** @var int */
	var $itemid	= null;
	
	/** @var string */
	var $itemname 	= null;
	
	/** @var float */
	var $itemprice 	= null;
	
	/** @var int */
	var $quantity	= null;
	
	/** @var float */
	var $total 	= null;
	
	/** @var float */
	var $tax_total 	= null;
		
	/**
	* @param database A database connector object
	*/
	function __construct(&$db)
	{
		parent::__construct('#__k2store_orderdetails', 'id', $db );
	}
	
	
}
?>
