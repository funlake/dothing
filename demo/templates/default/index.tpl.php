<html>
<head>
	<title><?php echo DOTemplate::_("block","title");?></title>
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/bootstrap.css" type="text/css" media="screen" />

</head>
<body>
	<div class="header">
		<?php echo DOTemplate::_("block","menu");?>
	</div>
	<div class="banner">
		<?php echo DOTemplate::_("block","banner");?>
	</div>
	<div class="message">
		<?php echo DOTemplate::_("block","message");?>
	</div>
	<div class="body">
		<?php echo DOTemplate::_("module","__CURRENT__");?>
	</div>
	<div class="footer">
		<?php echo DOTemplate::_("block","footer");?>
	</div>
</body>
</html>
