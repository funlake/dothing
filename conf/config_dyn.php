<?php
/**
 * setting by backend.
 *
 */
//database
define('DO_DBDRIVE','mysql');#if use want mysqli,set it to mysql_mysqli
define('DO_DATABASE','dothing');
define('DO_DBHOST','localhost');
define('DO_DBUSER','root');
define('DO_DBPASS','123456');
define('DO_TABLEPRE','');
define('DO_PDO',true);
define('DO_DEBUG',false);
define('DO_SQLPCONNECT',false);
//identify
define('DO_ACCESS',1);
//controller key in url
define('DO_CKEY','C');
//encry
define('DO_SITECIPHER',md5('susan'));
//pathinfo switch
define('DO_SEO',true);
//char set
define('DO_CHARSET','utf-8');
//brower cache or not
define('DO_BROWERCACHE',false);
//file cache or not
define('DO_FILECACHE',false);
//sessio handler
define('DO_SESSHANDLER','files');
//ciphter
define('DO_SITECIPHER',md5('justdoit'));
?>
