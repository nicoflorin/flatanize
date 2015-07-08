<div class="row">
    <div class="col-md-3 col-xs-12">
        <?php require_once ROOT . '/app/views/app/' . 'left_nav.php'; ?>
    </div>

    <div class="col-md-9 col-xs-12">
        <div class="well">
            <div class="page-header">
                <h1><?= $this->data['title'] ?></h1>
            </div>

            <!-- create New Task -->
            <div>
                <a class="btn btn-primary" href="<?= URL ?>/cleaning/addNewTask" role="button">Create New Task</a>
            </div>
            
            <!-- Flat schedules -->
            <div>
                <h3>Flat schedules</h3>
            </div>
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->