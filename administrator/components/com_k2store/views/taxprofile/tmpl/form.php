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
K2StoreSubmenuHelper::addSubmenu($vName = 'taxprofiles');
?>

<form action="index.php" method="post" name="adminForm" id="adminForm">		
<div id="k2store_taxprofile_item" class="col width-60">

<fieldset>
	<legend><?php echo JText::_('Details'); ?> </legend>
	
	<table class="admintable" width="100%">
	
		<tr>
			<td width="100" align="right" class="key">
				<label for="taxprofile_name">
					<?php echo JText::_( 'Tax Profile Name' ); ?>:
				</label>
			</td>
			<td>
				<input type="text" name="taxprofile_name" id="taxprofile_name" size="32" maxlength="250" value="<?php echo $this->taxprofile->taxprofile_name;?>" />
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key">
				<label for="tax_percent">
					<?php echo JText::_( 'Tax Percent' ); ?>:
				</label>
			</td>
			<td>
				<input type="text" name="tax_percent" id="tax_percent" size="32" maxlength="11" value="<?php echo $this->taxprofile->tax_percent;?>" />
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
	<input type="hidden" name="view" value="taxprofiles" />
	<input type="hidden" name="cid[]" value="<?php echo $this->taxprofile->id; ?>" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
<div class="clr"></div>

