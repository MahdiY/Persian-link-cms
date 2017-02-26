<html>
<head>
<meta http-equiv='Content-Language' content='en-us'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="shortcut icon" type="image/ico" href="<?php echo theme_dir(); ?>img/feed.gif"/>
<title><?php echo the_title(); ?></title>
<style>
body{margin: 0;overflow: hidden;}
.task a:hover{ color: #FFCC00; text-decoration: none}
.task{ width: 100%; height: 32px;border-top-width: 1px; border-bottom: 1px solid #1083B3;padding-left: 5px; padding-right: 0px; padding-top: 0px;padding-bottom: 0px; background-color:#238BFF; text-align:right; font-family:Tahoma; font-size:9pt; color:#FFFFFF; text-transform:capitalize; float:right;}
.task a{ text-decoration: none; color: #FFFFFF;}
</style>
</head>

<body scroll='no'>
<div class='task'>

<span style='font-family: Tahoma; font-size: 8pt; color: #9DB2D5; text-align: left; direction: ltr; width:380px; float:left; padding-top:2px; padding-left:15px' >
<a target='_blank' href='http://technorati.com/faves?add=<?php echo the_link(); ?>'><img border='0' src='<?php echo theme_dir(); ?>img/technorati.png' width='30' height='30' hspace='1' alt='Technorati'></a>
<a target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=<?php echo the_link(); ?>'><img border='0' src='<?php echo theme_dir(); ?>img/facebook.png' width='30' height='30' hspace='1' alt='Facebook'></a>
<a target='_blank' href='https://twitter.com/home?status=<?php echo the_link(); ?>'><img border='0' src='<?php echo theme_dir(); ?>img/twitter.png' width='30' height='30' hspace='1' alt='twitter'></a>
<a target='_blank' href='https://www.linkedin.com/shareArticle?mini=true&url=<?php echo the_link(); ?>&title=<?php echo the_title(); ?>'><img border='0' src='<?php echo theme_dir(); ?>img/linkedin.png' width='30' height='30' hspace='1' alt='linkedin'></a>
<a target='_blank' href='http://www.google.com/bookmarks/mark?op=add&bkmk=<?php echo the_link(); ?>&title=<?php echo the_title(); ?>'><img border='0' src='<?php echo theme_dir(); ?>img/google.png' width='30' height='30' hspace='1' alt='Google'></a>
<a target='_blank' href='http://reddit.com/submit?url=<?php echo the_link(); ?>&title=<?php echo the_title(); ?>'><img border='0' src='<?php echo theme_dir(); ?>img/reddit.png' width='30' height='30' hspace='1' alt='Reddit'></a>
<a target='_blank' href='http://digg.com/submit?phase=2&url=<?php echo the_link(); ?>'><img border='0' src='<?php echo theme_dir(); ?>img/digg.png' width='30' height='30' hspace='1' alt='Digg'></a>
<a target='_blank' href='http://del.icio.us/post?url=<?php echo the_link(); ?>&title=<?php echo the_title(); ?>'><img border='0' src='<?php echo theme_dir(); ?>img/delicious.png' width='30' height='30' hspace='1' alt='Del.icio.us'></a>
<a href='ymsgr:im?msg=ino bebin - <?php echo the_link(); ?>'><img border='0' src='<?php echo theme_dir(); ?>img/yahoo.png' width='30' height='30' hspace='1'></a>
</span> <div class='link' style="margin-top: 6px;"> « <a href='<?php echo next_link(); ?>'>لینک بعدی</a> | <a href='index.php'>لینکدونی</a> | <a href='<?php echo prev_link(); ?>'>لینک قبلی</a>  » &nbsp;</div>
	

	</div>
	<iframe name='contentframe' bordercolor='#ffffff' src='<?php echo the_link(); ?>' width='100%' height='95%' border='0' frameborder='0'></iframe>
</body>

</html>