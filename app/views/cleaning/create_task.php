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
                    <form method="post" action="<?= URL ?>/cleaning/createTask">
                        <div class="form-group">
                            <input type="text" id="title" name="title" class="form-control" placeholder="Title" tabindex="1" required autofocus>
                        </div>
                        <div class="form-group">
                            <!-- @todo auswahl per button -->
                            <select name="frequency" class="form-control" tabindex="2" required> 
                                <option value="" disabled selected>Select frequency</option>
                                <option value="once">once</option>
                                <option value="daily">daily</option>
                                <option value="weekly">weekly</option>
                                <option value="monthly">every month</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="weekday" class="form-control" tabindex="3" placeholder="bla" required> 
                                <option value="" disabled selected>Select weekday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>
                        </div>
                        <div class="form-group <?php echo (isset($this->data['date'])) ? 'has-error' : '' ?>">
                            <input type="date" id="start" name="start" class="form-control" placeholder="Start" tabindex="4" required>
                            <?php
                            if (isset($this->data['date'])) {
                                echo '<span class="help-block">Date format must be: "DD.MM.YYYY" or "YYYY-MM-DD"!</span>';
                            }
                            ?>
                        </div>
                        <p>Who has to do it?</p>
                        <div class="form-group <?php echo (isset($this->data['users'])) ? 'has-error' : '' ?>">
                            <div class="" data-toggle="buttons">
                                <?php
                                foreach ($this->userList as $key => $user) {
                                    echo '<label class="btn btn-primary"><input type="checkbox" name="user[]" value="' . $key . '">' . $user . '</label>';
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
                </div>
            </div>
        </div><!-- end well -->
    </div><!-- end col -->
</div><!-- end row -->