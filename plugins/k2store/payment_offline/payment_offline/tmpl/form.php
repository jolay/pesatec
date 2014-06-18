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


defined('_JEXEC') or die('Restricted access'); ?>

<?php echo JText::_( "K2Store Offline Payment Message" ); ?>

<table class="adminlist">
<tbody>
<?php if(!empty($vars->payment_method)): ?>	
<tr>
    <td class="key" style="width: 100px; text-align: right;">
        <?php echo JText::_( "K2Store Offline Payment Method" ); ?>
    </td>
    <td>
        <?php echo $vars->payment_method; ?> 
    </td>
</tr>
<?php endif; ?>
</tbody>
</table>
