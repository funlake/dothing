<?php
class DOIndex extends DOController
{
	public function OnSetHeader()
	{
		DOTemplate::SetTitle('Hello world');
		//echo 222;
	}
	public function OnSetTemplate($response)
	{
		//$response->SetTemplate("default2");
	}
	public function addAction()
	{
		
	}
	public function indexAction()
	{
		$db             = & DOFactory::GetDatabase();
		echo $db->From('#__users','u','u.*')
                   	->LeftJoin('#__role'
                          ,'r'
                          ,array('r.role_id'=>'u.role_id')
                          ,'r.role_name'
                     )
                  // ->Select('u.*')
                   	->Groupby('r.role_id')
                   	->Orderby('u.user_id','asc')
                   	->Read();
		
		$db->Clean();
		echo "<br/>";
		echo $db->From('#__category')
		   ->Set('category_name','?')
		   ->Where('category_id','=?')
		   ->Values('Article',1)
		   ->Update();
	#	echo $db->Commit();	
		$db->Clean();
		echo "<br/>";	
		echo $db->From('#__category','c','c.*')
			->InnerJoin('#__category_connection'
				   ,'cc'
				   ,'cc.category_id=c.category_id'
			)
			->Where('c.category_id','in (?,?,?)')
			->Where(array('c.category_name'=>'=?'))
			->Values(1,2,3,'xxx')
			->Delete();
		$db->Execute();
		echo "<br/>";
		$db->Clean();
		echo $db->From('#__category')->Select('count(*) as amount')->Read();
		$tb = DOFactory::GetTable('#__user');
		echo $tb->TotalRows();
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
		->Create();
		try{
			$in = $db->Execute();
		}catch(DOException $e)
		{
			print_r($e->_getMessage());
		}
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
		
		$cache->Set('lake2.module','tt');
		print_r($cache->Get('lake2.module'));
	}
	
	public function modelAction()
	{
		$_POST['user_name'] = 'testlsake';
		$_POST['user_pass'] = md5('123456');
		$_POST['state']		= 1;
		
		$model 	= DOFactory::GetModel('user');
		$ins 	= $model->Create();
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
}

?>
