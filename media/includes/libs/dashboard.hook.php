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

function dashboard_widget(&$widgets) {
	$widgets['dashboard_my_account'] = array(
		'name'=>t('My account info'),
		'description'=>t('My account info'),
		'callback'=>'dashboard_my_account'
		);
	$widgets['dashboard_friends_birthday'] = array(
		'name'=>t('Birthdays coming up'),
		'description'=>t('Friends birthday coming up'),
		'callback'=>'dashboard_friends_birthday'
		);
	$widgets['dashboard_messages'] = array(
		'name'=>t('Inbox'),
		'description'=>t('My recent messages'),
		'callback'=>'dashboard_messages'
		);
	$widgets['dashboard_notifications'] = array(
		'name'=>t('Notifications'),
		'description'=>t('My recent notifications'),
		'callback'=>'dashboard_notifications'
		);
}


function dashboard_my_account() {
		global $client, $apps;
		if (!$client['id']) return false;
		$res = sql_query("select * from `".tb()."pages` where uid='{$client['id']}' and type='u'");
		$row = sql_fetch_array($res);
		if ($client['avatar'] == 'undefined.jpg') {
			$uf[] = url('account/avatar', t('Avatar picture'));
		}
		if (is_array($uf)) {
			sys_notice(t("You haven't finished editing your profile").' : '.implode(', ',$uf));
		}
		$profile_views = $row['views'];
		$res = sql_query("select count(*) as num from ".tb()."friends where uid='{$client['id']}'");
		$row = sql_fetch_array($res);
		$friends = $row['num'];
		$res = sql_query("select count(*) as num from ".tb()."followers where fid='{$client['id']}'");
		$row = sql_fetch_array($res);
		$followers = $row['num'];
		$content = 
			t('Your profile was viewed {1} times.','<strong>'.$profile_views.'</strong>').'
		<div class="hr"></div>'.
			t('You have {1} friends and {2} followers.','<strong>'.$friends.'</strong>','<strong>'.$followers.'</strong>');

		
		$content .= '<div class="hr"></div>';
		$content .= '
		<ul>
		<li>'.url('u/'.$client['username'],t('My Profile')).'</li>
		<li>'.url('follow/myfollowers',t('My Followers').'('.$followers.')' ).'</li>
		<li>'.url('follow/imfollowing',t('My Following') ).'</li>
		<li>'.url('preference',t('Preference')).'</li>
		</ul>';
		
		return $content;
	}

function dashboard_friends_birthday() {
	global $client;
	$m = date('n');
	$d = date('j');
	$next = $m+1;
	if ($m<10) $m = '0'.$m;
	if ($next > 12) $next = '01';
	if ($d > 20) {
		$nextm = " or (f.uid='{$client['id']}' and birthmonth='$next' and birthday<$d) ";
	}
	$res = sql_query("select u.* from ".tb()."friends as f left join ".tb()."accounts as u on u.id=f.fid where (f.uid='{$client['id']}' and u.birthmonth='$m' and u.birthday>$d) $nextm  order by u.lastlogin desc limit 15");
	$content = '<ul>';
	while ($user = sql_fetch_array($res)) {
		$total++;
		if ($user['birthmonth'] < 10) $user['birthmonth'] = '0'.$user['birthmonth'];
		if ($user['birthday'] < 10) $user['birthday'] = '0'.$user['birthday'];
		$content .= '<li>'.url('u/'.$user['username'],$user['username']).' - <strong>'.$user['birthmonth'].'/'.$user['birthday'].'</strong></li>';
	}
	$content .= '</ul>';
	if (!$total) $content = 'none';
	return $content;
}

function dashboard_messages() {
	global $client;
	if (!$client['id']) return '';
	$res = sql_query("SELECT m.*,u.username,u.avatar FROM `".tb()."messages` as m left join `".tb()."accounts` as u on u.id=m.from_id where m.to_id='{$client['id']}' and m.from_id>0 ORDER by m.id DESC LIMIT 5 ");
	$out = '<ul class="simple_list">';
	while ($row = sql_fetch_array($res)) {
		if (!strlen($row['subject'])) {
			$row['subject'] = strip_tags(utf8_substr($row['message'],40));
		}
		if (!$row['hasread']) {
			$stress = 'style="font-weight:bold"';
		}
		else {
			$stress = '';
		}
		$from_user = htmlspecialchars($row['username']);
		$out .= '<li>';
		$out .= $from_user.': <span '.$stress.'>'.url('message/view/'.$row['id'], htmlspecialchars($row['subject'])).'</span>';
		$out .= ' ('.get_date($row['created']).')</li>';
	}
	$out .= '</ul>';
	return $out;
}

function dashboard_notifications() {
	global $client;
	if (!$client['id']) return '';
	$out = '<ul class="simple_list">';
	$res = sql_query("SELECT m.*,u.username FROM `".tb()."messages` as m left join `".tb()."accounts` as u on u.id=m.from_id where m.to_id='{$client['id']}' and m.from_id=0 ORDER by m.id DESC LIMIT 5");
	$rsspass = md5(get_gvar('secure_key').$client['id']);
	while ($row = sql_fetch_array($res)) {
		$out .= '<li>'.$row['message'].' ('.get_date($row['created']).')</li>';
	}
	$out .= '</ul>';
	return $out;
}