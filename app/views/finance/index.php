<div class="row">
    <div class="col-md-3 col-xs-12">
        <?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
    </div>

    <div class="col-md-9 col-xs-12">
        <div class="well">
            <div class="page-header">
                <h1><?= $this->data['title'] ?></h1>
            </div>

            <div class="alert alert-success" role="alert" <?php echo (Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <p>Please create or join a flat <a href="<?= URL ?>/settings/index"> here.</a></p>
            </div>

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <li class="active"><a data-toggle="tab" href="#financeEntry">Entries</a></li>
                <li><a data-toggle="tab" href="#financeBalance">Balance</a></li>
            </ul><!-- end nav -->
            <br />
            <div class="tab-content" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                    <?php require_once 'finance_entry.php'; ?>
                    <?php require_once 'finance_balance.php'; ?>
            </div><!-- end tab-content -->
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->