<?php $html = DOFactory::GetTool('html');?>
<form action="<?php echo DOUri::BuildQuery('autocrud',$task,'user');?>" method='POST'>
	Name : <input type='text' name='user_name' id='user_name' value='<?php echo $data->user_name;?>'/>
	<br/>
	Member : <input type='text' name='member_name' id='member_name' value='<?php echo $data->member->member_name;?>'/>
	<br/>
	Pwd:<input type='password' name='user_pass' id='user_pass' value='<?php echo $data->user_pass;?>'/>
	<br/>
	State:<?php echo $html->RadioList('state',array('1'=>'publish','0'=>'unpublish'),null,$data->state);?>
	<br/>
	<input type="submit" id="submit" name="submit" value="submit"/>	
	<input type="hidden" id="__redirect" name="__redirect" value="<?php echo DOUri::BuildQuery('welcome','index','adduser');?>"/>
	<input type="hidden" id="user_id" name="user_id" value="<?php echo $data->user_id;?>"/>
	<input type="hidden" id="__token" name="__token" value="<?php echo DOBase::SetToken()?>"/>
	<input type="hidden" id="__chain" name="__chain" value="1"/>
</form>
