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

//$mrl = 'http://www.k2store.org/index.php?option=com_wiupdate&view=checkupdate&format=ajax';
$mrl = JURI::root().'index.php?option=com_wiupdate&view=checkupdate&format=ajax';

$version = $this->row->version;
$doc = &JFactory::getDocument();


?>
 
<div style="padding: 4px 8px; border: 6px solid #becae4;">
<table>
	
	<tr>
		<td><h1 style="font: normal 18px Verdana, sans-serif; margin: 0 0 12px 0; padding: 0;">
		<?php echo JText::_('Update Check'); ?> </h1>
		</td>
		<td id="checkUpdate"> 
			<?php
			if($this->wiupdate->cupdate) { ?>
				<span class='updateyes'> <a href='http://k2store.org/download.html'><?php echo JText::_('New Version Available'); ?> : <?php echo $this->wiupdate->newversion; ?></a></span>
			<?php } else { ?>
				<span class='updateno'><?php echo JText::_('Your K2 Store is Up-to-date'); ?></span>
			<?php } ?>
		
		 </td>
	</tr>
	
	<tr>
		<td><h1 style="font: normal 18px Verdana, sans-serif; margin: 0 0 12px 0; padding: 0;">
		<?php echo JText::_('Current Version'); ?> </h1>
		</td>
		<td id="currentVersion"><?php echo $this->row->version; ?></td>
	</tr>
	
	
	<tr>
		<td colspan="2">
			
			<h1 style="font: normal 18px Verdana, sans-serif; margin: 0 0 12px 0; padding: 0;"> K2 Store</h1>
			
			<p style="margin: 10px 0; font: normal 14px Arial, sans-serif;">
			K2Store is a simple shopping cart extension for the famous K2 Content Construction Kit of Joomla CMS. 
			The extension is created by <a href="http://weblogicxindia.com">Weblogicx India</a>, professional Joomla extension
			developers.
			</p>
			
			<p style="margin: 10px 0; font: normal 16px Verdana, sans-serif; color: #333; "> 
			Key features of K2 Store: <br /> 
			<ul style="margin-left: 15px; color: #0055b3; font: normal 16px Verdana, sans-serif;">
			<li>Ajax shopping cart </li>
			<li>Product options, tax, shipping, global discount.</li>
			<li>Payment plugins - Paypal, Authorize.Net </li>
			<li>Enhanced order management </li>
			<li>Guest checkout </li>
			<li>Sell downloadable products</li>
			<li>Professional Support from developers</li>
			</ul></p>

			<p>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_donations">
			<input type="hidden" name="business" value="rameshelamathi@gmail.com">
			<input type="hidden" name="lc" value="US">
			<input type="hidden" name="item_name" value="K2Store">
			<input type="hidden" name="no_note" value="0">
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_SM.gif:NonHostedGuest">
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
			</p>
	
			<p style="margin: 10px 0;">
			<strong> Visit : <a href="http://k2store.org">K2Store.Org</a> to know more. <br /> 
			Use our <a href="http://k2store.org/support/forum.html"> forum</a> to post your queries <br /> 
			</strong>
			</p>
			
			
		 </td>
	</tr>
	
	
</table>
</div>
