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
/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );
JLoader::register( 'K2StoreTable', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'tables'.DS.'_base.php' ); 


class TableOrderItemAttributes extends K2StoreTable 
{
	function TableOrderItemAttributes( &$db ) 
	{
		$tbl_key 	= 'orderitemattribute_id';
		$tbl_suffix = 'orderitemattributes';
		$name 		= 'k2store';
		
		parent::__construct( "#__{$name}_{$tbl_suffix}", $tbl_key, $db );	
	}
	
	function check()
	{
		return true;
	}
}
