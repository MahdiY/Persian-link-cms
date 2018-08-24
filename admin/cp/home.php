<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

if ((!empty($_SERVER['SCRIPT_FILENAME']) && 'home.php' == basename($_SERVER['SCRIPT_FILENAME'])) || !is_admin() )
		die ('Please do not load this page directly. Thanks!');
	
	if(isset($_GET['delete'])){
		$db->delete('_link' , array('id'=>intval($_GET['delete'])));
	}
	
	if(isset($_GET['active'])){
		$db->update('_link' , array('status'=> 1) , array('id'=> intval($_GET['active'])));
	}
	
	$install = "";
	if( file_exists('../install') )
		$install = '<div class="alert alert-warning alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>فایل نصب اسکریپت هنوز حذف نشده است. توجه کنید که این یک ریسک بزرگ امنیتی است. توصیه های ایمنی را جدی بگیرید!</div>';
	
	$num_active = 0;
	$num_deactive = 0;
	$sql = $db->get_results("SELECT status FROM `_link`" , ARRAY_N);
	$num_total = $db->num_rows;
	foreach($sql as $num){
		if($num[0] == 1)
			$num_active++;
		else
			$num_deactive++;
	}
	
	$robot = get_option('robo_status') == 1 ? "فعال" : '<span style="font-size: 30px;">غیر فعال</span>';
	$lastversion = file_get_contents(versionchecker(), true);
	$finalversion = floatval($lastversion);
	
	if ( $finalversion > versionplcms() ){
	echo '<div class="row">
                <div class="col-lg-12" style="margin-top:20px;">
                    <div class="alert alert-warning">
                    نسخه جدید لینکدونی پرشین منتشر شد. برای اطلاعات بیشتر و دریافت نسخه جدید <a class="alert-link" href="http://www.persianlinkcms.ir/" target="_blank">اینجا کلیک کنید</a>.
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>';
	}
	else{
	
	}
echo '    <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">پیشخوان</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cogs fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">'.$robot.'</div>
                                    <div>وضعیت روبات</div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-link fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">'.$num_total.'</div>
                                    <div>مجموع لینک ها</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-check fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">'.$num_active.'</div>
                                    <div>لینک های فعال</div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">'.$num_deactive.'</div>
                                    <div>لینک های غیر فعال</div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
			'.$install.'
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                   
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> آخرین لینک های تایید نشده
                            <div class="pull-right">
                                
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>شناسه</th>
                                                    <th>عنوان</th>
                                                    <th>گزینه ها</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
											$Query = $db->get_results("SELECT * FROM `_link` where status = 0 order by `id` ASC limit 10" , ARRAY_A);
											foreach($Query as $rows){
													$status='<a class="btn btn-success btn-xs" title="فعال کردن" href="panel.php?act=default&active='.$rows['id'].'"><i class="fa fa-check"></i> فعال کردن</a>
													<a class="btn btn-info btn-xs" title="مشاهده سایت" target="_blank" href="'.href_link($rows['id']).'" title=""><i class="fa fa-link"></i> مشاهده لینک</a>
													<a class="btn btn-danger btn-xs" title="حذف" href="panel.php?act=default&delete='.$rows['id'].'"><i class="fa fa-times"></i> حذف</a>';
												
													echo'
                                                <tr>
                                                    <td>'.$rows['id'].'</td>
                                                    <td>'.$rows['title'].'</td>
                                                    <td>'.$status.'</td>
                                                </tr>
                                                ';
		}
		echo '
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
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
                <!-- /.col-lg-8 -->
				
				
				
                
            </div>
            <!-- /.row -->
			
			';?>