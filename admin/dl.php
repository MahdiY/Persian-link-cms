<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
session_start();
include('../inc/config.php');
if(is_admin()){
	$file = tr_num('PersianCmsLink-backup-' . jdate("Y-m-d" , time()) . '.sql');
	header("Content-Type: application/octet-stream");
	header("Content-disposition: attachment; filename=$file");
	backup_tables();
}
?>