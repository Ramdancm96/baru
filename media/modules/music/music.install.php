<?php
/* ############################################################ *\
 ----------------------------------------------------------------
@package	Jcow Social Networking Script.
@copyright	Copyright (C) 2009 - 2010 jcow.net.  All Rights Reserved.
@license	see http://jcow.net/license
 ----------------------------------------------------------------
\* ############################################################ */
function music_menu() {
	$items = array();
	$items['music'] = array(
		'name'=>'Music',
		'tab_name'=>'My connections',
		'type'=>'app'
	);
	$items['music/all'] = array(
		'name'=>'All public',
		'type'=>'tab',
		'parent'=>'music'
	);
	return $items;
}



?>