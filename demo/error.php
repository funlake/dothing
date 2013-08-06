
<div>
	<div id="error_tabs">
	<table class="table table-bordered table-striped">
		<tr>		
			<th colspan=1000>Error tables </th>
		</tr>
	<?php foreach($e->_getMessage() as $es):?>
		<tr>
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
					<table calss="doerror_table">
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
	</table>
	</div>
</div>
