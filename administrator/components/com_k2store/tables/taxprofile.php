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

class TableTaxProfile extends JTable
{
	
	/** @var int Primary key */
	var $id = null;
	
	/** @var int */
	var $taxprofile_name = null;	
	
	/** @var int */
	var $tax_percent = null;
	
	/** @var int */
	var $published = null;
		
	/**
	* @param database A database connector object
	*/
	function __construct(&$db)
	{
		parent::__construct('#__k2store_taxprofiles', 'id', $db );
	}
	
	
}
?>
