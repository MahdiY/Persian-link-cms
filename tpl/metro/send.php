<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ارسال لینک به لینکدونی</title>
    <link rel="stylesheet" href="<?php echo theme_dir(); ?>style.css" type="text/css"/>
    <style>
        body {
            direction: rtl
        }

        #page {
            padding: 5px;
            margin: 5px auto;
            width: 360px !important;
            min-width: 0px !important;
        }

        input[type=submit] {
            font-family: tahoma;
            font-size: 12px;
        }

        input[type=text] {
            font-family: tahoma;
            font-size: 13px;
            width: 50%;
        }</style>
</head>

<body>
<div id="page">
    <div class="date"><img src="<?php echo theme_dir(); ?>/img/rss.png">
        <p>ارسال لینک به لینکدونی</p></div>
    <p>جهت ارسال لینک های مفیدتان برای ما ابتدا فرم زیر را پر کنید و برای ما ارسال کنید . ما لینک شما را تایید می
        کنیم!</p>
	<?php echo $MSG; ?>
    <form method="post" action="">
        <p>
            عنوان لینک: <br/>
            <input type="text" name="title" required="required"/>
        </p>

        <p>
            آدرس لینک: <br/>
            <input type="text" dir="ltr" name="link" required="required"/>
        </p>

        <p>
            کد امنیتی: <br/>
            <input type="text" name="security" required="required" autocomplete="off"/>
            <img src="captcha.php"/>
        </p>

        <p><input type="submit" name="submit" value="ارسال لینک"/></p>
    </form>
</div>
</body>
</html>