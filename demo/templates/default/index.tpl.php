<html>
<head>
	<title><?php echo DOTemplate::_("block","title");?></title>
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
