<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top">
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
            <a class="brand" href="<?= URL ?>"><img src="/public/images/brand.png" alt="brand" /></a>
        </div><!-- end navbar-header -->

        <!-- Collect the nav links and forms for toggling -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="nav navbar-nav">
                <li class="<?php echo ($this->data['title'] == 'Home') ? 'active' : '' ?>"><a href="<?= URL ?>"><i class="fa fa-home fa-lg fa-fw"></i> Home</a></li>
                <li class="<?php echo ($this->data['title'] == 'FAQ') ? 'active' : '' ?>"><a href="<?= URL ?>/home/faq"><i class="fa fa-question-circle fa-lg fa-fw"></i> FAQ</a></li>
                <li class="<?php echo ($this->data['title'] == 'About') ? 'active' : '' ?>"><a href="<?= URL ?>/home/about"><i class="fa fa-info-circle fa-lg fa-fw"></i>  About</a></li>
                <li class="<?php echo ($this->data['title'] == 'Sign Up') ? 'active' : '' ?>"><a href="<?= URL ?>/register/index"><i class="fa fa-pencil-square-o fa-lg fa-fw"></i> Sign Up</a></li>
            </ul><!-- end navbar-nav -->

            <!-- login navbar -->
            <form class="navbar-form navbar-right" action="<?= URL ?>/auth/login" method="post">
                <div class="form-group ">
                    <input type="text" placeholder="User Name" class="form-control" id="username" name="username" tabindex="1" required>
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control" id="password" name="password" tabindex="2" required>
                </div>

                <button type="submit" class="btn btn-success" tabindex="3">Login</button>

                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary"><input type="checkbox" id="remember" name="remember" tabindex="4"> Remember</label>
                </div>
            </form><!-- end login -->
        </div><!-- end navbarCollapse -->
    </div> <!-- end container -->
</nav><!-- end nav -->	