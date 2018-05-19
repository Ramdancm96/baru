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
// list, add(request), my request,
class blacklist{
	
	function blacklist() {
		nav(url('blacklist',t('Blacklist')));
	}
	function index() {
		global $ubase;
		redirect($ubase.'blacklist/my');
	}

	function my() {
		global $client, $offset, $num_per_page, $page, $ubase, $nav;
		$nav[] = 'My blacklist';
		$res = sql_query("SELECT u.* FROM `".tb()."blacks` as b left join `".tb()."accounts` as u on u.id=b.bid where b.uid='{$client['id']}' ORDER BY b.id DESC");
		c('<ul>');
		while ($row = sql_fetch_array($res)) {
			c('<li>'
			.url('u/'.$row['url'],$row['firstname'].' '.$row['lastname']).
				' | <span class="sub">'.url('blacklist/delete/'.$row['id'],t('Delete')).'</span>
			</li>');
		}
		c('</ul>');
	}
	
	function remove($uid) {
		global $client, $ubase;
		if ($user = valid_user($uid)) {
			sql_query("delete from `".tb()."blacks` where uid={$client['id']} and bid='$uid'");
			redirect(url('u/'.$user['username']),1);
		}
		else {
			die('uid:'.$uid);
		}
	}
	
	function add($uid) {
		global $db, $client, $offset, $num_per_page, $page, $ubase;
		if ($uid) {
			$res = sql_query("select * from `".tb()."accounts` where id='$uid'");
			$user = sql_fetch_array($res);
		}
		c('
		'.t('Are you sure to block {1}','<strong>'.url('u/'.$user['url'],$user['firstname'].' '.$user['lastname']).'</strong>').'?
					<form method="post" name="form1" action="'.url('blacklist/addpost').'"  enctype="multipart/form-data">
					<input type="hidden" name="uid" value="'.$uid.'" />
					<p>
					<input class="button" type="submit" value="'.t('Yes').'" />
					</p>
					</form>
					
					<div class="sub">
		'.t('Blocked people will unable to send message and friend request to you, or comment to your profile and stories').'
		</div>
					');
	}
	
	function addpost() {
		global $db, $client, $ubase;
		//get_r('firstname');
		if(!$user = valid_user($_POST['uid'])) {
			sys_back('wrong firstname');
		}
		if ($user['id'] == $client['id']) {
			sys_back('you cannot add yourself');
		}
		$res = sql_query("select * from `".tb()."blacks` where uid='{$client['id']}' and bid='{$user['id']}'");
		if (!sql_counts($res)) {
			sql_query("insert into `".tb()."blacks` (uid,bid) values ('{$client['id']}','{$user['id']}')");
		}
		redirect(url('u/'.$user['username']),1);
	}
	


}