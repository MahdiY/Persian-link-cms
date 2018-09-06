<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * Version 3.0
 * copyright 2011 - 2018
*/

use App\Models\Link;

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'add.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
	die ('Please do not load this page directly. Thanks!');
}

$msg = "";
if (isset($_POST['save'])) {

	if (filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
		$addlink = Link::create([
			'id'     => '',
			'title'  => $_POST['title'],
			'url'    => $_POST['url'],
			'time'   => time(),
			'date'   => date("d-m-Y"),
			'status' => $_POST['status'],
		]);

		if ($addlink) {
			$msg = '<div class="alert alert-success alert-dismissable">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						لینک با موفقیت ارسال شد.
					</div>';
		} else {
			$msg = '<div class="alert alert-danger alert-dismissable">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
						مشکلی در ثبت لینک بوجود آمده است.
					</div>';
		}

	} else {
		$msg = '<div class="alert alert-danger alert-dismissable">
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
					لینک وارد شده معتبر نمی باشد.
				</div>';
	}
}
echo '		<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">افزودن لینک</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
				' . $msg . '
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            افزودن لینک تازه
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post">
                                       
                                        <div class="form-group">
                                            <label>عنوان لینک</label>
                                            <input class="form-control" type="text" name="title" placeholder="مثال: پرشین لینک سی ام اس نسخه 2 معرفی شد" required />
                                        </div>
										
										<div class="form-group">
                                            <label>آدرس لینک</label>
                                            <input dir="ltr" class="form-control" name="url" type="text" placeholder="http://www.persianlinkcms.ir" required />
                                        </div>
										
                                        <div class="form-group">
                                            <label>وضعیت لینک</label>
                                            <select name="status" class="form-control">
                                                <option value="1" selected>فعال</option>
                                                <option value="0">غیر فعال</option>
                                            </select>
                                        </div>
                                       
                                        <button type="submit" name="save" class="btn btn-success">ثبت لینک جدید</button>
                                        <button type="reset" class="btn btn-warning">دوباره</button>
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