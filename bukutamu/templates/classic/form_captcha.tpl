<tr bgcolor="$VARS[tb_color_1]">
    <td valign="top"><img src="$GB_PG[base_url]/img/user.gif" width="16" height="15" alt="$LANG[FormBot]" title="$LANG[FormBot]"> $LANG[FormBot]*:</td>
    <td><img src="$GB_PG[base_url]/captcha.php?hash=$TIMEHASH" align="top" style="float:left;margin-right:3px;" name="lazCaptcha" alt="CAPTCHA">$LANG[FormCAPTCHA] &nbsp; <input type="text" size="10" maxlength="7" name="gb_bottest" id="gb_bottest" class="input" value="$this->bottest"><br />
    <a href="#" onclick="reloadCaptcha(); return false;">$LANG[FormCAPref]</a></td>
</tr>
