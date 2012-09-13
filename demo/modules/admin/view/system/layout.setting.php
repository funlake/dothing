<div class="pull-right">
  <button class="btn btn-success" onclick="jQuery('#Afm').submit()">
  	<i class="icon-ok icon-white"></i>
  	<?php echo L('Apply');?>
  </button>
  <button class="btn btn-danger">
  	<i class="icon-remove icon-white"></i>
  	<?php echo L('Cancel');?>
  </button>
</div>
<form action="<?php echo Url(DO_ADMIN_INTERFACE.'/system/savesetting');?>" method="post" id="Afm" name="Afm" class="form-horizontal well">
<fieldset>
	<legend><?php echo L('Database');?></legend>
		<div class="control-group">
			<label class="control-label" for="drive">
				<?php echo DOLang::Get('Driver');?>
			</label>
			<div class="controls">
				<input type="text" id="drive" name="S_DO_DBDRIVE" class="input-xlarge" value="<?php echo $setting['DO_DBDRIVE'];?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="host">
				<?php echo DOLang::Get('Host');?>
			</label>
			<div class="controls">
				<input type="text" id="host" name="S_DO_DBHOST" class="input-xlarge" value="<?php echo $setting['DO_DBHOST'];?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="db">
				<?php echo DOLang::Get('Scheme');?>
			</label>
			<div class="controls">
				<input type="text" id="db" name="S_DO_DATABASE" class="input-xlarge" value="<?php echo $setting['DO_DATABASE'];?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="user">
				<?php echo DOLang::Get('User');?>
			</label>
			<div class="controls">
				<input type="text" id="user" name="S_DO_DBUSER" class="input-xlarge" value="<?php echo $setting['DO_DBUSER'];?>" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">
				<?php echo DOLang::Get('Password');?>
			</label>
			<div class="controls">
				<input type="password" id="password" class="input-xlarge" name="S_DO_DBPASS" value="<?php echo $setting['DO_DBPASS'];?>" />
			</div>
		</div>
		<div class="control-group">
			<?php 
				if(!isset($setting['DO_PDO']))
				{
					$pdo = array(1=>"checked");
				}
				else $pdo = array($setting['DO_PDO'] => "checked");
			?>
			<label class="control-label" for="pdo">
				<?php echo DOLang::Get('Use PDO?');?>
			</label>
			<div class="controls">
				<input id="pdo" name="S_DO_PDO" value="1" type="checkbox" <?php echo $pdo[1];?>/>
			</div>
		</div>
		<div class="control-group">
			<?php 
				if(!isset($setting['DO_SQLPCONNECT']))
				{
					$pcon = array(1=>"checked");
				}
				else $pcon = array($setting['DO_SQLPCONNECT'] => "checked");
			?>
			<label class="control-label" for="pcon">
				<?php echo DOLang::Get('Persistent connect?');?>
			</label>
			<div class="controls">
				<input id="pcon" name="S_DO_SQLPCONNECT" value="1" type="checkbox" <?php echo $pcon[1];?>/>
			</div>
		</div>
		<input type='hidden' name='__A' value='savesetting'/>
</fieldset>
</form>
