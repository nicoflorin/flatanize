<!-- Balance tab -->
<div id="financeBalance" class="tab-pane fade">
    <!-- Clear Balance -->
    <div>
        <a class="btn btn-success" href="<?= URL ?>/finance/clearBalance" role="button">Clear Balance</a>
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
                    <th class="col-xs-5 col-md-5 nopadding"></th>
                    <th class="col-xs-2 col-md-2 nopadding"></th>
                    <th class="col-xs-5 col-md-5 nopadding"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->userBalance as $balance) : //Balance für jeden User anzeigen ?>
                    <?php
                    //Prüfen ob Differenz positiv oder negativ
                    $diff = $balance['diff'];
                    if ($diff >= 0) {
                        $balance['plus'] = true;
                        $diff = '+' . $diff . ' ' . CURR;
                    } else {
                        $balance['minus'] = true;
                        $diff = $diff . ' ' . CURR;
                    }
                    ?>
                    <tr>
                        <td>
                            <?php if (isset($balance['minus'])) : ?>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" <?php echo (isset($balance['minus'])) ? ' style="width: ' . $balance['perc'] . '%; float: right;"' : '' ?>>
                                    <span><?= $diff ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><i class="fa fa-user fa-lg"></i><br><?= $balance['display_name'] ?></td>
                        <td>
                            <?php if (isset($balance['plus'])) : ?>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" <?php echo (isset($balance['plus'])) ? ' style="width: ' . $balance['perc'] . '%;"' : '' ?>>
                                    <span><?= $diff ?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- end panel -->
</div>