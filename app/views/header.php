<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <!-- mobile zuerst, kein zoomen auf Smartphone möglich -->
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title><?= TITLE ?> - <?= $this->data['title'] ?></title>
        <!-- @Todo Meta tags wie description, keywords, author usw. -->

        <!-- Bootstrap -->
        <link href="<?= URL ?>/public/css/bootstrap.min.css" rel="stylesheet">

        <!-- font-awesome -->
        <link href="<?= URL ?>/public/css/font-awesome.min.css" rel="stylesheet">

        <!-- own Stylesheet -->
        <link href="<?= URL ?>/public/css/styles.css" rel="stylesheet">
        
        <!-- Muli font -->
        <link href="http://fonts.googleapis.com/css?family=Muli:300" rel="stylesheet" type="text/css">
        
        <!-- @Todo favicon -->
        
        <!-- @Todo SEO Tags -->
        
        <!-- iOS -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="<?= TITLE ?>">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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