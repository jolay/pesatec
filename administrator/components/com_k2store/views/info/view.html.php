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

jimport('joomla.application.component.view');

class K2StoreViewInfo extends JView
{

	function display($tpl = null) {
		
		$mainframe = &JFactory::getApplication();
		$option = 'com_k2store';

		jimport ( 'joomla.filesystem.file' );
		$user = & JFactory::getUser();
		$db = & JFactory::getDBO();
		$db_version = $db->getVersion();
		$php_version = phpversion();
		$server = $this->get_server_software();
		$gd_check = extension_loaded('gd');
		$mb_check = extension_loaded('mbstring');

		$uri	=& JFactory::getURI();
		$model = &$this->getModel();
		
		$this->assignRef('server',$server);
		$this->assignRef('php_version',$php_version);
		$this->assignRef('db_version',$db_version);
		$this->assignRef('gd_check',$gd_check);
		$this->assignRef('mb_check',$mb_check);
		
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);

		
		$params = &JComponentHelper::getParams('com_k2store');
		
		$this->addToolBar();
		K2StoreSubmenuHelper::addSubmenu($vName = 'cpanel');		
		parent::display($tpl);
	}
	
	function get_server_software()
	{
		if (isset($_SERVER['SERVER_SOFTWARE'])) {
			return $_SERVER['SERVER_SOFTWARE'];
		} else if (($sf = getenv('SERVER_SOFTWARE'))) {
			return $sf;
		} else {
			return JText::_( 'n/a' );
		}
	}
	
	function addToolBar() {
		JToolBarHelper::title(JText::_('K2 Store Info'));		
	}

}
