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
K2StoreSubmenuHelper::addSubmenu($vName = 'shippingmethods');
?>

<form action="index.php" method="post" name="adminForm" id="adminForm">		
<div id="k2store_shipping_method_item" class="col width-60">

<fieldset>
	<legend><?php echo JText::_('Details'); ?> </legend>
	
	<table class="admintable" width="100%">
	
		<tr>
			<td width="100" align="right" class="key">
				<label for="shipping_method_name">
					<?php echo JText::_( 'Shipping method' ); ?>:
				</label>
			</td>
			<td>
				<input type="text" name="shipping_method_name" id="shipping_method_name" size="32" maxlength="250" value="<?php  echo $this->item->shipping_method_name;?>" />
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key">
				<label for="shipping_method_type">
					<?php echo JText::_( 'Shipping type' ); ?>:
				</label>
			</td>
			<td>
				<select id="shipping_method_type" name="shipping_method_type">
					<option selected="selected" value="0">Flat Rate Per Order</option>
					<option value="1">Quantity Based Per Order</option>
					<option value="2">Price Based Per Order</option>
				</select>
			</td>
		</tr>
	
		<tr>
			<td valign="top" align="right" class="key">
				<?php echo JText::_( 'Published' ); ?>:
			</td>
			<td>
				<?php echo $this->lists['published']; ?>
			</td>
		</tr>
	</table>
	
</fieldset>	
			
</div>
	<input type="hidden" name="option" value="com_k2store" />
	<input type="hidden" name="view" value="shippingmethods" />
	<input type="hidden" name="cid[]" value="<?php echo $this->shippingmethods->id; ?>" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<div class="clr"></div>

