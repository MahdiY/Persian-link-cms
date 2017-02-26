<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
error_reporting(0);
if ((!empty($_SERVER['SCRIPT_FILENAME']) && 'backup.php' == basename($_SERVER['SCRIPT_FILENAME'])) || !is_admin())
		die ('Please do not load this page directly. Thanks!');
		
	$persianscript = "";		
	if(isset($_POST['save'])){
	
		$path = $_SERVER['DOCUMENT_ROOT'];
		$sql_contents = $_POST['backupcode'];
		$sql_contents = explode("\n", $sql_contents);
			
		foreach($sql_contents as $query){
			   $result = mysqli_query($db->dbh , $query);
			   if (!$result)
					echo '<div class="error">خطا در ایمپورت : <br>'.mysqli_error($db->dbh).'</div><br>';
		}
		$persianscript = "<div class='success'>بکاپ با موفقیت در دیتابیس ایمپورت شد!</div><br>";

	}

echo'
	<h1>تنظیمات قالب</h1>
	
	'.$persianscript.'
	<div class="forms">
	<form method="post">
	لطفا فایل بکاپ را باز کنید و محتویات آن را در زیر کپی کنید . سپس روی ذخیره تغییرات کلیک کنید . توجه کنید این عمل قابل بازگشت نمی باشد.<br>
	<textarea name="backupcode" style="width: 100% !important; height: 300px;"></textarea>
	<br>
	<input type="submit" value="ذخیره تغییرات" name="save" class="btn" />
	<a href="dl.php">جهت دریافت بکاپ اینجا کلیک کنید</a>
	</form>
	</div>
	';

?>