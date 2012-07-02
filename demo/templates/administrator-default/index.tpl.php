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
				<li><?php echo DOTemplate::_("block","header");?></li>
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
			
			<ul id="nav">
				<li class="nav_current nav_icon"><a href="<?php echo DO_THEME_BASE;?>/dashboard.html"><span class="ui-icon ui-icon-home"></span>Home</a></li>
				<li class="nav_dropdown nav_icon">
					<a href="javascript:;"><span class="ui-icon ui-icon-gripsmall-diagonal-se"></span>Styles</a>
					
					<div class="nav_menu">			
						<ul>
							<li><a href="<?php echo DO_THEME_BASE;?>/pages/text.html">Buttons &amp; Text</a></li>	
							<li><a href="<?php echo DO_THEME_BASE;?>/pages/grid.html">Grid Layout</a></li>	
							<li><a href="<?php echo DO_THEME_BASE;?>/pages/tables.html">Tables</a></li>	
							<li><a href="<?php echo DO_THEME_BASE;?>/pages/forms.html">Forms</a></li>	
							<li><a href="<?php echo DO_THEME_BASE;?>/pages/charts.html">Charts</a></li>						
						</ul>
						
					</div>
				</li>
				
				<li class="nav_icon"><a href="<?php echo DO_THEME_BASE;?>/pages/widgets.html"><span class="ui-icon ui-icon-gear"></span>Widgets</a></li>
				<li class="nav_icon"><a href="<?php echo DO_THEME_BASE;?>/pages/reports.html"><span class="ui-icon ui-icon-signal"></span>Reports</a></li>
				
				<li class="nav_dropdown nav_icon_only">
					<a href="javascript:;">&nbsp;</a>
					
					<div class="nav_menu">
						
						<ul>
							<li><a href="javascript:;">Overflow Menu</a></li>
							<li><a href="javascript:;">Items Can</a></li>
							<li><a href="javascript:;">Go Here</a></li>
						</ul>
					</div> <!-- .menu -->
				</li>
			</ul>
		</div> <!-- .content_pad -->
		
	</div> <!-- #header -->	
	
	<div id="masthead">
		
		<div class="content_pad">
			
			<h1 class="no_breadcrumbs">Home</h1>
			
			<div id="search">
				<form action="/search" method="get">
					<input type="text" value="" placeholder="Search" name="search" id="search_input" title="Search" />					
					<input type="submit" value="" name="submit" class="submit" />					
				</form>
			</div> <!-- #search -->
			
		</div> <!-- .content_pad -->
		
	</div> <!-- #masthead -->	
	
	<div id="content" class="xgrid">
		
		<div id="welcome" class="x4">			
			
			<p><strong>Welcome back, Admin</strong><br />

You are currently signed up to the Free Trial Plan. <a href="<?php echo DO_THEME_BASE;?>/pages/upgrade.html">Update your plan today.</a>

