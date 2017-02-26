<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
include('inc/config.php');
include_once('inc/SimplePie/autoloader.php');
set_time_limit(60);
if(get_robo_status() == 1):
	$sql = $db->get_results("SELECT * FROM `_feeds` WHERE `status` = 1 ORDER BY time DESC" , ARRAY_A);
	foreach($sql as $row){
		$url = $row['link'];
		$feed = new SimplePie();
		$feed->set_feed_url($url);
		$feed->enable_cache(false);
		$feed->set_output_encoding('utf-8');
		$feed->init();
		$feed_item = (object)array_reverse( (array)$feed->get_items());
		foreach($feed_item as $item)
		{
			$title = $item->get_title();
			$Count = $db->get_results( "select id from `_link` where `title` = '$title'" );
			if( $db->num_rows == 0 )
			{
				$addlink = $db->insert('_link' , array('id'=>'' ,'title'=>$title ,'url'=>$item->get_permalink() ,'time'=>time() ,'date'=>date("d-m-Y") ,'status'=>1));
			}

		}
		$db->update('_feeds' , array('time'=>time()) , array('id'=>$row['id']));
	}	
endif;
?>
