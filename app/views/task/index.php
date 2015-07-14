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
                        <h3 class="panel-title">Your Scheduled Tasks</h3>
                    </div>
                    <!-- no tasks available -->
                    <div class="panel-body" <?php echo (!empty($this->taskList)) ? 'style="display:none;"' : '' ?>>
                        <p class="text-info">There are no scheduled tasks available.</p>
                    </div>

                    <table class="table table-hover" <?php echo (empty($this->taskList)) ? 'style="display:none;"' : '' ?>>
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
                                ?>
                                <tr class="<?php echo (isset($entry['overdue'])) ? 'bg-danger' : '' ?>">
                                    <td>
                                        <strong><?= $entry['title'] ?></strong>
                                        <p><?= $entry['description'] ?></p>
                                        <?php
                                        // Falls fällig, Meldung anzeigen
                                        if (isset($entry['overdue'])) {
                                            echo '<strong class="text-danger">overdue</strong>';
                                        } elseif (isset($entry['today'])) { // Falls Heute Meldung anzeigen
                                            echo '<strong class="text-success">today</strong>';
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <p><?= $entry['display_name'] ?>'s turn</p>
                                        <p>On <strong><?= $entry['day'] ?></strong>, <?= $entry['next_date'] ?></p>
                                    </td>

                                    <td class="text-right">
                                        <form action="<?php echo URL . '/task/setTaskDone'; ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button>
                                        </form>
                                        <br>
                                        <form action="<?php echo URL . '/task/deleteTask'; ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                                            <button type="submit" class="btn btn-danger" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span></button>
                                        </form>

                                    </td>
                                </tr>
                                <?php
                            }
                            ?><!-- end foreach -->
                        </tbody>
                    </table>
                </div><!-- end panel -->
            </div><!-- end taskContent -->
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->