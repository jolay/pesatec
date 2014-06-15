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

jimport('joomla.application.component.controller');

class K2StoreControllerInfo extends JController {

    function display() {
        JRequest::setVar('view', 'Info');
        parent::display();
    }

}
