<?php require_once ROOT . '/app/views/app/left_nav.php'; ?>
<div id="mainContent" class="well">
    <!-- Label damit ganzer Content Rechts clickbar wird, wenn collapsed -->
    <label id="bigLabel" for="leftMenuBtn" class="bigLabel"></label>
    <div class="page-header">
        <h1>
            <i class="fa fa-comment fa-fw"></i> <?= $this->data['title'] ?>
            <button type="submit" class="btn btn-default btn-sm pull-right" onClick="window.location.reload(true)">
                <i class="fa fa-refresh fa-lg"></i>
            </button>
        </h1>
    </div>

    <?php if (!Session::getFlatId()) : ?>
        <div class="alert alert-success" role="alert">
            <p>Please create or join a flat <a href="<?= URL ?>/settings/index"> here.</a></p>
        </div>
    <?php endif; ?>
    <?php if (Session::getFlatId()) : ?>
        <div id="whiteboardContent">
            <!-- Add To Whitebard -->
            <div id="addToWhiteboard">
                <form method="post" action="<?= URL ?>/whiteboard/addToWhiteboard">
                    <div class="row">
                        <div class="col-xs-10 col-md-10 nopadding-right-xs">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-font fa-lg"></i></span>
                                <input type="text" class="form-control" id="text" name="text" placeholder="Text" tabindex="1" required>
                            </div>
                        </div>
                        <div class="col-xs-2 col-md-2 nopadding-left-xs">
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
                <?php if (empty($this->whiteboardList)) : ?>
                    <!-- no entries available -->
                    <div class="panel-body">
                        <p class="text-info noMargin">There are no entries available.</p>
                    </div>
                <?php endif; ?>

                <?php foreach ($this->whiteboardList as $key => $date) : // Loop durch nach Datum gruppiertes Array ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="col-xs-10"><?= $key ?></th>
                                <th class="col-xs-1"></th>
                                <th class="col-xs-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->whiteboardList[$key] as $entry) : // Loop durch Einträge pro Datum ?>
                                <tr>
                                    <td><?= $entry['text'] ?></td>
                                    <td class="text-right"><?= $entry['display_name'] ?> </td>
                                    <td><?= $entry['time'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <br>
                <?php endforeach; ?>
            </div><!-- end panel -->
        </div><!-- end whiteboardContent -->
    <?php endif; ?>
</div><!-- end well -->