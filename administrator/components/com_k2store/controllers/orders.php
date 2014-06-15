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

class K2StoreControllerOrders extends JController {
	
    function display() {
        JRequest::setVar('view', 'orders');
       parent::display();
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
	
		$model = $this->getModel('orders');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_k2store&view=orders', 'Deleted item(s)' );
	}
	
	
	function view() {
		
		require_once( JPATH_SITE.DS.'components'.DS.'com_k2store'.DS.'models'.DS.'orders.php' );
		$orders_model = new K2StoreModelOrders;
		$id = JRequest::getVar('id');
		$orders_model  = $this->getModel('orders');
		$orders_model->setId($id);
		$order = $orders_model->getTable( 'orders' );
        $row = $order->load($orders_model->getId());
        $orderitems = &$order->getItems();
        $row = $orders_model->getItem();
        $view = $this->getView( 'orders', 'html' );
        $view->set( '_controller', 'orders' );
        $view->set( '_view', 'orders' );
        $view->set( '_doTask', true);
        $view->set( 'hidemenu', false);
        //$view->setModel( $orders_model, true );
        $view->assign( 'row', $row );
		$params = &JComponentHelper::getParams('com_k2store');
		$show_tax = $params->get('show_tax_total');
        $view->assign( 'show_tax', $show_tax );
        
        foreach ($orderitems as &$item)
        {
      		$item->orderitem_price = $item->orderitem_price + floatval( $item->orderitem_attributes_price );       		
        	$taxtotal = 0;
            if($show_tax)
            {
            	$taxtotal = ($item->orderitem_tax / $item->orderitem_quantity);            	
            }                   
            $item->orderitem_price = $item->orderitem_price + $taxtotal;
            $item->orderitem_final_price = $item->orderitem_price * $item->orderitem_quantity;
            $order->order_subtotal += ($taxtotal * $item->orderitem_quantity);    
        }
        
        //get the select list;
        $status_values = array(1 => JText::_('Confirmed'), 3 => JText::_('Failed'), 4 => JText::_('Pending'));

        foreach($status_values as $key=>$value) :
			$options[] = JHTML::_('select.option', $key, $value);
		endforeach;

		$order_state = JHTML::_('select.genericlist', $options, 'order_state_id', 'class="inputbox"', 'value', 'text', $order->order_state_id);
 
         //print_r($order);     exit;
        $view->assign( 'order', $order );
        $view->assign( 'order_state', $order_state );
        $view->assign( 'params', $params );
        $view->setLayout( 'view' );
        $this->_setModelState();
        $view->display();        
    }
    
    
    function printOrder() {
		
		require_once( JPATH_SITE.DS.'components'.DS.'com_k2store'.DS.'models'.DS.'orders.php' );
		$orders_model = new K2StoreModelOrders;
		$id = JRequest::getVar('id');
		$orders_model  = $this->getModel('orders');
		$orders_model->setId($id);
		$order = $orders_model->getTable( 'orders' );
        $row = $order->load($orders_model->getId());
        $orderitems = &$order->getItems();
        $row = $orders_model->getItem();
        $view = $this->getView( 'orders', 'html' );
        $view->set( '_controller', 'orders' );
        $view->set( '_view', 'orders' );
        $view->set( '_doTask', true);
        $view->set( 'hidemenu', false);
        //$view->setModel( $orders_model, true );
        $view->assign( 'row', $row );
		$params = &JComponentHelper::getParams('com_k2store');
		$show_tax = $params->get('show_tax_total');
        $view->assign( 'show_tax', $show_tax );
        
        foreach ($orderitems as &$item)
        {
      		$item->orderitem_price = $item->orderitem_price + floatval( $item->orderitem_attributes_price );       		
        	$taxtotal = 0;
            if($show_tax)
            {
            	$taxtotal = ($item->orderitem_tax / $item->orderitem_quantity);            	
            }                   
            $item->orderitem_price = $item->orderitem_price + $taxtotal;
            $item->orderitem_final_price = $item->orderitem_price * $item->orderitem_quantity;
            $order->order_subtotal += ($taxtotal * $item->orderitem_quantity);    
        }      
         //print_r($order);     exit;
        $view->assign( 'order', $order );
        $view->assign( 'params', $params );
        $view->setLayout( 'print' );
        $this->_setModelState();
        $view->display();        
    }
	
	
	   function _setModelState()
    {
	    $app = JFactory::getApplication();
	    $params = &JComponentHelper::getParams('com_k2store');
        $model = $this->getModel('orders');
        $ns = 'com_k2store.orders';
	
		$state = array();
		$state['limit']  	= $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'), 'int');
		$state['limitstart'] = $app->getUserStateFromRequest($ns.'limitstart', 'limitstart', 0, 'int');
		$state['order']     = $app->getUserStateFromRequest($ns.'.filter_order', 'filter_order', 'tbl.'.$model->getTable()->getKeyName(), 'cmd');
		$state['direction'] = $app->getUserStateFromRequest($ns.'.filter_direction', 'filter_direction', 'ASC', 'word');
		$state['filter']    = $app->getUserStateFromRequest($ns.'.filter', 'filter', '', 'string');
		$state['filter_enabled'] 	= $app->getUserStateFromRequest($ns.'enabled', 'filter_enabled', '', '');
		$state['id']        = JRequest::getVar('id', JRequest::getVar('id', '', 'get', 'int'), 'post', 'int');


        // adjust offset for when filter has changed
        if (
            $app->getUserState( $ns.'orderstate' ) != $app->getUserStateFromRequest($ns.'orderstate', 'filter_orderstate', '', '') 
        )
        {
            $state['limitstart'] = '0';
        }

        $state['order']     = $app->getUserStateFromRequest($ns.'.filter_order', 'filter_order', 'tbl.created_date', 'cmd');
        $state['direction'] = $app->getUserStateFromRequest($ns.'.filter_direction', 'filter_direction', 'DESC', 'word');
        
        $state['filter_orderstate'] = $app->getUserStateFromRequest($ns.'orderstate', 'filter_orderstate', '', 'string');
        
      //  $state['filter_userid']     = JFactory::getUser()->id;
      //  $filter_userid = $app->getUserStateFromRequest($ns.'userid', 'filter_userid', JFactory::getUser()->id, 'int');
        
        $state['filter_total']      = $app->getUserStateFromRequest($ns.'total', 'filter_total', '', 'float');
      
        foreach (@$state as $key=>$value)
        {
            $model->setState( $key, $value );   
        }
        return $state;		
		
	}
	
