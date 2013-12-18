<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
//print_r(DOBlocks::GetBlock('profiler')->GetErrors()); 
if(!DO_DEBUG) return "";
?>
<fieldset class="debug">
	<legend><?php echo L('Debug');?></legend>
	<div class="tabs-right ">
		<ul:loop=Block|Profiler.GetProfiler class="nav nav-tabs span2">
		  <li class="{#class}"><a href="#{#id}" data-toggle="tab">{#tab}</a></li>
		</ul:loop>

		<div:loop=Block|Profiler.GetProfiler class="tab-content span9">
			<div class='tab-pane {#class}' id='{#id}'>
				<table class="table table-striped table-hover">
					<thead>
						<tr >
							<th width="40%">Item</th>
							<th width="50%">File</th>
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