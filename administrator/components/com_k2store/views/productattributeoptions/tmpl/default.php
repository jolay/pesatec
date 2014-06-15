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
JHTML::_('stylesheet', 'style.css', 'administrator/components/com_k2store/css/');
 $state = @$this->state; 
 $items = @$this->items; 
 $row = @$this->row;
 $action = JRoute::_( 'index.php?option=com_k2store&view=products&task=setattributeoptions&tmpl=component&id='.$row->productattribute_id);
 require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_k2store'.DS.'library'.DS.'select.php');

?>

                            
<h1 style="margin-left: 2%; margin-top: 2%;"><?php echo JText::_( "Set Options for" ); ?>: <?php echo $row->productattribute_name; ?></h1>

<form action="<?php echo $action; ?>" method="post" name="adminForm" enctype="multipart/form-data">

	<div class="note" style="width: 96%; margin-left: auto; margin-right: auto;">
	
	    <div style="float: left; font-size: 1.3em; font-weight: bold; height: 30px;"><?php echo JText::_('Add a New Attribute Option'); ?></div>

	    <div class="reset"></div>
	    
                <table class="adminlist">
                <thead>
                <tr>
                    <th></th>
                    <th><?php echo JText::_( "Name" ); ?></th>
                    <th style="width: 15px;"><?php echo JText::_( "Prefix" ); ?></th>
                    <th><?php echo JText::_( "Price" ); ?></th>
                    <th><?php echo JText::_( "Code" ); ?></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <?php echo JText::_( "Complete this form to add a new option" ); ?>:
                    </td>
                    <td>
                        <input id="productattributeoption_name" name="productattributeoption_name" value="" />
                    </td>
                    <td>
                        <?php echo K2StoreSelect::productattributeoptionprefix( "+", 'productattributeoption_prefix' ); ?>
                    </td>
                    <td>
                        <input id="productattributeoption_price" name="productattributeoption_price" value="" size="10" />
                    </td>
                    <td>
                        <input id="productattributeoption_code" name="productattributeoption_code" value="" />
                    </td>
                    <td>
                        <button onclick="document.getElementById('task').value='createattributeoption'; document.adminForm.submit();"><?php echo JText::_('Create Option'); ?></button>
                    </td>
                </tr>
                </tbody>
                </table>
                
	</div>

<div class="note_green" style="width: 96%; margin-left: auto; margin-right: auto;">
    <div style="float: left; font-size: 1.3em; font-weight: bold; height: 30px;"><?php echo JText::_('Current Attribute Options'); ?></div>
    <div style="float: right;">
        <button onclick="document.getElementById('task').value='saveattributeoptions'; document.adminForm.toggle.checked=true; checkAll(<?php echo count( @$items ); ?>); document.adminForm.submit();"><?php echo JText::_('Save All Changes'); ?></button>
    </div>
    <div class="reset"></div>
        
	<table class="adminlist" style="clear: both;">
		<thead>
            <tr>
                <th style="width: 20px;">
                	<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( @$items ); ?>);" />
                </th>
                <th style="text-align: left;">
					<?php echo JHTML::_('grid.sort',  'Attribute Option Name', 'a.productattributeoption_name',  $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
                <th style="width: 100px;">
					<?php echo JHTML::_('grid.sort',  'Attribute Option Prefix', 'a.productattributeoption_prefix',  $this->lists['order_Dir'], $this->lists['order'] ); ?>
                </th>
                <th style="text-align: center;">
					<?php echo JHTML::_('grid.sort',  'Price', 'a.productattributeoption_price',  $this->lists['order_Dir'], $this->lists['order'] ); ?>                    
                </th>
                <th style="text-align: center;">
					<?php echo JHTML::_('grid.sort',  'Code', 'a.productattributeoption_code',  $this->lists['order_Dir'], $this->lists['order'] ); ?> 
                </th>
                <th style="width: 100px;">
                <?php echo JHTML::_('grid.sort',  'Order', 'a.ordering',  $this->lists['order_Dir'], $this->lists['order'] ); ?>                 
                </th>
				<th style="width: 100px;">
				</th>
            </tr>
		</thead>
        <tbody>
		<?php $i=0; $k=0; ?>
        <?php foreach (@$items as $item) : 
        $checked = JHTML::_('grid.id', $i, $item->productattributeoption_id);
        ?>
            <tr class='row<?php echo $k; ?>'>
				<td style="text-align: center;">
					<?php echo $checked; ?>
				</td>
				<td style="text-align: left;">
					<input type="text" name="name[<?php echo $item->productattributeoption_id; ?>]" value="<?php echo $item->productattributeoption_name; ?>" />
				</td>
                <td style="text-align: center;">
                    <?php echo K2StoreSelect::productattributeoptionprefix( $item->productattributeoption_prefix, "prefix[{$item->productattributeoption_id}]" ); ?>
                </td>
                <td style="text-align: center;">
                    <input type="text" name="price[<?php echo $item->productattributeoption_id; ?>]" value="<?php echo $item->productattributeoption_price; ?>" size="10" />
                </td>
                <td style="text-align: center;">
                    <input type="text" name="code[<?php echo $item->productattributeoption_id; ?>]" value="<?php echo $item->productattributeoption_code; ?>" size="10" />
                </td>
              <td style="text-align: center;">
					<input type="text" name="ordering[<?php echo $item->productattributeoption_id; ?>]" value="<?php echo $item->ordering; ?>" size="10" />
				</td>
				<td style="text-align: center;">
					[<a href="index.php?option=com_k2store&view=products&task=deleteattributeoptions&pa_id=<?php echo $row->productattribute_id; ?>&cid[]=<?php echo $item->productattributeoption_id; ?>&return=<?php echo base64_encode("index.php?option=com_k2store&view=products&task=setattributeoptions&id={$row->productattribute_id}&tmpl=component"); ?>">
						<?php echo JText::_( "Delete Option" ); ?>	
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
</div>

	<input type="hidden" name="order_change" value="0" />
	<input type="hidden" name="id" value="<?php echo $row->productattribute_id; ?>" />
	<input type="hidden" name="task" id="task" value="setattributeoptions" />
	<input type="hidden" name="boxchecked" value="" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />	
	
</form>
