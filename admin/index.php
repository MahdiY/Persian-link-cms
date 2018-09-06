<?php
/*
 * Persian Link CMS
 * Powered By www.PersianLinkCMS.ir
 * Author : Mohammad Majidi & Mahdi Yousefi (MahdiY.ir)
 * VER 2.2
 * copyright 2011 - 2018
*/

session_start();
include( "../vendor/autoload.php" );
$error = '';

if( is_admin() ) {
    header( 'location: panel.php' );
    die();
}

if( isset( $_POST['login'] ) ) {

    $username = $_POST['username'];
    $password = md5( $_POST['password'] );

    if( $_POST['security'] == $_SESSION['security_number'] && !empty( $_POST['security'] ) && strlen( $_POST['security'] ) == 5 ) {

        if( $password == get_option( 'user_pass' ) && $username == get_option( 'user_name' ) ) {
            
            $_SESSION['user_login'] = $username;
            $_SESSION['user_passw'] = $password;
            header( "location: panel.php" );
            die();

        } else {
            $error = "نام کاربری یا رمز عبور معتبر نمی باشد.";
        }
    } else {
        $error = "کد امنیتی به درستی وارد نشده است.";
    }
    if( $error == true ) {
        $error = '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> ' . $error . ' </div>';
    }

    $_SESSION['security_number'] = md5( rand() );
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="PersianScript.ir">

    <title>ورود به مدیریت</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">وارد شوید</h3>
                </div>
                <div class="panel-body">
                    <?php echo $error; ?>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="نام کاربری" name="username" type="text"
                                       autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="رمز عبور" name="password" type="password"
                                       value="">
                            </div>
                            <div class="form-group">
                                کد امنیتی: <img border="0" src="../captcha.php"/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="ورود کد امنیتی" name="security" type="text">
                            </div>

                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" name="login" class="btn btn-lg btn-success btn-block">ورود</button>
                        </fieldset>
                    </form>
                </div>
            </div>
            <a href="<?php echo get_option( 'site_url' ); ?>">← بازگشت به سایت</a>
        </div>
    </div>
</div>

<!-- jQuery Version 1.11.0 -->
<script src="js/jquery-1.11.0.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/sb-admin-2.js"></script>

</body>

</html>
