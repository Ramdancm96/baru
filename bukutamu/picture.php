<?php 
/*
 * ----------------------------------------------
 * Lazarus Guestbook
 * by Stewart Souter
 * URL: www.carbonize.co.uk 
 * Based on Advanced Guestbook 2.3.x (PHP/MySQL)
 * Copyright (c)2001 Chi Kien Uong
 * URL: http://www.proxy2.de
 * Last Modified: Mon, 15 September 2008 14:15:37 GMT
 * ----------------------------------------------
 */
 
//$include_path = dirname(__FILE__);
/*define('LAZ_INCLUDE_PATH', dirname(__FILE__));
require_once LAZ_INCLUDE_PATH.'/admin/version.php';
require_once LAZ_INCLUDE_PATH.'/admin/config.inc.php';
require_once LAZ_INCLUDE_PATH.'/lib/mysql.class.php';
require_once LAZ_INCLUDE_PATH.'/lib/vars.class.php';
require_once LAZ_INCLUDE_PATH.'/lib/template.class.php';

define('LAZ_TABLE_PREFIX', $table_prefix);

$db = new guestbook_vars(LAZ_INCLUDE_PATH);
$db->getVars();
*/
$border = 24;

$base_url = $db->VARS['base_url'];

/*if (IS_MODULE) { 
  $ModName = basename(LAZ_INCLUDE_PATH);
  $base_url = '/modules/'.$ModName.'/';
}*/

if (!empty($_GET['img']) && !is_array($_GET['img'])) 
{
  $illegalChars = array('?' => '',"\\" => '',':'  => '','*' => '','"' => '','<' => '','>' => '','|' => '','../' => '','./' => '',"\n" => '',"\r" => '',"\t" => '');
  $TheImg = trim(strtr($_GET['img'], $illegalChars));
  if (file_exists('public/'.$TheImg)) 
  {
    $size = @GetImageSize('public/'.$TheImg);
    $picture = 'public/'.$TheImg;
  }
  elseif (file_exists('tmp/'.$TheImg)) 
  {
    $size = @GetImageSize('tmp/'.$TheImg);
    $picture = 'tmp/'.$TheImg;
  }
  else
  {
    $size = '';
    $picture = '';
  }
}
if (isset($size[1]) && $size[1]>100) 
{
	$tbl_height = $size[1] + $border;
	$tbl_width = "100%";
} 
else 
{
	$tbl_height = 100;
	$tbl_width = 100 + $border;
}
?>
<html>
<head>
<title>Guestbook</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
body { margin: 0; background: #CCC; }
</style>
</head>
<body>
<table width="<?php echo $tbl_width; ?>" border="0" cellspacing="0" cellpadding="0" height="<?php echo $tbl_height; ?>">
  <tr>
    <td align="center" valign="middle">
    <?php
        if (!empty($picture) && is_array($size)) {
            echo '<a href="javascript:window.close()"><img src="'.$picture.'" '.$size[3].' border="0"></a>';
        }
    ?>
    </td>
  </tr>
</table>
</body>
</html>