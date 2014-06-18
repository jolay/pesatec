<?php

######################################################################
# OPENPOTION Google Analytics          	          	          	     #
# Copyright (C) 2012 by OPENPOTION  	   	   	   	   	   	   	   	 #
# Homepage   : www.openpotion.com		   	   	   	   	   	   		 #
# Author     : Jason Hull      		   	   	   	   	   	   	   	   	 #
# Email      : jason@openpotion.com 	   	   	   	   	   	   	     #
# Version    : 2.1                        	   	    	   	   	   	 #
# License    : http://www.gnu.org/copyleft/gpl.html GNU/GPL          #
######################################################################
// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgSystemOpenPotiongoogleanalytics extends JPlugin {

	function plgSystemOpenPotiongoogleanalytics(&$subject, $config) {
		parent::__construct($subject, $config);

		if (version_compare(JVERSION, '1.6.0', 'ge')) {
			$mode = $this->params->def('mode', 1);
		}
		else {
			$this->_plugin = JPluginHelper::getPlugin('system', 'openpotiongoogleanalytics');
			$this->_params = new JParameter($this->_plugin->params);
		}
	}

	function onAfterRender() {
		if (version_compare(JVERSION, '1.6.0', 'ge')) {
			$mainframe =& JFactory::getApplication();
		}
		else {
			global $mainframe;
		}

		if (version_compare(JVERSION, '1.6.0', 'ge')) { 
			$web_property_id = $this->params->get('web_property_id');
			$method = $this->params->get('method');
			$web_code = $this->params->get('web_code');
			$insertion = $this->params->get('insertion');
		}
		else {
			$web_property_id = $this->params->get('web_property_id', '');
			$method = $this->params->get('method', '0');
			$web_code = $this->params->get('web_code', '');
			$insertion = $this->params->get('insertion', '0');
		}

		if ( ($web_property_id == '' && $web_code == '') || $mainframe->isAdmin() || strpos($_SERVER["PHP_SELF"], "index.php") === false) {
			return;
		}
		
		//cheching for correct user settings
		if (!$method && ($web_property_id == '') && ($web_code != ''))
			$method = 1;
		else if ($method && ($web_code == '') && ($web_property_id != ''))
			$method = 0;
		
		//getting working Tracking Code from Web Property ID
		if (!$method) {
			#Begin build the list of options
			$ga_options = '_gaq.push([\'_setAccount\', \'' . $web_property_id . '\']);' . "\n";
			# Check if this one of the more advanced configurations
			if (version_compare(JVERSION, '1.6.0', 'ge')) { 
				$domain_model = $this->params->get('domain_model');
			}
			else {
				$domain_model = $this->params->get('domain_model', '');
			}
			if ($domain_model > 0) {
				switch ($domain_model) {
					case 1:
						if (version_compare(JVERSION, '1.6.0', 'ge')) { 
							$tracking_domain = $this->params->get('tracking_domain');
						}
						else {
							$tracking_domain = $this->params->get('tracking_domain', '');
						}
						if ($tracking_domain != '') {
							# We want to be sure there is a leading dot
							if (substr($tracking_domain, 0) != '.') {
								$tracking_domain = '.' . $tracking_domain;
							}
							$ga_options = $ga_options . '_gaq.push([\'_setDomainName\', \'' . $tracking_domain . '\']);' . "\n";
						}
						break;
					case 2:
						if (version_compare(JVERSION, '1.6.0', 'ge')) { 
							$tracking_domain = $this->params->get('tracking_domain');
						}
						else {
							$tracking_domain = $this->params->get('tracking_domain', '');
						}
						if ($tracking_domain != '') {
							# We want to be sure there is a leading dot
							if (substr($tracking_domain, 0) != '.') {
								$tracking_domain = '.' . $tracking_domain;
							}
							$ga_options = $ga_options . '_gaq.push([\'_setDomainName\', \'' . $tracking_domain . '\']);' . "\n";
						}
						$ga_options = $ga_options . '_gaq.push([\'_setAllowLinker\', true]);' . "\n";
						break;
				}
			}
			$ga_options = $ga_options . '_gaq.push([\'_trackPageview\']);' . "\n";
			
			$google_analytics_javascript = '<script type="text/javascript">
	var _gaq = _gaq || [];	' . $ga_options . '	(function() {
    	var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    	ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
   		var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  	})();
</script>
';
		}
		//getting Tracking Code from Properties
		else {
			$google_analytics_javascript = $web_code;
		}

		$buffer = JResponse::getBody();
		
		//adding google code-block into the end of the head block or into the end of the body block
		if (!$insertion)
			$pos = strrpos($buffer, "</head>");
		else
			$pos = strrpos($buffer, "</body>");
		
		if ($pos > 0) {
			$buffer = substr($buffer, 0, $pos) . $google_analytics_javascript . substr($buffer, $pos);
			JResponse::setBody($buffer);
		}

		return true;
	}

}

?>