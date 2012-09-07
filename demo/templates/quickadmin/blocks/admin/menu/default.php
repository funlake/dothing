<?php !defined('DO_ACCESS') AND DIE("Go Away!");?>
<div>
 	<ul:loop=Model|Menu.GetTopMenu class="nav-user-options">
			<li>
				<a onclick="{#onclick}" href="{#link}">
					<img src="<?php echo DO_THEME_BASE;?>/_layout/images/icons/{#icon}" alt="{#alt}" />
					&nbsp; {#title}						
				</a>
				<ul:loop=child class="menu_child">
					<li class="{#class}">
						<a href="{#link}">{#title}</a>
					</li>
				</ul:loop>
			</li>
	</ul:loop>
</div>
<script type='text/javascript'>
!function($){
	$('.menu_child').append('<li class="pin"></li>');
}(jQuery)
</script>