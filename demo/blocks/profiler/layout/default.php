<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
?>
<div class="well">
	<ul:loop=Block|Profiler.GetProfiler class="nav nav-tabs">
	  <li><a href="#{#id}" data-toggle="tab">{#tab}</a></li>
	</ul:loop>

	<div class="tab-content">
		<div:loop=Block|Profiler.GetProfiler>
			<div class='tab-pane' id='{#id}'>{#content}</div>
		</div:loop>
	</div>
</div>