<div class="well sidebar-nav affix">
  <ul:loop=Block|Admin/leftmenu.GetBackMenu class="nav nav-list">
    <li class="{#class}"><a href="{#link}">{#title}</a></li>
    <ul:loop=child class="nav nav-list DOSubnav">
      <li class="{#class}">
        <a href="{#link}">{#title}</a>
      </li>
    </ul:loop>
  </ul:loop>
</div><!--/.well -->