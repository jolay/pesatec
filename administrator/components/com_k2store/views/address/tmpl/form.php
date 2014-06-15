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

//no direct access
defined('_JEXEC') or die('Restricted access'); 

JHTML::_('behavior.tooltip'); 

	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( 'Address' ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
	$row = $this->address;
?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			form.view.value= 'addresses';
			submitform( pressbutton );
			return;
		}

		// do field validation
		if (form.first_name.value == ""){
			alert( "<?php echo JText::_( 'Enter the first name', true ); ?>" );
		} else {
			submitform( pressbutton );
		}
	}
</script>

<form action="index.php?option=com_k2store&view=address" method="post" name="adminForm" id="adminForm">
<div class="col width-50">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		
			    <tr>
			        <th style="width: 100px; text-align: right;" class="key">
			             <?php echo JText::_( 'First name' ); ?>
			        </th>
			        <td>
			            <input name="first_name" id="first_name" 
			            type="text" size="35" maxlength="250"
			            value="<?php echo $row->first_name; ?>" />
			        </td>
			    </tr>
			    <tr>
			        <th style="width: 100px; text-align: right;" class="key">
			             <?php echo JText::_( 'Last name' ); ?>
			        </th>
			        <td>
			           <input type="text" name="last_name"
			            id="last_name" size="45" maxlength="250"
			            value="<?php echo @$row->last_name; ?>" />
			        </td>
			    </tr>
			    <tr>
			        <th style="width: 100px; text-align: right;" class="key">
			              <?php echo JText::_( 'Address Line 1' ); ?>
			        </th>
			        <td>
			            <input type="text" name="address_1"
			            id="address_1" size="48" maxlength="250" 
			            value="<?php echo @$row->address_1; ?>" />
			        </td>
			    </tr>
			    <tr>
			        <th style="width: 100px; text-align: right;" class="key">
			              <?php echo JText::_( 'Address Line 2' ); ?>
			        </th>
			        <td>
			            <input type="text" name="address_2"
			            id="address_2" size="48" maxlength="250" 
			            value="<?php echo @$row->address_2; ?>" />
			        </td>
			    </tr>
				<tr>
					<th style="width: 100px; text-align: right;" class="key">
			            <?php echo JText::_( 'City' ); ?>
					</th>
					<td>
						<input type="text" name="city" id="city"
						size="48" maxlength="250" 
						value="<?php echo @$row->city; ?>" />
					</td>
				</tr>
				
				<tr>
					<th style="width: 100px; text-align: right;" class="key">
			            <?php echo JText::_( 'Zip' ); ?>
					</th>
					<td>
						<input type="text" name="zip" id="zip"
						size="48" maxlength="250" 
						value="<?php echo @$row->zip; ?>" />
					</td>
				</tr>
				
				<tr>
					<th style="width: 100px; text-align: right;" class="key">
			            <?php echo JText::_( 'State' ); ?>
					</th>
					<td>
						<input type="text" name="state" id="state"
						size="48" maxlength="250" 
						value="<?php echo @$row->state; ?>" />
					</td>
				</tr>
				
				<tr>
					<th style="width: 100px; text-align: right;" class="key">
			            <?php echo JText::_( 'Country' ); ?>
					</th>
					<td>
						<input type="text" name="country" id="country"
						size="48" maxlength="250" 
						value="<?php echo @$row->country; ?>" />
					</td>
				</tr>
				
				<tr>
					<th style="width: 100px; text-align: right;" class="key">
			            <?php echo JText::_( 'Phone' ); ?>
					</th>
					<td>
						<input type="text" name="phone_1" id="phone_1"
						size="25" maxlength="250" 
						value="<?php echo @$row->phone_1; ?>" />
					</td>
				</tr>
				
				<tr>
					<th style="width: 100px; text-align: right;" class="key">
			            <?php echo JText::_( 'Mobile' ); ?>
					</th>
					<td>
						<input type="text" name="phone_2" id="phone_2"
						size="25" maxlength="250"
						value="<?php echo @$row->phone_2; ?>" />
					</td>
				</tr>
				
				<tr>
					<th style="width: 100px; text-align: right;" class="key">
						<?php echo JText::_( 'Fax' ); ?>
					</th>
					<td>
						<input type="text" name="fax" id="fax" 
						size="25" maxlength="250" 
						value="<?php echo @$row->fax; ?>" />
					</td>
				</tr>
			
		
		</table>
	</fieldset>
</div>

<div class="clr"></div>

	<input type="hidden" name="option" value="com_k2store" />
	<input type="hidden" name="view" value="address" />
	<input type="hidden" name="cid[]" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="user_id" value="<?php echo $row->user_id; ?>" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
