
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">

<head>
	
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	
	<title>
		Quickadmin - Dashboard

	</title>
	
	
	<!-- 1140px Grid styles for IE -->
	
<!--[if lte IE 9]>

<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />

<![endif]-->

<!-- The 1140px Grid -->

<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/_layout/1140.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/_layout/styles.css" type="text/css" media="screen" />

<link rel='stylesheet' href='<?php echo DO_THEME_BASE;?>/_themes/default.css' type='text/css' media='screen' />

<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->

<script type="text/javascript" src="<?php echo DO_THEME_BASE;?>/_layout/scripts/css3-mediaqueries.js">

</script>

<!-- Fonts -->

<!-- Scripts -->

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js?ver=1.6'>

</script>

<!-- Charts -->

<script type='text/javascript' src='<?php echo DO_THEME_BASE;?>/_layout/scripts/jquery.raphael/raphael-min.js'>

</script>

<script type='text/javascript' src='<?php echo DO_THEME_BASE;?>/_layout/scripts/jquery.morris/morris.min.js'>

</script>

<!-- WYSISYG Editor -->

<script type='text/javascript' src='<?php echo DO_THEME_BASE;?>/_layout/scripts/nicEdit/nicEdit.js'>

</script>

<!-- Forms Elemets -->

<script type='text/javascript' src='<?php echo DO_THEME_BASE;?>/_layout/scripts/jquery.uniform/jquery.uniform.min.js'>

</script>

<link rel='stylesheet' href='<?php echo DO_THEME_BASE;?>/_layout/scripts/jquery.uniform/uniform.default.css' type='text/css' media='screen' />

<!-- Table sorter -->

<script type='text/javascript' src='<?php echo DO_THEME_BASE;?>/_layout/scripts/jquery.tablesorter/jquery.tablesorter.min.js'>

</script>

<script type='text/javascript' src='<?php echo DO_THEME_BASE;?>/_layout/scripts/table.resizable/resizable.tables.js'>

</script>

<!-- Lightbox - Colorbox -->

<script type='text/javascript' src='<?php echo DO_THEME_BASE;?>/_layout/scripts/jquery.colorbox/jquery.colorbox-min.js'>

</script>

<link rel='stylesheet' href='<?php echo DO_THEME_BASE;?>/_layout/scripts/jquery.colorbox/colorbox.css' type='text/css' media='screen' />

<script type='text/javascript' src='<?php echo DO_THEME_BASE;?>/_layout/custom.js'>

</script>

</head>

<body>
	
	
	<div id="header-wrapper" class="container">
		
		
		<div id="user-account" class="row" >
			
			
			<div class="threecol">
				

			</div>
			
			
			<div class="ninecol last">
				
				
				<a href="#">
					Logout

				</a>
				
				
				<span>
					|

				</span>
				
				
				<a href="#">
					Preview
				</a>
				

			</div>
			

		</div>
		
		
		<div id="user-options" class="row">
			
		
			<div class="threecol"></div>
			
			
			<div class="ninecol last fixed">
				<?php echo DOTemplate::_("block","menu");?>
			</div>
			

		</div>
		

	</div>
	
	
	<div class="container">
		
		
		<div class="row">
			
			
			<div id="sidebar" class="threecol">
				<?php echo DOTemplate::_("block","sidebar");?>
			</div>
			
			
			<div id="content" class="ninecol last">
				<?php echo DOTemplate::_("block","message");?>
				<?php echo DOTemplate::_("module","__CURRENT__");?>
			</div>
			

		</div>
		

	</div>
	
</body>

</html>
