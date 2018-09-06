<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

use App\Models\Link;

/** @var Link $link */
$link = NULL;

function have_link()
{
	global $links;

	return current($links);
}

function the_link()
{
	global $links, $link;

	/** @var Link $link */
	$link = (object)current($links);
	next($links);

	return $link;
}

function the_id()
{
	global $link;

	return $link->id;
}

function the_title()
{
	global $link;

	return $link->title;
}

function the_url()
{
	global $link;

	return href_link($link->id);
}

function the_count()
{
	global $link;

	return $link->counter;
}
