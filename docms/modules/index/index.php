<?php
class DOIndex extends DOController
{
	public function indexAction()
	{
		$db             = & DOFactory::get('dbo');
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
		   //->Where('category_id','=?')
		   ->Params('Article')
		   ->Replace();
	#	echo $db->Commit();	
		$db->Clean();
		echo "<br/>";	
		echo $db->From('#__category','c','c.*')
			->InnerJoin('#__category_connection'
				   ,'cc'
				   ,'cc.category_id=c.category_id'
			)
			->Where('c.category_id','in (?,?,?)')
			->Params(array(1,2,3))
			->Delete();
		$db->Commit();
		echo "<br/>";
		$db->Clean();
		echo	$db->From('#__category')->Select('count(*) as amount')->Read();
	}
}

?>
