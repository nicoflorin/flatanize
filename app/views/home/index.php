<!-- Carousel für mainpage Infos -->
<div class="carousel slide" id="mainCarousel" data-interval="5000" data-ride="carousel"> <!-- interval in ms, auto switch -->

    <!-- Indicatoren (Punkte für das Slide wechseln) -->
    <ol class="carousel-indicators">
        <li data-slide-to="0" data-target="#mainCarousel" class="active"></li>
        <li data-slide-to="1" data-target="#mainCarousel"></li>
        <li data-slide-to="2" data-target="#mainCarousel"></li>
        <li data-slide-to="3" data-target="#mainCarousel"></li>
    </ol>

    <!-- Wrapper für slides -->
    <div class="carousel-inner">
        <div class="item active" id="slide1">
            <div class="carousel-caption">
                <h4>Whiteboard</h4>
                <!-- <p>Write important messages to the whiteboard, so all your flat mates can see them!</p> -->
            </div>
        </div><!-- end item -->
        <div class="item" id="slide2">
            <div class="carousel-caption">
                <h4>Shopping List</h4>
                <!-- <p>Create and maintain a shared shopping list!</p> -->
            </div>
        </div><!-- end item -->
        <div class="item" id="slide3">
            <div class="carousel-caption">
                <h4>Task Scheduling</h4>
                <!-- <p>Organize your daily doings in your flat with an awesome task scheduler!</p> -->
            </div>
        </div><!-- end item -->
        <div class="item" id="slide4">
            <div class="carousel-caption">
                <h4>Finances</h4>
                <!-- <p>No struggle with your expenses anymore! Flatanize keeps track of your finances.</p> -->
            </div>
        </div><!-- end item -->
    </div><!-- end carousel-inner -->

    <!-- Controls für links und rechts switchen -->
    <a class="left carousel-control" data-slide="prev" href="#mainCarousel"><span class="icon-prev fa fa-chevron-left fa-lg"></span></a>
    <a class="right carousel-control" data-slide="next" href="#mainCarousel"><span class="icon-next fa fa-chevron-right fa-lg"></span></a>

</div><!-- end mainCarousel -->

<!-- main Callout -->
<div class="well" id="mainCallout">
    <div class="page-header">
        <h1><?= TITLE ?> <small>the little helper for your flat!</small></h1>
    </div><!-- end page-header -->
    <p class="lead">Let all the trouble of organize your living in a flat in the past and start to care about the real important things.</p>
    <p class="lead">With flatanize it’s never been more comfortable and easier to maintain a shared flat.</p>
    <a href="<?= URL ?>/register/signUp" class="btn btn-large btn-primary">Sign Up now!</a>
    <p class="margin-top-20">If you need any help, check out the <a href="<?= URL ?>/home/faq" alt="FAQ">FAQ</a> page.</p>
</div><!-- end mainCallout -->
