<?php
/**
 * setting by backend.
 *
 */
//time zone
date_default_timezone_set('Etc/GMT');
//database
define('DO_DBDRIVE','mysql');
define('DO_DATABASE','demo');
define('DO_DBHOST','127.0.0.1');
define('DO_DBUSER','root');
define('DO_DBPASS','123456');
define('DO_TABLEPRE','');
define('DO_DEBUG',false);
define('DO_SQLPCONNECT',false);
//identify
define('DO_ACCESS',1);
//controller key in url
define('DO_CKEY','C');
//pathinfo switch
define('DO_SEO',false);
//char set
define('DO_CHARSET','utf-8');
//brower cache or not
define('DO_BROWERCACHE',false);
//file cache or not
define('DO_FILECACHE',false);
//sessio handler
define('DO_SESSHANDLER','file');
//cache handler
#define('DO_CACHEHANDLER','memcache');
define('DO_CACHEHANDLER','file');
//ciphter
define('DO_SITECIPHER',md5('justdoit'));
//template
define('DO_TEMPLATE','default');
//mailer
define('DO_MAILER','smtp');
define('DO_MAIL_SMTP_AUTH','1');
define('DO_MAIL_SMTP_HOST','ssl://smtp.gmail.com');
define('DO_MAIL_SMTP_PORT',465);
define('DO_MAIL_SMTP_USER','ffunlake@gmail.com');
define('DO_MAIL_SMTP_PASS','fuliang168');
define('DO_MAIL_FROM_NAME','Petition system');
define('DO_MAIL_SEND_EXE','/usr/bin/sendmail');
?>

