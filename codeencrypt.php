<?php
error_reporting(~E_NOTICE & ~E_STRICT);
/** Encoded file **/
$dir = $argv[1];
echo "Encrypt start...".PHP_EOL;
foreach(FindPhpFile($dir) as $phpFile)
{
	echo $phpFile." is encoding...".PHP_EOL;
	CodeEncrypt($phpFile);
	echo "Done!".PHP_EOL;
}
echo "Encrypt finish...".PHP_EOL;
function FindPhpFile($dir)
{
	$r = array();
	foreach(glob($dir.'/*') as $fd)
	{
		if(substr($fd,-3) === 'php')
		{
			$r[] = $fd;
		}
		if(is_dir($fd))
		{
			$r = array_merge($r,FindPhpFile($fd));
		}
	}
	return $r;
}

function CodeEncrypt($phpFile)
{
	$content = file_get_contents($phpFile);
	CodeReplace3($phpFile,CodeEncode($content));
	CodeReplace2($phpFile,CodeEncode($content));
	CodeReplace($phpFile,CodeEncode($content));	
}
function CodeEncode($codes)
{

	/**$codes = preg_replace(array('#^<\?(php)?#i','#(\?>\s*)?$#'),array('',''),$codes);**/
	$codes = '?'.'>'.$codes;
	$codes = $codes;
	$codes = gzdeflate($codes);
	$codes = base64_encode($codes);
	return $codes;
}
/** Method 1 **/
function CodeReplace($file,$encodedCode)
{
	//for test
		     //012345678901234567890123456789
	$str 	= "e6loazi_fvtbs4gdncr#p()'k*,zhx";
	$s   	= unpack('H*p',$str);
	$s   	= preg_replace('#.{2}#','\x\0',$s['p']);
	$up   	= unpack('n*',$encodedCode);
	$pp    	= implode(',',$up);
	$fh 	= fopen($file,'w+');
	$codes  = '<'.'?php'.PHP_EOL;
	$codes .= '$O00000O="'.$s.'";';
	$codes .= '$OOOOOO=__FILE__;';
	//filesize
	$codes .= '$O0OOOO=$O00000O{8}.$O00000O{6}.$O00000O{2}.$O00000O{0}.$O00000O{12}.$O00000O{6}.$O00000O{27}.$O00000O{0};';
	//exit
	$codes .= '$OOO0OO=$O00000O{0}.$O00000O{29}.$O00000O{6}.$O00000O{10};';
	//eval
	$codes .= '$O0OOO0=$O00000O{0}.$O00000O{9}.$O00000O{4}.$O00000O{2};';
	//gzinflate
	$codes .= '$OOOO00=$O00000O{14}.$O00000O{5}.$O00000O{6}.$O00000O{16}.$O00000O{8}.$O00000O{2}.$O00000O{4}.$O00000O{10}.$O00000O{0};';
	//base64_decode
	$codes .= '$O0OO00=$O00000O{11}.$O00000O{4}.$O00000O{12}.$O00000O{0}.$O00000O{1}.$O00000O{13}.$O00000O{7}.$O00000O{15}.$O00000O{0}.$O00000O{17}.$O00000O{3}.$O00000O{15}.$O00000O{0};';
	//preg_replace
	$codes .= '$O00O00=$O00000O{20}.$O00000O{18}.$O00000O{0}.$O00000O{14}.$O00000O{7}.$O00000O{18}.$O00000O{0}.$O00000O{20}.$O00000O{2}.$O00000O{4}.$O00000O{17}.$O00000O{0};';
	/**preg_replace->eval->gzinflate->base64_decode(pack(unpack..))**/
	$codes .= '$O0OOOO($OOOOOO)^@@@@&&$OOO0OO{8}();';
	$codes .= '$O00O00($O00000O{19}.$O00000O{19}.$O00000O{0},$O0OOO0.$O00000O{21}.$OOOO00.$O00000O{21}.$O0OO00.$O00000O{21}.$O00000O{20}.$O00000O{4}.$O00000O{17}.$O00000O{24}.$O00000O{21}.$O00000O{23}.$O00000O{16}.$O00000O{25}.$O00000O{23}.$O00000O{26}."'.$pp.'".$O00000O{22}.$O00000O{22}.$O00000O{22}.$O00000O{22},NULL);';
	$codes .= PHP_EOL.'?'.'>';

	$codesLens = strlen($codes);
	$codesLen = $codesLen-4+strlen($codesLens);
	$codes    = preg_replace('#@{4}#',$codesLen,$codes);
	fwrite($fh, $codes);
	fclose($fh);
}
/** Method 2 **/
function CodeReplace2($file,$encodedCode)
{
		     //012345678901234567890123456
	$str 	= "e6loazi_fvtbs4gdncr#p()'k*,";
	$s   	= unpack('H*p',$str);
	$s   	= preg_replace('#.{2}#','\x\0',$s['p']);
	$fh = fopen($file,'w+');
	fwrite($fh,'<'.'?php'.PHP_EOL);
	fwrite($fh,'$O00000O="'.$s.'";');
	//eval
	fwrite($fh,'$O0OOO0=$O00000O{0}.$O00000O{9}.$O00000O{4}.$O00000O{2};');
	//gzdeflate
	fwrite($fh,'$OOOO00=$O00000O{14}.$O00000O{5}.$O00000O{6}.$O00000O{16}.$O00000O{8}.$O00000O{2}.$O00000O{4}.$O00000O{10}.$O00000O{0};');
	//base64_decode
	fwrite($fh,'$O0OO00=$O00000O{11}.$O00000O{4}.$O00000O{12}.$O00000O{0}.$O00000O{1}.$O00000O{13}.$O00000O{7}.$O00000O{15}.$O00000O{0}.$O00000O{17}.$O00000O{3}.$O00000O{15}.$O00000O{0};');
	fwrite($fh,'$O00O00=$O00000O{20}.$O00000O{18}.$O00000O{0}.$O00000O{14}.$O00000O{7}.$O00000O{18}.$O00000O{0}.$O00000O{20}.$O00000O{2}.$O00000O{4}.$O00000O{17}.$O00000O{0};');
	/**preg_replace->eval->gzinflate->base64_decode**/
	fwrite($fh,'$O00O00($O00000O{19}.$O00000O{19}.$O00000O{0},$O0OOO0.$O00000O{21}.$OOOO00.$O00000O{21}.$O0OO00.$O00000O{21}.$O00000O{23}."'.$encodedCode.'".$O00000O{23}.$O00000O{22}.$O00000O{22}.$O00000O{22},NULL);');
	fwrite($fh,PHP_EOL.'?'.'>');
	fclose($fh);
}
/** Method 3 **/
function CodeReplace3($file,$encodedCode)
{
	//for test
		     
	$str 	= "_rastep"; //parse_str
	$ss   	= unpack('H*p',$str);
	$ss   	= preg_replace('#.{2}#','\x\0',$ss['p']);
			 //012345678901234567890123456
	$str 	= "e6loazi_fvtbs4gdncr#p()'k*,";
	$s   	= unpack('H*p',$str);
	$s   	= preg_replace('#.{2}#','\x\0',$s['p']);
	$fh = fopen($file,'w+');
	fwrite($fh,'<'.'?php'.PHP_EOL);
	fwrite($fh,'$O00000O="'.$s.'";');
	fwrite($fh,'$O000000="'.$ss.'";');
	//parse_str
	fwrite($fh,'$lllll1=$O000000{6}.$O000000{2}.$O000000{1}.$O000000{3}.$O000000{5}.$O000000{0}.$O000000{3}.$O000000{4}.$O000000{1};');
	fwrite($fh,'$lllll1("O0OOO0=".$O00000O{0}.$O00000O{9}.$O00000O{4}.$O00000O{2});');
	fwrite($fh,'$lllll1("OOOO00=".$O00000O{14}.$O00000O{5}.$O00000O{6}.$O00000O{16}.$O00000O{8}.$O00000O{2}.$O00000O{4}.$O00000O{10}.$O00000O{0});');
	fwrite($fh,'$lllll1("O0OO00=".$O00000O{11}.$O00000O{4}.$O00000O{12}.$O00000O{0}.$O00000O{1}.$O00000O{13}.$O00000O{7}.$O00000O{15}.$O00000O{0}.$O00000O{17}.$O00000O{3}.$O00000O{15}.$O00000O{0});');
	fwrite($fh,'$lllll1("O00O00=".$O00000O{20}.$O00000O{18}.$O00000O{0}.$O00000O{14}.$O00000O{7}.$O00000O{18}.$O00000O{0}.$O00000O{20}.$O00000O{2}.$O00000O{4}.$O00000O{17}.$O00000O{0});');
	/**preg_replace->eval->gzinflate->base64_decode**/
	fwrite($fh,'$O00O00($O00000O{19}.$O00000O{19}.$O00000O{0},$O0OOO0.$O00000O{21}.$OOOO00.$O00000O{21}.$O0OO00.$O00000O{21}.$O00000O{23}."'.$encodedCode.'".$O00000O{23}.$O00000O{22}.$O00000O{22}.$O00000O{22},NULL);');
	fwrite($fh,PHP_EOL.'?'.'>');
	fclose($fh);
}
?>
