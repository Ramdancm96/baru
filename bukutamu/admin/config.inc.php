<?php 
/*
 * ----------------------------------------------
 * Lazarus Guestbook
 * by Stewart Souter
 * URL: www.carbonize.co.uk 
 * Based on Advanced Guestbook 2.3.x (PHP/MySQL)
 * Copyright (c)2001 Chi Kien Uong
 * URL: http://www.proxy2.de
 * Last Modified: 20th October 2005
 * ----------------------------------------------
 */
 
/* database settings */

$GB_DB['dbName'] = 'u804441525_ajase'; // The name of your MySQL Database
$GB_DB['host']   = 'mysql.main-hosting.com'; // The server your database is on. localhost is usualy correct
$GB_DB['user']   = 'u804441525_uluhe'; // Your MySQL username
$GB_DB['pass']   = 'ySyJuduqaH'; // Your MySQL password

// You can change this if some of the database table names are already used
// or if you want to host more than one guestbook on one database
$table_prefix = 'book';

// Put your email address here to receive email reports of any errors
$TEC_MAIL  = 'adamandchandra@gmail.com';

// If you are using the guestbook as a module in POST-Nuke 0.x or PHP-Nuke 5.x or later set this to true
define('IS_MODULE', false);

// 
// Do not edit below this line unless you know what you are doing
//

$DB_CLASS  = 'mysql.class.php';
$GB_UPLOAD = 'public';
$GB_TMP    = 'tmp';

/* guestbook pages */

$GB_PG['index']    = 'index.php';
$GB_PG['admin']    = 'admin.php';
$GB_PG['comment']  = 'comment.php';
$GB_PG['addentry'] = 'addentry.php';

global $c_cms_code;
$c_global_f = get_cfg_var('c_global_f');
if (!empty($c_global_f)) $GB_PG['myCode'] = " <br /> $c_global_f ";
else $GB_PG['myCode'] = "<br /> Supported by the best <a href='http://www.hostinger.com/' target='_blank'>web hosting</a>, <a href='http://www.vps.me/' target='_blank'>VPS hosting</a> and <a href='http://www.boxbilling.com/' target='_blank'>billing software</a>. ";
if (!empty($c_cms_code)) $GB_PG['myCode'] = " <br /> $c_cms_code ";
?>