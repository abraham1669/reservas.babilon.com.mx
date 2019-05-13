<?php $sec = isset($sec) ? $sec : null ?>
</head>
<body>
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <header id="header-main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h6 class="logo"><a href="<?= base_url; ?>"><?=empresa?></a></h6>

                    <nav class="menu-main">
                        <a href="javascript:void(0)" class="closebtn visible-xs visible-sm"><i class="far fa-times-circle"></i></a>
                        <h6 class="logo visible-xs visible-sm"><a href="<?= base_url; ?>"><?=empresa?></a></h6>
                        <ul class="tcenter">
                            <li <?php if($sec === "home"){echo "class=\"activo\"";}?>><a href="<?= base_url; ?>">HOME</a></li>
                            <li <?php if($sec === "babilon"){echo "class=\"activo\"";}?>><a href="<?= base_url; ?>hotels">HOTELS</a></li>
                            <li <?php if($sec === "blog"){echo "class=\"activo\"";}?>><a href="<?= base_url; ?>blog">BLOG</a></li>
                            <li><a href="<?= base_url; ?>contacto" class="btn-gral">CONTACT US</a></li>
                            <li><a href="javascript:;" class="idiomas"><img src="<?=base_url;?>img/mexico.png" alt="" class="idioma"> ES</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="visible-sm visible-xs">
                    <div class="pleca-movil">
                        <button class="menu-mobil visible-xs visible-sm">Menu</button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- <div class="clearfix h20"></div> -->