</p>
			
			<table class="data info_table">
				<tbody>
					<tr>
						<td class="value">789</td>
						<td class="full">Visits Today</td>
					</tr>
					<tr>
						<td class="value">634</td>
						<td class="full">Unique Visits</td>
					</tr>
					<tr>
						<td class="value">13</td>
						<td class="full">Pending Comments</td>
					</tr>
					<tr>
						<td class="value">17</td>
						<td class="full">Support Requests</td>
					</tr>
				</tbody>
			</table>
			
		</div> <!-- .x4 -->
			
		<div class="x8">
			<table class="stats" data-chart="bar">
				<caption>2009/2010 Sales by industry (Million)</caption>
				<thead>
						<tr>
							<td>&nbsp;</td>
							<th>Banking</th>
							<th>Beauty</th>
							<th>Insurance</th>
							<th>Internet</th>
							<th>Media</th>
						</tr>

					</thead>
					
					<tbody>
						<tr>
							<th>2009</th>
							<td>5</td>
							<td>6</td>
							<td>4</td>
							<td>7</td>
							<td>9</td>
						</tr>
						
						<tr>
							<th>2010</th>
							<td>12</td>
							<td>15</td>
							<td>13</td>
							<td>11</td>
							<td>13</td>
						</tr>							
					</tbody>
			</table>
		</div> <!-- .x8 -->
		
		<div class="xbreak"></div> <!-- .xbreak -->
			
			
			
		<div class="x5 a1">
			
			<h2>Sales</h2>
			
			<table class="stats" data-chart="pie">
				<caption>2008/2009/2010 Sales by industry (Million)</caption>
				<thead>
					<tr>
						<td>&nbsp;</td>
						<th>Banking</th>
						<th>Beauty</th>
						<th>Insurance</th>
						<th>Internet</th>
						<th>Media</th>
					</tr>

				</thead>
				
				<tbody>
					<tr>
						<th>2008</th>
						<td>2</td>
						<td>7</td>
						<td>8</td>
						<td>5</td>
						<td>6</td>
					</tr>
					<tr>
						<th>2009</th>
						<td>5</td>
						<td>6</td>
						<td>4</td>
						<td>7</td>
						<td>9</td>
					</tr>
					
					<tr>
						<th>2010</th>
						<td>8</td>
						<td>9</td>
						<td>5</td>
						<td>11</td>
						<td>13</td>
					</tr>							
				</tbody>
			</table>
			
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			
		</div> <!-- .x5 -->
		
		
			
		<div class="x6">
			
			<h2>Support Requests</h2>
			
			<table class="data support_table">
				<tbody>
				<tr>
					<td><span class="ticket open">Open</span></td>
					<td class="full"><a href="#">Lorem ipsum dolor sit amet</a></td>					
					<td class="who">Posted by Bill</td>
				</tr>

				<tr>
					<td><span class="ticket open">Open</span></td>
					<td class="full"><a href="#">Consectetur adipiscing</a></td>
					<td class="who">Posted by Pam</td>
				</tr>
				<tr>
					<td><span class="ticket open">Open</span></td>
					<td class="full"><a href="#">Sed in porta lectus maecenas</a></td>					
					<td class="who">Posted by Curtis</td>
				</tr>
				<tr>
					<td><span class="ticket closed">Closed</span></td>
					<td class="full"><a href="#">Dignissim enim</a></td>					
					<td class="who">Posted by John</td>
				</tr>
				<tr>
					<td><span class="ticket responded">Responded</span></td>
					<td class="full"><a href="#">Duis nec rutrum lorem</a></td>


					<td class="who">Posted by James</td>
				</tr>
				<tr>
					<td><span class="ticket closed">Closed</span></td>
					<td class="full"><a href="#">Maecenas id velit et elit</a></td>					
					<td class="who">Posted by Sam</td>
				</tr>
				<tr>
					<td><span class="ticket responded">Responded</span></td>
					<td class="full"><a href="#">Duis nec rutrum lorem</a></td>
					<td class="who">Posted by Carlos</td>
				</tr>
				</tbody>
			</table>
		</div> <!-- .x6 -->
		
	</div> <!-- #content -->
	
	<div id="footer">		
		<div class="content_pad">			
			<p>&copy; 2010-11 Copyright <a href="http://madebyamp.com">MadeByAmp</a>. Powered by <a href="http://madebyamp.com/themes/dashboard/">Dashboard Admin</a>.</p>
		</div> <!-- .content_pad -->
	</div> <!-- #footer -->		
	
</div> <!-- #wrapper -->
<script src="<?php echo DO_THEME_BASE;?>/js/jquery/jquery-1.5.2.min.js"></script>
<script src="<?php echo DO_THEME_BASE;?>/js/jquery/jquery-ui-1.8.12.custom.min.js"></script>
<script src="<?php echo DO_THEME_BASE;?>/js/misc/excanvas.min.js"></script>
<script src="<?php echo DO_THEME_BASE;?>/js/jquery/facebox.js"></script>
<script src="<?php echo DO_THEME_BASE;?>/js/jquery/jquery.visualize.js"></script>
<script src="<?php echo DO_THEME_BASE;?>/js/jquery/jquery.dataTables.min.js"></script>
<script src="<?php echo DO_THEME_BASE;?>/js/jquery/jquery.tablesorter.min.js"></script>
<script src="<?php echo DO_THEME_BASE;?>/js/jquery/jquery.uniform.min.js"></script>
<script src="<?php echo DO_THEME_BASE;?>/js/jquery/jquery.placeholder.min.js"></script>

<script src="<?php echo DO_THEME_BASE;?>/js/widgets.js"></script>
<script src="<?php echo DO_THEME_BASE;?>/js/dashboard.js"></script>

<script type="text/javascript">

</script>

</body> 
 
</html>