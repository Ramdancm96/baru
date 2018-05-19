<?php
/* ############################################################ *\
Copyright (C) 2009 - 2010 jcow.net.  All Rights Reserved.
------------------------------------------------------------------------
The contents of this file are subject to the Common Public Attribution
License Version 1.0. (the "License"); you may not use this file except in
compliance with the License. You may obtain a copy of the License at
http://www.jcow.net/celicense. The License is based on the Mozilla Public
License Version 1.1, but Sections 14 and 15 have been added to cover use of
software over a computer network and provide for limited attribution for the
Original Developer. In addition, Exhibit A has been modified to be consistent
with Exhibit B.

Software distributed under the License is distributed on an "AS IS" basis,
 WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
the specific language governing rights and limitations under the License.
------------------------------------------------------------------------
The Original Code is Jcow.

The Original Developer is the Initial Developer.  The Initial Developer of the
Original Code is jcow.net.

\* ############################################################ */


function images_u_menu(&$tab_menu,$page) {
	$tab_menu[] = array(
		'name'=>'Images',
		'type'=>'tab',
		'path'=>'images/liststories/page_'.$page['id']
		);
}

function images_page_menu(&$tab_menu,$page) {
	$tab_menu[] = array(
		'name'=>'Images',
		'type'=>'tab',
		'path'=>'images/liststories/page_'.$page['id']
		);
}

function images_group_menu(&$tab_menu,$page) {
	$tab_menu[] = array(
		'name'=>'Images',
		'type'=>'tab',
		'path'=>'images/liststories/page_'.$page['id']
		);
}

/* owner,connected,everyone */
function images_quick_share() {
	return array(
		'u' => array('access'=>'owner','flag' => t('Image'),'weight'=>3),
		'page' => array('access'=>'connected','flag' => t('Image'),'weight'=>10),
		'group' => array('access'=>'connected','flag' => t('Image'),'weight'=>10)
		);
}
