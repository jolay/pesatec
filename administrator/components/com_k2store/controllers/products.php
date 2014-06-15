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

class K2StoreControllerProducts extends JController {

   function __construct()
	{
		parent::__construct();
		
    }
    
    
    function createattribute() {
		$model  = $this->getModel( 'productattributes' );
		$row = $model->getTable();
		$row->product_id = JRequest::getVar( 'id' );
		$row->productattribute_name = JRequest::getVar( 'productattribute_name' );
        $row->ordering = '99';
      //  $post=JRequest::get('post');
       
		if ( !$row->save() )
		{
			$messagetype = 'notice';
			$message = JText::_( 'Save Failed' )." - ".$row->getError();
		}
		
		$redirect = "index.php?option=com_k2store&view=products&task=setattributes&id={$row->product_id}&tmpl=component";
		$redirect = JRoute::_( $redirect, false );

		$this->setRedirect( $redirect, $message, $messagetype );
		
	}
    
    
    function setattributes()
	{
		$app = JFactory::getApplication();
		$model = $this->getModel('productattributes');
		$ns = 'com_k2store.productattributes';
		
		$filter_order		= $app->getUserStateFromRequest( $ns.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $app->getUserStateFromRequest( $ns.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		
		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		
		$id = JRequest::getVar('id', 0, 'get', 'int');
		
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2'.DS.'tables');
		$row = JTable::getInstance('K2Item', 'Table');
		$row->load($id);
		
		$items = $model->getData();
		$total		= & $model->getTotal();
		$pagination = & $model->getPagination();
		
		$view   = $this->getView( 'productattributes', 'html' );
		$view->set( '_controller', 'products' );
		$view->set( '_view', 'products' );
		$view->set( '_action', "index.php?option=com_k2store&view=products&task=setattributes&tmpl=component&id=".$id);
		$view->setModel( $model, true );
		$view->assign( 'state', $model->getState() );
		$view->assign( 'row', $row );
		$view->assign( 'items', $items );
		$view->assign( 'total', $total );
		$view->assign( 'lists', $lists );
		$view->assign( 'pagination', $pagination );
		$view->assign( 'product_id', $id );
		$view->setLayout( 'default' );
		$view->display();
	}
	
	
	function saveattributes()
	{
		$error = false;
		$this->messagetype  = '';
		$this->message      = '';

		$model = $this->getModel('productattributes');
		$row = $model->getTable();
		
		$id = JRequest::getVar('id', 0, 'get', 'int');
		$cids = JRequest::getVar('cid', array(0), 'request', 'array');
		$name = JRequest::getVar('name', array(0), 'request', 'array');
		$ordering = JRequest::getVar('ordering', array(0), 'request', 'array');

		foreach (@$cids as $cid)
		{
			$row->load( $cid );
			$row->productattribute_name = $name[$cid];
			$row->ordering = $ordering[$cid];

			if (!$row->check() || !$row->store())
			{
				$this->message .= $row->getError();
				$this->messagetype = 'notice';
				$error = true;
			}
		}
		$row->reorder();

		if ($error)
		{
			$this->message = JText::_('Error') . " - " . $this->message;
		}
		else
		{
			$this->message = "";
		}

		$redirect = "index.php?option=com_k2store&view=products&task=setattributes&id={$id}&tmpl=component";
		$redirect = JRoute::_( $redirect, false );

		$this->setRedirect( $redirect, $this->message, $this->messagetype );
	}

	
	function deleteattributes()
	{		
		$error = false;
		$this->messagetype	= '';
		$this->message 		= '';
		$product_id = JRequest::getVar( 'product_id' );
		if (!isset($this->redirect)) {
			$this->redirect = JRequest::getVar( 'return' )			
			? base64_decode( JRequest::getVar( 'return' ) )
			: 'index.php?option=com_k2store&view=products&task=setattributes&id='.$product_id.'&tmpl=component';
			$this->redirect = JRoute::_( $this->redirect, false );
		}
	
		$model = $this->getModel('productattributes');
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
	
    function setattributeoptions()
	{
		$app = JFactory::getApplication();
		$model = $this->getModel('productattributeoptions');
		$ns = 'com_k2store.productattributeoptions';
		$filter_order		= $app->getUserStateFromRequest( $ns.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $app->getUserStateFromRequest( $ns.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		
		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		
		$id = JRequest::getVar('id', 0, 'get', 'int');
		
		JTable::addIncludePath(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'tables');
		$row = JTable::getInstance('ProductAttributes', 'Table');
		$row->load($model->getId());
		
		$items = $model->getData();
		$total		= & $model->getTotal();
		$pagination = & $model->getPagination();

		$view   = $this->getView( 'productattributeoptions', 'html' );
		$view->set( '_controller', 'products' );
		$view->set( '_view', 'products' );
		$view->set( '_action', "index.php?option=com_k2store&view=products&task=setattributeoptions&tmpl=component&id=".$model->getId());
		$view->setModel( $model, true );
		$view->assign( 'state', $model->getState() );
		$view->assign( 'row', $row );
		$view->assign( 'items', $items );
		$view->assign( 'total', $total );
		$view->assign( 'lists', $lists );
		$view->assign( 'pagination', $pagination );
		$view->setLayout( 'default' );
		$view->display();
	}
	
	
	function createattributeoption()
	{
		$model  = $this->getModel( 'productattributeoptions' );
		$row = $model->getTable();
		$row->productattribute_id = JRequest::getVar( 'id' );
		$row->productattributeoption_name = JRequest::getVar( 'productattributeoption_name' );
		$row->productattributeoption_price = JRequest::getVar( 'productattributeoption_price' );
		$row->productattributeoption_code = JRequest::getVar( 'productattributeoption_code' );
		$row->productattributeoption_prefix = JRequest::getVar( 'productattributeoption_prefix' );
        $row->ordering = '99';
        
		if (!$row->save() )
		{
			$this->messagetype  = 'notice';
			$this->message      = JText::_( 'Save Failed' )." - ".$row->getError();
		}

		$redirect = "index.php?option=com_k2store&view=products&task=setattributeoptions&id={$row->productattribute_id}&tmpl=component";
		$redirect = JRoute::_( $redirect, false );

		$this->setRedirect( $redirect, $this->message, $this->messagetype );
	}

    
    function saveattributeoptions()
	{
		$error = false;
		$this->messagetype  = '';
		$this->message      = '';

		$model = $this->getModel('productattributeoptions');
		$row = $model->getTable();
		
		$productattribute_id = JRequest::getVar('id');
		$cids = JRequest::getVar('cid', array(0), 'request', 'array');
		$name = JRequest::getVar('name', array(0), 'request', 'array');
		$prefix = JRequest::getVar('prefix', array(0), 'request', 'array');
		$price = JRequest::getVar('price', array(0), 'request', 'array');
		$code = JRequest::getVar('code', array(0), 'request', 'array');
		$ordering = JRequest::getVar('ordering', array(0), 'request', 'array');

		foreach (@$cids as $cid)
		{
			$row->load( $cid );
			$row->productattributeoption_name = $name[$cid];
			$row->productattributeoption_prefix = $prefix[$cid];
			$row->productattributeoption_price = $price[$cid];
			$row->productattributeoption_code = $code[$cid];
			$row->ordering = $ordering[$cid];

			if (!$row->check() || !$row->store())
			{
				$this->message .= $row->getError();
				$this->messagetype = 'notice';
				$error = true;
			}
		}
		$row->reorder();

		if ($error)
		{
			$this->message = JText::_('Error') . " - " . $this->message;
		}
		else
		{
			$this->message = "";
		}

		$redirect = "index.php?option=com_k2store&view=products&task=setattributeoptions&id={$productattribute_id}&tmpl=component";
		$redirect = JRoute::_( $redirect, false );

		$this->setRedirect( $redirect, $this->message, $this->messagetype );
	}
	
	function deleteattributeoptions()
	{		
		$error = false;
		$this->messagetype	= '';
		$this->message 		= '';
		$productattribute_id = JRequest::getVar( 'pa_id' );
		if (!isset($this->redirect)) {
			$this->redirect = JRequest::getVar( 'return' )			
			? base64_decode( JRequest::getVar( 'return' ) )
			: 'index.php?option=com_k2store&view=products&task=setattributeoptions&id='.$productattribute_id.'&tmpl=component';
			$this->redirect = JRoute::_( $this->redirect, false );
		}
	
		$model = $this->getModel('productattributeoptions');
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
