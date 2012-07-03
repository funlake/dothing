<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" /> 
	<title>Dashboard | Dashboard Admin</title> 
	
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/reset.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/text.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/form.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/buttons.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/grid.css" type="text/css" media="screen" title="no title" />	
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/layout.css" type="text/css" media="screen" title="no title" />	
	
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/ui-darkness/jquery-ui-1.8.12.custom.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/plugin/jquery.visualize.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/plugin/facebox.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/plugin/uniform.default.css" type="text/css" media="screen" title="no title" />
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/plugin/dataTables.css" type="text/css" media="screen" title="no title" />
	
	<link rel="stylesheet" href="<?php echo DO_THEME_BASE;?>/css/custom.css" type="text/css" media="screen" title="no title">
</head> 
<body> 
<div id="wrapper">
	
	<div id="top">
		
		<div class="content_pad">			
			<ul class="right">
				<li><a href="javascript:;" class="top_icon"><span class="ui-icon ui-icon-person"></span>Logged in as John Doe</a></li>
				<li><a href="javascript:;" class="new_messages top_alert">1 New Message</a></li>
				<li><a href="<?php echo DO_THEME_BASE;?>/pages/settings.html">Settings</a></li>
				<li><a href="index.html">Logout</a></li>
			</ul>
		</div> <!-- .content_pad -->
		
	</div> <!-- #top -->	
	
	<div id="header">
		
		<div class="content_pad">
			<h1><a href="dashboard.html">Dashboard Admin</a></h1>
			<?php echo DOTemplate::_("block","menu");?>
		</div> <!-- .content_pad -->
		
	</div> <!-- #header -->	
	
	<div id="masthead">
		
		<div class="content_pad">
			
			<h1 class="no_breadcrumbs">Home</h1>
			<div id="message"><?php echo DOTemplate::_("block","message");?></div>
			<div id="search">
				<form action="/search" method="get">
					<input type="text" value="" placeholder="Search" name="search" id="search_input" title="Search" />					
					<input type="submit" value="" name="submit" class="submit" />					
				</form>
			</div> <!-- #search -->
			
		</div> <!-- .content_pad -->
		
	</div> <!-- #masthead -->	
	
	<div id="content" class="xgrid">
		<?php echo DOTemplate::_("module","__CURRENT__");?>
	</div> <!-- #content -->
	
	<div id="footer">		
		<div class="content_pad">			
			<p>&copy; 2010-11 Copyright <a href="http://madebyamp.com">MadeByAmp</a>. Powered by <a href="http://madebyamp.com/themes/dashboard/">Dashboard Admin</a>.</p>
		</div> <!-- .content_pad -->
	</div> <!-- #footer -->		
	
</div> <!-- #wrapper -->

<script type="text/javascript">

</script>

</body> 
 
</html>