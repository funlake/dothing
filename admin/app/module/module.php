<?php
class DOModule extends DOController 
{
	public $model = 'module';
	public function __construct()
	{
		parent::__construct();
		$this->initExtjs();
	}
	function indexAction()
	{	
		$this->loadView('module_tree');
	}
	
	function dataAction()
	{

		$this->dataHandler->dumpTreeData( 'module' );
	}
	
	function addAction($id,$pid,$task=null) //添加
	{
		$args = func_get_args();
		$self = new reflectionMethod(__METHOD__);
		foreach($self->getParameters() as $k=>$v)
		{
			$this->var[$v->getName()] = $args[$k];
		}
		if($_POST)
		{
			$this->save( $_POST );
		}
		else
			$this->loadView('edit');
	}
	function editAction($id=null,$pid=null,$task=null) //编辑
	{
		#echo preg_match('#^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-z0-9A-Z]{8,16}$#',$str,$m);exit;
		$args = func_get_args();
		$this->data = DOModel::table('module')->getRow('*',"module_id='".$id."'");	
		$self = new reflectionMethod(__METHOD__);
		foreach($self->getParameters() as $k=>$v)
		{
			$this->var[$v->getName()] = $args[$k];
		}
		$this->loadView();
	}
	function beforeDelete($id)
	{
		return true;
	}	
	function afterDelete($id)
	{
		return true;
	}
	function deleteAction($id)
	{
		$subs = $this->get('modules',array($id));
		if(!!$subs)
		{
			DOExtData::dumpMsg('0','请先删除子项',';');
		}
		else 
		{
			$R = DOModel::table('module')->delete("module_id='".$id."'");
			
			if($R->affect_row)
			{
				DOExtData::dumpMsg('1','删除成功!','DO.activeParentReload();');
			}
			else 
			{
				DOExtData::dumpMsg('0','删除失败!',';');
			}
		}
		
	}
	function bind( $post )
	{
		
		$this->insertItems = array();
		$fields = $this->loadModel($this->model)->fields;
        foreach( $post as $k=>$v)
		{
			//validtate
			if( !isset($fields[$k]) ) continue;
			elseif(!preg_match('#'.$fields[$k].'#',$v)) 
			{
				return false;
			}
			else
			{
				$this->insertItems[$k] = $v;
			}
		}
		return (!!$this->insertItems) && true;
	}	
	function saveAction()
	{
		$this->save( $_POST );
	}
	function save( $post )
	{
/*		if($_SESSION['s_token'][$post['token']] !== true)
		{
			DOExtData::dumpMsg('0','验证错误!',';');
			exit;
		}
*/
//		$this->loadModel($this->model)->fields;
//		$insArray['module_name'] = $post['module_name'];
//		$insArray['module_pid']  = $post['id'] + 0;
//		$insArray['module_code'] = $post['module_code'];
//		$insArray['module_icon'] = $post['module_icon'];
//		$insArray['module_url']  = $post['module_url'];
//		$insArray['ordering']    = $post['ordering'];
//		$insArray['state']		 = $post['state'];
		//DOPrint($insArray);
		if($valid = $this->bind($post))
		{
				switch ($post['task'])
				{
					//add
					case 'add':
						
						if($R =  $this->loadModel()->create($this->insertItems) )
						{
							DOExtData::dumpMsg('1','保存成功'.$R->insert_id,'parent.DO.dialog.hide();parent.DO.activeReload();');
						}
						else 
						{
							DOExtData::dumpMsg('0','保存失败',';');
						}
						
					break;
					
					case 'edit':
						if($R =  $this->loadModel()->update($this->insertItems,"module_id='".$this->insertItems['module_id']."'") )
						{
							DOExtData::dumpMsg('1','保存成功',"parent.DO.dialog.hide();parent.DO.activeChangeText('".$this->insertItems['module_name']."');");
						}
						else 
						{
							DOExtData::dumpMsg('0','保存失败',';');
						}
					break;
				}
		}
	}

}
?>
