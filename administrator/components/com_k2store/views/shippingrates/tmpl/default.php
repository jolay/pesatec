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

 defined('_JEXEC') or die('Restricted access');
 JHTML::_('stylesheet', 'style.css', 'administrator/components/com_k2store/css/');
 $state = @$this->state;
 $items = @$this->items;
 $row = @$this->row;
 $action = JRoute::_( 'index.php?option=com_k2store&view=shippingmethods&task=setrates&tmpl=component&id='.$row->id);
  require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'library'.DS.'popup.php');
 ?>

<h3><?php echo JText::_( "Set Rates for" ); ?>: 
<?php 	echo $row->shipping_method_name; ?></h3>

<div class="note" style="width: 95%; text-align: center; margin-left: auto; margin-right: auto;">
	<?php echo JText::_( "Be Sure to Save Your Work" ); ?>:
	<button onclick="document.adminForm.toggle.checked=true; checkAll(<?php echo count( @$items ); ?>); document.getElementById('task').value='saverates'; document.adminForm.submit();"><?php echo JText::_('Save Changes'); ?></button>
</div>

<form action="<?php echo $action; ?>" method="post" name="adminForm" enctype="multipart/form-data">

	
    <table>
        <tr>
            <td align="left" width="100%">
            </td>
            <td nowrap="nowrap">
            	<table class="adminlist">
            	<thead>
            	<tr>
            		<th><?php echo JText::_( "Range" ); ?></th>
            		<th><?php echo JText::_( "Price" ); ?></th>
            		<th><?php echo JText::_( "Handling Fee" ); ?></th>
            		<th></th>
            	</tr>
            	</thead>
            	<tbody>
            	<tr>
					<td>
            			<input id="shipping_rate_weight_start" name="shipping_rate_weight_start" value="" size="5" />
            			<?php echo JText::_("to"); ?>
                		<input id="shipping_rate_weight_end" name="shipping_rate_weight_end" value="" size="5" />
                	</td>
            		<td>
            			<input id="shipping_rate_price" name="shipping_rate_price" value="" />
            		</td>
                    <td>
                        <input id="shipping_rate_handling" name="shipping_rate_handling" value="" />
                    </td>
            		<td>
            			<input type="button" onclick="document.getElementById('task').value='createrate'; document.adminForm.submit();" value="<?php echo JText::_('Create Rate'); ?>" class="button" />
            		</td>
            	</tr>
            	</tbody>
            	</table>
            </td>
        </tr>
    </table>
    
	<table class="adminlist" style="clear: both;">
		<thead>
            <tr>
                <th style="width: 20px;">
                	<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( @$items ); ?>);" />
                </th>
                <th style="text-align: center;">
                	<?php echo JHTML::_('grid.sort',  'Range', 'tbl.shipping_rate_weight_start',  $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
                <th style="text-align: center;">
					<?php echo JHTML::_('grid.sort',  'Price', 'tbl.shipping_rate_price',  $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
              
                <th style="text-align: center;">
                	<?php echo JHTML::_('grid.sort',  'Handling Fees', 'tbl.shipping_rate_handling',  $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
				<th>
				</th>
            </tr>
		</thead>
        <tbody>
		<?php $i=0; $k=0; ?>
        <?php foreach (@$items as $item) : 
        $checked = JHTML::_('grid.id', $i, $item->shipping_rate_id);
        ?>
            <tr class='row<?php echo $k; ?>'>
				<td style="text-align: center;">
				<?php 
					echo $checked;
					//echo TiendaGrid::checkedout( $item, $i, 'shipping_rate_id' ); ?>
				</td>
			
				<td style="text-align: center;">
				    <input type="text" name="weight_start[<?php echo $item->shipping_rate_id; ?>]" value="<?php echo $item->shipping_rate_weight_start; ?>" />
				    <?php echo JText::_("to"); ?>
				    <input type="text" name="weight_end[<?php echo $item->shipping_rate_id; ?>]" value="<?php echo $item->shipping_rate_weight_end; ?>" />
				</td>
				<td style="text-align: center;">
					<input type="text" name="price[<?php echo $item->shipping_rate_id; ?>]" value="<?php echo $item->shipping_rate_price; ?>" />
				</td>
				<td style="text-align: center;">
					<input type="text" name="handling[<?php echo $item->shipping_rate_id; ?>]" value="<?php echo $item->shipping_rate_handling; ?>" />
				</td>
				<td style="text-align: center;">
					[<a href="index.php?option=com_k2store&view=shippingmethods&task=deleterates&id=<?php echo $row->id; ?>&cid[]=<?php echo $item->shipping_rate_id; ?>&return=<?php echo base64_encode("index.php?option=com_k2store&view=shippingmethods&task=setrates&id={$row->id}&tmpl=component"); ?>">
						<?php echo JText::_( "Delete Rate" ); ?>	
					</a>
					]
				</td>
			</tr>
			<?php $i=$i+1; $k = (1 - $k); ?>
			<?php endforeach; ?>
			
			<?php if (!count(@$items)) : ?>
			<tr>
				<td colspan="10" align="center">
					<?php echo JText::_('No items found'); ?>
				</td>
			</tr>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="20">
					<?php echo @$this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	</table>

	<input type="hidden" name="order_change" value="0" />
	<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
	<input type="hidden" name="task" id="task" value="setrates" />
	<input type="hidden" name="boxchecked" value="" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	
	<?php //echo $this->form['validate']; ?>
</form>
