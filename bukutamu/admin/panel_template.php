<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Guestbook - Templates</title>
<meta http-equiv="content-type" content="text/html; charset=<?php echo $this->VARS['charset']; ?>">
<link rel="stylesheet" type="text/css" href="admin.css">
<style type="text/css">
table { background: #BBD8E7; }
</style>
<script type="text/javascript" src="lazjs.php?jspage=admin"></script> 
</head>
<body>
<h4 align="center">G U E S T B O O K &nbsp; T E M P L A T E S</h4>
<?php 
$include_path = dirname(__FILE__);
include($include_path.'/menu.php'); 
?>
<div class="contenttable">
<form action="<?php echo $this->SELF; ?>" name="FormMain" method="post">
  <table>
    <tr> 
      <td colspan="2" height="25" class="section">Templates</td>
    </tr>
    <tr> 
      <td colspan="2" class="subsection">Give write permissions to the webserver on the template files!</td>
    </tr>
    <tr> 
      <td valign="top" class="lefttd"> <b>Guestbook Templates</b><br>
          <br>
        <table cellspacing="0" cellpadding="1">
<?php 
if (!empty($template_list))
{
   reset($template_list);
foreach ($template_list as $templatename) {
    echo "         <tr> 
            <td width=\"15\" class=\"lefttd\">-</td>
            <td class=\"lefttd\"><a href=\"$this->SELF?action=template&amp;tpl_name=$templatename&amp;gbsession=$this->gbsession&amp;uid=$this->uid\">
            $templatename</a></td>
          </tr>\n";
}
}
?>
        </table>
       <br>
      </td>
      <td valign="top" align="center" class="righttd2">
        <table cellspacing="0" cellpadding="2">
          <tr>
            <td align="center" class="righttd2"><b> <?php echo $tpl_name.$can_edit; ?></b></td>
          </tr>
          <tr>
            <td class="righttd2">
              <textarea name="gb_template" id="gb_template" cols="60" rows="30" class="textfield" wrap="VIRTUAL" class="input"<?php echo $button_status; ?>><?php echo htmlspecialchars($gb_template); ?></textarea>
              <div class="textarea_resize"><img src="<?php echo $this->VARS["base_url"]; ?>/img/up.gif" alt="up" title="shrink textarea" onclick="resizeTextarea('gb_template','up');" /><br /><img src="<?php echo $this->VARS["base_url"]; ?>/img/down.gif" alt="up" title="enlarge textarea" onclick="resizeTextarea('gb_template','down');" /></div>
            </td>
          </tr>
        </table>
        <br>
      </td>
    </tr>
  </table>
  <br>
  <center>
    <input type="submit" class="submit" value="Submit Settings"<?php echo $button_status; ?>>
    <input type="reset" class="reset" value="Reset">
    <input type="hidden" name="uid" value="<?php echo $this->uid; ?>">
    <input type="hidden" name="gbsession" value="<?php echo $this->gbsession; ?>">
    <input type="hidden" name="action" value="template">
    <input type="hidden" name="tpl_name" value="<?php echo $tpl_name; ?>">
    <input type="hidden" name="save" value="update">
  </center>
</form>
</div>
