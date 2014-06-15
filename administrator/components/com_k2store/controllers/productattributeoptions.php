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
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');
class K2StoreControllerProductAttributeOptions extends JController 
{
	/**
	 * constructor
	 */
	function __construct() 
	{
		parent::__construct();
		
	}
	
	/**
	 * delete the object and updates the product quantities
	 */
	function delete(){
		
		$this->message = '';
		$this->messagetype = '';
		$error = false;
		
		$cids = JRequest::getVar('cid', array (0), 'request', 'array');
				
		// Get the ProductQuantities model
		$qmodel = JModel::getInstance('ProductQuantities', 'TiendaModel');
		// Filter the quantities
		$qmodel->setState('filter_attributes', implode(',', $cids));
		$quantities = $qmodel->getList();
		$qtable = $qmodel->getTable();
		
		// Delete the product quantities
		foreach(@$quantities as $q){
			if (!$qtable->delete($q->productquantity_id)){
				$this->message .= $qtable->getError();
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
		
		// delete the option itself
		parent::delete();
	}
	
	/**
	 * Expected to be called from ajax
	 */
	public function getProductAttributeOptions()
	{
		$attribute_id = JRequest::getInt('attribute_id', 0);
		$name = JRequest::getVar('select_name', 'parent');
		$id = JRequest::getVar('select_id', '0');
		
		$response = array();
		$response['msg'] = '';
		$response['error'] = '';
		
		if($attribute_id)
		{
			Tienda::load('TiendaSelect', 'library.select');
			$response['msg']  = TiendaSelect::productattributeoptions($attribute_id, 0, $name."[".$id."]");
		}
		else
		{
			$response['msg']  = '<input type="hidden" name="'.$name."[".$id."]".'" />';
		}
		
		echo json_encode($response);
	}
}

?>
