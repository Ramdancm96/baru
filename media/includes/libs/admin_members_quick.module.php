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

if (basename($_SERVER["SCRIPT_NAME"]) != 'index.php') die(basename($_SERVER["SCRIPT_NAME"]));
global $page,$client,$num_per_page,$offset;

if ($step == 'modify') {
}

elseif($step == 'changestatus') {
	if (is_array($_POST['ids'])) {
		foreach ($_POST['ids'] as $id) {
			sql_query("update ".tb()."accounts set disabled='{$_POST['status']}' where id='$id'");
		}
	}
	if ($_POST['act'] == 'havestreams') {
		redirect('admin/members_quick/havestreams',1);
	}
	else {
		redirect('admin/members_quick',1);
	}
}
elseif ($step == 'havestreams') {
	$res = sql_query("select * from `".tb()."accounts` "." where disabled=1 order by id DESC");
	c('<table class="stories">
	<form method="post" action="'.url('admin/members_quick/changestatus').'">
	<tr class="table_line1">
	<td></td><td>Member</td><td>Details</td><td>Recent acts</td></tr>');
	$j=1;
	while ($member = sql_fetch_array($res)) {
		$j++;
		if ($j > 50) break;
		$res2 = sql_query("select s.*,u.username,u.avatar,p.uid as wall_uid from ".tb()."streams as s left join ".tb()."accounts as u on u.id=s.uid left join ".tb()."pages as p on p.id=s.wall_id where u.id='{$member['id']}' order by s.id desc limit 6");
		$acts = '';
		$j=0;
		while($row2 = sql_fetch_array($res2)) {
			$j++;
			$attachment = unserialize($row2['attachment']);
			$att = '';
			if (count($attachment) > 1) {
				if (strlen($attachment['name'])) {
					if (strlen($attachment['uri'])) {
						$att = url($attachment['uri'],h($attachment['name']));
					}
					else {
						$att = h($attachment['name']);
					}
				}
				if (strlen($attachment['title'])) {
					$att = url($attachment['uri'],h($attachment['title']) );
				}
			}
			$acts .= '<li>'.$row2['message'].' '.$att.'</li>';
		}
		if ($member['disabled'] == 1) {
			$status = '<font color="red">Pending</font>';
		}
		elseif ($member['disabled'] == 2) {
			$status = '<font color="red">Suspended</font>';
		}
		else {
			$status = '<font color="green">Actived</font>';
		}
		$gender = $member['gender'] ? 'Male':'Femail';
		if ($j>1) {
			section_content('
			<tr class="row1">
			<td><input type="checkbox" name="ids[]" value="'.$member['id'].'" /></td>
			<td valign="top" width="60">'.avatar($member).'<br />'.$member['username'].'<br />'.h($member['fullname']). '<br />'.$status.'<br />'.url('admin/useredit/'.$member['id'],'Edit').'<br />
			</td>
			<td>Gender: '.$gender.'<br />
			Location: '.h($member['location']).'<br />
			Email: '.h($member['email']).'<br />
			Birth: '.$member['birthmonth'].'/'.$member['birthday'].'/'.$member['birthyear'].'<br />
			Custom filed 1: '.h($member['var1']).'<br />
			Custom field 2: '.h($member['var2']).'<br />
			Custom field 3: '.h($member['var3']).'
			</td>
			<td><ul>'.$acts.'</ul></td>
			</tr>');
		}
	}
	section_content('
	<tr class="row2"><td colspan="4">
	Change status to: <select name="status">
	<option value="0">Select..</option>
	<option value="0">Active</option>
	<option value="2">Suspend</option>
	<option value="1">Pending</option>
	</select> <input type="submit" value="Save" />
	<input type="hidden" name="act" value="havestreams" />
	</td></tr>
	</form>
	</table>');
}

else {
		c('<form method="post" action="'.url('admin/members_quick').'">
		Username or Email address: 
		<input type="text" name="username" /> <input type="submit" value="'.t('Search').'" />
		</form><br />
		'.url('admin/members_quick/havestreams','Show pending members who have streams'));
		if ($_POST['username']) {
			$res = sql_query("select * from `".tb()."accounts` "." where username like '%{$_POST['username']}%' or email like '%{$_POST['username']}%' order by id DESC limit 12");
		}
		else {
			$res = sql_query("select count(*) as total from `".tb()."accounts` "." where 1 $filter ");
			$row = sql_fetch_array($res);
			$total = $row['total'];
			$pb       = new PageBar($total, $num_per_page, $page);
			$pb->paras = url('admin/members_quick'.$pageb);
			$pagebar  = $pb->whole_num_bar();

			$res = sql_query("select * from `".tb()."accounts` "." order by id DESC limit $offset,$num_per_page");
		}
		c('<table class="stories">
		<form method="post" action="'.url('admin/members_quick/changestatus').'">
		<tr class="table_line1">
		<td></td><td>Member</td><td>Details</td><td>Recent acts</td></tr>');
		while ($member = sql_fetch_array($res)) {
			$res2 = sql_query("select s.*,u.username,u.avatar,p.uid as wall_uid from ".tb()."streams as s left join ".tb()."accounts as u on u.id=s.uid left join ".tb()."pages as p on p.id=s.wall_id where u.id='{$member['id']}' order by s.id desc limit 5");
			$acts = '';
			while($row2 = sql_fetch_array($res2)) {
				$attachment = unserialize($row2['attachment']);
				$att = '';
				if (count($attachment) > 1) {
					if (strlen($attachment['name'])) {
						if (strlen($attachment['uri'])) {
							$att = url($attachment['uri'],h($attachment['name']));
						}
						else {
							$att = h($attachment['name']);
						}
					}
					if (strlen($attachment['title'])) {
						$att = url($attachment['uri'],h($attachment['title']) );
					}
				}
				$acts .= '<li>'.$row2['message'].' '.$att.'</li>';
			}
			if ($member['disabled'] == 1) {
				$status = '<font color="red">Pending</font>';
			}
			elseif ($member['disabled'] == 2) {
				$status = '<font color="red">Suspended</font>';
			}
			else {
				$status = '<font color="green">Actived</font>';
			}
			$gender = $member['gender'] ? 'Male':'Femail';
			section_content('
			<tr class="row1">
			<td><input type="checkbox" name="ids[]" value="'.$member['id'].'" /></td>
			<td valign="top" width="60">'.avatar($member).'<br />'.$member['username'].'<br />'.h($member['fullname']). '<br />'.$status.'<br />'.url('admin/useredit/'.$member['id'],'Edit').'<br />
			</td>
			<td>Gender: '.$gender.'<br />
			Location: '.h($member['location']).'<br />
			Email: '.h($member['email']).'<br />
			Birth: '.$member['birthmonth'].'/'.$member['birthday'].'/'.$member['birthyear'].'<br />
			Custom filed 1: '.h($member['var1']).'<br />
			Custom field 2: '.h($member['var2']).'<br />
			Custom field 3: '.h($member['var3']).'
			</td>
			<td><ul>'.$acts.'</ul></td>
			</tr>');
		}
		section_content('
		<tr class="row2"><td colspan="4">
		Change status to: <select name="status">
		<option value="0">Select..</option>
		<option value="0">Active</option>
		<option value="2">Suspend</option>
		<option value="1">Pending</option>
		</select> <input type="submit" value="Save" />
		</td></tr>
		</form>
		</table>');
		
		c($pagebar);
}