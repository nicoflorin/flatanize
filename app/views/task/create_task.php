<div class="row">
    <div class="col-md-3 col-xs-12">
        <?php require_once ROOT . '/app/views/app/' . 'left_nav.php'; ?>
    </div>

    <div class="col-md-9 col-xs-12">
        <div class="well">
            <div class="page-header">
                <h1><?= $this->data['title'] ?></h1>
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
                                <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span>
                                <input type="text" id="title" name="title" class="form-control" placeholder="Title" tabindex="1" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-repeat"></span></span>
                                <!-- @todo auswahl per button -->
                                <select name="frequency" class="form-control" tabindex="2" required> 
                                    <option value="" disabled selected>Select frequency</option>
                                    <option value="<?= ONCE ?>">once</option>
                                    <option value="<?= DAILY ?>">daily</option>
                                    <option value="<?= WEEKLY ?>">weekly</option>
                                    <option value="<?= MONTHLY ?>">every month</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group <?php echo (isset($this->data['date'])) ? 'has-error' : '' ?>">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
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
                            <div class="" data-toggle="buttons">
                                <?php
                                foreach ($this->userList as $key => $user) {
                                    echo '<label class="btn btn-primary"><input type="checkbox" name="user[]" value="' . $key . '" tabindex="4">' . $user . '</label>';
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
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->