	function orderstatesave() {
		
		$id = JRequest::getVar('id', 0, 'post', 'int');
		$order_state_id = JRequest::getVar('order_state_id', 0, 'post', 'int');
		
		// $status_values = array(1 => JText::_('Confirmed'), 3 => JText::_('Failed'), 4 => JText::_('Pending'));
		if($order_state_id == 4) {
			$order_state = JText::_('Pending');	
		} elseif ($order_state_id == 3) {
			$order_state = JText::_('Failed');	
		} elseif ($order_state_id == 1) {
			$order_state = JText::_('Confirmed');	
		}
		
		JTable::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'tables' );
        $order = JTable::getInstance('Orders', 'Table');
        $order->load($id);
        //lets change the status
        $order->order_state = $order_state; 
        $order->order_state_id = $order_state_id;
        
        if ($order->save()) {
			require_once(JPATH_SITE.DS.'components'.DS.'com_k2store'.DS.'helpers'.DS.'orders.php');
			K2StoreOrdersHelper::sendUserEmail($order->user_id, $order->order_id, $order->transaction_status, $order->order_state, $order->order_state_id);
			$msg = JText::_('Order status updated successfully');
		} else {
			$msg = JText::_('Error in updating order status');
		}
		$link = 'index.php?option=com_k2store&view=orders&task=view&id='.$order->id;

		$this->setRedirect($link, $msg);				
	} 
	
	
}
