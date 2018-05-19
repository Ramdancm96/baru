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

class feed{
	function feed() {
		global $content, $db, $apps, $client, $settings, $menuon;
		do_auth(2);
		$menuon = 'feed';
		set_title(t('News feed'));
		clear_as();
	}

	function index($page = 0) {
		global $content, $db, $apps, $client, $settings;
		if ($client['avatar'] == 'undefined.jpg') {
			$uf[] = url('account/avatar', t('Avatar picture'));
		}
		if (is_array($uf)) {
			sys_notice(t("You haven't finished editing your profile").' : '.implode(', ',$uf));
		}
		c(stream_form($client['id']));
		$uids[] = $client['id'];
		$num = 10;
		$res = sql_query("select f.fid from ".tb()."friends as f left join ".tb()."accounts as u on u.id=f.fid where f.uid='{$client['id']}' order by u.lastlogin desc limit 5");
		while ($row = sql_fetch_array($res)) {
			$uids[] = $row['fid'];
		}
		$res = sql_query("select f.fid from ".tb()."followers as f left join ".tb()."accounts as u on u.id=f.fid where f.uid='{$client['id']}' order by u.lastlogin desc limit 5");
		while ($row = sql_fetch_array($res)) {
			$uids[] = $row['fid'];
		}
		$page_ids = array();
		$res = sql_query("select pid from ".tb()."page_users where uid='{$client['id']}' limit 10");
		while($page = sql_fetch_array($res)) {
			$page_ids[] = $page['pid'];
		}
		if (is_array($uids)) {
			$output .= activity_get($uids,$num,0,0,1,$page_ids);
		}
		else $output = t('No people');
		c($output);
		section_close();
	}

	function mentions() {
		global $content, $db, $apps, $client, $settings;
		$num = 10;
		c(feed_activity_get($client['id'],$num,0,0,1));
	}

	function likes() {
		global $content, $db, $apps, $client, $settings;
		$num = 10;
		c(feed_activity_get($client['id'],$num,0,0,1,'likes'));
	}

	function view($stream_id=0) {
		if (is_numeric($stream_id) && $stream_id > 0) {
			$res = sql_query("select s.*,u.username,u.avatar,p.uid as wall_uid from ".tb()."streams as s left join ".tb()."accounts as u on u.id=s.uid left join ".tb()."pages as p on p.id=s.wall_id where s.id='$stream_id' and s.hide!=1 ");
			$stream = sql_fetch_array($res);
			$stream['attachment'] = unserialize($stream['attachment']);
			c(stream_display($stream,'',0,0,100));
		}
	}

	function feedmoreactivities() {
		global $client;
		echo feed_activity_get($client['id'],7,$_POST['offset'],$_POST['target_id'],0,$_POST['type']);
		echo '<script>jcow_ajax_loaded();</script>';
		exit;
	}
	function all($page = 0) {
		global $content, $db, $apps, $client, $settings;
		$num = 10;
		c(activity_get(0,$num,0,0,1));
	}
}


function feed_activity_get($uid,$num = 12,$offset=0,$target_id=0,$pager=0,$type='mentions') {
	$extra = $num+1;
	$i = 1;
	if (!is_numeric($offset) || !is_numeric($target_id) || !is_numeric($uid)) die('wrong act p');
	if ($type == 'mentions') {
		$res = sql_query("select s.*,u.username,u.avatar,p.uid as wall_uid from ".tb()."mentions as m left join ".tb()."streams as s on s.id=m.stream_id left join ".tb()."accounts as u on u.id=s.uid left join ".tb()."pages as p on p.id=s.wall_id where m.uid='$uid' and p.type!='group' and s.hide!=1 order by m.id desc limit $offset,$extra");
	}
	else {
		$uids[] = $uid;
		$res = sql_query("select f.fid from ".tb()."friends as f left join ".tb()."accounts as u on u.id=f.fid where f.uid='{$uid}' order by u.lastlogin desc limit 5");
		while ($row = sql_fetch_array($res)) {
			$uids[] = $row['fid'];
		}
		$res = sql_query("select f.fid from ".tb()."followers as f left join ".tb()."accounts as u on u.id=f.fid where f.uid='{$uid}' order by u.lastlogin desc limit 5");
		while ($row = sql_fetch_array($res)) {
			$uids[] = $row['fid'];
		}
		if (count($uids)<1) {
			return '';
		}
		else {
			$uids = implode(',',$uids);
		}
		$res = sql_query("select s.*,u.username,u.avatar,p.uid as wall_uid from ".tb()."liked as l left join ".tb()."streams as s on s.id=l.stream_id left join ".tb()."accounts as u on u.id=s.uid left join ".tb()."pages as p on p.id=s.wall_id where l.uid in ($uids) and p.type!='group' and s.hide!=1 order by l.id desc limit $offset,$extra");
	}
	while($row = sql_fetch_array($res)) {
		if ($i <= $num) {
			$row['attachment'] = unserialize($row['attachment']);
			$output .= stream_display($row,'','',$target_id);
		}
		$i++;
	}
	if ($pager && $i > $num) {
		$uid = str_replace(',','_',$uid);
		$output .= '<div id="morestream_box"></div>
			<div>
			<script>
			$(document).ready(function(){
				$("#morestream_button").click(function() {
					$(this).hide();
					$("#morestream_box").html("<img src=\"'.uhome().'/files/loading.gif\" /> Loading");
					$.post("'.uhome().'/index.php?p=feed/feedmoreactivities",
								{offset:$("#stream_offset").val(),type:"'.$type.'",target_id:'.$target_id.'},
								  function(data){
									var currentVal = parseInt( $("#stream_offset").val() );
									$("#stream_offset").val(currentVal + 7);
									$("#morestream_box").before(data);
									if (data.length>50) {
										$("#morestream_button").show();
									}
									$("#morestream_box").html("");
									},"html"
								);
					return false;
				});
			});
			</script>

			<input type="hidden" id="stream_offset" value="'.$num.'" />
			<a href="#" id="morestream_button"><strong>'.t('See More').'</strong></a>
			</div>';
	}
	return $output;
}