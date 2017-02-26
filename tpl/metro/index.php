<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="fa" lang="fa" dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php _title(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="<?php echo theme_dir(); ?>style.css" />
<meta name="description" content="<?php _description(); ?>">
<meta name="keywords" content="<?php _keywords(); ?>">
<meta name="author" content="MahdiY">
<meta name="language" content="Fa">
<script language="JavaScript">
<!-- 
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=450,left = 483,top = 184');");
}
// -->
</script>
</head>
<body>

<div id="page">
<img src="<?php echo theme_dir(); ?>img/logo.jpg" />
</div>

<div id="menu">
<ul>
<li class="act"><a href="<?php _site_url(); ?>">صفحه نخست</a></li>
<li><a href="mailto:<?php _email(); ?>">تماس با ما</a></li>
<li><a href="<?php _site_url(); ?>box.php">لینک باکس</a></li>
<li><a href="javascript:popUp('<?php _site_url(); ?>send.php')">ارسال لینک</a></li>
<li style="float: left;" ><a href="<?php _site_url(); ?>rss.php"><img src="<?php echo theme_dir(); ?>img/rss.png" /></a></li>
</ul>
</div>

	<?php
	if(have_link()) : while(have_link()) : the_link();

		echo '<div id="page">
			<div class="date"><img src="'.theme_dir().'img/date.png" /><p>'.the_date().'</p></div>
			<ul>';
			
		while(link_in_day()) : the_link_day();
			echo '<li><a href="'.the_url().'" target="_blank" >:: '.the_title().'</a></li>';
		endwhile; 
		
		echo '</ul>
		</div>';

	endwhile; endif; ?>

	<?php echo pagination(page_numbers()); ?>

<div id="page" class="copyright">
Powered By <a rel="nofollow" href="http://www.persianlinkcms.ir/" target="_blank" title="پرشین اسکریپت">Persian Link CMS</a> - Design By <a rel="nofollow" href="http://MahdiY.ir" target="_blank" title="مهدی">MahdiY</a>
</div>

</body>
</html>