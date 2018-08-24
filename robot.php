<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

include( 'include/config.php' );
include_once( 'include/SimplePie/autoloader.php' );
set_time_limit( 60 );

if ( get_option( 'robo_status' ) == 1 ):

	$sql = $db->get_results( "SELECT * FROM `_feeds` WHERE `status` = 1 ORDER BY time DESC" );

	foreach ( $sql as $row ) {
		$feed = new SimplePie();
		$feed->set_feed_url( $row->link );
		$feed->enable_cache( false );
		$feed->set_output_encoding( 'utf-8' );
		$feed->init();
		$feed_item = (object) array_reverse( (array) $feed->get_items() );

		foreach ( $feed_item as $item ) {
			$title = htmlentities( $item->get_title() );
			$Count = $db->get_var( "SELECT COUNT(*) FROM `_link` WHERE `title` = '$title';" );

			if ( $Count == 0 && filter_var( $item->get_permalink(), FILTER_VALIDATE_URL ) ) {
				$addlink = $db->insert( '_link', [
					'title'  => $title,
					'url'    => $item->get_permalink(),
					'time'   => time(),
					'date'   => date( "d-m-Y" ),
					'status' => 1
				] );
			}

		}

		$db->update( '_feeds', [ 'time' => time() ], [ 'id' => $row->id ] );
	}

endif;
