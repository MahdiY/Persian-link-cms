<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

use App\Models\Link;

if ((!empty($_SERVER['SCRIPT_FILENAME']) && 'home.php' == basename($_SERVER['SCRIPT_FILENAME'])) || !is_admin())
	die ('Please do not load this page directly. Thanks!');

if (isset($_GET['delete'])) {
    Link::destroy($_GET['delete']);
}

if (isset($_GET['active'])) {
	Link::findOrFail($_GET['active'])
		->update([
			'status' => 1,
		]);
}

$install = "";
if (file_exists('../install')) {
	$install = '<div class="alert alert-warning alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>فایل نصب اسکریپت هنوز حذف نشده است. توجه کنید که این یک ریسک بزرگ امنیتی است. توصیه های ایمنی را جدی بگیرید!</div>';
}

/** @var Link[] $links */
$links = Link::all();

$num_total = $links->count();
$num_active = $links->where('status', 1)->count();
$num_deactive = $links->where('status', 0)->count();

$robot = get_option('robo_status') == 1 ? "فعال" : '<span style="font-size: 30px;">غیر فعال</span>';

if (versionchecker() > versionplcms()) {
	echo '<div class="row">
                <div class="col-lg-12" style="margin-top:20px;">
                    <div class="alert alert-warning">
                    نسخه جدید لینکدونی پرشین منتشر شد. برای اطلاعات بیشتر و دریافت نسخه جدید <a class="alert-link" href="http://www.persianlinkcms.ir/" target="_blank">اینجا کلیک کنید</a>.
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>';
}

?>
<div class="row">
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
                        <div class="huge"><?php echo $robot; ?></div>
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
                        <div class="huge"><?php echo $num_total; ?></div>
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
                        <div class="huge"><?php echo $num_active; ?></div>
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
                        <div class="huge"><?php echo $num_deactive; ?></div>
                        <div>لینک های غیر فعال</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php echo $install; ?>
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
                                <tbody>
								<?php
								/** @var Link[] $links */
								$links = Link::Deactive()->orderBy('id', 'ASC')->limit(10)->get();

								foreach ($links as $link) {
									$status = sprintf('
									<a class="btn btn-success btn-xs" title="فعال کردن" href="panel.php?act=default&active=%d">
                                    <i class="fa fa-check"></i> فعال کردن</a>
                                    <a class="btn btn-info btn-xs" title="مشاهده سایت" target="_blank" href="%s">
                                    <i class="fa fa-link"></i>مشاهده لینک
                                    </a>
                                    <a class="btn btn-danger btn-xs" title="حذف"
                                       href="panel.php?act=default&delete=%1$d">
                                    <i class="fa fa-times"></i>حذف
                                    </a>', $link->id, href_link($link->id));

									echo "<tr>
                                        <td>{$link->id}</td>
                                        <td>{$link->title}</td>
                                        <td>{$status}</td>
                                    </tr>";
								}
								?>
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