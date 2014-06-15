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

class JElementTaxSelect extends JElement
{
	var	$_name = 'taxselect';

	function fetchElement($name, $value, &$node, $control_name){
		
		$fieldName = $control_name.'['.$name.']';
		
		//$document = & JFactory::getDocument();
		//$document->addScriptDeclaration($js);
		//$document->addStyleDeclaration($css);
		
		$lists = $this->_getSelectProfiles($fieldName, $value);
		return $lists;
	}
	
	function _getSelectProfiles($var, $default) {
		
		$db = &JFactory::getDBO();
		$option ='';
		
		$query = 'select id as value, taxprofile_name as text from #__k2store_taxprofiles order by id';		
		$db->setQuery( $query );
		$taxprofiles = $db->loadObjectList();
		
		$types[] 		= JHTML::_('select.option',  '0', '- '. JText::_( 'Select a Tax Profile' ) .' -' );
		foreach( $taxprofiles as $item )
		{
			$types[] = JHTML::_('select.option',  $item->value, JText::_( $item->text ) );
		}		
		
		$lists 	= JHTML::_('select.genericlist',   $types, $var, 'class="inputbox" size="1" '.$option.'', 'value', 'text', $default );
		
		return $lists;
	
	}
}
