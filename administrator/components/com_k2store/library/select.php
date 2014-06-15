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
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_SITE.DS.'libraries'.DS.'joomla'.DS.'html'.DS.'html'.DS.'select.php' );
require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'library'.DS.'prices.php');
class K2StoreSelect extends JHTMLSelect
{   
	 /**
	 * Generates a +/- select list for pao prefixes
	 * 
	 * @param unknown_type $selected
	 * @param unknown_type $name
	 * @param unknown_type $attribs
	 * @param unknown_type $idtag
	 * @param unknown_type $allowAny
	 * @param unknown_type $title
	 * @return unknown_type
	 */
    public static function productattributeoptionprefix( $selected, $name = 'filter_prefix', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $allowAny = false, $title = 'Select Prefix' )
    {
        $list = array();
        if($allowAny) {
            $list[] =  self::option('', "- ".JText::_( $title )." -" );
        }

        $list[] = JHTML::_('select.option',  '+', "+" );
        $list[] = JHTML::_('select.option',  '-', "-" );
        $list[] = JHTML::_('select.option',  '=', "=" );

        return self::genericlist($list, $name, $attribs, 'value', 'text', $selected, $idtag );
    }
    
    /**
	 * Generates a selectlist for the specified Product Attribute 
	 *
	 * @param unknown_type $productattribute_id 
	 * @param unknown_type $selected
	 * @param unknown_type $name
	 * @param unknown_type $attribs
	 * @param unknown_type $idtag
	 * @return unknown_type
	 */
    
     public static function productattributeoptions( $productattribute_id, $selected, $name = 'filter_pao', $attribs = array('class' => 'inputbox', 'size' => '1'), $idtag = null, $opt_selected = array())
    {
        $list = array();
        
        JModel::addIncludePath( JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'models' );
        $model = JModel::getInstance( 'ProductAttributeOptions', 'K2StoreModel' );
        $model->setId($productattribute_id );
        $model->setState('order', 'a.ordering');
        $items = $model->getData();
        foreach (@$items as $item)
        {
        	if($item->productattributeoption_prefix != '=')
        	{
        		$display_suffix = ($item->productattributeoption_price > '0') ? ": ".$item->productattributeoption_prefix.K2StorePrices::number($item->productattributeoption_price) : '';
        	}
        	else
        	{
        		$display_suffix = ($item->productattributeoption_price > '0') ? ": ".K2StorePrices::number($item->productattributeoption_price) : '';
        	}
        	$display_name = JText::_($item->productattributeoption_name).$display_suffix;
            $list[] =  self::option( $item->productattributeoption_id, $display_name );
        }
        return self::genericlist($list, $name, $attribs, 'value', 'text', $selected, $idtag  );
    }	    
	
}
