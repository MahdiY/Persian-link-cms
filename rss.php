<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

header( 'Content-type: text/xml' );
include( "include/config.php" );

echo '<rss version="2.0">
<channel>
<title>' . get_option( 'title' ) . '</title>
<description>' . get_option( 'description' ) . '</description>
<link>' . get_option( 'site_url' ) . '</link>';

$num   = 10;
$type  = "`id`";
$count = "";

if ( isset( $_GET['type'] ) && $_GET['type'] == "rand" ) {
	$type = "RAND()";
} elseif ( isset( $_GET['type'] ) && $_GET['type'] == "popular" ) {
	$type = "counter";
}

if ( isset( $_GET['num'] ) && $_GET['num'] <= 50 ) {
	$num = intval( $_GET['num'] );
}

$links = $db->get_results( "SELECT * FROM `_link` WHERE `status` = 1 ORDER BY $type DESC limit $num" );

foreach ( $links as $link ) {

	$url  = href_link( $link->id );
	$date = pdate( "l j F Y", strtotime( $link->date ) ) . " - " . pdate( "H:i", $link->time );
	if ( isset( $_GET['count'] ) && $_GET['count'] ) {
		$count = " - " . $link->counter;
	}

	echo "
	<item>
		<title>$link->title$count</title>
		<description>$date</description>
		<link>$url</link>
	</item>  
	";
}
echo "

</channel>
</rss>
";
