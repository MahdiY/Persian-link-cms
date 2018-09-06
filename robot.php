<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * Version 3.0
 * copyright 2011 - 2018
*/

use App\Models\Feed;
use App\Models\Link;

include('vendor/autoload.php');

set_time_limit(60);

if (get_option('robo_status') == 1):

	/** @var Feed[] $feeds */
	$feeds = Feed::Active()->orderBy('time', 'DESC')->get();

	foreach ($feeds as $feed) {
		$rss = new SimplePie();
		$rss->set_feed_url($feed->link);
		$rss->enable_cache(false);
		$rss->set_output_encoding('utf-8');
		$rss->init();

		/** @var SimplePie_Item[] $rss_item */
		$rss_item = (object)array_reverse((array)$rss->get_items());

		foreach ($rss_item as $item) {
			$title = htmlentities($item->get_title());
			$count = Link::where('title', $title)->count();

			if ($count == 0 && filter_var($item->get_permalink(), FILTER_VALIDATE_URL)) {
				Link::create([
					'title'  => $title,
					'url'    => $item->get_permalink(),
					'time'   => time(),
					'date'   => date("d-m-Y"),
					'status' => 1,
				]);
			}

		}

		$feed->update(['time' => time()]);
	}

endif;
