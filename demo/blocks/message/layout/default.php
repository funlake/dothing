<?php 
!defined('DO_ACCESS') AND DIE("Go Away!");
$flashMsg 	= DOBlocks::GetBlock('message')->GetMessage();
?>
<?php if(isset($flashMsg['type'])):?>
	<div class="notice <?php echo GetMessageType($flashMsg['type']);?>">
		<span>
			<?php echo $flashMsg['message'];?>
		</span>
	</div>
<?php setcookie("__DOMSG",'',time()-3600);setcookie("__DOMSG_TYPE",'',time()-3600);?>
<?php endif;?>