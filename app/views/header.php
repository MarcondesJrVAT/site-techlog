<?php
$metatags = getMetaTags();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-80522056-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-80522056-1');
  </script>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?= $title; ?></title>
  <meta name="description" content="<?= $metatags['description']; ?>">
  <meta name="keywords" content="<?= $metatags['keywords']; ?>">
  <meta name="author" content="<?= $metatags['site_name']; ?>">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
  <meta name="format-detection" content="telephone=no">

  <meta property="og:site_name" content="<?= $metatags['site_name']; ?>">
  <meta property="og:title" content="<?= $title; ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= $metatags['url']; ?>">
  <meta property="og:description" content="<?= $metatags['description']; ?>">
  <meta property="og:image" content="https://www.vat.com.br/social.jpg">
  <meta property="og:image:type" content="image/jpeg">
  <meta property="og:image:width" content="800">
  <meta property="og:image:height" content="600">
  <meta property="og:locale" content="pt_BR">

  <link rel="icon" type="image/png" href="/assets/images/favicon.ico">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:400,300,600,700' type='text/css'>
  <link rel="stylesheet" href="/assets/css/styles.min.css?v=1.0.9">

  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="fixed-header">

  <header id="header" class="h-one-h" style="background: #e77242; position: relative;">

    <div class="top-bar clearfix" style="background: #e77242;">
      <ul>
        <li><i class="icon-telephone114"></i> <a href="#">(92) 3306-4410 / (92) 3306-4405</a></li>
        <li><i class="icon-envelope"></i> <a href="mailto:comercial@techlog.com.br" target="_blank">comercial@techlog.com.br</a></li>
        <li><i class="icon-icons74"></i> <a href="https://maps.app.goo.gl/pMWj1X8TryAgQApj8" target="_blank">Manaus - AM</a></li>
      </ul>
    </div>

    <div class="container">

      <div class="header clearfix row">
        <div class="col-md-9">
          <a href="/" class="logo"><img src="/assets/images/logos/logo-techlog.png" alt=""></a>
        </div>

        <div class="col-md-3">
          <div class="text-left">
            <a href="/fale-conosco" class="btn get-in-touch animate fadeInRight" style="background-color: #e77242; border-color: #d05e2a; color: #fff;" data-text="Fale Conosco"><i class="icon-telephone114"></i>Fale Conosco</a>
          </div>
        </div>

      </div>

    </div>

  </header>
  <div style="background-color: #FEF3C7; color: #92400E; padding: 0.5rem 0; justify-items: center">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; text-align: center; font-weight: 600;"></div>
    🚧 ESTE SITE ESTÁ EM CONSTRUÇÃO. AGRADECEMOS SUA COMPREENSÃO! 🚧
  </div>
  </div>