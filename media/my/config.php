<?php
/* ############################################################ *\
 ----------------------------------------------------------------
@package	Jcow Social Networking Script.
@copyright	Copyright (C) 2009 jcow.net.  All Rights Reserved.
@license	see http://jcow.net/license
 ----------------------------------------------------------------
\* ############################################################ */

$db_info = array(
	'host' => 'mysql.main-hosting.com',
	'user' => 'u804441525_avybu',
	'pass' => 'ujaWeVyNuB',
	'dbname' => 'u804441525_yvyjy'
	);

$lang_options = array(
	'en' => 'English'
	);

$uhome = 'http://raici.96.lt/media';
$flvtool2Path = '/usr/bin/flvtool2';
$ffmpegPath='/usr/local/bin/ffmpeg';
$var_cache_live = 3600; // seconds
//$ubase = $uhome.'/index.php?p=';
$ubase = $uhome.'/';
$num_per_page = 12;
$sid = 'jcow';
$table_prefix = 'jcow_';
$timezone = -8;
$settings = array(
	'time_format' => 'g:i a',
	'date_format' => 'M jS Y',
	'date_today' => 'Today',
	'date_yesterday' => 'Yesterday',
	'default_lang' => 'en',
	'hide_whatsnew' => 1,
	'hide_onlineuser' => 1,
	'online' => 10, // minutes
	);
$config['disable_language'] = 0;
$config['is_local'] = 1;
$config['max_upload'] = 200; // kb
$config['allowed_html_tags'] = '<ul><li><a><img><br><p><strong><em><span>';
$config['ad_right'] = 
	'';
$story_apps = array('blogs','videos','music','photos');

$optional_apps = array(
'photos' => array('uri'=>'photos','manageuri'=>'','profileuri'=>'photos/liststories/user_','flag'=>'Photos','des'=>'Allow your members to share photos.'),
'blogs' => array('uri'=>'blogs','manageuri'=>'','profileuri'=>'blogs/liststories/user_','flag'=>'Blogs','des'=>'Allow your members to share blogs.'),
'events' => array('uri'=>'events','manageuri'=>'','profileuri'=>'events/liststories/user_','flag'=>'Events','des'=>'Allow your members to start events.'),
'videos' => array('uri'=>'videos','manageuri'=>'','profileuri'=>'videos/liststories/user_','flag'=>'Videos','des'=>'Allow your members to share videos.'),
'music' => array('uri'=>'music','manageuri'=>'','profileuri'=>'music/liststories/user_','flag'=>'Music','des'=>'Allow your members to share music.'),

	'forums' => array('uri'=>'forums','manageuri'=>'forumadmin','flag'=>'Forums','des'=>'Build discussion forums for your community.'),
	'groups' => array('uri'=>'groups','manageuri'=>'groups/manage','flag'=>'Groups','des'=>'Allow your members to create Groups.')
	);
