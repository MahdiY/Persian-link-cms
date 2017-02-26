<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
error_reporting(0);
function creat($name,$file)
{
	$fp = fopen($name,"w") or $error=1;
	fputs($fp,$file);
	fclose($fp) or $error=1;
	if($error){$status= '0';}else{ $status= '1';}
	return ($status);
}
if(!empty($_POST['host']) && !empty($_POST['database']) && !empty($_POST['dbuser'])){
	$error = "";
	$success = "";
	$host = $_POST['host'];
	$database = $_POST['database'];
	$dbuser = $_POST['dbuser'];
	$dbpass = $_POST['dbpass'];
	
	mysql_connect($host,$dbuser,$dbpass) or $error='<div class="error"><span class="fontawesome-remove-sign"></span> مشخصات وارد شده برای نام کاربری و رمز عبور دیتابیس اشتباه است</div>'; 
	@mysql_select_db($database) or $error.='<div class="error"><span class="fontawesome-remove-sign"></span> نام دیتابیس وارد شده اشتباه است یا وجود ندارد</div>';
	
	if(!$error){
	
	$createconfig = creat('../inc/config.php','<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
	$dbhost = "'.$host.'";
	$dbuser = "'.$dbuser.'";
	$dbpassword = "'.$dbpass.'";
	$dbname = "'.$database.'";

	date_default_timezone_set("Asia/Tehran");
	ini_set("display_errors", 0);
	ini_set("log_errors" , 1);
	ini_set("error_log" , "inc/Error.log");
	
	include("MahdiYdb.php");
	include("base-function.php");
	include("jdf.php");
?>');
		if($createconfig){
		$success = '<div class="success"><span class="fontawesome-check"></span> فایل کانفیگ با موفقیت ایجاد شد!</div>';
		include ("../inc/config.php");
		$deletessss = $db->query("DROP TABLE IF EXISTS _ssss;");
		}
		else{$error = '<div class="error"><span class="fontawesome-remove-sign"></span> یک خطای نامشخص در هنگام ایجاد فایل کانفیگ رخ داده است. لطفا سطح دسترسی پوشه inc را به 777 تغییر دهید و مجددا مراحل نصب را طی کنید.</div>';};
	}
	
	
	
}
else {header ("Location: index.php");}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PersianLinkCMS - نصب اسکریپت : مرحله دوم</title>
<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/icons.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>
<div class="middle">

    <div id="head">
    <h1 class="fr"><span class="fontawesome-magic"></span> نصب کننده سیستم لینکدونی پرشین</h1>
    <p class="fl">مرحله 2 از 3</p>
    <div class="clear"></div>
    </div>
    
    <div id="main">
    <h6>به نصب کننده سیستم لینکدونی پرشین خوش آمدید</h6>
    
    
    <?php if(!empty($error)){
	echo $error;
	}
	if(!empty($success)){
	echo $success;
	echo '<div class="notify"><span class="fontawesome-check"></span> در صورتی که شما میخواهید اسکریپت را بروزرسانی کنید از فایل های اسکریپت و دیتابیس بکاپ تهیه کنید.</div><form method="post" action="step-3.php">
    <p><input type="submit" name="submit" value="مرحله بعد - ایجاد جداول" /> یا <input type="button" onclick="location.href=\'update.php\'" value="بروزرسانی اسکریپت" /></p>
    </form>';
	}?> 
    
    </div>
    
    <div id="footer">
    <div id="logo" class="fr"></div>
    <p class="fr">تمامی حقوق متعلق به <a href="http://www.persianscript.ir/" target="_blank">پرشین اسکریپت</a> می باشد</p>
    <p class="fl">نسخه 2.1</p>
    
    </div>

</div>
</body>
</html>
