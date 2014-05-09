<fieldset class="debug">
	<legend>Debug</legend>
	<div class="tabs-right ">
		<ul class="nav nav-tabs span2">				
<?php foreach((array)\Dothing\Lib\Blocks::GetBlock('profiler')->GetProfiler() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

		  <li class="<?php echo $item_0['class']?>"><a href="#<?php echo $item_0['id']?>" data-toggle="tab"><?php echo $item_0['tab']?></a></li>
			
<?php endforeach;?>
</ul>

		<div class="tab-content span9">				
<?php foreach((array)\Dothing\Lib\Blocks::GetBlock('profiler')->GetProfiler() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

			<div class='tab-pane <?php echo $item_0['class']?>' id='<?php echo $item_0['id']?>'>
				<table class="table table-striped table-hover">
					<thead>
						<tr >
							<th width="40%">Item</th>
							<th width="50%">File</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody class="adminTable">								
<?php foreach((array)$item_0["content"] as $key_1=>$item_1) : ?>
<?php $item_1=(array)$item_1; ?>

						<tr class="<?php echo $item_1['class']?>">
							<td><?php echo $item_1['item']?></td>
							<td><?php echo $item_1['file']?></td>
							<td><?php echo $item_1['value']?></td>
						</tr>
							
<?php endforeach;?>
</tbody>
				</table>
			</div>
				
<?php endforeach;?>
</div>
	</div>
</fieldset>