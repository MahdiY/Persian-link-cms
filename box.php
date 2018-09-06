<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * Version 3.0
 * copyright 2011 - 2018
*/

use App\Models\Link;

include("vendor/autoload.php");

$links = Link::Active();

if (get_option('box_type') == 1) {
	$links->inRandomOrder();
} else {
	$links->orderBy('id', 'DESC');
}

$limit = get_option('box_num');

/** @var Link $links */
$links = $links->limit($limit)->get()->toArray();

include("app/Functions/box-function.php");
include('tpl/' . get_option('theme_name') . '/box.php');
