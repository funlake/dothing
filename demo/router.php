<?php
DORouter::ModuleMap("admin","ads007");
DORouter::Map('/manage/user-:id','admin/user/edit');
DORouter::Map('/manage/group','admin/user/group');
DORouter::Map('/manage/group-:id','admin/user/editgroup');


DORouter::Map('/forbidden','debug/index/nopermission');

