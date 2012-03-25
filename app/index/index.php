<?php
class DOIndex extends DOController
{
	var $param;
	function indexAction()
	{
		$db		= & DOFactory::get('dbo');
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
	//	print_r($db->GetCol('user_name','user_id'));
		$db->Clean();

	echo	$db->From('#__member')
		   ->Where('member_id',"like ?")
		   ->Select('*')
		   ->Limit('?','?')
		   ->Params('%1%',1,3)
		   ->Read();
	//	print_r($db->GetAll());

		$db->Clean();

		echo $db->From('#__role')
		   ->Set(array(
			'role_id'		=> 'null'
		       ,'labor_union_id'	=> '?'
		       ,'role_name'		=> '?'
		       ,'state'		        => '?'	
		     ))	
		   ->Params('68','core','1')
		   ->Create();
		$db->Clean();
		echo "<br/>";
		echo $db->From('#__role','r','r.*')
		   ->InnerJoin('#__user','u',array('u.role_id'=>'r.role_id'),'u.*')
		   ->Set(array(
		        'r.labor_union_id'	=> '?'
		       ,'r.role_name'		=> '?'
		       ,'r.state'		=> '?'	
		     ))
		   ->Where('r.role_id',' = ?')	
		   ->Params('68','core','1')
		   ->Update();
#
#		echo $db->Commit();
		//$db->set('user');
		//echo 1;
#		print_r( $db );
		//echo class_exists('DOCache');
		#$image	= & DOFactory::get('com',array('image'));
		#print_r($image);
		#echo DOUri::getRoot();
		#DOCache_file::update('index.index.mybad','this is for a test also',time() + 60*60*24);
		#DOCache_file::update('index.index.baidu','aaa',time() + 60*60*24);
		#print_r(DOCache_file::read('index.index'));
		#DOCache_file::save('index','index');
	}
	
}
/*
$DO->create('user',DORequest::bind('#__users',$_POST));
$DO->update('user',DORequest::bind('#__users',$_POST));
$DO->delete('user');
$DO->get('user');
*/
?>
