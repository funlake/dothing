<style>
body {
	font-size: 72.5%;
}

table {
	font-size: 1em;
}

/* Site
   -------------------------------- */

body {
	font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
}

/* overrides for ui-tab styles */
#widget-docs ul.ui-tabs-nav { padding:0 0 0 8px; }
#widget-docs .ui-tabs-nav li { margin:5px 5px 0 0; }

#widget-docs .ui-tabs-nav li a:link,
#widget-docs .ui-tabs-nav li a:visited,
#widget-docs .ui-tabs-nav li a:hover,
#widget-docs .ui-tabs-nav li a:active { font-size:14px; padding:4px 1.2em 3px; color:#fff; }

#widget-docs .ui-tabs-nav li.ui-tabs-selected a:link,
#widget-docs .ui-tabs-nav li.ui-tabs-selected a:visited,
#widget-docs .ui-tabs-nav li.ui-tabs-selected a:hover,
#widget-docs .ui-tabs-nav li.ui-tabs-selected a:active { color:#e6820E; }
</style>
<div>
	<link rel="stylesheet" href="<?php echo DOUri::GetRoot()?>/templates/default/complex/jquery/css/smoothness/jquery.ui.all.css"/>
	<script type='text/javascript' 
	 		src='<?php echo DOUri::GetRoot()?>/templates/default/js/jquery.js'>
	</script>
	<script type='text/javascript' 
	 		src='<?php echo DOUri::GetRoot()?>/templates/default/complex/jquery/ui/jquery.ui.core.js'>
	</script>
	<script type='text/javascript' 
	 		src='<?php echo DOUri::GetRoot()?>/templates/default/complex/jquery/ui/jquery.ui.widget.js'>
	</script>
		<script type='text/javascript' 
	 		src='<?php echo DOUri::GetRoot()?>/templates/default/complex/jquery/ui/jquery.ui.tabs.js'>
	</script>
	<div id="error_tabs">
			<?php $keys = array_keys($errors);?>
			<ul>
			<?php foreach($keys as $key):?>
				<li><a href="#tab_<?php echo $key;?>"><?php echo substr(strstr($key,"_"),1)?></a></li>	
			<?php endforeach;?>
			</ul>
			<?php foreach($errors as $key=>$val):?>
				<div id="tab_<?php echo $key?>">
					<?php foreach($val as $error):?>
						<p><?php echo $error['msg']?></p>
					<?php endforeach;?>
				</div>
			<?php endforeach;?>
	</div>
	<script type='text/javascript'>
	$(function(){
		$('#error_tabs').tabs();
	})
	</script>
</div>