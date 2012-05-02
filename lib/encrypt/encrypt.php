<?php
class DOEncrypt extends DOBase
{
	public $cipher;
	
	function DOEncrypt()
	{
		$this->cipher = md5(DO_SITECIPHER);
	}
	function SimpleEncrypt($text , $cipher='')
	{
		  $return = '';
		  $text   = (string)$text;
		  $rand   = md5(uniqid(rand(), true));
		  for ($i = 0,$j=strlen($text); $i < $j; $i++)  
		  {
			$return .= ($text[$i] ^ $rand[$i%32]) . ($rand[$i%32] ^ $this->cipher[$i%32]);
			
		  }  
		  return base64_encode($this->SimpleKey($return,$cipher));
	}
	
	function SimpleDecrypt($text,$cipher='')
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
	
	function SimpleKey($text , $cipher='')
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
	function GetCipher( $cipher = '')
	{
		return $cipher ? $cipher : $this->cipher;
	}
	
	function CbcEncrypt($value){
		if(!$value){
			return false;
		}
		$key         = $this->GetCipher();
		$text        = $value;
		/** Get iv size accroding to encode way**/
		$iv_size     = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
		/** Create iv which make decrypt difficulty **/
		mt_srand();
		$iv          = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		/** Encode contents **/
		$crypttext   = mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$text, MCRYPT_MODE_CBC, $iv);
		/** Encode iv and pad it to encoded contents **/
		$ivencode    = @mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$crypttext,$iv,MCRYPT_MODE_ECB);
		return strtr(base64_encode($crypttext.$ivencode),'+/=','-_~'); 
	}
	function CbcDecrypt($value){
		if(!$value){
			return false;
		}
		$value       = base64_decode(strtr($value,'-_~','+/='));
		/** Raw content **/
		$rvalue      = substr($value,0,-32);
		/** IV **/
		$iv          = substr($value,-32);
		/** Decode iv **/
		$iv          = @mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$rvalue,$iv,MCRYPT_MODE_ECB);//decode iv
		$key         = $this->GetCipher();
		$text        = $rvalue;
		$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_CBC, $iv);
		return $decrypttext;
	}
	
}
?>