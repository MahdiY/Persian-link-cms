<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/
	$dbhost = "";
	$dbuser = "";
	$dbpass = "";
	$dbname = "";
	
	define("SALT", "");
	
	date_default_timezone_set("Asia/Tehran");
	ini_set("display_errors", 0);
	ini_set("log_errors" , 1);
	ini_set("error_log" , "include/Error.log");
	
	include("MahdiYdb.php");
	$db = new MahdiYdb($dbuser, $dbpass, $dbname, $dbhost);

	include("base-function.php");
	include("pdate.php");
	include("iNonce.php");
