<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * Version 3.0
 * copyright 2011 - 2018
*/

use App\Models\Feed;

if ((!empty($_SERVER['SCRIPT_FILENAME']) && 'rss.php' == basename($_SERVER['SCRIPT_FILENAME'])) || !is_admin()) {
	die ('Please do not load this page directly. Thanks!');
}

$msg = "";

if (isset($_GET['active']) && isset($_GET['id'])) {
    Feed::findOrFail($_GET['id'])
        ->update(['status' => $_GET['active']]);
}

if (isset($_GET['delete'])) {
    Feed::destroy($_GET['delete']);
}

if (isset($_POST['save'])) {

	if (filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
		$addfeed = Feed::create([
			'title'  => $_POST['title'],
			'link'   => $_POST['url'],
			'status' => $_POST['status'],
		]);

		if ($addfeed) {
			$msg = '<div class="alert alert-success alert-dismissable">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
					لینک با موفقیت ارسال شد</div>';
		} else {
			$msg = '<div class="alert alert-danger alert-dismissable">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
					مشکلی در ثبت لینک بوجود آمده است</div>';
		}
	} else {
		$msg = '<div class="alert alert-danger alert-dismissable">
					<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
				لینک وارد شده معتبر نمی باشد</div>';
	}
}

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">مدیریت لینک ها</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
		<?php echo $msg; ?>
        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> مدیریت خوراک های خبری (RSS)
                <div class="pull-right">

                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">

                        <form role="form" method="post">

                            <div class="form-group">
                                <label>عنوان وب سایت</label>
                                <input class="form-control" type="text" name="title" placeholder="مثال: خبرگزاری ایرنا"
                                       required/>
                            </div>

                            <div class="form-group">
                                <label>آدرس RSS</label>
                                <input dir="ltr" class="form-control" name="url" type="text"
                                       placeholder="http://www.persianlinkcms.ir/rss/" required/>
                            </div>

                            <div class="form-group">
                                <label>وضعیت RSS</label>
                                <select name="status" class="form-control">
                                    <option value="1" selected>فعال</option>
                                    <option value="0">غیر فعال</option>
                                </select>
                            </div>

                            <button type="submit" name="save" class="btn btn-success">ثبت RSS جدید</button>
                            <button type="reset" class="btn btn-warning">دوباره</button>
                        </form>


                        <h2>آخرین سایت های اضافه شده:</h2>

						<?php
						/** @var Feed[] $feeds */
						$feeds = Feed::orderBy('id', 'DESC')->paginate(2);

						if ($feeds->count()){
						?>
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
								foreach ($feeds as $feed) {
									if ($feed->status == 1) {
										$activebtn = 'btn-warning';
										$showtext = 'غیر فعال کردن';
										$code = '0';
									} else {
										$activebtn = 'btn-success';
										$showtext = 'فعال کردن';
										$code = '1';
									}
									?>
                                    <tr class="default">
                                        <td><?php echo $feed->id; ?></td>
                                        <td><?php echo $feed->title; ?></td>
                                        <td>
                                            <a class="btn <?php echo $activebtn; ?> btn-xs"
                                               href="panel.php?act=feeds&active=<?php echo $code; ?>&id=<?php echo $feed->id; ?>"><i
                                                        class="fa fa-check"></i> <?php echo $showtext; ?></a>
                                            <a class="btn btn-info btn-xs" title="مشاهده لینک" target="_blank"
                                               href="<?php echo $feed->link; ?>"><i class="fa fa-link"></i> مشاهده لینک</a>
                                            <a class="btn btn-danger btn-xs" title="حذف"
                                               href="panel.php?act=feeds&delete=<?php echo $feed->id; ?>"><i
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

		$paginate = $feeds->toArray();

		if (1 < $paginate['last_page']) {
			echo '<div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate"><ul class="pagination">';
			for ($i = 0; $i < $paginate['last_page']; $i++) {
				$page = $i + 1;
				echo "<li class='paginate_button ' aria-controls='dataTables-example' tabindex='0'><a href='?act=feeds&page=$page'>$page</a></li>";
			}
			echo '</ul></div>';
		}

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
				