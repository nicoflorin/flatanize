<div class="row">
    <div class="col-md-3 col-xs-12">
        <?php require_once ROOT . '/app/views/app/' . 'left_nav.php'; ?>
    </div>

    <div class="col-md-9 col-xs-12">
        <div class="well">
            <div class="page-header">
                <h1><?= $this->data['title'] ?></h1>
            </div>

            <div class="alert alert-success" role="alert" <?php echo (Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <p>Please create or join a flat <a href="<?= URL ?>/settings/index"> here.</a></p>
            </div>

            <div id="cleaningContent" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <!-- create New Task -->
                <div>
                    <a class="btn btn-success" href="<?= URL ?>/cleaning/showCreateTask" role="button">Create New Task</a>
                </div>
                <br>
                <!-- Flat schedules -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Scheduled Tasks</h3>
                    </div>
                    <div class="panel-body">
                    <?php
                    foreach ($this->taskList as $entry) {
                        ?>
                        <div class="row">
                            <div class="col-xs-5">
                                <strong><?= $entry['title'] ?></strong>
                                <p><?= $entry['description'] ?></p>
                            </div>
                            <div class="col-xs-5">
                                <p><?= $entry['display_name'] ?></p>
                                <p><?= $entry['day'] ?></p>
                            </div>
                            <div class="col-xs-2">
                                <a href="<?php echo URL . '/cleaning/setTaskDone/' . $entry['id'] ?>" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a>
                                <a href="<?php echo URL . '/cleaning/setTaskDone/' . $entry['id'] ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                        </div>
                        <hr>
                        <?php
                    }
                    ?><!-- end foreach -->
                    </div><!-- end panel-body -->
                </div><!-- end panel -->
            </div><!-- end cleaningContent -->
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->