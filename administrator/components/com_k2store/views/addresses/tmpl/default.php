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



<form action="index.php?option=com_k2store&view=addresses" method="post" name="adminForm">
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
				<?php echo JHTML::_('grid.sort',  'First Name', 'a.first_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th class="title">
				<?php echo JHTML::_('grid.sort',  'Last Name', 'a.last_name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			
			<th class="title">
				<?php echo JHTML::_('grid.sort',  'User ID', 'a.user_id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			
			<th class="title">
				<?php echo JHTML::_('grid.sort',  'Username', 'u.username', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			
			<th width="15%" class="title">
				<?php echo JHTML::_('grid.sort',  'Address 1', 'a.address_1', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="15%" class="title">
				<?php echo JHTML::_('grid.sort',  'Address 2', 'a.address_2', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>			
			
			<th width="10%" class="title">
				<?php echo JHTML::_('grid.sort',  'City', 'a.city', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			
			<th width="5%" class="title">
				<?php echo JHTML::_('grid.sort',  'Zip', 'a.zip', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			
			<th width="5%" class="title">
				<?php echo JHTML::_('grid.sort',  'State', 'a.state', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			
			<th width="5%" class="title">
				<?php echo JHTML::_('grid.sort',  'Country', 'a.country', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
						
			<th width="5%" class="title">
				<?php echo JHTML::_('grid.sort',  'Phone 1', 'a.phone_1', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			
			<th width="5%" class="title">
				<?php echo JHTML::_('grid.sort',  'Phone 2', 'a.phone_2', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			
			<th width="5%" class="title">
				<?php echo JHTML::_('grid.sort',  'Fax', 'a.fax', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="15">
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

		$link 	= JRoute::_( 'index.php?option=com_k2store&view=address&task=edit&cid[]='. $row->id );

		$checked 	= JHTML::_('grid.checkedout',   $row, $i );
	
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td align="center">
				<?php echo $this->escape($row->first_name); ?></a></span>
			</td>
			<td align="center">
				<?php echo $this->escape($row->last_name); ?></a></span>
			</td>
			
			<td align="center">
				<?php echo $this->escape($row->user_id); ?></a></span>
			</td>
			
			<td align="center">
				<span class="editlinktip hasTip" title="<?php echo JText::_( 'View Address' );?>::<?php echo $this->escape($row->username); ?>">
				<a href="<?php echo $link ?>" >
				<?php echo $this->escape($row->username); ?>
				</a>
				</span>
			</td>
			
			 <td>
				<?php echo $this->escape($row->address_1); ?></a></span>
			</td>
			
			<td>
				<?php echo $this->escape($row->address_2); ?></a></span>
			</td>
			
			<td align="center">
				<?php echo $row->city; ?>
			</td>
			<td align="center">
				<?php echo $row->zip; ?>
			</td>
			<td align="center">
				<?php echo $row->state; ?>
			</td>
			<td align="center">
				<?php echo $row->country; ?>
			</td>
			<td align="center">
				<?php echo $row->phone_1; ?>
			</td>
			<td align="center">
				<?php echo $row->phone_2; ?>
			</td>
			<td align="center">
				<?php echo $row->fax; ?>
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
	<input type="hidden" name="view" value="addresses" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>

<div class="clr"></div>

