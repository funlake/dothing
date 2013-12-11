<link rel="stylesheet" href="<?php echo DOUri::GetBase();?>/assets/css/install.css"/>
<h3>Install wizard</h3>
<div:loop=Block|Wizard.GetInstallWizard class="wizard">
	<a class="{#class}" href="{#link}"><span class="badge">{#@key_0}</span>{#title}</a>
</div:loop>