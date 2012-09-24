<?php !defined('DO_ACCESS') AND DIE("Go Away!"); ?>
<!--Begin Left menu -->
<div class="well sidebar-nav affix">
  <ul class="nav nav-list">				
<?php foreach(DOBlocks::GetBlock('admin.leftmenu')->GetBackMenu() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

    <li class="<?php echo ($item_0["class"]);?>"><a href="<?php echo ($item_0["link"]);?>"><?php echo ($item_0["title"]);?></a></li>
    <ul class="nav nav-list DOSubnav">								
<?php foreach($item_0["child"] as $key_1=>$item_1) : ?>
<?php $item_1=(array)$item_1; ?>

      <li class="<?php echo ($item_1["class"]);?>">
        <a href="<?php echo ($item_1["link"]);?>"><?php echo ($item_1["title"]);?></a>
      </li>
    		
<?php endforeach;?>
</ul>
  		
<?php endforeach;?>
</ul>
</div>
<!-- End Left menu -->