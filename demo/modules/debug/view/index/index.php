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
/** Custom style **/
.doerror_row{
	background:#f3f3f3;
	height:20px;
	padding:5px;
}
.doerror_num{
	margin-right:10px;
	font-weight:800;
}
.doerror_msg{
	color:red;
}
.doerror_table{
	width: 100%; 
	padding: 0; 
	margin: 0; 
}
.doerror_table th{
	font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
	color: #4f6b72; 
	border-right: 1px solid #C1DAD7; 
	border-bottom: 1px solid #C1DAD7; 
	border-top: 1px solid #C1DAD7; 
	letter-spacing: 2px; 
	text-transform: uppercase; 
	text-align: left; 
	padding: 6px 6px 6px 12px; 
	background: #CAE8EA  no-repeat; 
}
.doerror_table caption { 
	padding: 0 0 5px 0; 
	width: 700px; 
	font: italic 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
	text-align: right; 
} 
.doerror_table th.nobg { 
	border-top: 0; 
	border-left: 0; 
	border-right: 1px solid #C1DAD7; 
	background: none; 
} 

.doerror_table td { 
	border-right: 1px solid #C1DAD7; 
	border-bottom: 1px solid #C1DAD7; 
	background: #fff; 
	font-size:11px; 
	padding: 6px 6px 6px 12px; 
	color: #4f6b72; 
} 


.doerror_table td.alt { 
	background: #F5FAFA; 
	color: #797268; 
} 

.doerror_table th.spec { 
	border-left: 1px solid #C1DAD7; 
	border-top: 0; 
	background: #fff no-repeat; 
	font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
} 

.doerror_table th.specalt { 
	border-left: 1px solid #C1DAD7; 
	border-top: 0; 
	background: #f5fafa no-repeat; 
	font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
	color: #797268; 
} 
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
				<li><a href="#tab_<?php echo $key;?>"><?php echo substr(strstr($key,"_"),1)."(".count($errors[$key]).")";?></a></li>	
			<?php endforeach;?>
			</ul>
			<?php foreach($errors as $key=>$val):?>
				<div id="tab_<?php echo $key?>">
					<?php foreach($val as $num=>$error):?>
						<p class="doerror_row">
							<?php 
								echo "<span class='doerror_num'>#".($num+1).".</span>"
								."<span class='doerror_msg'>"
									.preg_replace('~\[###[^#]+###\]~','',$error['msg'])
									."</span>"
									." -> <b>".$error['file']."</b>"
									."({$error['line']})"
							?>
						<?php if(!empty($error['detail'])):?>
							<p>
								<table class='doerror_table' cellspacing='0'>
									<caption></caption>
									<tr>
										<th width='30%'>File/Line</th>
										<th>Function/Args</th>
									</tr>
							  <?php 
									 $json   = DOFactory::GetTool('json');
									 $detail = $json->decode($error['detail']);
									 foreach(array_reverse($detail) as $traces):
							   ?>
							   		 <tr>
							   		 	<td><?php echo $traces->file."(".$traces->line.")";?></td>
							   		 	<td><?php echo $traces->function.'(<b>'.implode(',',array_filter($traces->args)).'</b>)';?></td>
							   		 </tr>
							   <?php endforeach; //line 147 ?>
								</table>
							</p>
							<?php endif; //line 136?>
						</p>
					<?php endforeach; //line 126?>
				</div>
			<?php endforeach; //line 124?>
	</div>
	<script type='text/javascript'>
	$(function(){
		$('#error_tabs').tabs();
	})
	</script>
</div>
