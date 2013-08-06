<div class="well">
<table class="table table-bordered table-striped">
	<thead></thead>
	<tbody>
	<?php foreach($errors as $es):?>
	<tr class="info">
		<td width='10%'>Error msg</td>
		<td><?php echo preg_replace(
						DO_DEBUG ? '#//detail:(.*)$#i' : '#(?:[^/]+)//detail:(.*)$#i'
					   ,'<br/><font color=red>\1</font>'
					   ,$es['msg']);?>
		</td>
	</tr>
	<tr>
		<td>Traces</td>
		<td>
			<?php if(DO_DEBUG) :?>
				<table calss="table table-bordered table-striped">
				<tr>
					<th width='30%'>File</th>
					<th width='5%'>Line</th>
					<th>Function</th>
				</tr>
				<tr>
						<td><?php echo $es['file'];?></td>
						<td><?php echo $es['line'];?></td>
						<td>&nbsp;</td>
				</tr>
				<?php foreach($es['trace'] as $trace):?>
					<tr>
						<td><?php echo $trace['file']?$trace['file']:'^';?></td>
						<td><?php echo $trace['line']?$trace['line']:'-';?></td>
						<td><?php echo $trace['class'].$trace['type'].$trace['function'];?></td>
					</tr>
				<?php endforeach;?>
				</table>
			<?php else: ?>
				&nbsp;-
			<?php endif;?>
		</td>
	</tr>
	<?php endforeach;?>
	</tbody>
</table>
</div>