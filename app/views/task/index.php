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

            <div id="taskContent" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
                <!-- create New Task -->
                <div>
                    <a class="btn btn-success" href="<?= URL ?>/task/showCreateTask" role="button">Create New Task</a>
                    <button type="submit" class="btn btn-primary pull-right" onClick="window.location.reload(true)">
                        <span class="glyphicon glyphicon-repeat"></span>
                    </button>
                </div>
                <br>
                <!-- Flat schedules -->
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Scheduled Tasks</h3>
                    </div>

                    <div class="alert alert-info" role="alert" <?php echo (!empty($this->taskList)) ? 'style="display:none;"' : '' ?>>
                        <p>There are no scheduled tasks available.</p>
                    </div>
                    <table class="table">
                        <thead class="nopadding">
                            <tr>
                                <th class="col-xs-5 nopadding"></th>
                                <th class="col-xs-5 nopadding"></th>
                                <th class="col-xs-2 nopadding"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($this->taskList as $key => $entry) {
                                //prüfen ob Datum in vergangenheit
                                if (strtotime($entry['start']) < time()) {
                                    $this->dateError[$key] = true;
                                }
                                ?>
                                <tr class="<?php echo (isset($this->dateError[$key])) ? 'bg-danger' : '' ?>">
                                    <td>
                                        <strong><?= $entry['title'] ?></strong>
                                        <p><?= $entry['description'] ?></p>
                                        <strong class="text-danger" <?php echo (!isset($this->dateError[$key])) ? 'style="display:none;"' : '' ?>>overdue</strong>
                                    </td>

                                    <td>
                                        <p> <?= $entry['display_name'] ?>'s turn</p>
                                        <p>On <?= $entry['day'] ?></p>
                                    </td>

                                    <td>
                                        <a href="<?php echo URL . '/task/setTaskDone/' . $entry['id'] ?>" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></a>
                                        <a href="<?php echo URL . '/task/deleteTask/' . $entry['id'] ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?><!-- end foreach -->
                    </table>

                </div><!-- end panel -->
            </div><!-- end taskContent -->
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->