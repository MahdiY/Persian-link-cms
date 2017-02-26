<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
include("inc/config.php");
$num = get_box_num();
$order = get_box_type() == 1 ? 'RAND()' : '`id` DESC';
$links = $db->get_results("SELECT * FROM `_link` where `status`='1' ORDER BY $order LIMIT 0 , $num " , ARRAY_A);
include("inc/box-function.php");
include('tpl/'.get_theme_name().'/box.php');
?>