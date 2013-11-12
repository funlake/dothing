<?php
/**
**@project:/var/www/dothing
**@whytodo:
**@author:Lake
**/
		class squareArray
		{
		    public function swapRowCol($inArr)
		    {
		        // $mit = new MultipleIterator(MultipleIterator::MIT_KEYS_ASSOC);
		        // foreach($inArr as $key => $value) { $temArr = new ArrayIterator($value); $mit->attachIterator($temArr, $key); }
		        // $arr = array();
		        // foreach($mit as $item) array_push($arr,$item);
		        // if (isset($inArr[0])) $arr = array_combine(array_keys($inArr[0]),$arr);
		        // return $arr;
		        return call_user_func_array('array_merge_recursive', $inArr);
		    }
		 
		    public function swapRowColWithKey($inArr)
		    {
		        foreach($inArr as $k1=>$v1) foreach($v1 as $k2=>$v2) $arr[$k2][$k1] = $v2;
		        return $arr;

		    }
		 
		    public function intersect1st($arr1, $arr2, $key)
		    {
		        $arr[$key] = array_intersect($arr1[$key], $arr2[$key]);//match source's $key with target
		         foreach($arr1 as $k=>$v) { if ($k == $key) continue; $arr[$k] = array_intersect_key($v, $arr[$key]); }
		        return $arr;
		    }
		 
		    public function intersect2nd($arr1, $arr2, $key)
		    {
		        foreach($arr2 as $v) $tmpArr[] = $v[$key];
		        foreach($arr1 as $k=>$v) if(in_array($v[$key], $tmpArr)) $arr[$k] = $v;
		        return $arr;
		    }
		 
		}
class DOControllerIndex extends DOController
{
	public function assignTo($obj,$keys,$value)
	{
		if(count($keys) > 1) 
		{
			$h = array_shift($keys);
			$obj->$h = $obj->$h ? $obj->$h : new stdClass();
			$this->assignTo($obj->$h,$keys,$value);
		}
		else
		{
			$obj->$keys[0] = $value;
		}
	}

	public static function titleAction()
	{
		$db = DOFactory::GetDatabase();
		$db->From("C")->Select('*')->Read();
		echo "<pre/>";
		print_r($db->GetAll());
		echo "am i lockedss?";
		return DOLang::Get("Home");
	}
	public function addAction()
	{
		//echo strtr('he is the guy',array_combine($unuseful,array_fill(0,count($unuseful),'')));
 		$config['production']['db.mongo.hostname'] = "localhost";
 		$config['production']['db.mongo.password'] = "1234567";

 		$object = new stdClass();
 		foreach($config['production'] as $key=>$value)
 		{
 			$this->assignTo($object,explode('.',$key),$value);
 		}		
 		#$this->assignTo($o,array('db','mongo','hostname'),'localhost');
 		#$this->assignTo($o,array('lake'),'hehe');
 		print_r($object);
 		$str = "var a=23434,bc=3434,erd=5656,ddfeto='dsf3df34dff3',eof='sdfwerwer34',wer=4554;";
		#method 1
		preg_match_all('#\w+=\d+#i',$str,$m);

		print_r($m);
		#method 2

		parse_str(str_replace(array('var ',',',';'),array('','&',''),$str),$out);

		print_r(array_filter($out,'is_numeric'));

		exit;

		//echo date('Y-m-d', strtotime("last day of -4 month"));
		$arr1 = array(1,2,3,4);
		$arr2 = array(8,7,6,5);
		print_r(array_map('array_sum',array_map(null,$arr1,array_reverse($arr2))));
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

	public function indexAction($request=null)
	{
		$array = array(
			array('id' => '001', 'name' => '张三', 'age' => 22,'parent'=>array('dad'=>'zd','mom'=>'zm'))
			,array('id' => '002', 'name' => '李四', 'age' => 23,'parent'=>array('dad'=>'ld','mom'=>'lm'))
			,array('id' => '003', 'name' => '王五', 'age' => 11,'parent'=>array('dad'=>'wd','mom'=>'wm'))
		);  
		 
		$a = array(
		  0 => array('action_id' => 3),
		  1 => array('action_id' => 2),
		  2 => array('action_id' => 1),
		  3 => array('action_id' => 7),
		  4 => array('action_id' => 11),
		);
		 
		$b = array(
		  0 => array('action_id' => 3, 'type' => 0, 'order_num' => 67),
		  1 => array('action_id' => 2, 'type' => 0, 'order_num' => 66),
		  2 => array('action_id' => 1, 'type' => 0, 'order_num' => 65),
		  3 => array('action_id' => 7, 'type' => 0, 'order_num' => 64),
		  8 => array('action_id' => 14, 'type' => 0, 'order_num' => 40),
		  13 => array('action_id' => 11, 'type' => 0, 'order_num' => 30),
		);
		 
		//交换矩阵数组一维和二维键值例子
		$obj=new squareArray();
		$arr=$obj->swapRowCol($array);
		var_export($arr);
		 exit;
		//交换矩阵数组一维和二维键值例子(保留数值键名)
		$arr=$obj->swapRowColWithKey($b);
		var_export($arr);
		 
		//根据指定key求二维数组矩阵数组交集(一维key)
		$key='action_id';
		$aa=$obj->swapRowCol($a);
		$bb=$obj->swapRowCol($b);
		$arr = $obj->intersect1st($bb, $aa, $key);//$b和$a自己定义吧，我懒得输入了
		$arr=$obj->swapRowCol($arr);
		var_export($arr);
		 
		//根据指定key求二维数组矩阵数组交集(二维key)
		$key='action_id';
		$arr = $obj->intersect2nd($b, $a, $key);//$b和$a自己定义吧，我懒得输入了
		var_export($arr);
		 
		 
		exit;
		//echo "hello world!";return;
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
		$db->Clean();
		// $subq = $db->From('#__category','c','c.*')
		// 	->InnerJoin('#__category_connection'
		// 		   ,'cc'
		// 		   ,'cc.category_id=c.category_id'
		// 	)
		// 	->Where('c.category_id','in (?,?,?) and c.category_name=?')
		// 	->Values(array('a',2,3),'abc')
		// 	->Read();
		$subq   = $db->From("#__user",'u','u.*')
				 ->InnerJoin("#__member",'m','m.user_id=u.user_id')
				 ->Where("u.user_id=?")
				 ->Values(1)
				 ->Read();
		$db->Clean();
		echo $db->From("(".$subq.")","a","*")->Read();
		//$db->Execute();
		print_r($db->GetAll());
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
		exit;
		$this->Display(null);
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
		echo "<b>Cache usage:</b>";
		echo "<br/>";
		//DOFactory::GetCache()->Set('lake','Save yet?',60);
		if(DOFactory::GetCache()->Get('lake') === DOCACHE_EXPIRED)
		{
			DOFactory::GetCache()->Set('lake',"hello world!",100);
		}

		echo DOFactory::GetCache()->Get('lake');
		echo "<br/>----------<br/>";
	//	DOFactory::GetCache()->Set('lake.module','tt',30);
		print_r(DOFactory::GetCache()->Get('lake.module'));
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
