<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * Version 3.0
 * copyright 2011 - 2018
*/

if ((!empty($_SERVER['SCRIPT_FILENAME']) && 'theme.php' == basename($_SERVER['SCRIPT_FILENAME'])) || !is_admin())
		die ('Please do not load this page directly. Thanks!');
	
$themes = array_map( 'basename', glob( '../tpl/*', GLOB_ONLYDIR ) );

$msg = "";
if ( isset( $_POST['save'] ) && in_array( $_POST['theme_name'], $themes ) ) {
    update_option( 'theme_name', $_POST['theme_name'] );
    $msg = '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>تغییرات با موفقیت ثبت شد</div>';
}

$select = "";
foreach ( $themes as $theme )
    $select .= sprintf( '<option value="%1$s" %2$s>%1$s</option>', $theme, $theme == get_option('theme_name') ? 'selected' : '' );

?>
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تنظیمات قالب</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="row">
                <div class="col-lg-12">
                   <?php echo $msg; ?>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> مدیریت پوسته وب سایت
                            <div class="pull-right">
                                
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
								
							<form role="form" method="post">
                                       
                                        <div class="form-group">
                                            <label>انتخاب پوسته</label>
											<select name="theme_name" class="form-control">
												<?php echo $select; ?>
											</select>
                                        </div>

 <button type="submit" name="save" class="btn btn-success">ذخیره تغییرات</button>
  <button type="reset" class="btn btn-warning">دوباره</button>
                            </form>
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