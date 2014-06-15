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

?>



<form action="index.php?option=com_k2store&view=orders" method="post" name="adminForm">
<table>
<tr>
	<td align="left" width="100%">
		<?php echo JText::_( 'Filter' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo htmlspecialchars($this->lists['search']);?>" class="text_area" onchange="document.adminForm.submit();" />
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
	</td>
	<td nowrap="nowrap">
		<?php
		echo $this->lists['orderstate'];		
		?>
	</td>
</tr>
</table>

<div id="editcell">
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
				<?php echo JHTML::_('grid.sort',  'Invoice ID', 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>			
			<th class="title">
				<?php echo JHTML::_('grid.sort',  'Order ID', 'a.order_id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="15%"  class="title">
				<?php echo JHTML::_('grid.sort',  'Buyer Name', 'a.user_id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			
			<th width="15%"  class="title">
				<?php echo JText::_('Email'); ?>
			</th>
			
			<th width="15%">
				<?php echo JHTML::_('grid.sort',  'Amount', 'a.orderpayment_amount', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="15%">
				<?php echo JHTML::_('grid.sort',  'Payment Type', 'a.orderpayment_type', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="15%">
				<?php echo JHTML::_('grid.sort',  'Transaction Status', 'a.transaction_status', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="15%">
				<?php echo JHTML::_('grid.sort',  'Order Status', 'a.order_state', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="10">
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

		$link 	= JRoute::_( 'index.php?option=com_k2store&view=orders&task=view&id='. $row->id );

		$checked 	= JHTML::_('grid.checkedout',   $row, $i );
	
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<?php echo $this->escape($row->id); ?></a></span>
			</td>
			<td>
				<span class="editlinktip hasTip" title="<?php echo JText::_( 'View Order' );?>::<?php echo $this->escape($row->order_id); ?>">
				<a href="<?php echo $link ?>" >
				<?php echo $this->escape($row->order_id); ?>
				</a>
				</span>
			</td>
		
			<td align="center">
				<?php echo $row->buyer; ?>
			</td>
			
			<td align="center">
				<?php echo $row->bemail; ?>
			</td>
			
			<td align="center">
				<?php echo K2StoreUtilities::number( $row->orderpayment_amount, array( 'thousands'=>'' ) ); ?>
			</td>
			<td align="center">
				<?php echo $row->orderpayment_type; ?>
			</td>
			<td align="center">
				<?php echo $row->transaction_status; ?>
			</td>
			<td align="center">
				<?php echo $row->order_state; ?>
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
	<input type="hidden" name="view" value="orders" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>

<div class="clr"></div>

