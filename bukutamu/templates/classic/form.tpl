<script type="text/Javascript">
<!--
var input_error_color = "$VARS[input_error_color]";
var lazFormStyle = new Array();
var flag=0;

function resetFlag(){
   flag = 0;
}

function checkForm() {
  var errorMessages = new Array();
  var errorNum = 0;
  var noComment = 0;
  for (var itm in lazFormStyle)
  {
    document.getElementById(itm).style.backgroundColor = lazFormStyle[itm];
  }
  document.getElementById('gb_name').value = trim(document.getElementById('gb_name').value);
  document.getElementById('gb_comment').value = trim(document.getElementById('gb_comment').value);
  if(document.getElementById('gb_name').value == '') {
    errorStyling('gb_name');
    errorMessages[errorNum++] = "$LANG[ErrorPost1]";
  }
  if(document.getElementById('gb_comment').value == '') {
    errorStyling('gb_comment');
    errorMessages[errorNum++] = "$LANG[ErrorPost2]";
    noComment = 1;
  }
  $EXTRAJS
  if(document.getElementById('gb_comment').value.length < $VARS[min_text] && noComment == 0) {
    errorStyling('gb_comment');
    errorMessages[errorNum++] = "$LANG[ErrorPost3]";
  }
  if(document.getElementById('gb_comment').value.length > $VARS[max_text] && noComment == 0) {
    errorStyling('gb_comment');
    errorMessages[errorNum++] = "$LANG[ErrorPost17]";
  }  
  if(errorMessages.length > 0){
    errorAlert = errorMessages.join("\\n");
    alert(errorAlert);
    return false;
  }
  flag=1;
  window.onExit = resetFlag();
  return true;
}

function reloadCaptcha()
{
  var randomnumber=Math.floor(Math.random()*1001);
  document.images['lazCaptcha'].src = '$GB_PG[base_url]/captcha.php?hash=$TIMEHASH' + '&amp;rand=' + randomnumber;
}
//-->
</script>
<script type="text/javascript" src="$GB_PG[base_url]/lazjs.php?jspage=entryform"></script>
<script type="text/javascript" src="$GB_PG[base_url]/enlargeit.php"></script>
<script type="text/javascript">
hs.graphicsDir = '$GB_PG[base_url]/img/hs/';
hs.outlineType = 'rounded-white';
</script>
<script type="text/javascript" src="$GB_PG[base_url]/dom-drag.js"></script>  
<div class="lazTop">
  <div style="padding: 3px;font-weight:bold;font-size:1.2em;">
    $LANG[BookMess3]
  </div>
  <div style="clear: left; padding: 3px 3px 1px 3px">
    <div style="text-align: right;font-weight: bold;float:right;">
      <a href="$GB_PG[index]">$LANG[BookMess4]</a>
    </div>  
    <div>
      $LANG[FormMess1]
    </div>
  </div>
  $extra_html
  <form method="post" action="$GB_PG[addentry]" name="book" id="laz_entry" enctype="multipart/form-data" onsubmit="return checkForm()">
  <table border="0" cellspacing="1" cellpadding="4" width="100%" align="center" bgcolor="$VARS[tb_bg_color]" class="font1">
    <tr>
      <td colspan="2" bgcolor="$VARS[tb_hdr_color]"><b><font size="2" face="$VARS[font_face]" color="$VARS[tb_text]">$LANG[BookMess3]:</font></b></td>
    </tr>
    <tr bgcolor="$VARS[tb_color_1]">
      <td width="25%"><img src="$GB_PG[base_url]/img/user.gif" alt="$LANG[FormName]" title="$LANG[FormName]" /> $LANG[FormName]*:</td>
      <td><input type="text" name="gb_name" id="gb_name" size="42" maxlength="50" value="$this->name" /></td>
    </tr>
  $OPTIONAL
    <tr bgcolor="$VARS[tb_color_1]">
      <td valign="top" class="font1">$LANG[FormMessage]*:
      </td>
      <td bgcolor="$VARS[tb_color_1]" valign="top" class="font1">$display_tags<textarea id="gb_comment" name="gb_comment" cols="41" rows="11" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);" onchange="storeCaret(this);">$this->comment</textarea><br />
       	$PRIVATE
      </td>
    </tr>
    $BOTTEST
    <tr bgcolor="$VARS[tb_color_1]">
      <td><div align="left" class="font2">$HTML_CODE<br />$SMILE_CODE<br />$AG_CODE</div></td>
      <td><input type="submit" name="agb_submit_$antispam" value="$LANG[FormSubmit]" class="input" onclick="if(flag==1) return false;" />
        <input type="submit" name="agb_preview_$antispam" value="$LANG[FormPreview]" class="input" onclick="if(flag==1) return false;" />
        <input type="reset" value="$LANG[FormReset]" class="input" />
      </td>
    </tr>
  </table>
   <div id="LazSmileys" style="display: none;position:absolute;width:400px;background:#FFF;border: 1px solid #000;padding:3px;">
   <div style="text-align:right;margin:0;cursor:move;padding:2px;border-bottom: 1px solid #000;" id="smileyHandle"><span style="float: left;font-family: $VARS[font_face]; font-size: 14px;font-weight:bold;">Smileys</span><a href="#" onclick="smileyBox('none');return false;" style="cursor: pointer; height: 19px; width: 19px; margin-right: 3px; background-image: url($GB_PG[base_url]/img/buttons_inact.png); background-position: -105px 0px; display: block; float: right;"></a><br style="clear:both;" /></div>
   <div id="theSmileys" style="text-align:center;">$LAZSMILEYS</div>
   </div>
   <script type="text/javascript">
    var theHandle = document.getElementById("smileyHandle");
    var theRoot = document.getElementById("LazSmileys");
    Drag.init(theHandle, theRoot);
   </script> 
  </form>
</div>
