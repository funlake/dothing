<?php
namespace Dothing\Lib\Encrypt;
/**
** Encrypt/Decrypt handler
**@author lake
**@sample 
**================================
** $crypt   = DOFactory::GetTool('encrypt');
** $encoded = $crypt->Encrypt("balabla");
** echo $crypt->Decrypt($encoded);
**/
class Encrypt
{
	public $cipher;
	
	function __construct()
	{
		$this->cipher = md5(md5(DO_SITECIPHER));
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
		return !empty($cipher) ? $cipher : $this->cipher;
	}

	function SetCipher( $cipher )
	{
		$this->cipher = $cipher;
	}
	/**
	** Encrypt method
	**/
	public function Encrypt($value,$cipher = '')
	{
		/** Module init **/
		$ofb 		= mcrypt_module_open(MCRYPT_RIJNDAEL_256,'',DO_ENCRYPT_MODE, '');
		/** Get iv size **/
		$ivsize		= mcrypt_enc_get_block_size($ofb);
		/** Create iv,work for windows/linux platforms **/
		$iv  		= mcrypt_create_iv($ivsize,MCRYPT_DEV_URANDOM);
		/** Get key **/
		$key 		= substr($this->GetCipher($cipher),0,$ivsize);
		/** Init **/
		mcrypt_generic_init($ofb, $key, $iv);
		/** Encode,iv needed to pack in it**/
		$encrypted 	=  strtr(base64_encode(mcrypt_generic( $ofb, $value ).$iv),'+/=','-_~');
		/** Close **/
		mcrypt_generic_deinit($ofb);
		mcrypt_module_close($ofb);
		
		return $encrypted;
	}
	/**
	** Decrypt method
	**/
	public function Decrypt($value,$cipher = '')
	{
		$value       		= base64_decode(strtr($value,'-_~','+/='));	
		/** Module init **/
		$ofb 			= mcrypt_module_open(MCRYPT_RIJNDAEL_256,'',DO_ENCRYPT_MODE, '');
		/** Get iv size **/
		$ivsize		= mcrypt_enc_get_block_size($ofb);
		/** Get key **/
		$key 			= substr($this->GetCipher($cipher),0,$ivsize);
		/** Raw encoded value **/
		$rvalue		 = substr($value,0,$ivsize * -1);
		/** IV **/
		$iv			 = substr($value,$ivsize * -1);
		/** Init **/
		mcrypt_generic_init($ofb, $key, $iv);
		/** Get paintext **/
		$decrypted		= trim(mdecrypt_generic($ofb,$rvalue));
		/** Close **/
		mcrypt_generic_deinit($ofb);
		mcrypt_module_close($ofb);
		
		return $decrypted;
	}
}
?>