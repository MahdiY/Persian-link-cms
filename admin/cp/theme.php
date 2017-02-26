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
	
	$persianscript = "";
	if(isset($_POST['save'])){
		up_option('theme_name' , $_POST['theme_name']);
		option(true);
		$persianscript = '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>تغییرات با موفقیت ثبت شد</div>';

	}
	
	$theme = "";
	if ($handle = opendir('../tpl')) {
		while (false !== ($file = readdir($handle))) {
			if($file == current(explode('.', $file)))
				if($file == get_theme_name())
					$theme .= "<option value='{$file}' selected>$file</option>";
				else
					$theme .= "<option value='{$file}'>$file</option>";
			
		}
		closedir($handle);
	}

echo'
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تنظیمات قالب</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="row">
                <div class="col-lg-12">
                   '.$persianscript.'
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
												'.$theme.'
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
	
	
	';

?>
