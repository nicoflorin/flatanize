<!-- Secure Navigation -->
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

            <!-- left Navbar toggle -->
            <button id="leftMenuBtn" type="button" class="navbar-toggle hidden-lg">
                <i id="leftMenuIcon" class="fa fa-chevron-right whiteIcon"></i>
            </button>

            <!-- Titel -->
            <a class="brand" href="<?= URL ?>"><img src="<?= URL ?>/public/images/brand.png" alt="brand" /></a>
            

        </div><!-- end navbar-header -->

        <!-- Collect the nav links and forms for toggling -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="nav navbar-nav">
                <li class="<?php echo ($this->data['title'] != 'FAQ' && $this->data['title'] != 'About') ? 'active' : '' ?>"><a href="<?= URL ?>/home/index"><i class="fa fa-home fa-lg fa-fw"></i> Home</a></li>
                <li class="<?php echo ($this->data['title'] == 'FAQ') ? 'active' : '' ?>"><a href="<?= URL ?>/home/faq"><i class="fa fa-question-circle fa-lg fa-fw"></i> FAQ</a></li>
                <li class="<?php echo ($this->data['title'] == 'About') ? 'active' : '' ?>"><a href="<?= URL ?>/home/about"><i class="fa fa-info-circle fa-lg fa-fw"></i> About</a></li>
            </ul><!-- end navbar-nav -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-lg fa-fw"></i> Your Account <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= URL ?>/settings/flatSetting"><i class="fa fa-building fa-lg fa-fw"></i> Flat Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= URL ?>/settings/userSettings"><i class="fa fa-street-view fa-lg fa-fw"></i> User Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= URL ?>/auth/logout"><i class="fa fa-sign-out fa-lg fa-fw"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>

        </div><!-- end navbarCollapse -->
    </div> <!-- end container -->
</nav><!-- end nav -->	