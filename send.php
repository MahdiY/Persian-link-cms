<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

include( "include/config.php" );
$MSG = "";
session_start();

if ( isset( $_POST['submit'] ) ) {

	if ( $_POST['security'] == $_SESSION['security_number'] && ! empty( $_POST['security'] ) && strlen( $_POST['security'] ) == 5 ) {
		$url = $_POST['link'];

		if ( filter_var( $url, FILTER_VALIDATE_URL ) ) {
			$addlink = $db->insert( '_link', [
				'id'     => '',
				'title'  => htmlentities( $_POST['title'] ),
				'url'    => $url,
				'time'   => time(),
				'date'   => date( "d-m-Y" ),
				'status' => 0
			] );

			$MSG     = $addlink ? '<div class="success">لینک ارسال شد . منتظر تایید مدیریت باشید</div>' : '<div class="error">مشکلی در ثبت لینک بوجود آمده است</div>';

		} else {
			$MSG = '<div class="error">لطفا یک آدرس معتبر وارد کنید</div>';
		}

	} else {
		$MSG = '<div class="error">کد امنیتی اشتباه است</div>';
	}

	$_SESSION['security_number'] = md5( rand() );
}

include( 'tpl/' . get_option( 'theme_name' ) . '/send.php' );
