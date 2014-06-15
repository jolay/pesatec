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
class K2StorePopup {


function popup( $url, $text, $options = array() ) 
	{
		
require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'library'.DS.'browser.php');
		$params = &JComponentHelper::getParams('com_k2store');
		$html = "";
		
		if(!empty($options['onclose']))
		{
			JHTML::_('behavior.modal', 'a.modal', array('onClose'=> $options['onclose']) );
		}
		else
		{
			if (!empty($options['update']))
			{
			    JHTML::_('behavior.modal', 'a.modal', array('onClose'=>'\function(){k2storeUpdate();}') );
			}
	            else
			{
			    JHTML::_('behavior.modal', 'a.modal');
			}
		}

		// set the $handler_string based on the user's browser
		if(!empty($options['onclose'])) {
			$handler_string = "{handler:'iframe',size:{x: window.innerWidth-80, y: window.innerHeight-80}, onShow:$('sbox-window').setStyles({'padding': 0}), onClose: function(){k2storeNewModal('Refreshing the window...'); submitbutton('apply');}}";
		} else {	
			$handler_string = "{handler:'iframe',size:{x: window.innerWidth-80, y: window.innerHeight-80}, onShow:$('sbox-window').setStyles({'padding': 0})}";
		}
        
	    $browser = new K2StoreBrowser();
        if ( $browser->getBrowser() == K2StoreBrowser::BROWSER_IE ) 
        {
            // if IE, use 
            if(!empty($options['onclose'])) {
				$handler_string = "{handler:'iframe',size:{x:window.getSize().scrollSize.x-80, y: window.getSize().size.y-80}, onShow:$('sbox-window').setStyles({'padding': 0}), onClose: function(){k2storeNewModal('Refreshing the window...'); submitbutton('apply');}}";            
			} else {
				$handler_string = "{handler:'iframe',size:{x:window.getSize().scrollSize.x-80, y: window.getSize().size.y-80}, onShow:$('sbox-window').setStyles({'padding': 0})}";            
			}
        }
		
		$handler = (!empty($options['img']))
		  ? "{handler:'image'}"
		  : $handler_string;

		$lightbox_width = $params->get('lightbox_width');
		if(empty($options['width']) && !empty($lightbox_width))
			$options['width'] = $lightbox_width;
		  		
		if(!empty($options['width']))
		{
			if (empty($options['height']))
				$options['height'] = 480;	
			
			$handler = "{handler: 'iframe', size: {x: ".$options['width'].", y: ".$options['height']. "}}";	
		}			

		$class = (!empty($options['class'])) ? $options['class'] : '';
		
		$html	= "<a class=\"modal\" href=\"$url\" rel=\"$handler\" >\n";
		$html 	.= "<span class=\"".$class."\" >\n";
        $html   .= "$text\n";
		$html 	.= "</span>\n";
		$html	.= "</a>\n";
		
		return $html;
	}

}
