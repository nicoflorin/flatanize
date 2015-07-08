<!-- Secure Navigation -->
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
                <li class="<?php echo ($this->data['title'] == 'Home') ? 'active' : '' ?>"><a href="<?= URL ?>/home/index"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li class="<?php echo ($this->data['title'] == 'FAQ') ? 'active' : '' ?>"><a href="<?= URL ?>/home/faq"><span class="glyphicon glyphicon-question-sign"></span> FAQ</a></li>
                <li class="<?php echo ($this->data['title'] == 'About') ? 'active' : '' ?>"><a href="<?= URL ?>/home/about"><span class="glyphicon glyphicon-info-sign"></span> About</a></li>
            </ul><!-- end navbar-nav -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Your Account <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= URL ?>/app/settings"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= URL ?>/auth/logout"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
                    </ul>
                </li>
            </ul>

        </div><!-- end navbarCollapse -->
    </div> <!-- end container -->
</nav><!-- end nav -->	