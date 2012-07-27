<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<div class="panel-wrapper fixed">
	<div class="panel ">
		<div class="title">
			<h4>
				<?php echo DOLang::Get('System > Setting');?>
			</h4>
			<div class="collapse">
			</div>
		</div>
		<div class="content">
			<div class="panel-wrapper">
				<ul>
					<li style="float:right;margin:2px">
						<a href="javascript:$('#_DOAdmin').reset()" class="button-white">Cancel</a>
					</li>
					<li style="float:right;margin:2px">
						<a href="javascript:$('#DOAdmin').submit()" class="button-white">Save</a>
					</li>
				</ul>
			</div>
			<form method="post" action="" name="DOAdmin" id="DOAdmin" >
				<div class="group fixed">
					<label>
						<?php echo DOLang::Get('Database Driver');?>
					</label>
					<input name="S_DO_DBDRIVE" value="<?php echo $setting['DO_DBDRIVE'];?>" />
				</div>
				<div class="group fixed">
					<label>
						<?php echo DOLang::Get('Database Name');?>
					</label>
					<input name="S_DO_DATABASE" value="<?php echo $setting['DO_DATABASE'];?>" />
				</div>
				<div class="group fixed">
					<label>
						<?php echo DOLang::Get('Database Host');?>
					</label>
					<input name="S_DO_DBHOST" value="<?php echo $setting['DO_DBHOST'];?>" />
				</div>
				<div class="group fixed">
					<label>
						<?php echo DOLang::Get('Database User');?>
					</label>
					<input name="S_DO_DBUSER" value="<?php echo $setting['DO_DBUSER'];?>" />
				</div>
				<div class="group fixed">
					<label>
						<?php echo DOLang::Get('Database Password');?>
					</label>
					<input type="password" name="S_DO_DBPASS" value="<?php echo $setting['DO_DBPASS'];?>" />
				</div>
				<input type='hidden' name='__A' value='savesetting'/>
			</form>
			<!-- ## / Panel Content  -->
		</div>
	</div>
</div>