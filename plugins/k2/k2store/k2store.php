<?php
/*
 * --------------------------------------------------------------------------------
   Weblogicx India  - K2 Store v 2.0
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
defined('_JEXEC') or die ('Restricted access');
JLoader::register('K2Plugin', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'lib'.DS.'k2plugin.php');
require_once (JPATH_SITE.DS.'components'.DS.'com_k2store'.DS.'helpers'.DS.'utilities.php');
require_once (JPATH_SITE.DS.'components'.DS.'com_k2store'.DS.'helpers'.DS.'cart.php');
require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'library'.DS.'prices.php');
	
class plgK2K2Store extends K2Plugin {

	// Some params
	var $pluginName = 'k2store';
	var $pluginNameHumanReadable = 'K2 Store';

	function plgK2K2Store( & $subject, $params) {
	
		parent::__construct($subject, $params);		

	}
	
	function onK2PrepareContent( & $item, & $params, $limitstart) {
		 
	}
	
	function onK2AfterDisplay( & $item, & $params, $limitstart) {
	
		$mainframe = &JFactory::getApplication();
		$lang = JFactory::getLanguage();
		$lang->load('com_k2store');
		$k2params = &JComponentHelper::getParams('com_k2store');
		
		$item_price = K2StorePrices::getItemPrice($item->id);
		
		if ($item_price > 0) {
			 $doc = &JFactory::getDocument();
			 $doc->addStyleSheet(JURI::base().'components'.DS.'com_k2store'.DS.'css'.DS.'style.css');
			// show/hide add to cart button
			$content = '';
			$content = K2StoreHelperCart::getAjaxCart($item, $item_price);
			
			 if (!$k2params->get('show_addtocart')) {
				 $output = $content;	
			  }
			  
			  if($k2params->get('isregister')) {
					$user = JFactory::getUser();
					if($user->id && !$k2params->get('show_addtocart')) {
						$isregistered = true;
						$output = $content;
					} else {
						$isregistered = false;
						$output = '';
					}	
			  } 
			
		} else {
			$output = '';
			
		}
		return $output;
	}
	
} // END CLASS

