<?php
/**
 * user model
 *
 */
class DOModel_user extends DOModel
{
	/**
	 * 检测用户是否存在
	 *
	 * @param 用户名 $user
	 * @param 密码 $pass
	 * @return true or false
	 */
	public function checkExist($user,$pass,$conditon='')
	{
		//user table
		$dbt = parent::table('#__user');
		//get pwd first.
		$rs  = $dbt->getRow('*',"user_name='{$user}' And state=1 ".$conditon);
		
		if( $rs['user_pass'] == md5($pass) )
		{
			return $rs;
		}
		return false;
	}
	
	/**
	 * 把用户添加至某用户组
	 *
	 * @param 用户id 	$uid
	 * @param 用户组id 	$ugid
	 */
	public function assign($uid,$ugid)
	{
		
	}
	
	/**
	 * 检测用户是否在线
	 *
	 * @param 用户id $uid
	 * @return unknown
	 */
	public function isOnline($uid)
	{
		return $_SESSION['s_user']['user_id'] == $uid ? true : false;
	}
	
	
	public function userGroupTable()
	{
		$R			= self::table('#__group')->select('*','state=1');
		if(!$R->data) return;
		$treeHandler 	= & DOFactory::get('com',array('tree',$R->data,'group_id','group_pid'));
		$treeHandler->format = <<<tpl
			<tr><td><input type='checkbox' name='cid[]'/></td><td>[prefix]{group_name}</td></tr>
tpl;
		$tb =  "<table class='gridTable'>";
		$tb.= "<tr><th width='5%'>#</th><th>".DOLang::get('g_usergroup','用户组')."</th></tr>";
		$tb.= $treeHandler->render(0,0);
		$tb.=  "</table>";
		return $tb;
	}
	
}
?>