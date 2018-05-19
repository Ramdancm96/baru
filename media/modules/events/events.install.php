<?php
/* ############################################################ *\
 ----------------------------------------------------------------
@package	Jcow Social Networking Script.
@copyright	Copyright (C) 2009 - 2010 jcow.net.  All Rights Reserved.
@license	see http://jcow.net/license
 ----------------------------------------------------------------
\* ############################################################ */


function events_menu() {
	$items = array();
	$items['events'] = array(
		'name'=>'Events',
		'tab_name'=>'My connections',
		'type'=>'app'
	);
	$items['events/all'] = array(
		'name'=>'All public',
		'type'=>'tab',
		'parent'=>'events'
	);
	return $items;
}
?>