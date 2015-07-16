            <!-- Carousel for mainpage Infos -->
            <div class="carousel slide" id="mainCarousel" data-interval="5000" data-ride="carousel"> <!-- interval in ms, auto switch -->

                <!-- Indicators (dots for change slides) -->
                <ol class="carousel-indicators">
                    <li data-slide-to="0" data-target="#mainCarousel" class="active"></li>
                    <li data-slide-to="1" data-target="#mainCarousel"></li>
                    <li data-slide-to="2" data-target="#mainCarousel"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active" id="slide1">
                        <div class="carousel-caption">
                            <h4>Slide 1</h4>
                            <p>blabla blablab alblab lablablab albla blabl ablabalblablab lablabal</p>
                        </div>
                    </div><!-- end item -->
                    <div class="item" id="slide2">
                        <div class="carousel-caption">
                            <h4>Slide 2</h4>
                            <p>blabla blablab alblab lablablab albla blabl ablabalblablab lablabal</p>
                        </div>
                    </div><!-- end item -->
                    <div class="item" id="slide3">
                        <div class="carousel-caption">
                            <h4>Slide 3</h4>
                            <p>blabla blablab alblab lablablab albla blabl ablabalblablab lablabal</p>
                        </div>
                    </div><!-- end item -->
                </div><!-- end carousel-inner -->

                <!-- Controls for left and right icon-->
                <a class="left carousel-control" data-slide="prev" href="#mainCarousel"><span class="icon-prev fa fa-chevron-left fa-lg"></span></a>
                <a class="right carousel-control" data-slide="next" href="#mainCarousel"><span class="icon-next fa fa-chevron-right fa-lg"></span></a>

            </div><!-- end mainCarousel -->

            <!-- main Callout -->
            <div class="well" id="mainCallout">
                <div class="page-header">
                    <h1>A Fancy Header <small>A subheader for extras</small></h1>
                </div><!-- end page-header -->

                <p class="lead">Some solid leading copy text comes here</p>

                <a href="<?= URL ?>/home/signUp" class="btn btn-large btn-primary">Sign Up now!</a>
            </div><!-- end mainCallout -->
