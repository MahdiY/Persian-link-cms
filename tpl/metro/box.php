<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="fa" lang="fa" dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php _title(); ?></title>
<meta name="description" content="<?php _description(); ?>">
<meta name="keywords" content="<?php _keywords(); ?>">
<meta name="author" content="MahdiY">
<meta name="language" content="Fa">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="<?php echo theme_dir(); ?>style.css" />
</head>
<body>

<div id="page">
<div class="date"><img src="<?php echo theme_dir(); ?>img/date.png" /><p>لینکدونی - مطالب جالب 
و خواندنی از سراسر وب</p></div>
<ul>
<?php
if(have_link()) : while(have_link()) : the_link();

	echo "<a href='".the_url()."' target='_blank' title='".the_title()."'>".the_title()." [".the_count()."]</a><br>";

endwhile; endif;
?>
</ul>
<div class="date"><img src="<?php echo theme_dir(); ?>img/date.png" /><p><a href="<?php _site_url(); ?>" target="_blank" style="color:#FFF;">:: ادامه - آرشیو لینکدونی</a></p></div>
</div>








</body>
</html>