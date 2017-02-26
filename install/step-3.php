<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
include ("../inc/config.php");
$error = "";
$success = "";
	if(isset($_POST['submit'])){
	$createtblfeeds = $db->query("CREATE TABLE IF NOT EXISTS `_feeds` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `title` text NOT NULL,
	  `link` text NOT NULL,
	  `status` int(11) NOT NULL,
	  `time` int(32) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
	
		if($createtblfeeds){
		$success = '<div class="success"><span class="fontawesome-check"></span> جدول سایت ها با موفقیت ایجاد شد</div>';
		}
		else{$error = '<div class="error"><span class="fontawesome-remove-sign"></span> یک خطا در هنگام ایجاد جدول سایت ها رخ داده است</div>';}
		
	$createtbllinks = $db->query("CREATE TABLE IF NOT EXISTS `_link` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`title` text NOT NULL,
	`url` text NOT NULL,
	`time` text NOT NULL,
	`date` varchar(200) NOT NULL,
	`counter` int(11) NOT NULL,
	`status` int(1) NOT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");
	
		if($createtbllinks){
		$success .= '<div class="success"><span class="fontawesome-check"></span> جدول لینک ها ها با موفقیت ایجاد شد</div>';
		}
		else{$error .= '<div class="error"><span class="fontawesome-remove-sign"></span> یک خطا در هنگام ایجاد جدول لینک ها رخ داده است</div>';}
		
	$createtbloptions = $db->query("CREATE TABLE IF NOT EXISTS `_options` (
	`option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	`option_name` varchar(64) NOT NULL DEFAULT '',
	`option_value` longtext NOT NULL,
	PRIMARY KEY (`option_id`),
	UNIQUE KEY `option_name` (`option_name`)
	) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=182 ;");
	
		if($createtbloptions){
		$success .= '<div class="success"><span class="fontawesome-check"></span> جدول تنظیمات با موفقیت ایجاد شد</div>';
		}
		else{$error .= '<div class="error"><span class="fontawesome-remove-sign"></span> یک خطا در هنگام ایجاد جدول تنظیمات رخ داده است</div>';}
	
	$url = $_SERVER['REQUEST_URI'];
	$parts = explode('/',$url);
	$dir = 'http://'.$_SERVER['SERVER_NAME'];
	for ($i = 0; $i < count($parts) - 2; $i++) {
		$dir .= $parts[$i] . "/";
	}

	$insertoptions = $db->query("INSERT INTO `_options` (`option_id`, `option_name`, `option_value`) VALUES
	(166, 'theme_name', 'metro'),
	(167, 'site_url', '$dir'),
	(169, 'title', 'لینکدونی پرشین'),
	(170, 'email', 'you@gmail.com'),
	(171, 'description', 'لینک های روزانه'),
	(172, 'keywords', 'persian link cms,link,لینکدونی اتوماتیک'),
	(173, 'user_name', 'admin'),
	(174, 'user_pass', '21232f297a57a5a743894a0e4a801fc3'),
	(176, 'robo_status', '1'),
	(179, 'box_num', '10'),
	(180, 'box_type', '0'),
	(181, 'page_vahed', '4');");
	
		if($insertoptions){
		$success .= '<div class="success"><span class="fontawesome-check"></span> اطلاعات پیشفرض تنظیمات با موفقیت درون ریزی شد</div>';
		}
		else{$error .= '<div class="error"><span class="fontawesome-remove-sign"></span> یک خطا در هنگام درون ریزی اطلاعات پیشفرض تنظیمات رخ داده است</div>';}
	
	}
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PersianLinkCMS - نصب اسکریپت : مرحله سوم</title>
<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/icons.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>
<div class="middle">

    <div id="head">
    <h1 class="fr"><span class="fontawesome-magic"></span> نصب کننده سیستم لینکدونی پرشین</h1>
    <p class="fl">مرحله 3 از 3</p>
    <div class="clear"></div>
    </div>
    
    <div id="main">
    <h6>به نصب کننده سیستم لینکدونی پرشین خوش آمدید</h6>
    
    <?php if(!empty($error)){
	echo $error;
	}
	elseif(!empty($success)){
	echo $success;
	echo '<p>نصب سیستم با موفقیت به پایان رسید</p>
    <p>نام کاربری و رمز عبور پیشفرض جهت ورود به بخش مدیریت admin می باشد. لطفا پس از ورود به محیط مدیریت ، رمز خود را تغییر دهید</p>
    <div class="notify"><span class="fontawesome-exclamation-sign"></span> لطفا پوشه install و محتویات آن را از هاست خود حذف کنید. وجود این پوشه یک ریسک امنیتی محسوب می گردد.</div>
    
    <h4 align="center"><a href="../admin" target="_blank">ورود به مدیریت سیستم</a> یا <a href="../" target="_blank">مشاهده سایت</a></h4>';
	}
	?>
    
    
    
    </div>
    
    <div id="footer">
    <div id="logo" class="fr"></div>
    <p class="fr">تمامی حقوق متعلق به <a href="http://www.persianscript.ir/" target="_blank">پرشین اسکریپت</a> می باشد</p>
    <p class="fl">نسخه 2.1</p>
    
    </div>

</div>
</body>
</html>