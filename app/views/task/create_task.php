<?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
<div id="mainContent" class="well">
    <!-- Label damit ganzer Content Rechts clickbar wird, wenn collapsed -->
    <label id="bigLabel" for="leftMenuBtn" class="bigLabel"></label>
    <div class="page-header">
        <h1><i class="fa fa-wrench fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>
    <!-- Create a Task -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Create a new task</h3>
        </div>
        <div class="panel-body">
            <form method="post" action="<?= URL ?>/task/createTask">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-thumb-tack fa-lg"></i></span>
                        <input type="text" id="title" name="title" class="form-control" placeholder="Title" tabindex="1" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-repeat fa-lg"></i></span>

                        <select name="frequency" class="form-control" tabindex="2" required> 
                            <option value="" disabled selected>Select frequency</option>
                            <option value="<?= ONCE ?>">once</option>
                            <option value="<?= DAILY ?>">daily</option>
                            <option value="<?= WEEKLY ?>">weekly</option>
                            <option value="<?= MONTHLY ?>">every month</option>
                        </select>
                    </div>
                </div>
                <!-- @Todo evtl. als Button lösen, sonst löschen -->
                <!--
                <div class="form-group">
                    <div data-toggle="buttons">
                        <label class="btn btn-default">
                            <input type="radio" id="once" name="frequency" value="<?= ONCE ?>"><?= ONCE ?>
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" id="daily" name="frequency" value="<?= DAILY ?>"><?= DAILY ?>
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" id="weekly" name="frequency" value="<?= WEEKLY ?>"><?= WEEKLY ?>
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" id="monthly" name="frequency" value="<?= MONTHLY ?>"><?= MONTHLY ?>
                        </label>
                    </div>
                </div>
                -->
                <div class="form-group <?php echo (isset($this->data['date'])) ? 'has-error' : '' ?>">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
                        <input type="date" id="start" name="start" class="form-control" placeholder="Start Date" tabindex="4" required>
                    </div>
                    <?php
                    if (isset($this->data['date'])) {
                        echo '<span class="help-block">Date format must be: "DD.MM.YYYY" or "YYYY-MM-DD"!</span>';
                    }
                    ?>
                </div>
                <p>Who needs to do it all?</p>
                <div class="form-group <?php echo (isset($this->data['users'])) ? 'has-error' : '' ?>">
                    <div data-toggle="buttons">
                        <?php
                        foreach ($this->userList as $key => $user) {
                            echo '<label class="btn btn-default">';
                            echo '<input type="checkbox" name="user[]" value="' . $key . '" tabindex="4">' . $user;
                            echo '</label>';
                        }
                        ?>
                    </div>
                    <?php
                    if (isset($this->data['users'])) {
                        echo '<span class="help-block">Select at least one resident!</span>';
                    }
                    ?> 
                </div>

                <div class="form-group">
                    <input type="submit" value="Create Task" class="btn btn-success btn-block btn-lg" tabindex="5">
                </div>
            </form>
        </div><!-- end panel-body -->
    </div><!-- end panel -->
</div><!-- end mainContent -->