<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * Version 3.0
 * copyright 2011 - 2018
*/

use App\Models\Link;

if ((!empty($_SERVER['SCRIPT_FILENAME']) && 'links.php' == basename($_SERVER['SCRIPT_FILENAME'])) || !is_admin()) {
	die ('Please do not load this page directly. Thanks!');
}

if (isset($_GET['active'], $_GET['id'])) {
	Link::findOrFail($_GET['id'])
		->update(['status' => intval($_GET['active'])]);
}

if (isset($_GET['delete'])) {
    Link::destroy($_GET['delete']);
}

$page = $_GET['page'] ?? 1;

/** @var Link[] $links */
$links = Link::orderBy('time', 'DESC')->paginate(20);

if ($links->count() > 0){

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">مدیریت لینک ها</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">

        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> مدیریت لینک های ارسال شده - برگه <?php echo $page; ?>
                <div class="pull-right">

                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>شناسه</th>
                                    <th>عنوان</th>
                                    <th>گزینه ها</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php
								foreach ($links as $link) {

									if ($link->status == 1) {
										$activebtn = 'btn-warning';
										$showtext = 'غیر فعال کردن';
										$trstatus = 'default';
										$code = '0';
									} else {
										$activebtn = 'btn-success';
										$showtext = 'فعال کردن';
										$trstatus = 'warning';
										$code = '1';
									}
									?>

                                    <tr class="<?php echo $trstatus; ?>">
                                        <td><?php echo $link->id; ?></td>
                                        <td><?php echo $link->title; ?></td>
                                        <td>
                                            <a class="btn <?php echo $activebtn; ?> btn-xs"
                                               href="panel.php?act=links&page=<?php echo $page; ?>&active=<?php echo $code; ?>&id=<?php echo $link->id; ?>"><i
                                                        class="fa fa-check"></i> <?php echo $showtext; ?></a>
                                            <a class="btn btn-info btn-xs" title="مشاهده لینک" target="_blank"
                                               href="<?php echo href_link($link->id); ?>"><i
                                                        class="fa fa-link"></i> مشاهده لینک</a>
                                            <a class="btn btn-danger btn-xs" title="حذف"
                                               href="panel.php?act=links&page=<?php echo $page; ?>&delete=<?php echo $link->id; ?>"><i
                                                        class="fa fa-times"></i> حذف</a>
                                        </td>
                                    </tr>

									<?php
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
</div>

<div class="row">

    <div class="col-lg-12">
		<?php

		$paginate = $links->toArray();

		echo pagination($paginate['last_page'], 5, true);

		} else {
			echo '<br/><br/><br/><br/><br/><div class="alert alert-warning alert-dismissable">چیزی یافت نشد!</div>';
			if (isset($_GET['page'])) {
				header("Location: panel.php?act=links");
			}
		}
		?>

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.col-lg-8 -->
				