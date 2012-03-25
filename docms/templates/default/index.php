<html>
<head>
	<title><?php DOTheme::Hook('title');?></title>
	<?php DOTheme::Hook('script'); ?>
</head>
<body>
	<div><?php DOTheme::Hook('blocks','banner');?></div>
	<div><?php DOTheme::Hook('modules');?></div>
	<div><?php DOTheme::Hook('blocks','footer');?></div>
</body>
</html>
