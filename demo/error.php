
<style>
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
	border-left: 1px solid #C1DAD7; 
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
	<link rel="stylesheet" href="<?php echo DOUri::GetBase()?>/templates/default/complex/jquery/css/smoothness/jquery.ui.all.css"/>
	<script type='text/javascript' 
	 		src='<?php echo DOUri::GetBase()?>/templates/default/js/jquery.js'>
	</script>
	<script type='text/javascript' 
	 		src='<?php echo DOUri::GetBase()?>/templates/default/complex/jquery/ui/jquery.ui.core.js'>
	</script>
	<script type='text/javascript' 
	 		src='<?php echo DOUri::GetBase()?>/templates/default/complex/jquery/ui/jquery.ui.widget.js'>
	</script>
		<script type='text/javascript' 
	 		src='<?php echo DOUri::GetBase()?>/templates/default/complex/jquery/ui/jquery.ui.tabs.js'>
	</script>
	<div id="error_tabs">
	<table class="doerror_table">
		<tr>		
			<th colspan=1000>Error tables </th>
		</tr>
	<?php foreach($e->_getMessage() as $es):?>
		<tr>
			<td width='10%'>Error msg</td>
			<td><?php echo preg_replace(
							DO_DEBUG ? '#//detail:(.*)$#i' : '#(?:[^/]+)//detail:(.*)$#i'
						   ,'<br/><font color=red>\1</font>'
						   ,$es['msg']);?>
			</td>
		</tr>
		<tr>
			<td>Traces</td>
			<td>
				<?php if(DO_DEBUG) :?>
					<table calss="doerror_table">
					<tr>
						<th width='30%'>File</th>
						<th width='5%'>Line</th>
						<th>Function</th>
					</tr>
					<tr>
							<td><?php echo $es['file'];?></td>
							<td><?php echo $es['line'];?></td>
							<td>&nbsp;</td>
					</tr>
					<?php foreach($es['trace'] as $trace):?>
						<tr>
							<td><?php echo $trace['file']?$trace['file']:'^';?></td>
							<td><?php echo $trace['line']?$trace['line']:'-';?></td>
							<td><?php echo $trace['class'].$trace['type'].$trace['function'];?></td>
						</tr>
					<?php endforeach;?>
					</table>
				<?php else: ?>
					&nbsp;-
				<?php endif;?>
			</td>
		</tr>
	<?php endforeach;?>
	</table>
	</div>
	<button onclick='calljsonp()' value="test jsonp"/>
	<script type='text/javascript'>
	function calljsonp()
	{
		jQuery.ajax({
			url:'http://localhost/frimann2_ki/api/json.php'
		  // ,type:'POST'
		   ,dataType:'jsonp'
		   ,jsonp:'callback'
		   ,data:{
		   		method:'system.get_member'
		   	   ,args:'0101393259'
		   	   ,_token:'rafapis2012'
		   	}
		   ,success:function(data){
		   		if(data.success)
		   		{
		   			console.log(data)
		   		}
		   		else
		   		{
		   			alert(data.msg)
		   		}
		   }
		});
	}
	</script>
</div>
