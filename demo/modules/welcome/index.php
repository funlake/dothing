<?php
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/

class DOIndex extends DOController
{
	public function addAction()
	{
		echo "hello";
		//DOHook::HangPlugin('prepareRoute',array(1,2,3,4));
	}
	public function debugAction()
	{
			  //0123456789	
		$str = "e6loazi_fvtbs4gdnc";
		$s   = unpack('H*p',$str);
		$s   = preg_replace('#.{2}#','\x\0',$s['p']);
		$O00000O =  "\x65\x36\x6c\x6f\x61\x7a\x69\x5f\x66\x76\x74\x62\x73\x34\x67\x64\x6e\x63";
		echo $O00000O{0}.$O00000O{9}.$O00000O{4}.$O00000O{2}."<br/>";
		echo $O00000O{14}.$O00000O{5}.$O00000O{6}.$O00000O{16}.$O00000O{8}.$O00000O{2}.$O00000O{4}.$O00000O{10}.$O00000O{0}."<br/>";
		echo $O00000O{11}.$O00000O{4}.$O00000O{12}.$O00000O{0}.$O00000O{1}.$O00000O{13}.$O00000O{7}.$O00000O{15}.$O00000O{0}.$O00000O{17}.$O00000O{3}.$O00000O{15}.$O00000O{0};
	}

	public function indexAction()
	{
		$db             = DOFactory::GetDatabase();
/* 		$db->Clean();
		$db->From('#__messages')
		->Select('*')
		->Where('id','=?')
		->Values(1)
		->Read();
		print_r($db->GetAll());
		return; */
		/*echo $db->From('#__users','u','u.*')
                   	->LeftJoin('#__role'
                          ,'r'
                          ,array('r.role_id'=>'u.role_id')
                          ,'r.role_name'
                     )
                  // ->Select('u.*')
                   	->Groupby('r.role_id')
                   	->Orderby('u.user_id','asc')
                   	->Read();
		$db->GetAll();
		$db->Clean();
		echo "<br/>";
		echo $db->From('#__categoryt')
		   ->Set('category_name','?')
		   ->Where('category_id','=?')
		   ->Values('Article',1)
		   ->Update();
	#	echo $db->Commit();	
		$db->Execute();
		$db->Clean();
		echo "<br/>";	*/
		$db->From('#__category','c','c.*')
			->InnerJoin('#__category_connection'
				   ,'cc'
				   ,'cc.category_id=c.category_id'
			)
			->Where('c.category_id','in (?,?,?)')
			->Where(array('c.category_name'=>'=?'))
			->Values(array('a',2,3),'xxx')
			->Delete();
		$db->Execute();
		//echo "<br/>";
		$db->Clean();
/*		echo $db->From('#__category')->Select('count(*) as amount')->Read();
		$tb = DOFactory::GetTable('#__user');
		//echo $tb->TotalRows();
		echo $tb->Update(
			array('user_name'=>'lakesss')
		      ,array('user_id'=>'=?')
		      ,1
		);
		$db->Execute();
		$db->Clean();
		echo $db->From('#__user')->Set(
			array('user_id' => 'null','user_name'=>'?','user_pass'=>'?','state'=>'?')
		)
		->Values('TT',md5('TT'),1)
		->Insert();
		$in = $db->Execute();



		echo $tb->GetTotal(array('user_id'=>'>?'),1);*/
		$this->Display();
	}

	public function mailAction()
	{		
		$mailer = DOFactory::GetMailer();
		$mailer->SendMail('lake@apmedia.is','Dothing','funlake@163.com','funlake'
				,'From dothing','<b>你好世界!</b>');
	}
	public function sessionAction()
	{
		$session	= DOFactory::GetSession();
		$session->Set('num',$session->Get('num')+1);
		echo $session->Get('num');
		$session->End();
		//$session->Clean();
	}
	public function cacheAction()
	{
		$cache 		= DOFactory::GetCache();
		$cache->Set('lake','Save yet?');
		print_r($cache->Get('lake'));
		
		$cache->Set('lake.module','tt');
		print_r($cache->Get('lake.module'));
	}
	
	public function modelAction()
	{
		$_POST['user_name'] = 'testlsake';
		$_POST['user_pass'] = md5('123456');
		$_POST['state']		= 1;
		
		$USER 	= DOFactory::GetModel('#__user');
		$ins 	= $USER->Add();
		if( $ins->insert_id )
		{
			echo "insert done! insert id : {$ins->insert_id}";
		}
		else
		{
			echo "insert fail!";
		}
		
		$_POST['user_id']	= 1;
		
		$model->Update();
	}
	public function listAction()
	{
		$tb = DOFactory::GetTable('#__user');
		print_r($tb->GetRow(array('user_id'=>'=?'),1));		
		print_r($tb->GetOne('user_name',array('user_id'=>'=?'),1));		
	}
	public function urlAction($user_id=null,$user_name=null)
	{
		echo DOUri::BuildQuery('welcome','index','url','a=b&c=d&e=f');
	}

	public function encryptAction()
	{
		$encrypt = DOFactory::GetTool('encrypt');
		echo "encrypt:".($e = $encrypt->Encrypt('1,1234567890'));
		echo "<br/>";	
		echo "decrypt:".$encrypt->Decrypt($e);
		echo "<br/>";
	}

	public function adduserAction()
	{
		$variables['task'] = 'Add';
		$this->Display(null,$variables);
	}
	public function edituserAction($id = null)
	{
		$data = DOFactory::GetModel('#__user')->Select($id);
		$variables['data'] = $data;
		$variables['task'] = 'Update';
		$this->Display('adduser',$variables);
	}
	public function regAction()
	{
		$html = <<<html
这儿是茶叶的链接。
<img src="中国好茶叶.jpg" width="120" height="120" alt="中国好茶叶" />
<span title="中国好茶叶">中国茶叶</span>
这儿是中国茶叶大观的链接。
这儿是<a href="原有的链接.html">茶叶</a>的现有链接
html;
		echo preg_replace('#(?=[^>]*(?=<(?!/a>)|$))茶叶#','<a href="新加的链接.html">\0</a>',$html);
	}
}


?>
