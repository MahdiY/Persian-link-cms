<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
include_once"inc/config.php"; 


$page_vahed = get_page_vahed();
if(isset($_GET['page'])){ 
	$paged = intval($_GET['page']);
	$page2 = $paged - 1;
	if($page2 !== -1){
	$from = $page2 * $page_vahed;
	}
	else
	$from = 0;
}
else 
	$from = 0;


	
	
	
$links = $db->get_results("select date from `_link` where `status`='1' group by `date` order by `id` DESC LIMIT $from , $page_vahed" , ARRAY_A);
$link = null;
$link_count = 0;
$link_index = 0;
$count = 0;
$link_count_day = 0;
$link_index_day = 0;
$count_day = 0;
$q = "";
$q2 = "";

	function have_link() {
		global $links, $link_count, $link_index , $count, $db , $q;
		
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
		global $links, $link, $link_count, $link_index , $db , $q , $link_index_day , $link_count_day  ,$count_day;

		if ($link_index >= $link_count) {
			$link_index++;
			return false;
		}
		else if(isset($links[$link_index])){
			$link = $links[$link_index];
			$date = $links[$link_index]['date'];
			$q = $db->get_results("select * from `_link` where `date`='".$date."' order by `id` DESC" , ARRAY_A); 
			$link_count_day = 0;
			$link_index_day = 0;
			$count_day = 0;
			$link_index++;
			return $link;
		}
	}


	function the_date() {
		global $links , $link_index;
		return jdate("l j F Y",strtotime($links[$link_index-1]['date']));
	}

	function link_in_day(){
		global $q, $link_count_day, $link_index_day , $count_day, $db;
		
		if ($q && $link_index_day <= $link_count_day - $count_day){
			$link_count_day = count($q);
			$count_day = 1;
			return true;
		}
		else {
			$link_count = 0;
			return false;
		}	
	}

	function the_link_day() {
		global $q, $link_count_day, $link_index_day , $count_day, $db , $q2;

		if ($link_index_day >= $link_count_day) {
			$link_index_day++;
			return false;
		}
		else if(isset($q[$link_index_day])){
			$q2 = $q[$link_index_day];
			$link_index_day++;
			return $q2;
		}
	}

	function the_url(){
		global $q2;
		$id = $q2['id'];
		return get_site_url()."link-$id.html";
	}
	
	function the_title(){
		global $q2;
		return $q2['title'];
	}
	
	function the_id(){
		global $q2;
		return $q2['id'];
	}
	
	function the_count(){
		global $q2;
		return $q2['counter'];
	}

	function page_numbers(){
		global $db , $page_vahed;
		$db->get_results("select id from `_link` where `status`='1' group by `date` order by `id` DESC");
		return ceil($db->num_rows / $page_vahed);
	}
	
	include('tpl/'.get_theme_name().'/index.php');
	
	
	
?>