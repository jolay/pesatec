<?php
/**
*/

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

/** Import library dependencies */
jimport('joomla.plugin.plugin');

class plgUserK2Store extends JPlugin
{
    function plgUserK2Store(&$subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage( '', JPATH_ADMINISTRATOR );
    }

    /**
     * When the user logs in, their session cart should override their db-stored cart.
     * Current actions take precedence
     *
     * @param $user
     * @param $options
     * @return unknown_type
     */
    function onUserLogin($user, $options)
    {
    	$session =& JFactory::getSession();
    	$old_sessionid = $session->get( 'old_sessionid' );

    	$user['id'] = intval(JUserHelper::getUserId($user['username']));
    	
    	// Should check that K2 Store is installed first before executing
        if (!$this->_isInstalled())
        {
            return;
        }
        
        JLoader::register( "K2StoreHelperCart", JPATH_SITE.DS."components".DS."com_k2store".DS."helpers".DS."cart.php" );

        $helper = new K2StoreHelperCart();
        if (!empty($old_sessionid))
        {
            $helper->mergeSessionCartWithUserCart( $old_sessionid, $user['id'] );
        }
            else
        {
            $helper->updateUserCartItemsSessionId( $user['id'], $session->getId() );
        }
       
       return true;
    }

    /**
     * Checks the extension is installed 
     *
     * @return boolean
     */
    function _isInstalled()
    {
        $success = false;

        jimport('joomla.filesystem.file');
        if (JFile::exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'admin.k2store.php'))
        {
            $success = true;
        }
        return $success;
    }
   
   
}
