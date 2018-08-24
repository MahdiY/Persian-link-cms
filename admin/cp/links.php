<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

if ( ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'links.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) || ! is_admin() ) {
	die ( 'Please do not load this page directly. Thanks!' );
}

if ( isset( $_GET['active'] ) && isset( $_GET['id'] ) ) {
	$sql = $db->update( '_link', array( 'status' => intval( $_GET['active'] ) ), array( 'id' => intval( $_GET['id'] ) ) );

	if ( $sql ) {
		header( "Location: panel.php?" . str_replace( '&active=' . intval( $_GET['active'] ) . '&id=' . intval( $_GET['id'] ), "", $_SERVER['QUERY_STRING'] ) );
	}
}
if ( isset( $_GET['delete'] ) ) {
	$db->delete( '_link', array( 'id' => intval( $_GET['delete'] ) ) );
	//	header( "Location: panel.php?" . str_replace( '&delete=' . intval( $_GET['delete'] ), "", $_SERVER['QUERY_STRING'] ) );
}

$offset = 20;
$from   = 0;
$paged  = 1;

if ( isset( $_GET['page'] ) && $_GET['page'] > 0 ) {
	$paged = intval( $_GET['page'] );
	$from  = ( $paged - 1 ) * $offset;
}

$sql = sprintf( "SELECT * FROM _link ORDER BY `id` DESC LIMIT %d, %d", $from, $offset );
$sql = $db->get_results( $sql );

if ( $db->num_rows > 0 ){

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
                <i class="fa fa-bar-chart-o fa-fw"></i> مدیریت لینک های ارسال شده - برگه <?php echo $paged; ?>
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
								foreach ( $sql as $row ) {

									if ( $row->status == 1 ) {
										$activebtn = 'btn-warning';
										$showtext  = 'غیر فعال کردن';
										$trstatus  = 'default';
										$code      = '0';
									} else {
										$activebtn = 'btn-success';
										$showtext  = 'فعال کردن';
										$trstatus  = 'warning';
										$code      = '1';
									}
									?>

                                    <tr class="<?php echo $trstatus; ?>">
                                        <td><?php echo $row->id; ?></td>
                                        <td><?php echo $row->title; ?></td>
                                        <td>
                                            <a class="btn <?php echo $activebtn; ?> btn-xs"
                                               href="panel.php?act=links&page=<?php echo $paged; ?>&active=<?php echo $code; ?>&id=<?php echo $row->id; ?>"><i
                                                        class="fa fa-check"></i> <?php echo $showtext; ?></a>
                                            <a class="btn btn-info btn-xs" title="مشاهده لینک" target="_blank"
                                               href="<?php echo href_link( $row->id ); ?>"><i
                                                        class="fa fa-link"></i> مشاهده لینک</a>
                                            <a class="btn btn-danger btn-xs" title="حذف"
                                               href="panel.php?act=links&page=<?php echo $paged; ?>&delete=<?php echo $row->id; ?>"><i
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
		$db->get_results( "select id from `_link`" );
		$num = ceil( $db->num_rows / $offset );
		echo pagination( $num, 5, true );

		} else {
			echo '<br/><br/><br/><br/><br/><div class="alert alert-warning alert-dismissable">چیزی یافت نشد!</div>';
			if ( isset( $_GET['page'] ) ) {
				header( "Location: panel.php?act=links" );
			}
		}
		?>

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.col-lg-8 -->
				