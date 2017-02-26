<?php
/*
	Persian Link CMS
	Powered By www.PersianLinkCMS.ir
	Author : Mohammad Majidi & MahdiY.ir
	VER 2.1
	copyright 2011 - 2015
		
*/
error_reporting(0);
if ((!empty($_SERVER['SCRIPT_FILENAME']) && 'conf.php' == basename($_SERVER['SCRIPT_FILENAME'])) || !is_admin())
		die ('Please do not load this page directly. Thanks!');
		
$configstatus = "";		
	if(isset($_POST['save'])){
		if(!empty($_POST['username']) AND !empty($_POST['mail'])){
		
			up_option('title' , $_POST['sitetitle']);
			if(filter_var($_POST['website'], FILTER_VALIDATE_URL))
			{
				up_option('site_url' , $_POST['website']);
			}
			else {
				$configstatus = '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>آدرس سایت معتبر نمی باشد</div>';
			}
			if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
			{
				up_option('email' , $_POST['mail']);
			}
			else
			{
				$configstatus .= '<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>ایمیل معتبر نمی باشد</div>';
			}
			up_option('user_name' , clean($_POST['username']));
			up_option('description' , clean($_POST['description']));
			up_option('keywords' , clean($_POST['keywords']));
			up_option('robo_status' , intval($_POST['rbstatus']));
			up_option('page_vahed' , intval($_POST['page_vahed']));
			up_option('box_num' , intval($_POST['box_num']));
			up_option('box_type' , intval($_POST['box_type']));
			if($_POST['password']==$_POST['password2'] && !empty($_POST['password']))
				up_option('user_pass' , md5($_POST['password']));
			option(true);
			$configstatus .= '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>تغییرات با موفقیت در سیستم ثبت شد</div>';
		
		}
			
	}

	$on = get_robo_status() == 1 ? "selected" : "";
	$off = get_robo_status() == 0 ? "selected" : "";
	
	$new = get_box_type() == 0 ? "selected" : "";
	$rand = get_box_type() == 1 ? "selected" : "";
echo'<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تنظیمات سیستم</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					'.$configstatus.'
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            مدیریت تنظیمات سیستم
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="" method="post">
                                       
                                        <div class="form-group">
                                            <label>نام کاربری مدیریت</label>
                                            <input dir="ltr" class="form-control" type="text" name="username" value="'.get_user_name().'" required="required"/>
											<p class="form-control-static">در صورتی که قصد تغییر ندارید چیزی وارد نکنید</p>
                                        </div>
										
										<div class="form-group">
                                            <label>رمز عبور مدیریت</label>
                                            <input dir="ltr" class="form-control" name="password" type="password" />
											<p class="form-control-static">در صورتی که قصد تغییر ندارید چیزی وارد نکنید</p>
                                        </div>
										
										<div class="form-group">
                                            <label>تکرار رمز عبور مدیریت</label>
                                            <input dir="ltr" class="form-control" name="password2" type="password" />
											<p class="form-control-static">در صورتی که قصد تغییر ندارید چیزی وارد نکنید</p>
                                        </div>
										
										<div class="form-group">
                                            <label>ایمیل مدیر وب سایت</label>
                                            <input dir="ltr" class="form-control" type="email" name="mail" value="'.get_email().'" required="required"/>
                                        </div>
										
										<div class="form-group">
                                            <label>آدرس لینک دونی</label>
                                            <input dir="ltr" class="form-control" type="text" name="website" value="'.get_site_url().'" required="required"/>
											<p class="form-control-static">آدرس محل نصب سیستم را همراه با / انتها و همچنین http:// وارد کنید</p>
                                        </div>
										
										<div class="form-group">
                                            <label>عنوان وب سایت</label>
                                            <input class="form-control" type="text" name="sitetitle" value="'.get_title().'" required="required"/>
                                        </div>
										
										<div class="form-group">
                                            <label>توضیحات کوتاه وب سایت</label>
                                            <input class="form-control" type="text" name="description" value="'.get_description().'" required="required"/>
											<p class="form-control-static">توضیحات کوتاه وب سایت جهت نمایش برای موتور های جستجو می باشد</p>
                                        </div>
										
										<div class="form-group">
                                            <label>کلمات کلیدی وب سایت</label>
                                            <textarea name="keywords" class="form-control" rows="3">'.get_keywords().'</textarea>
											<p class="form-control-static">کلمات کلیدی وب سایت را به وسیله کاما (,) از یکدیگر جداسازی کنید.<br/> مثال: لینکدونی,جدیدترین,پرشین</p>
                                        </div>
										
										<div class="form-group">
                                            <label>نمایش تعداد روز های لینکدونی در برگه نخست سایت</label>
                                            <input class="form-control" type="number" name="page_vahed" value="'.get_page_vahed().'" required="required"/>
                                        </div>
										
										<div class="form-group">
                                            <label>تعداد لینک های قابل نمایش در باکس لینکدونی</label>
                                            <input class="form-control" type="number" name="box_num" value="'.get_box_num().'" required="required"/>
											<p class="form-control-static">تنها می توانید عدد وارد کنید.</p>
                                        </div>
										
                                        <div class="form-group">
                                            <label>ترتیب نمایش لینک ها در باکس لینکدونی</label>
                                            <select class="form-control" name="box_type">
                                                <option value="0" '.$new.'>جدیدترین</option>
                                                <option value="1" '.$rand.'>تصادفی</option>
                                            </select>
                                        </div>
										
										<div class="form-group">
                                            <label>وضعیت روبات</label>
                                            <select class="form-control" name="rbstatus">
                                                <option value="1" '.$on.'>هوشمند - روشن</option>
                                                <option value="0" '.$off.'>دستی - خاموش</option>
                                            </select>
                                        </div>
                                       
                                        <button type="submit" class="btn btn-success" name="save">ذخیره تنظیمات</button>
                                    </form>
                                </div>
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->';

?>