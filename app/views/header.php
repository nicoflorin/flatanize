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

        <!-- Bootstrap -->
        <link href="<?= URL ?>/public/css/bootstrap.min.css" rel="stylesheet">

        <!-- font-awesome -->
        <link href="<?= URL ?>/public/css/font-awesome.min.css" rel="stylesheet">

        <!-- own Stylesheet -->
        <link href="<?= URL ?>/public/css/styles.min.css" rel="stylesheet">

        <!-- Muli font -->
        <link href="<?= PROTOCOL ?>://fonts.googleapis.com/css?family=Muli:300" rel="stylesheet" type="text/css">

        <!-- @Todo favicon -->

        <!-- iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="<?= TITLE ?>">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">

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