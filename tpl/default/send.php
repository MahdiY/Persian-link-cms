<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ارسال لینک به لینکدونی</title>
<style>body{direction:rtl;font-family:tahoma;font-size:13px;background:#F2F2F2;}#page{background:#FAFAFA;margin:5px auto;padding:5px;width:360px !important;min-width: 0px !important;border:2px solid #D9D9D9;}input[type=submit]{font-family: tahoma;font-size: 12px;}.error{background:#C30;padding:8px;border-radius:4px;margin:10px 0 10px 0;color:#fff;}.notify{background:#FC6;padding:8px;border-radius:4px;margin:10px 0 10px 0;color:#fff;}.success{background:#0C3;padding:8px;border-radius:4px;margin:10px 0 10px 0;color:#fff;}input[type=text]{font-family: tahoma;font-size: 13px;width:50%;}</style>
</head>

<body>
<div id="page">
	<div class="date"><p><img src="<?php echo theme_dir(); ?>img/feed.gif"> ارسال لینک به لینکدونی</p></div>
	<p>جهت ارسال لینک های مفیدتان برای ما ابتدا فرم زیر را پر کنید و برای ما ارسال کنید . ما لینک شما را تایید می کنیم!</p>
	<?php echo $MSG; ?>
	 <form method="post" action="">
		<p>
		عنوان لینک: <br/>
		<input type="text" name="title" required="required" />
		</p>
		
		<p>
		آدرس لینک: <br/>
		<input type="text" dir="ltr" name="link" required="required" />
		</p>
		
		<p>
		کد امنیتی: <br/>
		<input type="text" name="security" required="required" />
		<img src="inc/image.php" />
		</p>
		
		<p><input type="submit" name="submit" value="ارسال لینک" /></p>
	</form>
</div>
</body>
</html>