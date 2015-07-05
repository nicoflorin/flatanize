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
                        <a class="navbar-brand" href="<?= URL ?>">FLATANIZE</a>

                    </div><!-- end navbar-header -->

                    <!-- Collect the nav links and forms for toggling -->
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="<?= URL ?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                            <li><a href="<?= URL ?>/home/faq"><span class="glyphicon glyphicon-question-sign"></span> FAQ</a></li>
                            <li><a href="<?= URL ?>/home/about"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
                            <li><a href="<?= URL ?>/register/signUp"><span class="glyphicon glyphicon-pencil"></span> Sign Up</a></li>
                        </ul><!-- end navbar-nav -->

                        <!-- login navbar -->
                        <form class="navbar-form navbar-right" action="<?= URL ?>/auth/login" method="post">
                            <div class="form-group ">
                                <input type="text" placeholder="User Name" class="form-control" name="l_username">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" class="form-control" name="l_password">
                            </div>

                            <button type="submit" class="btn btn-success">Login</button>

                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary"><input type="checkbox" id="rememberMe"> Remember</label>
                            </div>
                        </form><!-- end login -->

                    </div><!-- end navbarCollapse -->
                </div> <!-- end container -->
            </nav><!-- end nav -->	