<?php
// Here you can modify the navigation of the website
// No direct access.
defined('_JEXEC') or die; 
?>
<?php if($this->getParam('show_menu', 1)) : ?>
	<div id="gkMenu">
		<?php
			$this->menu->loadMenu($this->getParam('menu_name','mainmenu')); 
		    $this->menu->genMenu($this->getParam('startlevel', 0), $this->getParam('endlevel',-1));
		?>
	</div>
		
<?php if($this->generateSubmenu && $this->menu->genMenu($this->getParam('startlevel', 0)+1, $this->getParam('endlevel',-1), true)): ?>
<div id="gkSubmenu">	
	<?php $this->menu->genMenu($this->getParam('startlevel', 0)+1, $this->getParam('endlevel',-1));?>
</div>	
<?php endif; ?>
<?php endif; ?>