<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head base='<?php echo DOUri::getRoot();?>'>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo DO_CHARSET;?>" />
         <title>模块 - 管理</title>
	</head>
	<body>
	<script type='text/javascript' src='<?php echo DOUri::getRoot();?>/data/js/common/loader.js'>
			@load Ext;
			@load Tablayout;	
			@load Theme[backend/default]
    </script>
	<script type="text/javascript">
		Ext.onReady(function(){
			DO.addTabs([
				['太1','http://www.sina.com.cn',{}]
			   ,['太2','http://www.baidu.com.cn',{}]
			],null,0)
		})
	</script>
	</body>
</html>