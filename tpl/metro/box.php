<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="fa" lang="fa" dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo get_option( 'title' ); ?></title>
    <meta name="description" content="<?php echo get_option( 'description' ); ?>">
    <meta name="keywords" content="<?php echo get_option( 'keywords' ); ?>">
    <meta name="author" content="MahdiY">
    <meta name="language" content="Fa">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link type="text/css" rel="stylesheet" href="<?php echo theme_dir(); ?>style.css"/>
</head>
<body>

<div id="page">
    <div class="date"><img src="<?php echo theme_dir(); ?>img/date.png"/>
        <p>لینکدونی - مطالب جالب و خواندنی از سراسر وب</p></div>
    <ul>
		<?php
		if ( have_link() ) : while( have_link() ) : the_link();

			echo sprintf( "<a href='%1\$s' target='_blank' title='%2\$s'>%2\$s [%3\$d]</a><br>", the_url(), the_title(), the_count() );

		endwhile; endif;
		?>
    </ul>
    <div class="date"><img src="<?php echo theme_dir(); ?>img/date.png"/>
        <p><a href="<?php echo get_option( 'site_url' ); ?>" target="_blank" style="color:#FFF;">:: ادامه - آرشیو
                لینکدونی</a></p></div>
</div>


</body>
</html>