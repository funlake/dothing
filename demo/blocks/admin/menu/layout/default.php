<?php 
	!defined('DO_ACCESS') AND DIE("Go Away!");
?>
<ul:loop=Block|Admin/menu.GetMenu class="nav">
  <li class="{#class}">
    <a href="{#link}" {#attrs}>{#title}</a>
    <ul:loop=child class="dropdown-menu">
      <li class="{#class}"><a href="{#link}">{#title}</a></li>
    </ul:loop>
  </li>
</ul:loop>
<p class="navbar-text pull-right">
           <button class="btn btn-success">
           	<i class="icon-user icon-white"></i>
		<?php echo SG('_adm_user');?>
           </button>
           <button class="btn btn-danger" onclick="location.href='<?php echo Url(DO_ADMIN_INTERFACE.'/user/logout');?>'">
		<i class="icon-share-alt icon-white"></i>
		<?php echo L('Log out');?>
	</button> 
</p>