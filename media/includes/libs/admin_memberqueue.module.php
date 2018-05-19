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


if ($step == 'post') {
	if (is_array($_POST['ids'])) {
		foreach ($_POST['ids'] as $id) {
			if ($_POST['opt'] == 1) {
				sql_query("update ".tb()."accounts set disabled=0 where id='{$id}'");
				sql_query("delete from ".tb()."pending_review where uid='$id' and ignored!=1");
			}
			elseif ($_POST['opt'] == 2) {
				sql_query("update ".tb()."accounts set disabled=2 where id='{$id}'");
			}
		}
	}
	redirect('admin/memberqueue',1);

}

else {
	$num_per_page = 20;
	global $parr;
	if (!$parr[2]) $page=1;
	else $page = $parr[2];
	$offset = ($page-1)*$num_per_page;
	$more = $num_per_page+1;
	c('
	<script>
	$(document).ready( function(){
		$("#checkallids").click(function() {
			$(".checkids").attr("checked",true);
		});
	});
	</script>
	<form method="post" action="'.url('admin/memberqueue/post').'">
	Make sure do not make bot/spammer verified.  Only verify those who are posting on-topic messages.
<table class="stories">
	
	<tr class="table_line1">
	<td width="5"></td><td>Member</td><td>Posts</td></tr>');
	$res = sql_query("select * from ".tb()."accounts where forum_posts>1 and disabled=1 order by lastlogin DESC limit $offset,$more");
	$i=1;
	while ($row = sql_fetch_array($res)) {
		if ($i < $more) {
			c('<tr class="row1">
			<td><input type="checkbox" name="ids[]" class="checkids" value="'.$row['id'].'" /></td>
			<td>'.url('u/'.$row['username'],$row['username']).'<br />
			Fullname: '.h($row['fullname']).'<br />
			Register: '.get_date($row['created']).'<br />
			Posts: '.$row['forum_posts'].'<br />
			IP: '.$row['ipaddress'].'</td><td>
			<div style="height:90px;width:470px;overflow-x:auto;overflow-y:scroll">
			<ul>');
			$res2 = sql_query("select * from ".tb()."streams where uid='{$row['id']}' order by id DESC limit 10");
			while ($row2 = sql_fetch_array($res2)) {
				$attachment = unserialize($row2['attachment']);
				if (count($attachment)>0) {
					if (strlen($attachment['name'])) {
						if (strlen($attachment['uri'])) {
							$row2['att'] = '<div class="att_name">'.url($attachment['uri'],h($attachment['name'])).'</div>';
						}
						else {
							$row2['att'] = '<div class="att_name">'.h($attachment['name']).'</div>';
						}
					}
				}
				c('<li><span class="sub">'.$row2['message'].' '.$row2['att']);
				c(' | '.get_date($row2['created']).'</span></li>');
			}
			c('</ul>
			</div></td></tr>');
		}
		$i++;
	}
	c('<tr class="row2">
	<td colspan="3">
	<input type="checkbox" id="checkallids" />Select All | 
	What to do? <select name="opt">
	<option value="1" selected>Verify</option>
	<option value="2">Ban</option>
	</select> 
	<input type="hidden" name="act" value="havestreams" />
	</td></tr>
	</table><br />
	<input type="submit" value=" Save Changes" style="font-size:15px" />
	</form>
	');
	if ($i>$num_per_page) {
		$page = $page+1;
		c('<div style="font-size:15px;padding:5px;">'.url('admin/memberqueue/'.$page,'More..').'</div>');
	}
	section_close();
}