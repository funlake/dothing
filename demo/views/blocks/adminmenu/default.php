<?php 
	!defined('DO_ACCESS') AND DIE("Go Away!");
?>
<ul class="nav">				
<?php foreach(DOBlocks::GetBlock('admin.menu')->GetMenu() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

  <li class="<?php echo $item_0['class']?>">
    <a href="<?php echo $item_0['link']?>" <?php echo $item_0['attrs']?>><?php echo $item_0['title']?></a>
    <ul class="dropdown-menu">								
<?php foreach($item_0["child"] as $key_1=>$item_1) : ?>
<?php $item_1=(array)$item_1; ?>

      <li class="<?php echo $item_1['class']?>"><a href="<?php echo $item_1['link']?>"><?php echo $item_1['title']?></a></li>
    		
<?php endforeach;?>
</ul>
  </li>
		
<?php endforeach;?>
</ul>
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