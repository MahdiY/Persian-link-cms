<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
error_reporting(0);
if ((!empty($_SERVER['SCRIPT_FILENAME']) && 'theme.php' == basename($_SERVER['SCRIPT_FILENAME'])) || !is_admin())
		die ('Please do not load this page directly. Thanks!');
echo'
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">درباره سیستم</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="row">
                <div class="col-lg-12">
                   
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> درباره پرشین لینک سی ام اس بدانید
                            <div class="pull-right">
                                
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
								
							<p>اسکریپت لینکدونی پرشین یک سیستم متن باز و رایگان است که توسط گروه پرشین اسکریپت طراحی شده است.</p>
							
							<a href="http://forum.persianscript.ir/" target="_blank" class="btn btn-default">تالار های پشتیبانی</a>
							<a href="http://www.persianlinkcms.ir/" target="_blank" class="btn btn-danger">وب سایت پشتیبانی رسمی</a>
							</p>
							<h2>اعضای گروه</h2>
							</div>
								
							<div class="col-lg-6">	
							<div class="panel panel-green">
							<div class="panel-heading">
								مهدی یوسفی
							</div>
								<div class="panel-body">
									<p>برنامه نویس PHP و توسعه دهنده</p>
									<a href="http://mahdiy.ir/" target="_blank" class="btn btn-outline btn-xs btn-success">سایت شخصی</a>
								</div>
								
								</div>
								</div>
								
							<div class="col-lg-6">	
							<div class="panel panel-red">
							<div class="panel-heading">
								محمد مجیدی
							</div>
								<div class="panel-body">
									<p>برنامه نویس ، طراح رابط کاربری و توسعه دهنده</p>
									<a href="http://mammad.ir/" target="_blank" class="btn btn-outline btn-xs btn-success">سایت شخصی</a>
									<a href="http://facebook.com/mamad.majidi" target="_blank" class="btn btn-outline btn-xs btn-primary"><i class="fa fa-facebook"></i> فیسبوک</a>
									<a href="http://twitter.com/mammad_majidi" target="_blank" class="btn btn-outline btn-xs btn-info"><i class="fa fa-facebook"></i> توییتر</a>
								</div>
								
								</div>
								</div>
								
							
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                </div>
                </div>										
	
	
	';

?>
