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
                            <input type="text" id="title" name="title" class="form-control" placeholder="Title" tabindex="1" required>
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
                                <option value="mo">Monday</option>
                                <option value="tu">Tuesday</option>
                                <option value="we">Wednesday</option>
                                <option value="th">Thursday</option>
                                <option value="fr">Friday</option>
                                <option value="sa">Saturday</option>
                                <option value="su">Sunday</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="date" id="start" name="start" class="form-control" placeholder="Start" tabindex="4" required>
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