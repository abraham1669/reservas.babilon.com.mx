<?php include '_funciones.php';?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="description" content="" />
    <meta name="ROBOTS" content="INDEX, FOLLOW" />
    <meta name="distribution" content="global" />
    <meta name="author" content="Genotipo Laboratorio Creativo" />
    <meta name="copyright" content="Genotipo.com" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?= $site_name ?> - Backend</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo $title; ?>">
    <meta property="og:image" content="<?php echo $image; ?>">
    <meta property="og:description" content="<?php echo $description; ?>">
    <!-- Favicon -->
    <link href="<?= base_url; ?>favicon.png" rel="icon" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= base_url; ?>favicon.png" />
    <link rel="apple-touch-icon" sizes="114x114"  href="<?= base_url; ?>apple-touch-icon-precomposed.png" />
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url; ?>css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?= base_url; ?>css/backend.min.css"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/humanity/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url ?>js/bundles/slidebars/slidebars.min.css">
    <!-- JS -->
    <script type="text/javascript">var $url = '<?= base_url ?>'; var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;</script>
    <script src="<?= base_url; ?>js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?= base_url; ?>js/vendor/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <script src="<?= base_url ?>js/vendor/bootstrap.min.js"></script>
    <script src="<?= base_url ?>js/main.js"></script>
    <?if(file_exists('.local')){?>
        <script src="http://localhost:35729/livereload.js"></script>
        <?}?>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <?php if(isset($_SESSION['session'])){?>
            <div class="layout">
                <header>
                    <div class="container">
                        <div class="row hidden-xs">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <?php include '_modulesMenu.php' ?>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 align-center">
                                <div class="logoholder">
                                <div class="img">
                                <a href="<?= base_url ?>" target="_blank">
                                <img src="<?= base_url ?>img/logo_header.png" alt="<?= $site_name ?>" title="<?= $site_name ?>"/>
                                </a>
                                </div>
                                </div>
                                </div>
                                <div class="col-lg-2 col-md-2 hidden-sm alpha">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-4 align-right">
                                <?php include '_profileMenu.php' ?>
                                </div>
                                </div>
                                <div class="row visible-xs">
                                <div class="col-lg-12 col-md-12 col-sm-12 align-center">
                                <img src="<?= base_url ?>img/logo_header.png" alt="<?= $site_name ?>" title="<?= $site_name ?>"/>
                                </div>
                                </div>

                                <div class="row visible-xs">
                                <div class="col6">
                                <?php include '_modulesMenu.php' ?>
                                </div>
                                <div class="col6 align-right">
                                <?php include '_profileMenu.php' ?>
                                </div>
                                </div>
                                </div>
                                </header>
                                </div>
                                <?php } ?>