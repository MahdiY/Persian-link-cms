<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

include_once "include/config.php";

$offset = get_option( 'page_vahed' );
$from   = 0;

if ( isset( $_GET['page'] ) ) {
	$paged = intval( $_GET['page'] ) - 1;

	if ( $paged !== - 1 ) {
		$from = $paged * $offset;
	}
}

$sql   = sprintf( "SELECT date FROM `_link` WHERE `status` = 1 group by `date` order by `id` DESC LIMIT %d, %d", $from, $offset );
$links = $db->get_results( $sql );

$link           = null;
$link_count     = 0;
$link_index     = 0;
$count          = 0;
$link_count_day = 0;
$link_index_day = 0;
$count_day      = 0;
$q              = "";
$q2             = "";

function have_link() {
	global $links, $link_count, $link_index, $count, $db, $q;

	if ( $links && $link_index <= ( $link_count - $count ) ) {
		$link_count = count( $links );
		$count      = 1;

		return true;
	} else {
		$link_count = 0;

		return false;
	}

}

function the_link() {
	global $links, $link, $link_count, $link_index, $db, $q, $link_index_day, $link_count_day, $count_day;

	if ( $link_index >= $link_count ) {
		$link_index ++;

		return false;
	} else if ( isset( $links[ $link_index ] ) ) {
		$link           = $links[ $link_index ];
		$date           = $links[ $link_index ]->date;
		$q              = $db->get_results( sprintf( "SELECT * FROM `_link` WHERE `status` = 1 AND `date` = %s order by `id` DESC", db_safe( $date ) ) );
		$link_count_day = 0;
		$link_index_day = 0;
		$count_day      = 0;
		$link_index ++;

		return $link;
	}
}

function the_date() {
	global $links, $link_index;

	return pdate( "l j F Y", strtotime( $links[ $link_index - 1 ]->date ) );
}

function link_in_day() {
	global $q, $link_count_day, $link_index_day, $count_day, $db;

	if ( $q && $link_index_day <= ( $link_count_day - $count_day ) ) {
		$link_count_day = count( $q );
		$count_day      = 1;

		return true;
	} else {
		$link_count = 0;

		return false;
	}
}

function the_link_day() {
	global $q, $link_count_day, $link_index_day, $count_day, $db, $q2;

	if ( $link_index_day >= $link_count_day ) {
		$link_index_day ++;

		return false;
	} else if ( isset( $q[ $link_index_day ] ) ) {
		$q2 = $q[ $link_index_day ];
		$link_index_day ++;

		return $q2;
	}
}

function the_url() {
	global $q2;

	return href_link( $q2->id );
}

function the_title() {
	global $q2;

	return $q2->title;
}

function the_id() {
	global $q2;

	return $q2->id;
}

function the_count() {
	global $q2;

	return $q2->counter;
}

function page_numbers() {
	global $db, $offset;
	$db->get_results( "SELECT id from `_link` where `status`='1' group by `date` order by `id` DESC" );

	return ceil( $db->num_rows / $offset );
}

include( 'tpl/' . get_option( 'theme_name' ) . '/index.php' );
	