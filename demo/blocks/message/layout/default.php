<span>
	<?php 
		$request = DOFactory::GetTool('http.request');
		$msg	 = $request->Get('__DOMSG','cookie');
		$type	 = $request->Get('__DOMSG_TYPE','cookie','int');
		if(!empty($msg))
		{
	?>
			<div class='do_msg<?php echo $type;?>'><?php echo $msg;?></div>
	<?php		
			setcookie('__DOMSG','',time()-180);
		}		
	?>
</span>
