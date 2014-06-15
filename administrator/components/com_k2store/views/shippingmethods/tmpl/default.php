<?php
/*
 * --------------------------------------------------------------------------------
   Weblogicx India  - K2 Store v 2.0
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
JHTML::_('stylesheet', 'style.css', 'administrator/components/com_k2store/css/');
require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'library'.DS.'popup.php');
?>

<form action="index.php?option=com_k2store&view=shippingmethods" method="post" name="adminForm">
<table>
<tr>
	<td align="left" width="100%">
		<?php echo JText::_( 'Filter' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo htmlspecialchars($this->lists['search']);?>" class="text_area" onchange="document.adminForm.submit();" />
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
	</td>	
</tr>
</table>

<div id="editcell" class="width-60">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort',  'ID', 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>			
			<th class="title">
				<?php echo JHTML::_('grid.sort',  'Name', 'shipping_method_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="5%" nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'Published', 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="5">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];

		$link 	= JRoute::_( 'index.php?option=com_k2store&view=shippingmethods&task=edit&cid[]='. $row->id );

		$checked 	= JHTML::_('grid.checkedout',   $row, $i );
		$published 	= JHTML::_('grid.published', $row, $i );
	
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<?php echo $this->escape($row->id); ?>
			</td>
			<td>
				<span class="editlinktip hasTip" title="<?php echo JText::_( 'View Shipping method' );?>::<?php echo $this->escape($row->shipping_method_name); ?>">
				<a href="<?php echo $link ?>" >
				<?php echo $this->escape($row->shipping_method_name); ?>
				</a>
				</span>
				<br/>
				<b>Type</b>:
				<?php 
				$model = $this->getModel('shippingmethods');
				$row->shipping_method_type = $model->getShippingMethodType($row->shipping_method_type);
				echo $this->escape($row->shipping_method_type); ?>
				
				<span style="float:right">
					[<?php echo K2StorePopup::popup( "index.php?option=com_k2store&view=shippingmethods&task=setrates&id=".$row->id."&tmpl=component", JText::_( "Set Rates" ) ); ?>]
				</span>
			</td>
			
			<td align="center">
				<?php echo $published;?>
			</td>			
			
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</tbody>
	</table>
</div>

	<input type="hidden" name="option" value="com_k2store" />
	<input type="hidden" name="view" value="shippingmethods" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>

<div class="clr"></div>

