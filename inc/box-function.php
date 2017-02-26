<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
$link = null;
$link_count = 0;
$link_index = 0;
$count = 0;

function have_link() {
	global $links, $link_count, $link_index , $count;
	
	if ($links && $link_index <= $link_count - $count){
		$link_count = count($links);
		$count = 1;
		return true;
	}
	else {
		$link_count = 0;
		return false;
	}
}

function the_link() {
	global $links, $link, $link_count, $link_index;

	if ($link_index >= $link_count) {
		$link_index++;
		return false;
	}
	else if(isset($links[$link_index])){
		$link = $links[$link_index];
		$link_index++;
		return $link;
	}
}

function the_id() {
global $link;
return $link['id'];
}

function the_title() {
global $link;
return $link['title'];
}

function the_url() {
global $link;
$id = $link['id'];
return get_site_url()."link-$id.html";
}

function the_count() {
global $link;
return $link['counter'];
}
?>
