<?php
class DODatetime extends DOBase 
{
	function showTime()
	{
		
	}
	
	function storeDateTime()
	{
		
	}
	
	function storeDate()
	{
		
	}
	
	function storeTime()
	{
		
	}
	/**
	 * unix time to dos time 
	 * copy from joomla
	 *
	 * @param  $unixTimes
	 * @return unknown
	 */
	function unixToDos( $unixTimes='' )
	{
		$times = strlen($unixTimes)  == 0 ? getdate() : getdate( $unixTimes );
		
		if ($times['year'] < 1980) 
		{
			$times['year'] 		= 1980;
			$times['mon'] 		= 1;
			$times['mday'] 		= 1;
			$times['hours'] 	= 0;
			$times['minutes'] 	= 0;
			$times['seconds'] 	= 0;
		}
		
		return (($times['year'] - 1980) << 25) | ($times['mon'] << 21) | ($times['mday'] << 16) | ($times['hours'] << 11) | ($times['minutes'] << 5) | ($times['seconds'] >> 1);
	}
}
?>