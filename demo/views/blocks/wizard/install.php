<link rel="stylesheet" href="http://localhost:81/dothing/demo/assets/css/install.css"/>
<div class="row">
	<h3>Install wizard</h3>
	<div class="wizard">				
<?php foreach((array)DOBlocks::GetBlock('wizard')->GetInstallWizard() as $key_0=>$item_0) : ?>
<?php $item_0=(array)$item_0; ?>

		<a class="<?php echo $item_0['class']?>" href="<?php echo $item_0['link']?>"><span class="badge"><?php echo $key_0?></span><?php echo $item_0['title']?></a>
		
<?php endforeach;?>
</div>
</div>