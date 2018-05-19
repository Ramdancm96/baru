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
class apps{
	function apps() {
		do_auth(2);

	}

	function index() {
		global $content, $client,$all_apps,$my_apps,$new_apps;
		set_title('apps');

		section_content('
					<form method="post" name="form1" action="'.url('apps/post').'"  enctype="multipart/form-data">
					
					
					<p>
					'.label('*'.t('My homepage')).'
					<select name="my_jcow_homeapp">');
					if (!$client['settings']['my_jcow_homeapp']) {
						$my_jcow_homeapp = 'feed';
					}
					else {
						$my_jcow_homeapp = $client['settings']['my_jcow_homeapp'];
					}
					foreach ($all_apps as $key=>$app) {
						if ($key == $my_jcow_homeapp) {
							$app['selected'] = 'selected';
						}
						c('<option value="'.$key.'" '.$app['selected'].'>'.$app['name'].'</option>');
					}

					c('
					</select>
					<span class="sub">'.t('Go to this app when you click LOGO or "home"').'</span>
					</p>
<input class="button" type="submit" value="'.t('Save').'" />
</form>
					');
		section_close(t('My homepage'));
		c('<meta charset="utf-8">
	<style>
	#jcow_sortable1, #jcow_sortable2 { list-style-type: none; margin: 0; padding: 0; float: left; margin-right: 10px; }
	#jcow_sortable1 li, #jcow_sortable2 li { background:white;margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 120px; }
	#jcow_sortable1 {padding:0 0 100px 20px;width:150px;background:#eeeeee}
	#jcow_sortable2 {padding:0 0 100px 20px;width:150px;background:#FFFFCC}
	</style>
	<script>
	$(function() {
		$( ".jcow_sortableapps" ).sortable(
		{connectWith: ".jcow_sortableapps"}, { update: function(event, ui) {
						if ($(this).attr("id") == "jcow_sortable1") {
							var out = $("#jcow_sortable1").sortable("serialize");
							$.ajax({
							   type: "POST",
							   url: "'.url('apps/update_apps').'",
							   data: out
							 });
						}
					}
				}
		).disableSelection();
	});
	</script>
<div style="padding:5px;margin:3px;border:#eeeeee 1px solid;background:white;color:#666666;font-weight:bold;">
<img src="'.uhome().'/modules/apps/help.png" /> '.t('You can drag/drop the items').'</div>
<div class="my_app_box">

<ul id="jcow_sortable1" class="jcow_sortableapps">'.t('Displayed'));
if (is_array($my_apps)) {
			foreach ($my_apps as $item) {
				if ($item['path'] != 'account') {
					$icon = uhome().'/modules/'.$item['app'].'/icon.png';
					if ($item['icon']) $icon = $item['icon'];
					c( '<li class="ui-state-highlight" id="'.$item['path'].'_1">'.url($item['path'],
					'<div style="padding:3px 0 3px 23px;background:url('.$icon.') 0 1px no-repeat">'.t($item['name']).'</div>'
					).'</li>');
				}
			}
		}
if (is_array($new_apps)) {
			foreach ($new_apps as $item) {
				if ($item['path'] != 'account') {
					$icon = uhome().'/modules/'.$item['app'].'/icon.png';
					if ($item['icon']) $icon = $item['icon'];
					c( '<li  class="ui-state-highlight" id="'.$item['path'].'_1">'.url($item['path'],
					'<div style="padding:3px 0 3px 23px;background:url('.$icon.') 0 1px no-repeat">'.t($item['name']).'</div>'
					).'</li>');
				}
			}
		}
c('
</ul>
<ul id="jcow_sortable2" class="jcow_sortableapps">
'.t('Hidden'));

foreach ($all_apps as $app_key=>$item) {
	if (!is_array($my_apps[$app_key]) && !is_array($new_apps[$app_key]) && $item['path'] != 'account') {
		$icon = uhome().'/modules/'.$item['app'].'/icon.png';
		if ($item['icon']) $icon = $item['icon'];
		c( '<li  class="ui-state-highlight" id="'.$item['path'].'_1">'.url($item['path'],
		'<div style="padding:3px 0 3px 23px;background:url('.$icon.') 0 1px no-repeat">'.t($item['name']).'</div>'
		).'</li>');
	}
}

c('
</ul>

</div>

');
		section_close(t('My apps'));
	}

	function post() {
		$my_settings = array('my_jcow_homeapp'=>$_POST['my_jcow_homeapp']);
		save_u_settings($my_settings);
		redirect(url('apps'),1);
	}

	function update_apps() {
		global $all_apps;
		echo time().'| ';
		print_r($_POST);
		echo '<br />';
		$my_apps = $hide_apps = array();
		foreach ($_POST as $key=>$value) {
			if (is_array($all_apps[$key])) {
				$my_apps[] = $key;
			}
		}
		foreach ($all_apps as $app_key=>$app) {
			if (!in_array($app_key,$my_apps)) {
				$hide_apps[] = $app_key;
			}
		}
		$arr = array('my_jcow_apps'=>$my_apps,'hidden_jcow_apps'=>$hide_apps);
		save_u_settings($arr);
		exit;
	}
}