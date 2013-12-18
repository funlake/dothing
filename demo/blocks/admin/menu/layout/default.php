<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
?>
<ul:loop=Block|Admin/menu.GetMenu class="nav navbar-nav fixed">
	<li class="{#class}">
		<a href="{#link}" {#attrs}>{#title}</a>
		<ul:loop=child class="dropdown-menu">
			<li class="{#class}"><a href="{#link}">{#title}</a></li>
		</ul:loop>
	</li>
</ul:loop>
<ul class="nav navbar-nav pull-right">
	<li><a href="#"><i class="glyphicon glyphicon-user glyphicon-white"></i>&nbsp;<?php echo SG('_adm_user');?></a></li>
	<li>
		<a href="<?php echo Url('admin/user/logout');?>">
			<i class=" glyphicon glyphicon-hand-down glyphicon-white"></i>&nbsp;<?php echo L('Log out');?>
		</a>
	</li>
</ul>