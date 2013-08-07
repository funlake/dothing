<form action="http://localhost/dothing/demo/index.php/ads007/dashboard/savesetting" method="post" id="Afm" name="Afm" class="form-horizontal well">
	<div class="pull-right">
		<button class="btn btn-success" onclick="jQuery('#Afm').submit()">
			<i class="icon-ok icon-white"></i>
			Save		</button>
	</div>
	<fieldset>
		<legend><a name="baseinfo">Base Information</a></legend>
		<div class="control-group">
			<label class="control-label" for="cipher">
				Cipher			</label>
			<div class="controls">
				<input type="text" id="cipher" name="S_DO_SITECIPHER" class="input-xlarge" value="formml" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="copyright">
				Copyright			</label>
			<div class="controls">
				<input type="text" id="copyright" name="S_DO_COPYRIGHT" class="input-xlarge" value="Dothing 2012!" />
			</div>
		</div>
	</fieldset>
	<fieldset>
		<legend><a name="database">Database</a></legend>
		<div class="control-group">
			<label class="control-label" for="drive">
				Driver			</label>
			<div class="controls">
				<input type="text" id="drive" name="S_DO_DBDRIVE" class="input-xlarge" value="mysql" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="host">
				Host			</label>
			<div class="controls">
				<input type="text" id="host" name="S_DO_DBHOST" class="input-xlarge" value="127.0.0.1" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="db">
				Scheme			</label>
			<div class="controls">
				<input type="text" id="db" name="S_DO_DATABASE" class="input-xlarge" value="docms" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="user">
				User			</label>
			<div class="controls">
				<input type="text" id="user" name="S_DO_DBUSER" class="input-xlarge" value="root" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="password">
				Password			</label>
			<div class="controls">
				<input type="password" id="password" class="input-xlarge" name="S_DO_DBPASS" value="123456" />
			</div>
		</div>
		<div class="control-group">
						<label class="control-label" for="pcon">
				Persistent connect?			</label>
			<div class="controls">
				<input id="pcon" name="S_DO_SQLPCONNECT" value="0" type="radio" checked/>No
				<input id="pcon" name="S_DO_SQLPCONNECT" value="1" type="radio" />Yes
			</div>
		</div>
		<input type='hidden' name='__A' value='savesetting'/>
	</fieldset>

</form>