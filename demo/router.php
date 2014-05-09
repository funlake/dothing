<?php
use \Dothing\Lib\Router;
Router::ModuleMap("admin","ads007");
Router::Map('/manage/user','admin/user/index');
Router::Map('/manage/user-:id','admin/user/edit');
Router::Map('/manage/group','admin/user/group');
Router::Map('/manage/group-:id','admin/user/editgroup');
Router::Map('/assign/permission-:id','admin/user/rolepermission');

Router::Map('/forbidden','debug/index/nopermission');
Router::Map('/'.md5(md5("back@end@login")),'admin/user/login');