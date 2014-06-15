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

class K2StoreControllerShippingMethods extends JController {
	
	function __construct($config = array())
	{
		parent::__construct($config);

		// Register Extra tasks
		$this->registerTask( 'add',  'display' );
		$this->registerTask( 'edit', 'display' );
		
	}

    function display() {
      
        switch($this->getTask())
		{		
		
		
			case 'add'     :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'shippingmethods');
				JRequest::setVar( 'edit', false );
				
			} break;
			case 'edit'    :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'shippingmethods');
				JRequest::setVar( 'edit', true );
				
			} break;
		}        
		
	    parent::display();
    }
    
    function save() {

		$post	= JRequest::get('post');
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post['id'] = (int) $cid[0];
		
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('shippingmethods');
	
		if ($model->store($post)) {
			$msg = JText::_( 'Shipping method saved' );
		} else {
			$msg = JText::_( 'Error Saving Shipping method' );
		}
	
		$link = 'index.php?option=com_k2store&view=shippingmethods';
		$this->setRedirect($link, $msg);
	}
    
 
    function remove()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		
		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('shippingmethods');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_k2store&view=shippingmethods', 'Deleted item(s)' );
	}

	
	function publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}

		$model = $this->getModel('shippingmethods');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_k2store&view=shippingmethods' );
	}


	function unpublish()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to unpublish' ) );
		}

		$model = $this->getModel('shippingmethods');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_k2store&view=shippingmethods' );
	}

	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		// Checkin the weblink
		

		$this->setRedirect( 'index.php?option=com_k2store&view=shippingmethods' );
	}


	function setrates(){

		$app = JFactory::getApplication();
		$model = $this->getModel('shippingrates');
		$ns = 'com_k2store.shippingrates';
		
		$filter_order		= $app->getUserStateFromRequest( $ns.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $app->getUserStateFromRequest( $ns.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$state['id']        = JRequest::getVar('id', JRequest::getVar('id', '', 'get', 'int'), 'post', 'int');

		foreach (@$state as $key=>$value)
		{
			$model->setState( $key, $value );
		}
		
		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		
		$id = JRequest::getVar('id', 0, 'get', 'int');
		
		$model->setState('filter_shippingmethod', $model->getId());
		
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'tables');
		$row = JTable::getInstance('ShippingMethods', 'Table');
		$row->load($model->getId());

		$items =& $model->getList();

		$total		= & $model->getTotal();
		$pagination = & $model->getPagination();
      
        $view   = $this->getView( 'shippingrates', 'html' );
        $view->set( '_controller', 'shippingmethods' );
        $view->set( '_view', 'shippingmethods' );
        $view->set( '_action', "index.php?option=com_k2store&view=shippingmethods&task=setrates&id=".$id."&tmpl=component" );
        $view->setModel( $model, true );
        $view->assign( 'row', $row );
        $view->assign( 'items', $items );
		$view->assign( 'total', $total );
		$view->assign( 'lists', $lists );
		$view->assign( 'pagination', $pagination );
		$view->assign( 'product_id', $id );
        $view->setLayout( 'default' );
        $view->display();

		}
		
	    /**
     * Saves the properties for all prices in list
     * 
     * @return unknown_type
     */
    function saverates()
    {
        $error = false;
        $this->messagetype  = '';
        $this->message      = '';
                
        $model = $this->getModel('shippingrates');
        $row = $model->getTable();
        $id = JRequest::getVar('id', 0, 'get', 'int');
        $cids = JRequest::getVar('cid', array(0), 'request', 'array');
        $prices = JRequest::getVar('price', array(0), 'request', 'array');
        $weight_starts = JRequest::getVar('weight_start', array(0), 'request', 'array');
        $weight_ends = JRequest::getVar('weight_end', array(0), 'request', 'array');
        $handlings = JRequest::getVar('handling', array(0), 'request', 'array');
        
        foreach (@$cids as $cid)
        {
            $row->load( $cid );
            $row->shipping_rate_price = $prices[$cid];
            $row->shipping_rate_weight_start = $weight_starts[$cid];
            $row->shipping_rate_weight_end = $weight_ends[$cid];
            $row->shipping_rate_handling = $handlings[$cid];

            if (!$row->save())
            {
                $this->message .= $row->getError();
                $this->messagetype = 'notice';
                $error = true;
            }
        }
        
        if ($error)
        {
            $this->message = JText::_('Error') . " - " . $this->message;
        }
            else
        {
            $this->message = "";
        }

        $redirect = "index.php?option=com_k2store&view=shippingmethods&task=setrates&id={".$id."}&tmpl=component";
        $redirect = JRoute::_( $redirect, false );
        
        $this->setRedirect( $redirect, $this->message, $this->messagetype );
    }
    
    /**
     * Creates a rate and redirects
     * 
     * @return unknown_type
     */
    function createrate()
    {
		
        $model  = $this->getModel('shippingrates');
        $row = $model->getTable();
        $row->shipping_method_id = JRequest::getVar( 'id' );
        $row->shipping_rate_price = JRequest::getVar( 'shipping_rate_price' );
        $row->shipping_rate_weight_start = JRequest::getVar( 'shipping_rate_weight_start' );
        $row->shipping_rate_weight_end = JRequest::getVar( 'shipping_rate_weight_end' );
        $row->shipping_rate_handling  = JRequest::getVar( 'shipping_rate_handling' );
		
        //$row->bind($_POST);
        
		if ( !$row->save() )
		{
			$messagetype = 'notice';
			$message = JText::_( 'Save Failed' )." - ".$row->getError();
		}
		
		$redirect = "index.php?option=com_k2store&view=shippingmethods&task=setrates&id={$row->shipping_method_id}&tmpl=component";
        $redirect = JRoute::_( $redirect, false );
        
        $this->setRedirect( $redirect, $this->message, $this->messagetype );
    }
    
    function deleterates(){
		
				$error = false;
		$this->messagetype	= '';
		$this->message 		= '';
		$ship_method_id = JRequest::getVar( 'id' );
		if (!isset($this->redirect)) {
			$this->redirect = JRequest::getVar( 'return' )			
			? base64_decode( JRequest::getVar( 'return' ) )
			: 'index.php?option=com_k2store&view=shippingmethods&task=setrates&id='.$ship_method_id.'&tmpl=component';
			$this->redirect = JRoute::_( $this->redirect, false );
		}
	
		$model = $this->getModel('shippingrates');
		$row = $model->getTable();

		$cids = JRequest::getVar('cid', array (0), 'request', 'array');
		foreach (@$cids as $cid)
		{
			if (!$row->delete($cid))
			{
				$this->message .= $row->getError();
				$this->messagetype = 'notice';
				$error = true;
			}
		}

		if ($error)
		{
			$this->message = JText::_('Error') . " - " . $this->message;
		}
		else
		{
			$this->message = JText::_('Items Deleted');
		}

		$this->setRedirect( $this->redirect, $this->message, $this->messagetype );

		
	}
	

}
