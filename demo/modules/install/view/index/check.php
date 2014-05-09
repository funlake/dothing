<div class="row top20">
	<div class="span4">
		<ul:loop={#phprelative} class="list-group">
	                <li class="list-group-item {#class}">
	                  <span class="badge">{#value}</span>
	                  	{#item}
	                </li>
	         </ul:loop>
	</div>
	<!--bl-->
	<div class="span4">
		<ul:loop={#serverrelative} class="list-group">
	                <li class="list-group-item {#class}">
	                  <span class="badge">{#value}</span>
	                  	{#item}
	                </li>
	         </ul:loop>
	</div>
</div>
<div class="row span12 top20">
	<div class="span4"></div>
	<div class="span4"><a id="next-btn" class="btn btn-medium btn-primary" href="<?php echo Url('install/index/database');?>"><?php echo L('Next');?></a></span>
</div>