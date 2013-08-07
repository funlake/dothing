<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<!--Begin Left menu -->
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-10">
  <ul:loop=Block|Admin/leftmenu.GetBackMenu class="nav nav-pills nav-stacked">
    <li class="{#class}"><a href="{#link}"><i class="{#iconClass}"></i>{#title}</a></li>
    <ul:loop=child class="nav nav-pills nav-stacked">
      <li class="{#class}">	
        <a href="{#link}">
        	{#title}
       </a>
      </li>
    </ul:loop>
  </ul:loop>
 </div>
</div>
<!-- End Left menu -->