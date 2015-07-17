<?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
<div id="mainContent" class="well">
    <!-- Label damit ganzer Content Rechts clickbar wird, wenn collapsed -->
    <label id="bigLabel" for="leftMenuBtn" class="bigLabel"></label>
    <div class="page-header">
        <h1><i class="fa fa-comment fa-fw"></i> <?= $this->data['title'] ?></h1>
    </div>

    <div class="alert alert-success" role="alert" <?php echo (Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
        <p>Please create or join a flat <a href="<?= URL ?>/settings/index"> here.</a></p>
    </div>

    <div id="whiteboardContent" <?php echo (!Session::getFlatId()) ? 'style="display:none;"' : '' ?>>
        <!-- Add To Whitebard -->
        <div id="addToWhiteboard">
            <form method="post" action="<?= URL ?>/whiteboard/addToWhiteboard">
                <div class="row">
                    <div class="col-xs-9 col-md-10 nopadding-right-xs">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font fa-lg"></i></span>
                            <input type="text" class="form-control" id="text" name="text" placeholder="Text" tabindex="1" autofocus>
                        </div>
                    </div>
                    <div class="col-xs-3 col-md-2 nopadding-left-xs">
                        <button type="submit" class="btn btn-success btn-block" tabindex="2">
                            <i class="fa fa-plus fa-lg"></i>
                        </button>
                    </div>
                </div><!-- end row -->
            </form>
        </div><!-- end addToWhiteboard -->
        <br>
        <!-- Whiteboard List -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Whiteboard</h3>
            </div>
            <?php
            // Loop durch nach Datum gruppiertes Array
            foreach ($this->whiteboardList as $key => $date) {
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-xs-10"><?= $key ?>
                            <th class="col-xs-1"></th>
                            <th class="col-xs-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop durch Einträge pro Datum
                        foreach ($this->whiteboardList[$key] as $entry) {
                            ?>
                            <tr>
                                <td><?= $entry['text'] ?></td>
                                <td><?= $entry['display_name'] ?> </td>
                                <td><?= $entry['time'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            <br>
                <?php
            }
            ?>
        </div><!-- end panel -->
    </div><!-- end whiteboardContent -->
</div><!-- end well -->