<?php
/**
 * Sqlite syntax
 * @author lake
 *
 */
class SqliteSyntax extends DOSyntax
{
	/** Replace table prefix,trim */
	function FormatSql( $sql )
	{
		$sql = preg_replace(
				array('~(?<=\s)(`)?(?(1)#__(\w+)`|#__(\w+))(?=\s+|$)~is','#^\s+|\s+$#')
				,array(DO_TABLEPRE.'\2\3','')
				,$sql
		);
		return $sql;
	}
}