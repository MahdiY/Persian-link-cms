<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpassword = "";
	$dbname = "linkbox";
	
	date_default_timezone_set("Asia/Tehran");
	ini_set("display_errors", 0);
	ini_set("log_errors" , 1);
	ini_set("error_log" , "inc/Error.log");
	
	include("MahdiYdb.php");
	include("base-function.php");
	include("jdf.php");
?>