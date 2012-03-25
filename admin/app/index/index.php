<?php 
class DOIndex extends DOController 
{
	function indexAction()
	{
		#echo "hello world!";
		$this->loadView();
		
	}
	function welcomeAction()
	{
		$cata = array();
    		$cata[0] = 'a_aa_aaa_5';
    		$cata[1] = 'a_aa_aab_2';
    		$cata[2] = 'a_aa_aac_2';
    		$cata[3] = 'a_ab_abb_1';
    		$cata[4] = 'a_ab_abc_2';
		$cata[5] = 'b_ba_baa_9';
		$cata[6] = 'b_ba_bab_2';
		$cata[7] = 'b_bb_bbb_3';
		$cata[8] = 'c_ca_cab_2';
		$cata[9] = 'c_ca_caa_3';
		$cata[10] = 'c_ca_cac_4';
	#	error_reporting(E_ALL);
	#	ini_set('display_errors',1);
	
		$result[] = array('id'=>1,'pid'=>0,'name'=>'合作销售');

		$result[] = array('id'=>2,'pid'=>1,'name'=>'深圳营业部');

		$result[] = array('id'=>3,'pid'=>1,'name'=>'上海营业部');

		$result[] = array('id'=>4,'pid'=>2,'name'=>'泉州营业部');

		$result[] = array('id'=>5,'pid'=>2,'name'=>'萍乡营业部');

		$result[] = array('id'=>6,'pid'=>3,'name'=>'郑州嵩山路营业部');

		$result[] = array('id'=>7,'pid'=>4,'name'=>'乐平营业部');

		$result[] = array('id'=>8,'pid'=>4,'name'=>'南昌营业部运营中心');

		$result[] = array('id'=>9,'pid'=>1,'name'=>'杭州营业部');

		$result[] = array('id'=>10,'pid'=>7,'name'=>'杭州营业部3');

		$result[] = array('id'=>11,'pid'=>2,'name'=>'合作销售2');

		$result[] = array('id'=>12,'pid'=>11,'name'=>'合作销售3');

		$result[] = array('id'=>13,'pid'=>11,'name'=>'合作销售4');
		
		$result[] = array('id'=>14,'pid'=>11,'name'=>'合作销售4');
		$result[] = array('id'=>15,'pid'=>14,'name'=>'合作销售4','url'=>'http://www.csdn.net');
		$treeHandler = & DOFactory::get('com',array('tree',$result,'id','pid'));
		
		$treeHandler->format = <<<tpl
		<tr><td>[prev]<a href='{url}'>{name}</a></td></tr>
tpl;
		echo "<table>";
		echo $treeHandler->render(0,0);
		echo "</table>";
	}	
	function dataAction()
	{

		$json = &DOFactory::get('com',array('json'));
		
		$data =  $json->encode(array("你好"=>"hello"));
		
		/*
		        	    var str = 'AaaBbbbCcDdddddddd';
			    str = str.replace(/([a-z])\1*(?!\1*$)/gi,'$&.');
			    alert(str);
		*/
		//$str = 'AaaBbbbCcDdddddddd';
		
		//echo preg_replace('#([a-z])\1*(?!\1*$)#i','$0.',$str);
		//$a = $this->globDir();	
	//	echo "<pre/>";
	//$str =  serialize("a\\\'b");
	//echo unserialize( $str );
/*	$db = & DOFactory::get('dbo',array('localhost','root','','check'));
	$t  = DOModel::table('chinese2','',$db);
	//$t->insert(array('text'=>'abc'));
	$rs =  $t->select('*') ;
	
	foreach( $rs->data as $k=>$v)
	{
		echo print_r(unpack('C*',$v['text']),1)."<br/>";
	}
	$this->loadView();*/
		//$neiron='你好呀,呵呵,还有1天就过生日喽!';
		//$neiron=iconv('utf-8','gbk',$neiron);
		//echo mb_strlen($neiron,'gbk').'<br><br>';
		//echo mb_substr($neiron,0,10,'gbk').'<br><br>';
		//echo $this->csubstr($neiron,0,1);

		// usort($a,array($this,'fileusort')) ;
		 
		// print_r($a);
		//$db = &DOFactory::get('dbo');
		
		//$db->query("select * from c");
		$this->loadView();
	}
	
	function searchFile( $path='' , $pat = '*' , $deep = false)
	{
		static $files = array();
		$dir = $path ? $path : SYSTEM_ROOT;
		foreach(glob($dir.DS.$pat) as $v)
		{
			!is_dir($v) ? $files[] = $v : '';
			if(is_dir($v) && $deep) $this->searchFile( $v , $pat ,$deep);

		}
		return $files;
	}
	
	function fileusort( $item1,$item2 )
	{
		$mt1 = filemtime($item1);
		$mt2 = filemtime($item2);
		return $mt1 < $mt2 ?  1 : ($mt1 == $mt2 ? 0 : -1);
	}
	
	//截取字符串
	function csubstr($str,$start,$len)
	{
	    $strlen = strlen($str);
	    $clen = 0;
	    $tmpstr = '';
	    for($i = 0; $i < $strlen; $i++, $clen++){
	        if($clen >= $start+$len){
	            break;
	        }
	        if(ord(substr($str,$i,1)) > 0xa0){
	            if ($clen   >=   $start){
	                $tmpstr .= substr($str,$i,2);
	            }
	            $i++;
	        }else{
	            if($clen >= $start){
	                $tmpstr .= substr($str,$i,1);
	            }
	        }
	    }
	    return $tmpstr;
	}

}
