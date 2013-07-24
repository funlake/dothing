<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<!--Begin Left menu -->
<div class="well sidebar-nav affix bs-docs-sidenav">
  <ul:loop=Block|Admin/leftmenu.GetBackMenu class="nav nav-list">
    <li class="{#class}"><a href="{#link}"><i class="{#iconClass}"></i>{#title}</a></li>
    <ul:loop=child class="nav nav-list DOSubnav">
      <li class="{#class}">	
        <a href="{#link}">
        	<i class="icon-chevron-left"></i>
        	{#title}
       </a>
      </li>
    </ul:loop>
  </ul:loop>
</div>
<!-- End Left menu -->