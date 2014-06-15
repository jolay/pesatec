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
defined( '_JEXEC' ) or die( 'Restricted access' );
JHTML::_('stylesheet', 'style.css', 'administrator/components/com_k2store/css/');
require_once (JPATH_SITE.DS.'components'.DS.'com_k2store'.DS.'helpers'.DS.'utilities.php');
require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'submenu.php');
/*
 * Make sure the user is authorized to view this page
 */
	$controller = JRequest::getWord('view', 'cpanel');
	require_once (JPATH_COMPONENT_ADMINISTRATOR.DS.'controllers'.DS.$controller.'.php');
	$classname = 'K2StoreController'.$controller;
	$controller = new $classname();
	$controller->execute(JRequest::getWord('task'));
	$controller->redirect();
?>
