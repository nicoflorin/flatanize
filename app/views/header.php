<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- mobile first, no zoom on mobile -->
        <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1, user-scalable=no">
        <title>Homepage - Home</title>

        <!-- Bootstrap -->
        <link href="<?php echo URL; ?>/public/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo URL; ?>/public/css/styles.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="container">

                    <div class="navbar-header">
                        <!-- button for menu when on mobile -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Titel -->
                        <a class="navbar-brand" href="index.php">FLATANIZE</a>

                    </div><!-- end navbar-header -->

                    <!-- Collect the nav links and forms for toggling -->
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                            <li><a href=""><span class="glyphicon glyphicon-question-sign"></span> FAQ</a></li>
                            <li><a href=""><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
                            <li><a href=""><span class="glyphicon glyphicon-pencil"></span> Sign Up</a></li>
                        </ul><!-- end navbar-nav -->

                        <!-- login navbar -->
                        <form class="navbar-form navbar-right" action="action.php" method="post">
                            <div class="form-group ">
                                <input type="text" placeholder="Username" class="form-control" id="inputUsername">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" class="form-control" id="inputPassword">
                            </div>

                            <button type="submit" class="btn btn-success">Login</button>

                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary"><input type="checkbox" id="rememberMe"> Remember</label>
                            </div>
                            <!-- copyright, only on small devices, hidden in footer -->
                            <p class="visible-xs">&copy; 2015 Nico Florin All Rights Reserved</p>
                        </form><!-- end login -->

                    </div><!-- end navbarCollapse -->
                </div> <!-- end container -->
            </nav><!-- end nav -->	