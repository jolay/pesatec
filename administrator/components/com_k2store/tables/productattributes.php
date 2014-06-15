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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

class TableProductAttributes extends JTable
{
	
	/** @var int Primary key */
	var $productattribute_id = null;
	
	/** @var int */
	var $product_id = null;	
	
	/** @var int */
	var $productattribute_name = null;
	
	/** @var int */
	var $ordering = null;
		
	/**
	* @param database A database connector object
	*/
	function __construct(&$db)
	{
		parent::__construct('#__k2store_productattributes', 'productattribute_id', $db );
	}
	
	
	function check()
	{
		if (empty($this->product_id))
		{
			$this->setError( JText::_( "Product Association Required" ) );
			return false;
		}
        if (empty($this->productattribute_name))
        {
            $this->setError( JText::_( "Attribute Name Required" ) );
            return false;
        }
		return true;
	}
	
	
	function save()
	{
	    $this->_isNew = false;
	    $key = $this->getKeyName();
	    if (empty($this->$key))
        {
            $this->_isNew = true;
        }
        
		if ( !$this->check() )
		{
			return false;
		}
		
		if ( !$this->store() )
		{
			return false;
		}
		
		if ( !$this->checkin() )
		{
			$this->setError( $this->_db->stderr() );
			return false;
		}
		
		$this->reorder();
		
		
		$this->setError('');
		
		// TODO Move ALL onAfterSave plugin events here as opposed to in the controllers, duh
        //$dispatcher = JDispatcher::getInstance();
        //$dispatcher->trigger( 'onAfterSave'.$this->get('_suffix'), array( $this ) );
		return true;
	}
	
	
	 function reorder()
    {
        parent::reorder('product_id = '.$this->_db->Quote($this->product_id) );
    }
    
	
	 function delete( $oid=null )
    {
        if ($oid) 
        { 
            $k = $oid;
        } 
            else 
        { 
            $k = $this->_tbl_key;
        }
        
        if ($return = parent::delete( $oid ))
        {
            // also delete all PAOs for this PA
            $query = 'DELETE FROM #__k2store_productattributeoptions WHERE productattribute_id='.$k;
            $this->_db->setQuery( (string) $query );
            $this->_db->query();          
        }
        return $return;
    }

}
?>
