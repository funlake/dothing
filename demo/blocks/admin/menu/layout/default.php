<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<ul:loop=Block|Admin/menu.GetMenu class="nav">
  <li class="{#class}">
    <a href="{#link}" {#attrs}>{#title}</a>
    <ul:loop=child class="dropdown-menu">
      <li class="{#class}"><a href="{#link}">{#title}</a></li>
    </ul:loop>
  </li>
</ul:loop>