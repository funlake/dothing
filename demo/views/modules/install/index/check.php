<div class="row top20">
	<div class="span4">
		<ul class="list-group">				
<?php foreach((array)$phprelative as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

	                <li class="list-group-item <?php echo $item_0['class']?>">
	                  <span class="badge"><?php echo $item_0['value']?></span>
	                  	<?php echo $item_0['item']?>
	                </li>
	         	
<?php endforeach;?>
</ul>
	</div>
	
	<div class="span4">
		<ul class="list-group">				
<?php foreach((array)$serverrelative as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

	                <li class="list-group-item <?php echo $item_0['class']?>">
	                  <span class="badge"><?php echo $item_0['value']?></span>
	                  	<?php echo $item_0['item']?>
	                </li>
	         	
<?php endforeach;?>
</ul>
	</div>
</div>
<div class="row span12 top20">
	<div class="span4"></div>
	<div class="span4"><a class="btn btn-medium btn-primary" href="http://localhost/dothing/demo/index.php/install/index/database">Next</a></span>
</div>