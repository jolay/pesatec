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


class TableAddress extends JTable
{
	
	/** @var int Primary key */
	var $id = null;
	
	/** @var int */
	var $user_id = null;
		
	/** @var string */
	var $first_name = null;	
	
	/** @var string */
	var $last_name = null;	
	
	/** @var string */
	var $address_1 	= null;
	
	/** @var string */
	var $address_2 	= null;
	
	/** @var string */
	var $city 	= null;
	
	/** @var string */
	var $zip 	= null;	
	
	/** @var string */
	var $country = null;	
	
	/** @var string */
	var $state 	= null;
	
	/** @var string */
	var $phone_1 	= null;
	
	/** @var string */
	var $phone_2 	= null;
	
	/** @var string */
	var $fax 	= null;
	
	/**
	* @param database A database connector object
	*/
	
	function __construct(&$db)
	{
		parent::__construct('#__k2store_address', 'id', $db );
	}
	
	
	/**
	 * Checks the entry to maintain DB integrity 
	 * @return unknown_type
	 */
	function check()
	{
		if (empty($this->user_id))
		{
			    $this->setError( "User Required" );
	            return false;
	     }
	    
	    if (empty($this->first_name))
		{
			$this->setError( "First Name Required" );
			return false;
		}
	    if (empty($this->last_name))
        {
            $this->setError( "Last Name Required" );
            return false;
        }
	    if (empty($this->address_1))
        {
            $this->setError( "At Least One Address Line is Required" );
            return false;
        }
	    if (empty($this->city))
        {
            $this->setError( "City Required" );
            return false;
        }
	    if (empty($this->zip))
        {
            $this->setError( "Zip/Postal code Required" );
            return false;
        }
                           
	    if (empty($this->country))
        {
            $this->setError( "Country Required" );
            return false;
        }
        
	    if (empty($this->phone_1))
        {
            $this->setError( "At least one phone number required" );
            return false;
        }        
        
		return true;
	}
	
	
}

