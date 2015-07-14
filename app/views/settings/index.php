<div class="row">
    <div class="col-md-3 col-xs-12">
        <?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
    </div>

    <div class="col-md-9 col-xs-12">
        <div class="well">
            <div class="page-header">
                <h1><?= $this->data['title'] ?></h1>
            </div>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#flatSettings">Flat settings</a></li>
                <li><a data-toggle="tab" href="#userSettings">User settings</a></li>
            </ul><!-- end nav -->
            <br />
            <div class="tab-content">
                <?php require_once 'flatSettings.php'; ?>
                <?php require_once 'userSettings.php'; ?>
            </div><!-- end tab-content -->
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->