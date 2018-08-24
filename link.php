<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

include_once "include/config.php";

if ( isset( $_GET['id'] ) ):

	$id   = intval( $_GET['id'] );
	$link = $db->get_row( sprintf( "SELECT * FROM `_link` where `id` = '%d'", $id ) );
	$db->update( '_link', [ 'counter' => $link->counter + 1 ], [ 'id' => $id ] );

	$prev = $db->get_var( sprintf( "SELECT * FROM `_link` where `id` < '%d' ORDER BY id DESC", $id ) );

	$prev = is_null( $prev ) ? $id : $prev;

	$next = $db->get_var( sprintf( "SELECT * FROM `_link` where `id` > '%d' ORDER BY id ASC", $id ) );

	$next = is_null( $next ) ? $id : $next;

	function next_link() {
		global $next;

		return "link-$next.html";
	}

	function prev_link() {
		global $prev;

		return "link-$prev.html";
	}

	function the_link() {
		global $link;

		return $link->url;
	}

	function the_title() {
		global $link;

		return $link->title;
	}

	include( 'tpl/' . get_option( 'theme_name' ) . '/link.php' );

endif;