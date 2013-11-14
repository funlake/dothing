<div class="well">
<!-- 	<form class="form-horizontal" id="Afm" method="post" action="<?php echo Url('debug/index/clearsession');?>">
		<div class="col-lg-5"></div>
		<div class="col-lg-4"></div>
		<div class="col-lg-3">
			<?php if(strpos($mca,'autocrud') === false) :?>
			<button class="btn btn-danger" id="clear_seesion">
				<i class="glyphicon glyphicon-remove glyphicon-white"></i> <?php echo L('Clear and back');?>
			</button>
			<?php endif;?>
		</div>
		<input type="hidden" value="<?php echo $source;?>" name="source_link"/>
		<input type="hidden" value="<?php echo $mca;?>" name="mca"/>
	</form> -->
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