<html>
<head>
<title><?php _title(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="<?php _description(); ?>">
<meta name="keywords" content="<?php _keywords(); ?>">
<meta name="author" content="MahdiY">
<meta name="language" content="Fa">
<link rel="shortcut icon" type="image/ico" href="<?php echo theme_dir(); ?>img/feed.gif"/>
<style>
body{padding:0;margin:0;font-family:"tahoma";font-size:11px;direction:rtl;background:#FAFAFA;}a , a:hover , a:active{text-decoration:none;color:#000000;}img,img a{boder:0;}.clear{clear:both;}.wrap h1{	font-family:tahoma;font-size:12px;font-weight:600;border-right:3px #900 solid;padding-right:5px;}hr{height:1px;}.div{ border-left: 3px solid #FFFFFF;border-right: 3px solid #FFFFFF;background-color: #FFFFFF;width:600;height:100%;}p{ font-family: Tahoma;font-size: 10pt;color: #808080;text-decoration: none;margin-top: 0;margin-bottom: 0 }a{ text-decoration: none;font-family: Tahoma;color: #000;font-size: 8pt }a:hover{ text-decoration: none;color: #204080 }.pagination {clear:both;padding:20px 0;position:relative;font-size:11px;line-height:13px;}.pagination span, .pagination a {display:block;float:right;margin: 2px 2px 2px 0;padding:6px 9px 5px 9px;text-decoration:none;width:auto;color:#000 !important;background: #F8F5D3;border:1px solid #F1E98E;}.pagination a:hover{color:#fff;background: #F1E98E;}.pagination .current{padding:6px 9px 5px 9px;background: #F1E98E;color:#000 !important;}
</style>
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
<table align=center border="0" width="600"  height="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td height="24" width="607" style="border-left: 3px solid #FFFFFF;border-right: 3px solid #FFFFFF;padding-left: 2px;padding-right: 2px" valign="top" bgcolor="#FFFFFF">
	
	<p align="center" dir="rtl">
	
	<img border="0" src="<?php echo theme_dir(); ?>img/logo.jpg"><br>
	<a href="<?php _site_url(); ?>" targer="_blank">صفحه نخست</a> | 
	<a href="mailto:<?php _email(); ?>" targer="_blank">تماس با ما</a> |
	<a href="<?php _site_url(); ?>box.php" targer="_blank">لینک باکس</a> | 
	<a href="javascript:popUp('<?php _site_url(); ?>send.php')">ارسال لینک</a> | 
	<a href="rss.php" targer="_blank"><img border="0" src="<?php echo theme_dir(); ?>img/feed.gif"></a> 
	</p>
	<hr size="1" color="#F1F6FB" style="margin-top: 0; 
 margin-bottom: 0">
	<p align="right">
	<?php
	if(have_link()) : while(have_link()) : the_link();

		echo '<hr size="1" color="#F1F6FB" style="margin-top: 0;margin-bottom: 0"><p align="right" dir="rtl"><span style="font-size: 8pt"><b>'.the_date()."</b><br><br>";
			
		while(link_in_day()) : the_link_day();
			echo '<font color="#204080">::</font> <a target="_blank" href="'.the_url().'">'.the_title().'</a></font><br>';
		endwhile; 

		echo "<br>";
		
	endwhile; endif; ?>
	</p>
	<br><br>
	<p style="font-size:11px; 
 text-align:center">Powered By <a href="http://persianscript.ir/" target="_blank" title="پرشین اسکریپت">Persian Link CMS</a></p>
	<hr size="1" color="#F1F6FB" style="margin-top: 0; 
 margin-bottom: 0">
	<?php echo pagination(page_numbers()); ?>
	</td>
	</tr>
</table>
</body>
</html>