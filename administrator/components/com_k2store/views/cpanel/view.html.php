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

class K2StoreViewCpanel extends JView
{

	function display($tpl = null) {

		$model = &$this->getModel();

		$params = &JComponentHelper::getParams('com_k2store');
		
		$xmlfile = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'manifest.xml';
		
		
		$data = JApplicationHelper::parseXMLInstallFile($xmlfile);
			foreach($data as $key => $value) {
						$row->$key = $value;
				}
		$output=null;		
		
		//check updates only when curl is enabled
		if(function_exists('curl_exec')) 
		{
		//$mrl = JURI::root().'index.php?option=com_wiupdate&view=checkupdate&format=ajax';	
		$mrl = 'http://k2store.org/index.php?option=com_wiupdate&view=checkupdate&format=ajax';	
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_URL, $mrl);
		
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$data = array(
		"cversion" => "$row->version",
		"wiproduct" => "com_k2store"
		);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);
        
		}

        $wiupdate = json_decode($output);  
        $this->assignRef('row', $row);
		$this->assignRef('wiupdate', $wiupdate);
		
		$user = & JFactory::getUser();
		
		$this->addToolBar();
		K2StoreSubmenuHelper::addSubmenu($vName = 'cpanel');		
		parent::display($tpl);
	}
	
	function addToolBar() {
		JToolBarHelper::title(JText::_('Dashboard'));
		JToolBarHelper::preferences('com_k2store', '500', '850');	
	}

}
