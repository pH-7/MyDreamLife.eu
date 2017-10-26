<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo SITE_NAME; ?> &mdash; <?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, user-scalable=no"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,300,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="<?php echo site_url('node_modules/materialize-css/dist/css/materialize.min.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('node_modules/material-icons/css/material-icons.min.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('node_modules/flag-icon-css/css/flag-icon.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset_url('css/style.css') ?>">
    <?php include 'analytics.inc.php' ?>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
  <nav class="light-orange lighten-1" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="<?php echo site_url() ?>" class="brand-logo">MyNewDream.EU</a>
      <ul id="nav-mobile" class="right">
        <li><a "<?php echo site_url() ?>">Home</a></li>
        <li><a href="<?php echo site_url('forum') ?>" class="yellow-text">Forum</a></li>
      </ul>
    </div>
  </nav>

  <?php if (Core\Route::isHomepage()): ?>
      <header class="section no-pad-bot" id="index-banner">
        <div class="container">
          <h2 class="header center orange-text">Get A Dream Life - Dream Life Builder</h2>
          <div class="row center">
            <h5 class="header col s12 light">Build A New Life, Step-by-Step</h5>
              <h6>The FIRST European Platform that gives a <span class="underline">real full itinerary</span> for starting a new exciting life from scratch</h6>
          </div>
        </div>
      </header>
  <?php endif ?>

  <section class="container">
