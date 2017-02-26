<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
session_start();
include("../inc/config.php");

	if(isset($_GET['act']) && $_GET['act']=="logout"){
		unset($_SESSION['user_login'] , $_SESSION['user_password']);
		header("location: index.php");
	}
	
if(!is_admin()){header("location: index.php"); die();} 
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="MahdiY">

<title>مدیریت سایت</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">منوی ناوبری</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">مدیریت لینکدونی</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php _site_url(); ?>" target="_blank"><i class="fa fa-gear fa-fw"></i> مشاهده سایت</a></li>
                        <li><a href="<?php _site_url(); ?>admin/panel.php?act=addlink" ><i class="fa fa-gear fa-fw"></i> افزودن لینک</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="panel.php?act=logout"><i class="fa fa-sign-out fa-fw"></i> خروج</a>
                        </li>
                    </ul>
					
					
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a class="active" href="panel.php"><i class="fa fa-dashboard fa-fw"></i> پیشخوان</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> لینک ها<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panel.php?act=links">مدیریت لینک ها</a>
                                </li>
                                <li>
                                    <a href="panel.php?act=addlink">افزودن لینک</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="panel.php?act=feeds"><i class="fa fa-table fa-fw"></i> فید های RSS</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> تنظیمات<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panel.php?act=setting">تنظیمات کلی</a>
                                </li>
                                <li>
                                    <a href="panel.php?act=theme">تنظیمات قالب</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						
						<li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> راهنما<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
                                <li>
                                    <a href="panel.php?act=robot">راهنمای روبات</a>
                                </li>
                                <li>
                                    <a href="panel.php?act=about">درباره سیستم</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
        
		<?php
				$Page = isset($_GET['act']) ? $_GET['act'] : 1;
				switch($Page){
					case("addlink");
						include("cp/add.php");
					break;
					case("links");
						include("cp/links.php");
					break;
					case("setting");
						include("cp/conf.php");
					break;
					case("theme");
						include("cp/theme.php");
					break;
					case("feeds");
						include("cp/rss.php");
					break;
					case("backup");
						include("cp/backup.php");
					break;
					case("robot");
						include("cp/robot.php");
					break;
					case("about");
						include("cp/about.php");
					break;
					default:
						include("cp/home.php");
					break;
				}
				?>
		
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>
