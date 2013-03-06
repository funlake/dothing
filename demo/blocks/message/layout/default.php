<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
$flashMsg 	= DOBlocks::GetBlock('message')->GetMessage();
?>
<?php if(isset($flashMsg['type'])):?>
	<div class="row-fluid" id="msg-row">
		<div class="span12">
			<div class="alert alert-<?php echo GetMessageType($flashMsg['type']);?>">
				<a class="close" id="msg-close">x</a>
				<span>
					<?php echo $flashMsg['message'];?>
				</span>
			</div>
		</div>
	</div>
	<script type='text/javascript'>
		$(function(){
			$('#msg-close').click(function(){
				$('#msg-row').fadeOut();
			})
		})
	</script>
	<?php $this->CleanMessage();?>
<?php endif;?>
