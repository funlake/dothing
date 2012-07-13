<?php
class DOIndex extends DOController
{
	public function indexAction()
	{
		$sentence = "zero one two three four five six seven eight";
		$words    = explode(" ",$sentence,3);
		$base     = explode(" ",$words[2]);
		array_splice($base,2,0,array($words[0],$words[1]));
		echo implode(" ",$base);
		echo "<br/>";
		echo preg_replace('#^(\w+\s+)(\w+\s+)(\w+\s+)(\w+\s+)#','$3$4$1$2',$sentence);

		$searchWords = array("test","this","s");

		$label = "This is a test string<span>test</span>";

		echo htmlspecialchars(preg_replace('#(?=[^>]*(?=<|$))('.implode('|',$searchWords).')#i'
						 ,'<strong>\1</strong>',$label));
	}

	public function settingAction()
	{
		$string="Hi! [num:0] with [num:1]";
		$array=array();
		$array[0]=array('name'=>"na");
		$array[1]=array('name'=>"nam");

		echo preg_replace('#(\!)?\s+\[num:(\d+)\]#ie','isset($array[\2]) ? "\1 ".$array[\2]["name"] : " "',$string);
	}
}
?>
