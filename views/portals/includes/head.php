    <!-- PHP start session -->
    <?php session_start(); ?>

    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Meta Tags -->
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="robots" content="no index, no follow">

        <!-- Title -->
        <title><?= $site_title; ?></title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

        <!-- Font Icons -->
        <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" onload="this.onload=null;this.rel='stylesheet'">

        <!-- Fonts Family -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Festive&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet"> <!-- Style -->
        <link rel="stylesheet" href="<?= $asset_url; ?>/students/css/portal.min.css?<?= time(); ?>">

    </head>

    <body>

        <header class="header">
            <div class="container-fluid">
                <section class="top-bar">
                    <h2 class="u-name">
                        Student <strong>Career</strong>
                    </h2>
                    <a href="">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </a>
                </section>
            </div>
        </header>

        <!-- Main Page -->
        <div class="body">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-2 col-sm-2">
                    <section class="sidebar">
                        <div class="container-fluid">
                            <nav class="side-bar">
                                <div class="user-p">
                                    <img src="<?= $asset_url; ?>/students/img/logo/logo_1.png">
                                </div>
                                <ul>
                                    <!-- PHP check is session level = students include student-nav.php  -->
                                    <?php if ($_SESSION['level'] == 'student') : ?>
                                        <?php require_once 'menu/student-nav.php'; ?>
                                    <?php elseif ($_SESSION['level'] == 'company') : ?>
                                        <?php include 'menu/company-nav.php'; ?>
                                    <?php elseif ($_SESSION['level'] == 'admin') : ?>
                                        <?php include 'menu/admin-nav.php'; ?>
                                    <?php endif; ?>
                                    <li>
                                        <a href="<?= $base_url; ?>/logout">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </section>
                </div>

                <!-- Main Section -->
                <div class="col-md-10 col-sm-10">
                    <div class="container-fluid">
                        <!-- Main Section -->
                        <section class="main-area">
                            <div class="portal-area">
                                <div class="row">
                                    <div class="col-md-12">