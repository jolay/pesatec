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

require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'library'.DS.'popup.php');

class JElementItemOptions extends JElement
{
	var	$_name = 'itemoptions';

	function fetchElement($name, $value, &$node, $control_name){
		
		$fieldName = $control_name.'['.$name.']';
		
		//get libraries
		$html ='';
		
		$cid = JRequest::getVar('cid');
		if($cid) {
			$link = 'index.php?option=com_k2store&view=products&task=setattributes&id='.$cid.'&tmpl=component';			
			
			//let us first get Product Attribute Names
			$attributes = $this->getProductAttributes($cid);
			if(!empty($attributes)) {
				$html .=$attributes;
			}
		
			$html .= K2StorePopup::popup( $link, JText::_( "Add/edit product attributes" ), array('onclose' => '\function(){k2storeNewModal(\''.JText::_('Saving the Product options...').'\'); submitbutton(\'apply\');}') ); 			
		} 
		
		return $html;
	}
	
	
	function getProductAttributes($product_id) {
		
		$db = &JFactory::getDBO();
		$query = 'SELECT a.* FROM #__k2store_productattributes AS a WHERE a.product_id='. (int) $product_id
				 .' ORDER BY a.ordering'
		;
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$html= '';
		
		if(count($rows)) {
		$html .='<table width="100%">
			<thead>
			<th>'.JText::_('Attribute Name').'</th>
			<th>'.JText::_('Set options').'</th>
			<th>'.JText::_('Options set for this Attribute').'</th>
			<th>'.JText::_('Remove').'</th>
			</thead>
			<tbody>';
			foreach($rows as $row) {
				//lets get a list of attribute options for each attribute
				$pa_options = $this->getProductAttributeOptions($row->productattribute_id);
				
				$html .='<tr>';
				$html .='<td>'.$row->productattribute_name.'</td>';		
				$html .='<td>';		
				$html .= K2StorePopup::popup( "index.php?option=com_k2store&view=products&task=setattributeoptions&id=".$row->productattribute_id."&tmpl=component", JText::_( "Set options to this attribute" ), array('onclose' => '\function(){k2storeNewModal(\''.JText::_('Saving the Product options...').'\'); submitbutton(\'apply\');}')); 
				$html .='</td>';
				//attribute options
				if(!empty($pa_options)) {
					$html .='<td>'.$pa_options.'</td>';
				}
				$html .='<td>';
				$html .='<a href="index.php?option=com_k2store&view=products&task=deleteattributes&cid[]='.$row->productattribute_id.'&return='.base64_encode("index.php?option=com_k2&view=item&cid=".$product_id).'">';
				$html .= JText::_( 'Delete Attribute' );
				$html .='</a>';
				$html .='</td>';
				$html .='</tr>';			
			}
			
			$html .='</tbody>';
			$html .='</table>';				
		}
		return $html;
	}
	
	
	function getProductAttributeOptions($pa_id) {
		
		$db = &JFactory::getDBO();
		$query = 'SELECT a.* FROM #__k2store_productattributeoptions AS a WHERE a.productattribute_id='. (int) $pa_id
				 .' ORDER BY a.ordering'
		;
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		
		$html = '';
		foreach ($rows as $row) {
			$html .= $row->productattributeoption_name.',&nbsp;&nbsp;'; 
		}
		
		return $html;
	}
		
}
