<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

include("include/config.php");

$num = get_option('box_num');
$order = get_option('box_type') == 1 ? 'RAND()' : '`id` DESC';
$links = $db->get_results( sprintf("SELECT * FROM `_link` where `status` = 1 ORDER BY %s LIMIT 0, %d", $order, $num) );

include("include/box-function.php");
include('tpl/'.get_option('theme_name').'/box.php');
