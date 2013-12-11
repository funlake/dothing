<form action="<?php echo Url('install/index/savedbsetting');?>" method="post" id="Afm" name="Afm" class="form-horizontal">
<div class="row top20">
	<div class="span12">
		
			<div class="form-group">
				<label class="control-label col-lg-2" for="dbhost">
					<?php echo L('Host');?>
				</label>
				<div class="col-lg-4">
					<input type="text" id="dbhost" name="dbhost" class="form-control" value="" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2" for="dbuser">
					<?php echo L('User');?>
				</label>
				<div class="col-lg-4">
					<input type="text" id="dbuser" name="dbuser" class="form-control" value="" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2" for="dbpass">
					<?php echo L('Host');?>
				</label>
				<div class="col-lg-4">
					<input type="password" id="dbpass" name="dbpass" class="form-control" value=""/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2" for="database">
					<?php echo L('Database');?>
				</label>
				<div class="col-lg-4">
					<input type="text" id="database" name="database" class="form-control" value="" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2" for="tablepre">
					<?php echo L('Table prefix');?>
				</label>
				<div class="col-lg-4">
					<input type="text" id="tablepre" name="tablepre" class="form-control" value="do_" required/>
				</div>
			</div>
	</div>
</div>
<div class="row span8 top20">
	<div class="span4"></div>
	<div class="span4">
		<a class="btn btn-medium btn-info" href="<?php echo Url('install/index/check');?>"><?php echo L('Prev');?></a>
		<button class="btn btn-medium btn-primary"><?php echo L('Save and next');?></button>
	</div>
</div>
</form>