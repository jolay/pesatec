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

jimport('joomla.application.component.controller');

class K2StoreControllerAddress extends JController {

    function display() {
		
		switch($this->getTask())
		{			
			case 'edit'    :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'address');
				JRequest::setVar( 'edit', true );
				$model = $this->getModel('address');
				
			} 
			break;
			
		}
	    parent::display();
    }
    
    
    function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$post	= JRequest::get('post');
		
		//print_r($post); exit;
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post['id'] = (int) $cid[0];

		$model = $this->getModel('address');

		if ($model->store($post)) {
			$msg = JText::_( 'Address Saved' );
		} else {
			$msg = JText::_( 'Error Saving address' );
		}

		$link = 'index.php?option=com_k2store&view=addresses';
		$this->setRedirect($link, $msg);
	}
    

}
?>
