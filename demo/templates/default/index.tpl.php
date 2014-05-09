<?php use \Dothing\Lib\Template;?>
<html>
<head>
	<title><?php echo Template::_("block","title");?></title>
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/bootstrap.css" type="text/css" media="screen" />

</head>
<body>
	<div class="header">
		<?php echo Template::_("block","menu");?>
	</div>
	<div class="banner">
		<?php echo Template::_("block","banner");?>
	</div>
	<div class="message">
		<?php echo Template::_("block","message");?>
	</div>
	<div class="body">
		<?php echo Template::_("module","__CURRENT__");?>
	</div>
	<div class="footer">
		<?php echo Template::_("block","footer");?>
	</div>
</body>
</html>
