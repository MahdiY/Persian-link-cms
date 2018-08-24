<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        <!--
        body, td, th {
            font-family: Tahoma, Arial;
            font-size: 8pt;
        }

        a:link {
            text-decoration: none;
        }

        a:visited {
            text-decoration: none;
        }

        a:hover {
            text-decoration: none;
        }

        a:active {
            text-decoration: none;
        }

        -->
    </style>
    <head>
        <title>لینکدونی پرشین اسکریپت</title>
    </head>
<body dir="rtl" link="#000000" vlink="#333300" alink="#216269">

<div style="text-align:right; direction:rtl">

    <img border="0" src="<?php echo theme_dir(); ?>img/linkdump.gif" width="11" height="9"> لینکدونی - مطالب جالب و
    خواندنی از سراسر وب
    <br>
    <br>

	<?php
	if ( have_link() ) : while( have_link() ) : the_link();

		echo sprintf( "<a href='%1\$s' target='_blank' title='%2\$s'>%2\$s [%3\$d]</a><br>", the_url(), the_title(), the_count() );

	endwhile; endif;
	?>
    <br><a href="<?php echo get_option( 'site_url' ); ?>" target="_blank">:: ادامه - آرشیو لینکدونی</a>
</div>
</body>
</html>