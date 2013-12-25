<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
$flashMsg 	= DOBlocks::GetBlock('message')->GetMessage();
?>
<?php if(isset($flashMsg['type'])):?>
	<div class="col-lg-12" id="msg-row">
		<div class="alert alert-<?php echo GetMessageType($flashMsg['type']);?>">
			<a class="close" id="msg-close">x</a>
			<span>
				<?php echo $flashMsg['message'];?>
			</span>
		</div>
	</div>
	<script type='text/javascript'>
		require([DOJsBase+'/blocks/message.js'],function(m){
			m.closeInit();
		});
	</script>
	<?php 
		DOBlocks::GetBlock('message')->CleanMessage();
	?>
<?php endif;?>