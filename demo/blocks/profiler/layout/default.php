<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
//print_r(DOBlocks::GetBlock('profiler')->GetErrors()); 
if(!DO_DEBUG) return "";
?>
<fieldset class="debug">
	<legend><?php echo L('Debug');?></legend>
	<div class="tabs-right ">
		<ul:loop=Block|Profiler.GetProfiler class="nav nav-tabs">
		  <li class="{#class}"><a href="#{#id}" data-toggle="tab">{#tab}</a></li>
		</ul:loop>

		<div:loop=Block|Profiler.GetProfiler class="tab-content">
			<div class='tab-pane {#class}' id='{#id}'>
				<table class="table table-striped table-hover" style="width:90%">
					<thead>
						<tr >
							<th width="30%">Item</th>
							<th width="30%">File</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody:loop=content class="adminTable">
						<tr class="{#class}">
							<td>{#item}</td>
							<td>{#file}</td>
							<td>{#value}</td>
						</tr>
					</tbody:loop>
				</table>
			</div>
		</div:loop>
	</div>
</fieldset>