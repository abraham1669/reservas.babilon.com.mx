<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta name="description" content="<?= $description; ?>">
    <meta name="keywords" content="<?= $keywords; ?>">
    <meta name="ROBOTS" content="INDEX, FOLLOW" />
    <meta name="author" content="<?= empresa; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <?=geo_tags;?>
    <link rel="alternate" hreflang="es-mx" href="<?=base_url;?>" />
    <meta name="DC.Language" content="es-MX">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="canonical" href="<?= page(); ?>" />
    <script type="application/ld+json">
        { 
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "<?= empresa; ?>",
            "logo" : "<?= base_url . logo; ?>",
            "url": "<?= base_url; ?>",
            "contactPoint": [{
                "@type": "ContactPoint",
                "telephone": "<?=telefono;?>",
                "contactType": "customer service"
            }],
            "sameAs": [<?php if (defined('facebook')) {echo '"'.facebook.'",';} if (defined('twitter')) {echo '"'.twitter.'",';} if (defined('gplus')) {echo '"'.gplus.'",';} if (defined('instagram')) {echo '"'.instagram.'",';} if (defined('pinterest')) {echo '"'.pinterest.'",';} if (defined('linkedin')) {echo '"'.linkedin.'",';} if (defined('youtube')) {echo '"'.youtube.'",';} ?>]
        }
    </script>
    <!-- Favicon -->
    <link href="<?= base_url; ?>img/favicon.png" rel="icon" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= base_url; ?>img/favicon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url; ?>img/touch-icon-iphone.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url; ?>img/touch-icon-ipad.png" />

    <!-- CSS -->
    <?= css(); ?>
    <script>var $url = '<?= base_url ?>';</script>

    
    <!-- <link rel="stylesheet"  href="<?=base_url;?>css/jquery-ui.min.css"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->