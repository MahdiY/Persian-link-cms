<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
	include_once"inc/config.php";
	if(isset($_GET['id'])):
	$id=intval($_GET['id']);
	$query= $db->get_results("select * from `_link` where `id`='$id' LIMIT 1" , ARRAY_A);
 
	$db->update('_link' , array('counter'=> $query[0]['counter']+1) , array('id'=>$id));

  	$dir = $query[0]['url'];
	$title = $query[0]['title'];
	$id = $query[0]['id'];
	$last = current(current($db->get_results("SELECT id FROM `_link` order by id DESC" , ARRAY_N)));
	$first = current(current($db->get_results("SELECT id FROM `_link` ORDER BY id ASC" , ARRAY_N)));
	
	if($id !== $first){
		$okprev = false;
		$prev = $id - 1;
		while($okprev == false){
		   $sql = current(current($db->get_results("select COUNT(*) from `_link` where `id` = $prev" , ARRAY_N)));
		   if($sql == 0){
			  $prev = $prev-1;
		   }else{
			  break;
		   }
		}
	}
	else
		$prev = $id;
	
	if($id !== $last){
		$oknext = false;
		$next = $id + 1;
		while($oknext == false){
		   $sql = current(current($db->get_results("select COUNT(*) from `_link` where `id` = $next")));
		   if($sql == 0){
			  $next = $next+1;
		   }else{
			  break;
		   }
		}
	}
	else
		$next = $id;

	function next_link(){
		global $next;
		return "link-$next.html";
	}
	
	function prev_link(){
		global $prev;
		return "link-$prev.html";
	}
	
	function the_link(){
		global $dir;
		return $dir;
	}
	
	function the_title(){
		global $title;
		return $title;
	}
	
	
	
include('tpl/'.get_theme_name().'/link.php');
	
	endif;

?>