<?php
DORouter::ModuleMap("admin","ads007");
DORouter::Map('/manage/user','admin/user/index');
DORouter::Map('/manage/user-:id','admin/user/edit');
DORouter::Map('/manage/group','admin/user/group');
DORouter::Map('/manage/group-:id','admin/user/editgroup');
DORouter::Map('/assign/permission-:id','admin/user/rolepermission');

DORouter::Map('/forbidden','debug/index/nopermission');
DORouter::Map('/'.md5(md5("back@end@login")),'admin/user/login');

