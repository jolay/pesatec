<?php

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Restricted access' );

JLoader::register( 'K2StoreTable', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'tables'.DS.'_base.php' ); 

class TableShippingRates extends K2StoreTable
{
	function TableShippingRates ( &$db ) 
	{
        parent::__construct('#__k2store_shippingrates', 'shipping_rate_id', $db );
	}
	
	/**
	 * Checks row for data integrity.
	 * Assumes working dates have been converted to local time for display, 
	 * so will always convert working dates to GMT
	 *  
	 * @return unknown_type
	 */
	function check()
	{		
        if (empty($this->shipping_method_id))
        {
            $this->setError( JText::_( "Shipping Method Required" ) );
            return false;
        }
        
		if (empty($this->created_date) || $this->created_date == $nullDate)
		{
			$date = JFactory::getDate();
			$this->created_date = $date->toMysql();
		}
		
		$date = JFactory::getDate();
		$this->modified_date = $date->toMysql();
		
		return true;
	}
}
