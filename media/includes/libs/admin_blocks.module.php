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

$theme_tpl = get_gvar('theme_tpl');
if (file_exists('themes/'.$theme_tpl.'/settings.php')) {
	include('themes/'.$theme_tpl.'/settings.php');
}
if (is_array($theme_blocks)) {
	if ($step == 'post') {
		foreach ($theme_blocks as $key=>$block) {
			$key = 'theme_block_'.$key;
			set_gvar($key,$_POST[$key]);
		}
		redirect('admin/blocks',1);
	}

	section_content('<h2>Blocks in your current template ('.$theme_tpl.')</h2>
	<form method="post" action="'.url('admin/blocks/post').'">');
	foreach ($theme_blocks as $key=>$block) {
		$key = 'theme_block_'.$key;
		section_content('<fieldset><legend>'.$block['name'].'</legend>
		<p>'.$block['description'].'<br /><textarea name="'.$key.'" rows="5">'.h(get_gvar($key)).'</textarea>
		</p></fieldset>');
	}
	section_content('<p><input type="submit" value="Save Changes" /></p>
	</form>');

}

else {
	section_content('No block was defined in your current template');
}