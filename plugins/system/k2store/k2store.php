<?php
/*
 * --------------------------------------------------------------------------------
   Weblogicx India  - K2 Store v 2.5
 * --------------------------------------------------------------------------------
 * @package		Joomla! 1.7x
 * @subpackage	K2 Store
 * @author    	Weblogicx India http://www.weblogicxindia.com
 * @copyright	Copyright (c) 2010 - 2015 Weblogicx India Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link		http://weblogicxindia.com
 * --------------------------------------------------------------------------------
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );
jimport('joomla.html.parameter');

class plgSystemK2Store extends JPlugin {
	
	function plgSystemK2Store( &$subject, $config ){
		parent::__construct( $subject, $config );
		$this->_plugin = JPluginHelper::getPlugin( 'system', 'k2store' );
        $this->_params = new JParameter( $this->_plugin->params );
		$this->_mainframe= &JFactory::getApplication();
		//if($this->_mainframe->isAdmin())return;
			
	}
	
	function onAfterRoute() {
	
		JHtml::_('behavior.framework');
		$baseURL = JURI::root();
		$document =& JFactory::getDocument();
		if($this->_mainframe->isAdmin()) {
			$document->addScript($baseURL.'administrator/components/com_k2store/js/k2store_admin.js'); 
		}
		
		

		$document->addScriptDeclaration("var k2storeURL = '$baseURL';");
		$document->addScript($baseURL.'components/com_k2store/js/k2store.js'); 
		
		
	}
	
}
