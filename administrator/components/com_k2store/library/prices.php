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
defined('_JEXEC') or die('Restricted access');

JLoader::register('K2Parameter', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'lib'.DS.'k2parameter.php');
	
class K2StorePrices 
{
	
	function getPrice( $id, $quantity = '1')
	{
		// $sets[$id][$quantity][$group_id][$date]
		static $sets;
		
		if ( !is_array( $sets ) )
		{
			$sets = array( );
		}
		
		$price = null;
		if ( empty( $id ) )
		{
			return $price;
		}
		
		if ( !isset( $sets[$id][$quantity] ) )
		{
			
			( int ) $quantity;
			if ( $quantity <= '0' )
			{
				$quantity = '1';
			}
			
			// TiendaModelProductPrices is a special model that overrides getItem
			$price = K2StorePrices::getItemPrice( $id );
			$item = new JObject;
			$item->product_price = $price;
			$sets[$id][$quantity] = $item;
		}
		
		return $sets[$id][$quantity];
	}
	
		
	/**
	 * 
	 * @return unknown_type
	 */
	function getItemPrice(&$id) 
	{
		
		
		$mainframe = JFactory::getApplication();
				
		$item = K2StorePrices::_getK2Item($id);
		$pluginName = 'k2store';

		//get the item price and tax profile id
		//for 1.5 'k2parameter' for 1.6,1.7 'jparameter'
		//$plugins = new K2Parameter($item->plugins, '', $pluginName);
		
		$plugin = &JPluginHelper::getPlugin('k2', $pluginName);
		$pluginParams = new JParameter($plugin->params);
		
		// Get the output of the K2 plugin fields (the data entered by your site maintainers)
		$plugins = new K2Parameter($item->plugins, '', $pluginName);
		
		 $item_price = $plugins->get('item_price'); 
		 $item_taxid = $plugins->get('item_tax');
		
		//now get the tax
		
	//	if ($item_taxid) {
	//		$taxrate = K2StorePrices::_getTaxRate($item_taxid);
	//		$price = $item_price + ($item_price * $taxrate);
	//	} else {
	//		$price = $item_price;
	//	}
		$price = $item_price;
		//process the price for number format
		//$price = K2StorePrices::number($price);
		
		return $price;  
	}
	
	
	function getItemTax(&$id) {
		
		$item = K2StorePrices::_getK2Item($id);
		$pluginName = 'k2store';

		//get the item price and tax profile id
		//$plugins = new JParameter($item->plugins, '', $pluginName);
		$plugin = &JPluginHelper::getPlugin('k2', $pluginName);
		$pluginParams = new JParameter($plugin->params);
		
		// Get the output of the K2 plugin fields (the data entered by your site maintainers)
		$plugins = new K2Parameter($item->plugins, '', $pluginName);
		
		 $item_price = $plugins->get('item_price'); 
		 $item_taxid = $plugins->get('item_tax');
		 if ($item_taxid) {
			 $taxrate = K2StorePrices::_getTaxRate($item_taxid);
		//	$item_tax = $item_price * $taxrate;
		  }	else {
			  //$item_tax = 0;
			  $taxrate = 0;
		  
		  }
		return $taxrate;
		}
	

	
	function _getTaxRate($taxid) {
		
		$db		=& JFactory::getDBO();
		$query= "SELECT tax_percent FROM #__k2store_taxprofiles WHERE id=".$taxid;
		$db->setQuery($query);
		return $db->loadResult();
	}
	
	function number($amount, $options='')
    {
        // default to whatever is in config
		$config = &JComponentHelper::getParams('com_k2store');
        $options = (array) $options;
        $post = '';
        $pre = '';
        
        $default_currency = $config->get('currency_code', 'USD');
        $num_decimals = isset($options['num_decimals']) ? $options['num_decimals'] : $config->get('currency_num_decimals', '2');
        $thousands = isset($options['thousands']) ? $options['thousands'] : $config->get('currency_thousands', ',');
        $decimal = isset($options['decimal']) ? $options['decimal'] : $config->get('currency_decimal', '.');
        $currency_symbol = isset($options['currency']) ? $options['currency'] : $config->get('currency', '$');
        $currency_position = isset($options['currency_position']) ? $options['currency_position'] : $config->get('currency_position', 'pre');
        if($currency_position == 'post') {
			$post = $currency_symbol;
		} else {
			$pre = $currency_symbol;
		}
		
        $return = $pre.number_format($amount, $num_decimals, $decimal, $thousands).$post;
        
        return $return;
    }
   
	function _getK2Item($id) {
		
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');
		$item = & JTable::getInstance('K2Item', 'Table');
		$id = intval($id);
		$item->load($id);
		return $item;
	}
	
}

