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
class K2StoreItem 
{
		
	/**
	 * 
	 * @return unknown_type
	 */
	function display( $articleid )
	{
		$html = '';
		
		$mainframe = JFactory::getApplication();
		
		JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables' );
        $item = JTable::getInstance('K2Item', 'Table');	
		$item->load( $articleid );
		// Return html if the load fails
		if (!$item->id)
		{
			return $html;
		}
		
		$item->title = JFilterOutput::ampReplace($item->title);
		
		
		//import plugins
		
		$item->text = '';
		
		$item->text = $item->introtext . chr(13).chr(13) . $item->fulltext;

		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');
		$params		=& $mainframe->getParams('com_k2');
		
		//Process Plugins
		$dispatcher = &JDispatcher::getInstance();
		JPluginHelper::importPlugin('content');
		
						$results = $dispatcher->trigger('onContentBeforeDisplay', array(&$item, &$params, $limitstart));
						$item->event->BeforeDisplay = trim(implode("\n", $results));

						$results = $dispatcher->trigger('onContentAfterDisplay', array(&$item, &$params, $limitstart));
						$item->event->AfterDisplay = trim(implode("\n", $results));

						$results = $dispatcher->trigger('onContentAfterTitle', array(&$item, &$params, $limitstart));
						$item->event->AfterDisplayTitle = trim(implode("\n", $results));

						$results = $dispatcher->trigger('onContentBeforeDisplay', array(&$item, &$params, $limitstart));
						$item->event->BeforeDisplayContent = trim(implode("\n", $results));
						
						$dispatcher->trigger('onPrepareContent', array(&$item, &$params, $limitstart));
						$item->introtext = $item->text;
						
		// process k2 plugins
		
		//Init K2 plugin events
					$item->event->K2BeforeDisplay = '';
					$item->event->K2AfterDisplay = '';
					$item->event->K2AfterDisplayTitle = '';
					$item->event->K2BeforeDisplayContent = '';
					$item->event->K2AfterDisplayContent = '';
					$item->event->K2CommentsCounter = '';
						
				
						JPluginHelper::importPlugin('k2');
						$results = $dispatcher->trigger('onK2BeforeDisplay', array(&$item, &$params, $limitstart));
						$item->event->K2BeforeDisplay = trim(implode("\n", $results));

						$results = $dispatcher->trigger('onK2AfterDisplay', array(&$item, &$params, $limitstart));
						$item->event->K2AfterDisplay = trim(implode("\n", $results));

						$results = $dispatcher->trigger('onK2AfterDisplayTitle', array(&$item, &$params, $limitstart));
						$item->event->K2AfterDisplayTitle = trim(implode("\n", $results));

						$results = $dispatcher->trigger('onK2BeforeDisplayContent', array(&$item, &$params, $limitstart));
						$item->event->K2BeforeDisplayContent = trim(implode("\n", $results));

						$results = $dispatcher->trigger('onK2AfterDisplayContent', array(&$item, &$params, $limitstart));
						$item->event->K2AfterDisplayContent = trim(implode("\n", $results));

						$dispatcher->trigger('onK2PrepareContent', array(&$item, &$params, $limitstart));
						$item->introtext = $item->text;
		

		// Use param for displaying article title
			$k2store_params = &JComponentHelper::getParams('com_k2store');
			$show_title = $k2store_params->get('show_title', $params->get('show_title') );
			if ($show_title)
			{
				$html .= "<h3>{$item->title}</h3>";	
			}
			$html .= $item->introtext;
		
		return $html;
	}
	
	
	function getK2Image($id, $size) {
		
		$app = JFactory::getApplication();
		jimport('joomla.filesystem.file');
		
		if (JFile::exists(JPATH_SITE.DS.'media'.DS.'k2'.DS.'items'.DS.'cache'.DS.md5("Image".$id).$size.'.jpg')) {
			$image = JURI::root().'media/k2/items/cache/'.md5("Image".$id).$size.'.jpg';
		} else {
			$image = '';
		}
		return $image;
		
	}
	
	function isShippingEnabled($product_id) {
		$row = K2StoreItem::_getK2Item($product_id);
		$pluginName = 'k2store';

		//get the item price and tax profile id
		//for 1.5 'k2parameter' for 1.6,1.7 'jparameter'
		//$plugins = new K2Parameter($item->plugins, '', $pluginName);
		
		$plugin = &JPluginHelper::getPlugin('k2', $pluginName);
		$pluginParams = new JParameter($plugin->params);
		
		// Get the output of the K2 plugin fields (the data entered by your site maintainers)
		$plugins = new K2Parameter($row->plugins, '', $pluginName);
	
		$shipping = $plugins->get('item_shipping');
		if($shipping) {
			return true;
		}
		return false;		
	}
	
	function _getK2Item($id) {
		
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');
		$item = & JTable::getInstance('K2Item', 'Table');
		$id = intval($id);
		$item->load($id);
		return $item;
	}
	
	
	
	
}

