<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

if ((!empty($_SERVER['SCRIPT_FILENAME']) && 'theme.php' == basename($_SERVER['SCRIPT_FILENAME'])) || !is_admin())
		die ('Please do not load this page directly. Thanks!');
echo'
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">راهنمای روبات لینکدونی</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="row">
                <div class="col-lg-12">
                   
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> راهنمای روبات لینکدونی
                            <div class="pull-right">
                                
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
								
							<p>روبات سیستم با استفاده از قابلیت کرون جاب (cron job) قابل استفاده می باشد.<br/>
							هم اکنون روبات در مسیر زیر قرار دارد:<br/>
							<pre dir="ltr">'.get_option('site_url').'robot.php</pre>
							اگر نمی دانید چگونه کرون جاب را برای سیستم فعال کنید کافیست یکی از لینک های زیر را مطالعه کنید</p>
							<p>
							<a href="http://forum.persianscript.ir/f133/%D8%A2%D9%85%D9%88%D8%B2%D8%B4-%D9%81%D8%B9%D8%A7%D9%84-%D8%B3%D8%A7%D8%B2%DB%8C-%DA%A9%D8%B1%D9%88%D9%86-%D8%AC%D8%A7%D8%A8%D8%B2-cron-jobs-%D8%AF%D8%B1-%D8%B3%DB%8C-%D9%BE%D9%86%D9%84-cpanel-8689/" target="_blank" class="btn btn-info">آموزش فعال سازی کرون جاب در CPanel</a>
							<a href="http://forum.persianscript.ir/f133/%D8%A2%D9%85%D9%88%D8%B2%D8%B4-%D9%81%D8%B9%D8%A7%D9%84-%D8%B3%D8%A7%D8%B2%DB%8C-%DA%A9%D8%B1%D9%88%D9%86-%D8%AC%D8%A7%D8%A8%D8%B2-cron-jobs-%D8%AF%D8%B1-%D8%AF%D8%A7%DB%8C%D8%B1%DA%A9%D8%AA-%D8%A7%D8%AF%D9%85%DB%8C%D9%86-directadmin-8688/" target="_blank" class="btn btn-info">آموزش فعال سازی کرون جاب در DirectAdmin</a>
							</p>
								</div>
                                <!-- /.col-lg-4 (nested) -->
                                
                                <!-- /.col-lg-8 (nested) -->
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
