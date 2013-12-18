<?php
//defined('DO_ACCESS') OR die('');
// DORouter::map('/lake/:id/:module/:name'
// 			 ,array('M'=>'borgun','C'=>'borgun','A'=>'foundmyroute')
// 			 ,array('%s','','%s'));
// DORouter::map('/lake/*',array('M'=>'borgun','C'=>'borgun','A'=>'payment'));
// DORouter::map('/user/:id/:pid',array('M'=>'user','C'=>'user','A'=>'index'),array('%c'));
// DORouter::map('/view-:category-:id',array('M'=>'article','C'=>'article','A'=>'index'),array('%s','%d'));
DORouter::map('/manageuser-:id','admin/user/edit');
//admin/user/edit ~ manageuser-:id
//highlight_file(__FILE__);
?>