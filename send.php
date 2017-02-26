<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
include("inc/config.php");
$MSG = "";
session_start();
if(isset($_POST['submit'])){

	if($_POST['security'] == $_SESSION['security_number']){
		$url = $_POST['link'];
		if(filter_var($url, FILTER_VALIDATE_URL)){
			$addlink = $db->insert('_link' , array('id'=>'' ,'title'=>$_POST['title'] ,'url'=>$url ,'time'=>time() ,'date'=>date("d-m-Y") ,'status'=>0));
			if ( $addlink ){
				$MSG = '<div class="success">لینک ارسال شد . منتظر تایید مدیریت باشید</div>';
			}
			else
			{
				$MSG = '<div class="error">مشکلی در ثبت لینک بوجود آمده است</div>';
			}
		}
		else
			$MSG = '<div class="error">لطفا یک آدرس معتبر وارد کنید</div>';
	}
		else
			$MSG = '<div class="error">کد امنیتی اشتباه است</div>';
}
include('tpl/'.get_theme_name().'/send.php');
?>
