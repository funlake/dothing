<fieldset>
	<legend>Debug</legend>
	<div class="tabs-left ">
		<ul class="nav nav-tabs">				
<?php foreach((array)DOBlocks::GetBlock('profiler')->GetProfiler() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

		  <li><a href="#<?php echo $item_0['id']?>" data-toggle="tab"><?php echo $item_0['tab']?>/<?php echo $key_0?></a></li>
			
<?php endforeach;?>
</ul>

		<div class="tab-content">
			<div >				
<?php foreach((array)DOBlocks::GetBlock('profiler')->GetErrors() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

				<div class='tab-pane' id='<?php echo $item_0['id']?>'><?php echo $key_0?></div>
				
<?php endforeach;?>
</div>
		</div>
	</div>
</fieldset>