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
                <a class="btn btn-success" href="<?= URL ?>/cleaning/showCreateTask" role="button">Create New Task</a>
            </div>
            <br>
            <!-- Flat schedules -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Scheduled Tasks</h3>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-xs-7">Title</th>
                            <th class="col-xs-2">Freq.</th>
                            <th class="col-xs-1">On</th>
                            <th class="col-xs-2">Start</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->taskList as $value) {
                            echo '<tr>';
                            echo '<td>' . $value['title'] . '</td>';
                            echo '<td>' . $value['description'] . '</td>';
                            echo '<td>' . $value['day'] . '</td>';
                            echo '<td>' . $value['start'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div><!-- end panel -->
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->