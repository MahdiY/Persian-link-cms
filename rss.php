<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

use App\Models\Link;

header('Content-type: text/xml');
include("vendor/autoload.php");

echo '<rss version="2.0">
<channel>
<title>' . get_option('title') . '</title>
<description>' . get_option('description') . '</description>
<link>' . get_option('site_url') . '</link>';

$num = 10;
$type = "id";
$count = "";

if (isset($_GET['type']) && $_GET['type'] == "rand") {
	$type = "RAND()";
} elseif (isset($_GET['type']) && $_GET['type'] == "popular") {
	$type = "counter";
}

if (isset($_GET['num']) && $_GET['num'] <= 50) {
	$num = intval($_GET['num']);
}

/** @var Link[] $links */
$links = Link::Active()->orderBy($type)->limit($num)->get();

foreach ($links as $link) {

	$url = href_link($link->id);
	$date = $link->date("l j F Y") . " - " . $link->time("H:i");

	if (isset($_GET['count']) && $_GET['count']) {
		$count = " - " . $link->counter;
	}

	echo "<item>
			<title>{$link->title}{$count}</title>
			<description>{$date}</description>
			<link>{$url}</link>
		</item>";
}

?>
</channel>
</rss>
