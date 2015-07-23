<?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
<div id="mainContent" class="well">
    <!-- Label damit ganzer Content Rechts clickbar wird, wenn collapsed -->
    <label id="bigLabel" for="leftMenuBtn" class="bigLabel"></label>
    <div class="page-header">
        <h1><i class="fa fa-wrench fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>
    <div class="alert alert-success" role="alert" <?php echo (Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
        <p>Please create or join a flat <a href="<?= URL ?>/settings/index"> here.</a></p>
    </div>

    <?php if (Session::getFlatId()) : ?>
        <div id="taskContent">
            <!-- create New Task -->
            <div>
                <a class="btn btn-success" href="<?= URL ?>/task/showCreateTask" role="button">Create New Task</a>
                <button type="submit" class="btn btn-primary pull-right" onClick="window.location.reload(true)">
                    <i class="fa fa-refresh fa-lg fa-"></i>
                </button>
            </div>
            <br>

            <!-- User Flat schedules -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Your Next Tasks</h3>
                </div>
                <?php if (empty($this->userTaskList)) : ?>
                    <!-- no tasks available -->
                    <div class="panel-body">
                        <p class="text-info">You have no open tasks.</p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($this->userTaskList)) : ?>
                    <table class="table table-hover">
                        <thead class="nopadding">
                            <tr>
                                <th class="col-xs-5 nopadding"></th>
                                <th class="col-xs-4 nopadding"></th>
                                <th class="col-xs-3 nopadding"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->userTaskList as $key => $entry) : ?>
                                <!-- row als Link zu Modal -->
                                <tr class="<?php echo (isset($entry['overdue'])) ? 'bg-danger' : '' ?>">
                                    <td onclick="input" data-toggle="modal" href="#TaskInfoId<?= $entry['id'] ?>">
                                        <strong><?= $entry['title'] ?></strong>
                                        <p><?= $entry['description'] ?></p>
                                        <?php if (isset($entry['overdue'])) : // Falls fällig, Meldung anzeigen ?>
                                            <strong class="text-danger">overdue</strong>
                                        <?php elseif (isset($entry['today'])) : // Falls Heute Meldung anzeigen ?>
                                            <strong class="text-success">today</strong>
                                        <?php else : ?>
                                            <p>due in <?= $entry['due_in'] ?> <?php echo ($entry['due_in'] == 1) ? 'day' : 'days' ?></p>
                                        <?php endif; ?>
                                    </td>

                                    <td onclick="input" data-toggle="modal" href="#TaskInfoId<?= $entry['id'] ?>">
                                        <p>On <strong><?= $entry['day'] ?></strong>, <?= $entry['next_date'] ?></p>
                                    </td>

                                    <td class="text-right">
                                        <form action="<?php echo URL . '/task/setTaskDone'; ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-lg"></i></button>
                                            <i class="fa fa-chevron-right"></i>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div><!-- end panel -->

            <!-- All other Flat schedules -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Your Mates Next Tasks</h3>
                </div>
                <?php if (empty($this->taskList)) : ?>
                    <!-- no tasks available -->
                    <div class="panel-body">
                        <p class="text-info">There are no scheduled tasks available.</p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($this->taskList)) : ?>
                    <table class="table table-hover">
                        <thead class="nopadding">
                            <tr>
                                <th class="col-xs-5 nopadding"></th>
                                <th class="col-xs-4 nopadding"></th>
                                <th class="col-xs-3 nopadding"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->taskList as $key => $entry) : ?>
                                <!-- row als Link zu Modal -->
                                <tr class="<?php echo (isset($entry['overdue'])) ? 'bg-danger' : '' ?>">
                                    <td onclick="input" data-toggle="modal" href="#TaskInfoId<?= $entry['id'] ?>">
                                        <strong><?= $entry['title'] ?></strong>
                                        <p><?= $entry['description'] ?></p>
                                        <?php if (isset($entry['overdue'])) : // Falls fällig, Meldung anzeigen ?>
                                            <strong class="text-danger">overdue</strong>
                                        <?php elseif (isset($entry['today'])) : // Falls Heute Meldung anzeigen ?>
                                            <strong class="text-success">today</strong>
                                        <?php else : ?>
                                            <p>due in <?= $entry['due_in'] ?> <?php echo ($entry['due_in'] == 1) ? 'day' : 'days' ?></p>
                                        <?php endif; ?>
                                    </td>

                                    <td onclick="input" data-toggle="modal" href="#TaskInfoId<?= $entry['id'] ?>">
                                        <p><?= $entry['display_name'] ?>'s turn</p>
                                        <p>On <strong><?= $entry['day'] ?></strong>, <?= $entry['next_date'] ?></p>
                                    </td>

                                    <td class="text-right">
                                        <form action="<?php echo URL . '/task/setTaskDone'; ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-lg"></i></button>
                                            <i class="fa fa-chevron-right"></i>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div><!-- end panel -->

            <!-- Modal für Task Information -->
            <div id="taskModal">
                <?php
                foreach ($this->allTaskList as $entry) {
                    ?>
                    <div id="TaskInfoId<?= $entry['id'] ?>" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Task Informations</h4>
                                </div>
                                <div class="modal-body">
                                    <h4><?= $entry['title'] ?></h4>
                                    <p>On: <?= $entry['day'] ?>, <?= $entry['next_date'] ?></p>
                                    <p>Scheduled: <?= $entry['description'] ?></p>
                                    <p>Next is <?= $entry['display_name'] ?></p>
                                    <br>
                                    <?php if (isset($entry['overdue'])) : // Falls fällig, Meldung anzeigen ?>
                                        <p>This task is <strong class="text-danger">overdue!</strong></p>
                                    <?php elseif (isset($entry['today'])) : // Falls Heute Meldung anzeigen ?>
                                        <p>This task is due <strong class="text-success">today!</strong></p>
                                    <?php else : ?>
                                        <p>This task is due in <?= $entry['due_in'] ?> <?php echo ($entry['due_in'] == 1) ? 'day' : 'days' ?>.</p>
                                    <?php endif; ?>

                                </div>
                                <div class="modal-footer">
                                    <form method="post" action="<?= URL ?>/task/deleteTask">
                                        <input type="hidden" name="id" value="<?= $entry['id'] ?>">
                                        <input type="submit" class="btn btn-danger pull-left" value="Delete">
                                    </form>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div><!-- end modal -->
                    </div><!-- end TaskInfoId -->
                    <?php
                }
                ?>
            </div><!-- financeModal -->
        </div><!-- end taskContent -->
    <?php endif; ?>
</div><!-- end mainContent -->