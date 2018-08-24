<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

ob_start();
include( "../include/config.php" );

if ( ! isset( $_GET['link'] ) ) {

	$deleteuser     = $db->query( "DROP TABLE IF EXISTS _users;" );
	$deletrobot     = $db->query( "DROP TABLE IF EXISTS _robot;" );
	$deletessss     = $db->query( "DROP TABLE IF EXISTS _ssss;" );
	$renamelink     = $db->query( "RENAME TABLE _link TO link;" );
	$createtbllinks = $db->query( "CREATE TABLE IF NOT EXISTS `_link` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `title` text NOT NULL,
	  `url` text NOT NULL,
	  `time` text NOT NULL,
	  `date` varchar(200) NOT NULL,
	  `counter` int(11) NOT NULL,
	  `status` int(1) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;" );
	$renamefeed     = $db->query( "RENAME TABLE _feeds TO feeds;" );
	$createtblfeeds = $db->query( "CREATE TABLE IF NOT EXISTS `_feeds` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `title` text NOT NULL,
	  `link` text NOT NULL,
	  `status` int(11) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;" );

	$createtbloptions = $db->query( "CREATE TABLE IF NOT EXISTS `_options` (
	  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  `option_name` varchar(64) NOT NULL DEFAULT '',
	  `option_value` longtext NOT NULL,
	  PRIMARY KEY (`option_id`),
	  UNIQUE KEY `option_name` (`option_name`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=182;" );

	$url   = $_SERVER['REQUEST_URI'];
	$parts = explode( '/', $url );
	$dir   = 'http://' . $_SERVER['SERVER_NAME'];
	for ( $i = 0; $i < count( $parts ) - 2; $i ++ ) {
		$dir .= $parts[ $i ] . "/";
	}

	$insertoptions = $db->query( "INSERT INTO `_options` (`option_id`, `option_name`, `option_value`) VALUES
	(166, 'theme_name', 'metro'),
	(167, 'site_url', '$dir'),
	(169, 'title', 'لينکدوني پرشين'),
	(170, 'email', 'you@gmail.com'),
	(171, 'description', 'لينک هاي روزانه'),
	(172, 'keywords', 'persian link cms,link,لينکدوني اتوماتيک'),
	(173, 'user_name', 'admin'),
	(174, 'user_pass', '21232f297a57a5a743894a0e4a801fc3'),
	(176, 'robo_status', '1'),
	(179, 'box_num', '10'),
	(180, 'box_type', '0'),
	(181, 'page_vahed', '4');" );

	$feeds = $db->get_results( "SELECT * FROM `feeds`", ARRAY_A );
	foreach ( $feeds as $feed ) {
		$db->insert( "_feeds", $feed );
	}

	$deletefeed = $db->query( "DROP TABLE IF EXISTS feeds;" );

	header( "Location: update.php?link" );

} elseif ( isset( $_GET['link'] ) ) {
	function persian( $str ) {
		$alphabet = array(
			'U°'   => '?',
			'U±'   => '?',
			'U²'   => '?',
			'U³'   => '?',
			'U´'   => '?',
			'Uµ'   => '?',
			'U¶'   => '?',
			'U·'   => '?',
			'U¸'   => '?',
			'U¹'   => '?',
			'?¢'   => 'آ',
			'?§'   => 'ا',
			'?£'   => 'أ',
			'?¥'   => 'إ',
			'?¤'   => 'ؤ',
			'?¦'   => 'ئ',
			'??'   => 'ء',
			'?¨'   => 'ب',
			'U¾'   => 'پ',
			'??'   => 'ت',
			'?«'   => 'ث',
			'?¬'   => 'ج',
			'?†'   => 'چ',
			'?­'   => 'ح',
			'?®'   => 'خ',
			'?¯'   => 'د',
			'?°'   => 'ذ',
			'?±'   => 'ر',
			'?²'   => 'ز',
			'??'   => 'ژ',
			'?³'   => 'س',
			'?´'   => 'ش',
			'?µ'   => 'ص',
			'?¶'   => 'ض',
			'?·'   => 'ط',
			'?¸'   => 'ظ',
			'?¹'   => 'ع',
			'??'   => 'غ',
			'U?'   => 'ف',
			'U‚'   => 'ق',
			'?©'   => 'ک',
			'?¯'   => 'گ',
			'U„'   => 'ل',
			'U…'   => 'م',
			'U†'   => 'ن',
			'Uˆ'   => 'و',
			'U‡'   => 'ه',
			'UŒ'   => 'ي',
			'U?'   => 'ي',
			'U€'   => '?',
			'?©'   => 'ة',
			'U?'   => 'َ',
			'U?'   => 'ُ',
			'U?'   => 'ِ',
			'U‘'   => 'ّ',
			'U‹'   => 'ً',
			'UŒ'   => 'ٌ',
			'U?'   => 'ٍ',
			'?Œ'   => '،',
			'?›'   => '؛',
			','    => ',',
			'??'   => '؟',
			'â€Œ'  => " ",
			"â€œ"  => "«",
			"â€"   => "»",
			"U€U€" => "",
			"A"    => "",
			'Uƒ'   => 'ک',
			'U€'   => '',
			'»?'   => ' '
		);

		foreach ( $alphabet as $western => $fa ) {
			$str = str_replace( $western, $fa, $str );
		}

		return $str;
	}

	$i     = 0;
	$links = $db->get_results( "SELECT * FROM `link` ORDER BY id DESC", ARRAY_A );
	if ( $db->num_rows == 0 ) {
		$deletelink = $db->query( "DROP TABLE IF EXISTS link;" );
		header( "Location: ../index.php" );
		die();
	}
	foreach ( $links as $link ) {
		$link    = array_map( 'persian', $link );
		$d       = explode( " ", $link['date'] );
		$search  = array(
			'فروردين',
			'ارديبهشت',
			'خرداد',
			'تير',
			'مرداد',
			'شهريور',
			'مهر',
			'آبان',
			'آذر',
			'دي',
			'بهمن',
			'اسفند'
		);
		$replace = range( 1, 12 );
		if ( count( $d ) == 4 ) {
			$d[2]         = str_replace( $search, $replace, $d[2] );
			$link['date'] = implode( array_reverse( jalali_to_gregorian( $d[3], $d[2], $d[1] ) ), "-" );
		} elseif ( count( $d ) == 5 ) {
			$d[3]         = str_replace( $search, $replace, $d[3] );
			$link['date'] = implode( array_reverse( jalali_to_gregorian( $d[4], $d[3], $d[2] ) ), "-" );
		}
		$link['time'] = strtotime( "$link[date] $link[time]" );
		if ( ! empty( $link['time'] ) ) {
			$db->insert( "_link", array_map( 'persian', $link ) );
			$db->delete( "link", array( 'id' => $link['id'] ) );
			$i ++;
		}
		if ( $i == 1000 ) {
			break;
		}
	}
	echo '<meta http-equiv="refresh" content="1">';
}
?>