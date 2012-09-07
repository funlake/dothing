<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<div class="panel-wrapper fixed">
	<div class="panel">
		<div class="tabs">
			<ul>
				<li class="tabheader active">

					<a href="#" rel="tab-01-content">
						<?php echo DOLang::Get('Global');?>
					</a>

				</li>
				<li class="tabheader">

					<a href="#" rel="tab-02-content">
						<?php echo DOLang::Get('Database');?>
					</a>

				</li>
				
				<li class="tabheader last">

					<a href="#" rel="tab-03-content">
						<?php echo DOLang::Get('Information');?>
					</a>

				</li>
				
			</ul>
			
		</div>
		<form method="post" action="" name="DOAdminForm" id="DOAdminForm" >
		<div class="tabs-content">
			<div id="tab-01-content" class="active">

			</div>
			<div id="tab-02-content">
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
				<div class="inline group fixed">
					<?php 
						if(!isset($setting['DO_PDO']))
						{
							$pdo = array(1=>"checked");
						}
						else $pdo = array($setting['DO_PDO'] => "checked");
					?>
					<label>
						<?php echo DOLang::Get('Use PDO?');?>
					</label>
					<input name="S_DO_PDO" value="0" type="radio" <?php echo $pdo[0];?>/>
					<?php echo DOLang::Get('No');?>
					<input name="S_DO_PDO" value="1" type="radio" <?php echo $pdo[1];?>/>
					<?php echo DOLang::Get('Yes');?>
				</div>
				<div class="inline group fixed">
					<?php 
						if(!isset($setting['DO_SQLPCONNECT']))
						{
							$pcon = array(0=>"checked");
						}
						else $pcon = array($setting['DO_SQLPCONNECT'] => "checked");
					?>
					<label>
						<?php echo DOLang::Get('Persistent connect?');?>
					</label>
					<input name="S_DO_SQLPCONNECT" value="0" type="radio" <?php echo $pcon[0];?>/>
					<?php echo DOLang::Get('No');?>
					<input name="S_DO_SQLPCONNECT" value="1" type="radio" <?php echo $pcon[1];?>/>
					<?php echo DOLang::Get('Yes');?>
				</div>
				<input type='hidden' name='__A' value='savesetting'/>
				
			</div>
			<div id="tab-03-content">
			</div>
		</div>
		</form>
</div>