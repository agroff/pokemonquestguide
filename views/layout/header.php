<!doctype html>

<html class="no-js" lang="en">

<head>

    <?php require "metas.php" ?>


    <link rel="shortcut icon" href="/img/favicon.png"/>
    <link rel="apple-touch-icon" href="/img/favicon.png"/>

    <!-- Place favicon.ico and apple-touch-icon(s) in the root directory -->
    <!-- Web fonts and Web Icons -->
    <link rel="stylesheet" href="/fonts/opensans/stylesheet.css">
    <!--    <link rel="stylesheet" href="/fonts/montserrat/stylesheet.css">-->
    <link rel="stylesheet" href="/fonts/roboto/stylesheet.css">
    <link rel="stylesheet" href="/fonts/ionicons.min.css">


    <!-- Uncomment below to load individualy vendor CSS -->
    <link rel="stylesheet" href="/css/foundation.min.css">
    <link rel="stylesheet" href="/js/vendor/swiper.min.css">
    <link rel="stylesheet" href="/js/vendor/jquery.fullpage.min.css">

    <!-- Main CSS files -->
    <link rel="stylesheet" href="/css/main.css">
    <!-- alt layout -->
    <link rel="stylesheet" href="/css/style-color3.css">

    <script src="/js/vendor/modernizr-2.7.1.min.js"></script>

    <!-- ADSENSE-->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-2194128563708434",
            enable_page_level_ads: true
        });
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async
            src="https://www.googletagmanager.com/gtag/js?id=UA-10831320-9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-10831320-9');
    </script>
</head>

<body id="menu" class="hh-body alt-bg left-light">
<!--[if lt IE 8]>
<p class="browsehappy">You are using an
    <strong>outdated</strong>
    browser. Please
    <a href="http://browsehappy.com/">upgrade
        your browser
    </a>
    to improve your experience.
</p>
<![endif]-->


<!-- BEGIN OF site header Menu -->
<header class="hh-header header-top">
    <?php include "header-element.php" ?>

</header>

<!-- END OF site header Menu-->

<!-- BEGIN OF page cover -->
<div class="hh-cover page-cover">
    <!-- Cover Background -->
    <div class="cover-bg pos-abs full-size bg-img  bg-blur-0"
         data-image-src="/img/bg-default3.jpg"></div>


    <!-- Transluscent mask as filter -->
    <div class="cover-bg-mask pos-abs full-size bg-color"
         data-bgcolor="rgba(255, 255, 255, 0.8)"></div>

</div>
<!--END OF page cover -->


<!-- BEGIN OF page main content -->
<main class="page-main fullpg" id="mainpage">

    <!-- Begin of home section -->
    <div class="section section-home fp-auto-height-responsive" data-section="home">
        <div class="content">
            <!-- Begin of Content -->
            <div class="c-pos-1-4 c-columns">
                <div class="c-logo ">
                    <span class="ion-ios-home-outline icon visible-for-large-up"></span>
                    <div class="top">
                        <?php require "side-menu.php"; ?>
                    </div>

                </div>