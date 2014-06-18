<?php

/**
* reCaptcha plugin
* @Copyright (C) 2011 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: GK4 1.0 $
**/

// No direct access
defined('_JEXEC') or die;

jimport( 'joomla.plugin.plugin' );
jimport( 'joomla.application.application' );

class plgSystemGk_ReCaptcha extends JPlugin {
	// function necessary to render captcha form
	function onAfterRender() {
		$app = JFactory::getApplication();
		
		if($app->isSite()) {
			$option = JRequest::getCmd('option', '');
			$view = JRequest::getCmd('view', '');
			
			if($option == 'com_users' && $view == 'registration') {
				require_once('recaptcha/recaptchalib.php');
				$params = json_decode($this->params);
				$buffer = JResponse::getBody();
				$publickey = $params->public_key;
				$settings = '<script>var RecaptchaOptions = { theme : \''.$params->theme.'\', lang : \''.$params->lang.'\' };</script>';
				$buffer = str_replace('<div id="gk_recaptcha"></div>', $settings . recaptcha_get_html($publickey), $buffer);
				JResponse::setBody($buffer);
			} else {
				$buffer = JResponse::getBody();
				$buffer = str_replace('<div id="gk_recaptcha"></div>', '', $buffer);
				JResponse::setBody($buffer);
			}
		}
	}
	// function necessary to check the captcha
	function onAfterInitialise() {
		$app = JFactory::getApplication();
		
		if($app->isSite()) {	
			$option = JRequest::getCmd('option', '');
			$task = JRequest::getCmd('task', '');
			
			if($option == 'com_users' && $task == 'registration.register') {
				require_once('recaptcha/recaptchalib.php');
				$params = json_decode($this->params);
				$resp = recaptcha_check_answer ($params->private_key, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
			
				if (!$resp->is_valid) {
					$app->redirect( 'index.php?option=com_users&view=registration', "Wrong reCaptcha", 'error' );
				}
			}
		}
	}
}