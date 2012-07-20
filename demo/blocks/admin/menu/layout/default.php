<div class="admin_menu" loop="#__menus">
	<ul id="nav">
		<li class="nav_current nav_icon">
			<a href="<?php echo DOUri::BuildQuery(DO_ADMIN_INTERFACE);?>">
				<span class="ui-icon ui-icon-home"></span>Home</a>
		</li>
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
		
		<li class="nav_icon">
			<a href="<?php echo DO_THEME_BASE;?>/pages/widgets.html">
				<span class="ui-icon ui-icon-gear"></span>
				Widgets
			</a>
		</li>
		<li class="nav_icon">
			<a href="<?php echo DO_THEME_BASE;?>/pages/reports.html">
				<span class="ui-icon ui-icon-signal"></span>
				Reports
			</a>
		</li>
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
</div>