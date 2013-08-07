<?php 
	!defined('DO_ACCESS') AND DIE("Go Away!");
?>
<ul:loop=Block|Admin/menu.GetMenu class="nav navbar-nav">
  <li class="{#class}">
    <a href="{#link}" {#attrs}>{#title}</a>
    <ul:loop=child class="dropdown-menu">
      <li class="{#class}"><a href="{#link}">{#title}</a></li>
    </ul:loop>
  </li>
</ul:loop>
<ul class="nav navbar-nav pull-right">
  <li><a href="#"><i class="glyphicon glyphicon-user glyphicon-white"></i>&nbsp;<?php echo SG('_adm_user');?></a></li>
  <li class="dropdown">

    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=" glyphicon glyphicon-setting glyphicon-white"></i><?php echo L('Actions');?> <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="<?php echo Url(DO_ADMIN_INTERFACE.'/user/logout');?>"><?php echo L('Log out');?></a></li>
    </ul>
  </li>
</ul>