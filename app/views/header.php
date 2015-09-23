<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <!-- mobile zuerst, kein zoomen auf Smartphone möglich -->
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title><?= TITLE ?> - <?= $this->data['title'] ?></title>
        <META NAME="author" CONTENT="Nico Florin">
        <META NAME="subject" CONTENT="Home, Organize, Planning">
        <META NAME="Description" CONTENT="An application to organize your flat. It includes functions like a whiteboard, finance/budget planning, a shared shopping list and a task Scheduler.">
        <META NAME="Keywords" CONTENT="flat, resident, apartment, share, living, community, organize, finances, shopping list, task scheduler, expenses, planning, wg, wohngemeinschaft, organisieren, ausgaben, einkaufsliste, finanzplanung, aufgabenplanung">
        <META NAME="Language" CONTENT="English">
        <META NAME="Copyright" CONTENT="Nico Florin">
        <META NAME="distribution" CONTENT="Global">
        
        <!-- Favicon -->
        <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/public/images/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/public/images/favicon-16x16.png">

        <!-- Bootstrap -->
        <link href="/public/css/bootstrap.min.css" rel="stylesheet">

        <!-- font-awesome -->
        <link href="/public/css/font-awesome.min.css" rel="stylesheet">

        <!-- own Stylesheet -->
        <link href="/public/css/styles.min.css" rel="stylesheet">

        <!-- Muli font -->
        <link href="<?= PROTOCOL ?>://fonts.googleapis.com/css?family=Muli:300" rel="stylesheet" type="text/css">

        <!-- iOS / WebApp -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="<?= TITLE ?>">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
        <link rel="apple-touch-icon" sizes="57x57" href="/public/images/webapp/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/public/images/webapp/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/public/images/webapp/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/public/images/webapp/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/public/images/webapp/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/public/images/webapp/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/public/images/webapp/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/public/images/webapp/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/public/images/webapp/apple-icon-180x180.png">

    </head>
    <body>
        <div id="wrapper">
            <?php
            if (Session::isLoggedIn()) {
                require_once ROOT . '/app/views/nav_sec.php';
            } else {
                require_once ROOT . '/app/views/nav.php';
            }
            ?>

            <!-- main container -->
            <div class="container" id="mainContainer">