<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
//print_r(DOBlocks::GetBlock('profiler')->GetErrors()); 
?>
<fieldset>
	<legend><?php echo L('Debug');?></legend>
	<div class="tabs-left ">
		<ul:loop=Block|Profiler.GetProfiler class="nav nav-tabs">
		  <li><a href="#{#id}" data-toggle="tab">{#tab}/{#@key_0}</a></li>
		</ul:loop>

		<div class="tab-content">
			<div:loop=Block|Profiler.GetErrors>
				<div class='tab-pane' id='{#id}'>{#@key_0}</div>
			</div:loop>
		</div>
	</div>
</fieldset>