<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * Version 3.0
 * copyright 2011 - 2018
*/

use App\Models\Link;

include_once "vendor/autoload.php";

if (isset($_GET['id'])):

	$id = intval($_GET['id']);

	/** @var Link $link */
	$link = Link::findOrFail($id);

	$link->increment('counter');

	/** @var Link $prev */
	$prev = Link::where('id', '<', $id)->orderBy('id', 'DESC')->first();

	$prev = is_null($prev) ? $id : $prev->id;

	/** @var Link $next */
	$next = Link::where('id', '>', $id)->orderBy('id', 'ASC')->first();

	$next = is_null($next) ? $id : $next->id;

	function next_link()
	{
		global $next;

		return "link-$next.html";
	}

	function prev_link()
	{
		global $prev;

		return "link-$prev.html";
	}

	function the_link()
	{
		global $link;

		return $link->url;
	}

	function the_title()
	{
		global $link;

		return $link->title;
	}

	include('tpl/' . get_option('theme_name') . '/link.php');

endif;