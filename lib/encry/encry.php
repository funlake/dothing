<?php
class DOEncry extends DOBase
{
	public $cipher;
	
	function DOEncry()
	{
		$this->cipher = md5(DO_SITECIPHER);
	}
	function simpleEncry($text , $cipher='')
	{
		  $return = '';
		  $text   = (string)$text;
		  $rand   = md5(uniqid(rand(), true));
		  for ($i = 0,$j=strlen($text); $i < $j; $i++)  
		  {
			$return .= ($text[$i] ^ $rand[$i%32]) . ($rand[$i%32] ^ $this->cipher[$i%32]);
			
		  }  
		  return base64_encode($this->simpleKey($return,$cipher));
	}
	
	function simpleDecry($text,$cipher='')
	{
	  $text = $this->simpleKey(base64_decode($text), $cipher);

	  $return = '';  
	  $j = 0;
	  for ($i = 0; $i < strlen($text); $i++,$j++)  
	  {
			$return .= $text[$i] ^ $this->cipher[$j%32] ^ $text[++$i]   ;
	  }   
	  return $return;  
	}
	
	function simpleKey($text , $cipher='')
	{
		$i = 0;
		$j = 0;
		$l = strlen( $cipher );
		$text = (string)$text;
		$cipher = $this->getCipher( $cipher );

		while( isset($text{$i}) )
		{
			$text{$i} = $text{$i} ^ $cipher{$j%$l};
			$i++;
		}
		return  $text;
	}
	function getCipher( $cipher = '')
	{
		return $cipher ? $cipher : $this->cipher;
	}
}
?>