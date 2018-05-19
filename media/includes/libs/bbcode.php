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
function decode_bb($msg){
        $search_array = array(
            "/\[code](.*)\[\/code]/isU",
            "/\[quote](.*)\[\/quote]/isU",
			"/\[quote=([0-9a-z_]+)](.*)\[\/quote]/isU",
            "/\[img]([^'\"\?\&\+]*(\.gif|jpg|jpeg|png|bmp))\[\/img]/iU",
            "/\[img=([^'\"\?\&\+]*(\.gif|jpg|jpeg|png|bmp))]([^'\"]*)\[\/img]/iU",
            "/\[url]www.([^'\"]*)\[\/url]/iU",
            "/\[url]([^'\"]*)\[\/url]/iU",
            "/\[url=www.([^'\"\s]*)](.*)\[\/url]/iU",
            "/\[url=([^'\"\s]*)](.*)\[\/url]/iU",
            "/\[b](.*)\[\/b]/isU",
            "/\[i](.*)\[\/i]/isU",
            "/\[u](.*)\[\/u]/isU",
        );

        $replace_array = array(
            "<fieldset class=\"codeStyle\"><legend>Code</legend>\\1</fieldset>",
            "<fieldset class=\"quoteStyle\"><legend>Quote</legend>\\1</fieldset>",
			"<fieldset class=\"quoteStyle\"><legend><strong>\\1</strong> Wrote</legend>\\2</fieldset>",
            " <img src=\"\\1\" alt=\"User's Image\" onload=\"if(this.width>580) {this.resized=true; this.width=580; this.alt='Click here to open new window';}\" onmouseover=\"this.style.cursor='hand';\" onclick=\"window.open('\\1');\" /> ",
            " <img src=\"\\1\" alt=\"\\3\" onload=\"if(this.width>580) this.width=580;\" onmouseover=\"this.style.cursor='hand';\" onclick=\"window.open('\\1');\" /> ",
            "<a href=\"http://www.\\1\" target=\"_blank\" rel=\"nofollow\">www.\\1</a>",
            "<a href=\"\\1\" target=\"_blank\" rel=\"nofollow\">\\1</a>",
            "<a href=\"http://www.\\1\" target=\"_blank\" rel=\"nofollow\">\\2</a>",
            "<a href=\"\\1\" target=\"_blank\" rel=\"nofollow\">\\2</a>",
            "<b>\\1</b>",
            "<i>\\1</i>",
            "<u>\\1</u>"
        );
        $msg = preg_replace($search_array, $replace_array, $msg);
		return $msg;
}