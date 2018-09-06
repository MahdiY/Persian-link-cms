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

$offset = get_option('page_vahed');

$days = Link::Active()->groupBy('date')->orderBy('id', 'DESC')->paginate($offset)->pluck('date')->toArray();

$day = NULL;

/** @var Link[] $links */
$links = [];

/** @var Link $link */
$link = NULL;

function have_link()
{
	global $days;

	return current($days);
}

function the_link()
{
	global $days, $day, $links;

	$day = current($days);
	next($days);

	$links = Link::Active()->where('date', $day)->orderBy('id', 'DESC')->get()->toArray();

	return $day;
}

function the_date()
{
	global $day;

	return pdate("l j F Y", strtotime($day));
}

function link_in_day()
{
	global $links;

	return current($links);
}

function the_link_day()
{
	global $links, $link;

	/** @var Link $link */
	$link = (object)current($links);
	next($links);

	return $link;
}

function the_url()
{
	global $link;

	return href_link($link->id);
}

function the_title()
{
	global $link;

	return $link->title;
}

function the_id()
{
	global $link;

	return $link->id;
}

function the_count()
{
	global $link;

	return $link->counter;
}

function page_numbers()
{
	global $offset;
	$num_rows = Link::Active()->groupBy('date')->orderBy('id', 'DESC')->count();

	return ceil($num_rows / $offset);
}

include('tpl/' . get_option('theme_name') . '/index.php');
	