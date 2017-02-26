<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
header('Content-type: text/xml'); 
include("inc/config.php");  
echo '<rss version="2.0">
<channel>
<title>'.get_title().'</title>
<description>'.get_description().'</description>
<link>'.get_site_url().'</link>';

$num = 10;
$type = "`id`";
$count = "";

if(isset($_GET['type']) && $_GET['type'] == "rand")
	$type = "RAND()";
elseif(isset($_GET['type']) && $_GET['type'] == "popular")
	$type = "counter";

if(isset($_GET['num']) && $_GET['num'] <= 50)
	$num = intval($_GET['num']);

$q = $db->get_results("SELECT * FROM `_link` WHERE `status`='1' order by $type desc limit $num" , ARRAY_A);
foreach($q as $r)
{
	$name=$r["title"];
	$id=$r["id"];
	$content=$r['url'];
	$date=jdate("l j F Y",strtotime($r["date"]))." - ".jdate("H:i",$r["time"]);
	if(isset($_GET['count']) && $_GET['count'] == 1)	
		$count = " - ".$r['counter'];
	echo "
	<item>
		<title>$name$count</title>
		<description>$date</description>
		<link>".get_site_url()."link-$id.html</link>
	</item>  
	";
}
echo "

</channel>
</rss>
";
?>