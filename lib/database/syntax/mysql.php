<?php
/**
 * mysql syntax
 *
 */
class MysqlSyntax extends DOSyntax 
{
	/**
	 * idea from csdn,not really tested ,just mark it.
	 *
	 * @param unknown_type $table
	 * @param unknown_type $fileds
	 * @param unknown_type $condition
	 * @param unknown_type $start
	 * @param unknown_type $limit
	 * @param unknown_type $keyid
	 * @return unknown
	 */
	function QuickLimit( $table,$fileds,$condition,$start,$limit,$keyid)
	{
		//model
/*		select module_id,module_pid,module_name from module m 
		INNER JOIN ( 
				select module_id as my_id from ( 
						select module_id from module order by module_id desc limit 0,100 
				) as tmp 
		) as temp ON my_id=module_id */

		$sql = "select {$fileds} from `{$table}` \n"
		      ."inner join( \n"
		      ." select `{$keyid}` as key_id from ( \n"
		      ."	select `{$keyid}` from `{$table}` order by `{$key}` desc limit {$start},{$limit} \n"
		      ." ) as tmp \n"
		      .") as temp on key_id=`{$key}`";
		 return $sql;
	}
}