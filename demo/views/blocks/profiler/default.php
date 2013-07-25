<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
?>
<div class="well">
	<ul class="nav nav-tabs">				
<?php foreach(DOBlocks::GetBlock('profiler')->GetProfiler() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

	  <li><a href="#<?php echo ($item_0["id"]);?>" data-toggle="tab"><?php echo ($item_0["tab"]);?></a></li>
		
<?php endforeach;?>
</ul>

	<div class="tab-content">
		<div >				
<?php foreach(DOBlocks::GetBlock('profiler')->GetProfiler() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

			<div class='tab-pane' id='<?php echo ($item_0["id"]);?>'><?php echo ($item_0["content"]);?></div>
			
<?php endforeach;?>
</div>
	</div>
</div>