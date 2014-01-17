<ul class="nav navbar-nav fixed">				
<?php foreach((array)DOBlocks::GetBlock('admin.menu')->GetMenu() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

	<li class="<?php echo $item_0['class']?>">
		<a href="<?php echo $item_0['link']?>" <?php echo $item_0['attrs']?>><?php echo $item_0['title']?></a>
		<ul class="dropdown-menu">								
<?php foreach((array)$item_0["child"] as $key_1=>$item_1) : ?>
<?php $item_1=(array)$item_1; ?>

			<li class="<?php echo $item_1['class']?>"><a href="<?php echo $item_1['link']?>"><?php echo $item_1['title']?></a></li>
				
<?php endforeach;?>
</ul>
	</li>
		
<?php endforeach;?>
</ul>
<ul class="nav navbar-nav pull-right">
	<li><a href="#"><i class="glyphicon glyphicon-user glyphicon-white"></i>&nbsp;Admin</a></li>
	<li>
		<a href="http://localhost:81/dothing/demo/index.php/ads007/user/logout">
			<i class=" glyphicon glyphicon-hand-down glyphicon-white"></i>&nbsp;Log out		</a>
	</li>
</ul>