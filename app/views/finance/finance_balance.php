<!-- Balance tab -->
<div id="financeBalance" class="tab-pane fade">
    <!-- Clear Balance -->
    <div>
        <a class="btn btn-success" href="<?= URL ?>/finance/clearBalance" role="button">Clear Balance</a>
        <button type="submit" class="btn btn-primary pull-right" onClick="window.location.reload(true)">
            <span class="glyphicon glyphicon-repeat"></span>
        </button>
    </div>
    <br>
    <!-- Balance -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Finance Balance</h3>
        </div>
        <table class="table">
            <thead class="nopadding">
                <tr>
                    <th class="col-xs-2 col-md-4 nopadding"></th>
                    <th class="col-xs-5 col-md-4 nopadding"></th>
                    <th class="col-xs-5 col-md-4 nopadding"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                //Balance für jeden User anzeigen
                foreach ($this->userBalance as $balance) {
                    $diff = $balance['diff'];
                    if ($diff >= 0) {
                        $balance['plus'] = true;
                    } else {
                        $balance['minus'] = true;
                    }
                    ?>
                    <tr>
                        <td class="vertical-center"><?= $balance['display_name'] ?></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" <?php echo (isset($balance['minus'])) ? ' style="width: 100%;"' : ''?>>
                                    <?php echo (isset($balance['minus'])) ? $diff . ' ' . CURR : ''?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" <?php echo (isset($balance['plus'])) ? ' style="width: 100%;"' : ''?>>
                                    <?php echo (isset($balance['plus'])) ? $diff . ' ' . CURR : ''?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div><!-- end panel -->
</div>